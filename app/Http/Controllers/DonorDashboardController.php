<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class DonorDashboardController extends Controller
{
    /**
     * Affiche la page "Mon profil" publique.
     */
    public function profile()
    {
        $user = Auth::user();

        return view('donor.profile', compact('user'));
    }

    /**
     * Affiche la page "Mes dons".
     *
     * Pour l'instant, cette page affiche un message informatif.
     * Elle pourra être reliée plus tard aux vrais enregistrements de dons.
     */
    public function donations()
    {
        $user = Auth::user();

        return view('donor.donations', compact('user'));
    }

    /**
     * Affiche la page "Activités".
     *
     * Cette page pourra être enrichie avec le suivi détaillé des activités soutenues.
     */
    public function activities()
    {
        $user = Auth::user();

        return view('donor.activities', compact('user'));
    }

    /**
     * Met à jour le profil du donateur via AJAX (modal "Mon profil").
     */
    public function updateProfile(ProfileUpdateRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Vos informations ont été mises à jour avec succès.',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'country' => $user->country,
                'donation_period' => $user->donation_period,
                'donation_type' => $user->donation_type,
                'donation_amount' => $user->donation_amount,
                'donation_currency' => $user->donation_currency,
                'donation_description' => $user->donation_description,
            ],
        ]);
    }

    /**
     * Réception du formulaire "Envoyer mon don".
     * Pour l'instant, on se contente de valider et de stocker éventuellement les pièces jointes.
     */
    public function sendDonation(Request $request)
    {
        $request->validate([
            'donation_type' => ['required', 'in:espece,nature'],
            'payment_method' => ['nullable', 'in:mobile_money,carte_bancaire,cash'],
            'receipt_file_espece' => ['nullable', 'image', 'max:4096'],
            'details_espece' => ['nullable', 'string', 'max:2000'],
            'receipt_file_nature' => ['nullable', 'image', 'max:4096'],
            'details_nature' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($request->hasFile('receipt_file_espece')) {
            $request->file('receipt_file_espece')->store('donations/espece', 'public');
        }

        if ($request->hasFile('receipt_file_nature')) {
            $request->file('receipt_file_nature')->store('donations/nature', 'public');
        }

        return redirect()->route('monProfil')->with('status', 'Votre don a bien été transmis. Merci pour votre générosité !');
    }
}

