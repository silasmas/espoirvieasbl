<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service FlexPay – API de paiement (documentation v1.4).
 * Payment Service : envoi d'une requête de paiement (mobile money ou carte).
 * Check transaction : vérification de l'état d'une transaction.
 */
class FlexPayService
{
    protected string $baseUrl;
    protected string $token;
    protected string $merchant;

    public function __construct()
    {
        $this->baseUrl = config('flexpay.api_url', '');
        $this->token = config('flexpay.token', '');
        $this->merchant = config('flexpay.merchant', '');
    }

    /**
     * URL du Payment Service (Mobile Money).
     * Priorité : FLEXPAY_GATEWAY_MOBILE, sinon api_url + /api/rest/v1/paymentService
     */
    protected function getPaymentUrl(): string
    {
        $gateway = config('flexpay.gateway_mobile', '');
        if ($gateway !== '') {
            return $gateway;
        }
        return $this->baseUrl . '/api/rest/v1/paymentService';
    }

    /**
     * URL de base pour Check transaction.
     * Priorité : FLEXPAY_GATEWAY_CHECK, sinon api_url + /api/rest/v1/check
     */
    protected function getCheckBaseUrl(): string
    {
        $gateway = config('flexpay.gateway_check', '');
        if ($gateway !== '') {
            return $gateway;
        }
        return $this->baseUrl . '/api/rest/v1/check';
    }

    /**
     * Envoie une requête de paiement à FlexPay (Payment Service).
     * type: "1" = mobile money, "2" = carte bancaire.
     * Réponse: code "0" = requête envoyée, message, orderNumber.
     */
    public function payment(string $reference, string $phone, float $amount, string $currency, string $callbackUrl, string $type = '1'): array
    {
        $url = $this->getPaymentUrl();
        $phone = $this->normalizePhone($phone);

        $body = [
            'merchant' => $this->merchant,
            'type' => $type,
            'reference' => $reference,
            'phone' => $phone,
            'amount' => (string) $amount,
            'currency' => $currency,
            'callbackUrl' => $callbackUrl,
        ];

        try {
            $response = Http::withToken($this->token)
                ->acceptJson()
                ->timeout(30)
                ->post($url, $body);

            $data = $response->json();
            $code = $data['code'] ?? $response->status();
            $message = $data['message'] ?? $data['error'] ?? $data['msg'] ?? $response->reason();
            $orderNumber = $data['orderNumber'] ?? null;

            return [
                'success' => $code === '0' || $code === 0,
                'code' => $code,
                'message' => $message,
                'orderNumber' => $orderNumber,
            ];
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('FlexPay payment error: ' . $errorMsg);
            return [
                'success' => false,
                'code' => '1',
                'message' => $errorMsg,
                'orderNumber' => null,
            ];
        }
    }

    /**
     * Vérifie l'état d'une transaction (Check transaction).
     * GET {base_url}/api/rest/v1/check/{orderNumber}
     * Réponse: code, message, transaction (reference, orderNumber, status, amount, currency, createdAt).
     * status: "0" = succès, "1" = échec.
     */
    public function checkTransaction(string $orderNumber): array
    {
        $url = $this->getCheckBaseUrl() . '/' . urlencode($orderNumber);

        try {
            $response = Http::withToken($this->token)
                ->acceptJson()
                ->timeout(15)
                ->get($url);

            $data = $response->json();
            $code = $data['code'] ?? $response->status();
            $message = $data['message'] ?? $data['error'] ?? $data['msg'] ?? $response->reason();
            $transaction = $data['transaction'] ?? null;

            $success = ($code === '0' || $code === 0) && $transaction !== null;
            $status = $transaction['status'] ?? null; // "0" = paid, "1" = failed

            return [
                'success' => $success,
                'code' => $code,
                'message' => $message,
                'transaction' => $transaction,
                'paid' => $status === '0' || $status === 0,
            ];
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('FlexPay check transaction error: ' . $errorMsg);
            return [
                'success' => false,
                'code' => '1',
                'message' => $errorMsg,
                'transaction' => null,
                'paid' => false,
            ];
        }
    }

    /**
     * Initie un paiement par carte bancaire.
     * Redirige l'utilisateur vers la page FlexPay pour saisir ses coordonnées.
     *
     * @param float  $amount      Montant à payer
     * @param string $currency    Devise (USD, CDF)
     * @param string $reference   Référence unique de la transaction
     * @param string $description Description affichée (ex: "Don spontané")
     * @return array ['success' => bool, 'url' => string|null, 'orderNumber' => string|null, 'message' => string]
     */
    public function initiateCardPayment(float $amount, string $currency, string $reference, string $description = 'Don spontané'): array
    {
        $gateway = config('flexpay.gateway_card', '');
        if ($gateway === '') {
            return [
                'success' => false,
                'url' => null,
                'orderNumber' => null,
                'message' => 'FlexPay carte non configuré (FLEXPAY_GATEWAY_CARD manquant).',
            ];
        }

        $baseRedirectUrl = rtrim(config('app.url'), '/') . '/paid/' . urlencode($reference) . '/' . $amount . '/' . $currency;
        $callbackUrl = url()->route('flexpay.callback');

        $body = [
            'authorization' => 'Bearer ' . $this->token,
            'merchant' => $this->merchant,
            'reference' => $reference,
            'amount' => (string) $amount,
            'currency' => $currency,
            'description' => $description,
            'callback_url' => $callbackUrl,
            'approve_url' => $baseRedirectUrl . '/success',
            'cancel_url' => $baseRedirectUrl . '/cancel',
            'decline_url' => $baseRedirectUrl . '/decline',
            'home_url' => rtrim(config('app.url'), '/') . '/',
        ];

        try {
            $response = Http::acceptJson()
                ->timeout(30)
                ->asJson()
                ->post($gateway, $body);

            $data = $response->json();
            $code = $data['code'] ?? $response->status();
            $message = $data['message'] ?? $data['error'] ?? $data['msg'] ?? $response->reason();
            $url = $data['url'] ?? null;
            $orderNumber = $data['orderNumber'] ?? null;

            $success = $code === '0' || $code === 0;

            return [
                'success' => $success,
                'url' => $url,
                'orderNumber' => $orderNumber,
                'message' => $message,
            ];
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('FlexPay card payment error: ' . $errorMsg);
            return [
                'success' => false,
                'url' => null,
                'orderNumber' => null,
                'message' => $errorMsg,
            ];
        }
    }

    /**
     * Normalise le numéro de téléphone pour FlexPay (format RDC 243XXXXXXXXX).
     */
    protected function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\s+/', '', $phone);
        $phone = preg_replace('/[^0-9+]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '243' . substr($phone, 1);
        } elseif (!str_starts_with($phone, '243')) {
            $phone = '243' . ltrim($phone, '+');
        }
        return $phone;
    }
}
