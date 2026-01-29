<?php

namespace App\Console\Commands;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Console\Command;

class MigrateUsersToDonors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donors:migrate-from-users
                            {--dry-run : Affiche uniquement ce qui serait fait, sans rien écrire en base}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migre / synchronise les anciens enregistrements de la table users vers la table donors.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $this->info('--- Migration des donateurs depuis users vers donors ---');
        $this->line('Mode : ' . ($dryRun ? 'DRY-RUN (aucune écriture en base)' : 'RÉEL (écriture en base)'));

        $createdCount = 0;
        $updatedCount = 0;

        User::chunk(100, function ($users) use (&$createdCount, &$updatedCount, $dryRun) {
            foreach ($users as $user) {
                if (! $user->email) {
                    $this->warn("Utilisateur #{$user->id} ignoré (email manquant).");
                    continue;
                }

                $email = strtolower($user->email);

                /** @var \App\Models\Donor|null $existing */
                $existing = Donor::where('email', $email)->first();

                $payload = [
                    'first_name'      => $user->name, // à affiner plus tard si tu sépares prénom/nom
                    'last_name'       => '',
                    'email'           => $email,
                    'phone'           => $user->phone,
                    'country'         => $user->country,
                    'status'          => $existing?->status ?? 'active',
                    'wants_reports'   => $existing?->wants_reports ?? true,
                    'wants_newsletter'=> $existing?->wants_newsletter ?? false,
                    'is_anonymous'    => $existing?->is_anonymous ?? false,
                    'notes'           => trim(($existing?->notes ? $existing->notes . PHP_EOL : '') . 'Importé depuis la table users.'),
                ];

                if ($dryRun) {
                    $action = $existing ? 'Mettre à jour' : 'Créer';
                    $this->line("{$action} Donor pour user #{$user->id} ({$email})");
                    continue;
                }

                if ($existing) {
                    $existing->fill($payload);

                    if ($existing->isDirty()) {
                        $existing->save();
                        $updatedCount++;
                        $this->line("Mise à jour du donateur existant ({$email}).");
                    }
                } else {
                    Donor::create($payload);
                    $createdCount++;
                    $this->line("Création d'un nouveau donateur ({$email}).");
                }
            }
        });

        if ($dryRun) {
            $this->info('DRY-RUN terminé. Aucune donnée n\'a été modifiée.');
        } else {
            $this->info("Migration terminée : {$createdCount} donateur(s) créé(s), {$updatedCount} mis à jour.");
        }

        return self::SUCCESS;
    }
}

