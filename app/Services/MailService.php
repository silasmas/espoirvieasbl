<?php

namespace App\Services;

use App\Mail\DonationConfirmationEmail;
use App\Mail\PartnerSubscriptionEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailService
{
    /**
     * Envoie un email de confirmation de don
     *
     * @param array $donationData Données du don
     * @param string $toEmail Adresse email du donateur
     * @return bool
     */
    public function sendDonationConfirmation(array $donationData, string $toEmail): bool
    {
        try {
            Mail::to($toEmail)->send(new DonationConfirmationEmail($donationData));
            return true;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de confirmation de don : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoie un email de confirmation de demande de partenariat
     *
     * @param array $partnerData Données du partenaire
     * @param string $toEmail Adresse email du partenaire
     * @return bool
     */
    public function sendPartnerSubscription(array $partnerData, string $toEmail): bool
    {
        try {
            Mail::to($toEmail)->send(new PartnerSubscriptionEmail($partnerData));
            return true;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de partenariat : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoie un email personnalisé avec des données dynamiques
     *
     * @param string $toEmail Adresse email du destinataire
     * @param string $subject Sujet de l'email
     * @param string $view Vue Blade à utiliser
     * @param array $data Données à passer à la vue
     * @return bool
     */
    public function sendCustomEmail(string $toEmail, string $subject, string $view, array $data = []): bool
    {
        try {
            Mail::send($view, $data, function ($message) use ($toEmail, $subject) {
                $message->to($toEmail)
                        ->subject($subject);
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email personnalisé : ' . $e->getMessage());
            return false;
        }
    }
}
