<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin principal (gardé pour la rétrocompatibilité)
        Admin::updateOrCreate(
            ['email' => 'silasjmas@gmail.com'],
            [
                'name' => 'Silas Mas',
                'password' => Hash::make('silasmas'),
                'photo' => 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=400',
                'position' => 'Directeur Général',
                'bio' => 'Fondateur et directeur général d\'Espoir Vie ASBL. Passionné par le développement communautaire et l\'éducation pour tous.',
                'is_team_visible' => true,
                'team_order' => 1,
            ]
        );

        // Membres de l'équipe pour la section "Notre équipe"
        $teamMembers = [
            [
                'name' => 'Marie Fontaine',
                'email' => 'marie.fontaine@espoirvie.org',
                'password' => Hash::make('password123'),
                'photo' => 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=400',
                'position' => 'Coordinatrice des projets',
                'bio' => 'Experte en gestion de projets humanitaires avec plus de 10 ans d\'expérience dans le secteur associatif.',
                'facebook_url' => 'https://facebook.com/',
                'twitter_url' => 'https://twitter.com/',
                'linkedin_url' => 'https://linkedin.com/',
                'instagram_url' => 'https://instagram.com/',
                'is_team_visible' => true,
                'team_order' => 2,
            ],
            [
                'name' => 'Jean-Pierre Mbeki',
                'email' => 'jp.mbeki@espoirvie.org',
                'password' => Hash::make('password123'),
                'photo' => 'https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=400',
                'position' => 'Responsable terrain',
                'bio' => 'Responsable de la coordination des activités sur le terrain. Engagé depuis 8 ans pour améliorer les conditions de vie des communautés.',
                'facebook_url' => 'https://facebook.com/',
                'linkedin_url' => 'https://linkedin.com/',
                'is_team_visible' => true,
                'team_order' => 3,
            ],
            [
                'name' => 'Sophie Lambert',
                'email' => 'sophie.lambert@espoirvie.org',
                'password' => Hash::make('password123'),
                'photo' => 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=400',
                'position' => 'Responsable communication',
                'bio' => 'Spécialiste en communication et relations publiques. Passionnée par le storytelling au service des causes humanitaires.',
                'twitter_url' => 'https://twitter.com/',
                'instagram_url' => 'https://instagram.com/',
                'is_team_visible' => true,
                'team_order' => 4,
            ],
            [
                'name' => 'David Nkomo',
                'email' => 'david.nkomo@espoirvie.org',
                'password' => Hash::make('password123'),
                'photo' => 'https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=400',
                'position' => 'Trésorier',
                'bio' => 'Expert-comptable de formation, il veille à la bonne gestion financière de l\'association et à la transparence de nos comptes.',
                'linkedin_url' => 'https://linkedin.com/',
                'is_team_visible' => true,
                'team_order' => 5,
            ],
        ];

        foreach ($teamMembers as $member) {
            Admin::updateOrCreate(
                ['email' => $member['email']],
                $member
            );
        }

        $this->command->info((count($teamMembers) + 1) . ' membres d\'équipe créés avec succès !');
    }
}
