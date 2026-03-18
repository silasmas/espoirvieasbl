<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Callback FlexPay – reçoit le résultat de la transaction envoyé par FlexPay.
 * Documentation v1.4 : FlexPay envoie une requête à callbackUrl avec :
 * code (0 = succès), reference, provider_reference, orderNumber.
 * Cette route doit être exclue de la vérification CSRF (appel externe).
 */
class FlexPayCallbackController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $code = $request->input('code');
        $reference = $request->input('reference');
        $orderNumber = $request->input('orderNumber');
        $providerReference = $request->input('provider_reference');

        Log::info('FlexPay callback received', [
            'code' => $code,
            'reference' => $reference,
            'orderNumber' => $orderNumber,
        ]);

        $donation = Donation::where('payment_reference', $reference)->first();
        if (!$donation) {
            Log::warning('FlexPay callback: donation not found', ['reference' => $reference]);
            return response()->json(['received' => true]);
        }

        if ($code === '0' || $code === 0) {
            $donation->update([
                'status' => 'completed',
                'paid_at' => now(),
                'transaction_id' => $providerReference,
                'metadata' => array_merge($donation->metadata ?? [], [
                    'flexpay_order_number' => $orderNumber,
                    'flexpay_provider_reference' => $providerReference,
                    'flexpay_callback_at' => now()->toIso8601String(),
                ]),
            ]);
            Log::info('FlexPay callback: donation marked as paid', ['reference' => $reference]);
        } else {
            $donation->update([
                'metadata' => array_merge($donation->metadata ?? [], [
                    'flexpay_order_number' => $orderNumber,
                    'flexpay_callback_code' => $code,
                    'flexpay_callback_at' => now()->toIso8601String(),
                ]),
            ]);
            Log::info('FlexPay callback: transaction not successful', ['reference' => $reference, 'code' => $code]);
        }

        return response()->json(['received' => true]);
    }
}
