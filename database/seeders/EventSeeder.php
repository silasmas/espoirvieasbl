<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Événements futurs (planned)
        $futureEvents = [
            [
                'title' => 'Concert de solidarité 2025',
                'short_description' => 'Grande soirée musicale au profit de nos projets éducatifs avec des artistes locaux et internationaux.',
                'description' => 'Rejoignez-nous pour une soirée exceptionnelle de musique et de solidarité. Plusieurs artistes locaux et internationaux se produiront pour soutenir nos projets d\'éducation. Les fonds collectés financeront la construction d\'écoles primaires dans les zones rurales. Au programme : concerts, témoignages de bénéficiaires, exposition photos et buffet convivial.',
                'category' => 'Collecte de fonds',
                'type' => 'event',
                'status' => 'planned',
                'location' => 'Palais des Congrès',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => true,
            ],
            [
                'title' => 'Marche solidaire pour l\'éducation',
                'short_description' => 'Marche de 10 km à travers la ville pour sensibiliser à l\'importance de l\'éducation pour tous.',
                'description' => 'Participez à notre marche annuelle de 10 km à travers les rues de Bruxelles. Cette marche vise à sensibiliser le public à l\'importance de l\'éducation pour tous, notamment pour les filles et les enfants des zones rurales. Inscription gratuite, collecte de fonds optionnelle. T-shirts de la marche offerts aux 100 premiers inscrits.',
                'category' => 'Sensibilisation',
                'type' => 'event',
                'status' => 'planned',
                'location' => 'Parc de Bruxelles',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/1062422/pexels-photo-1062422.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
            ],
            [
                'title' => 'Exposition photos : "Espoir en Afrique"',
                'short_description' => 'Exposition photographique retraçant nos actions et leur impact sur le terrain.',
                'description' => 'Venez découvrir notre exposition photographique "Espoir en Afrique" qui présente nos projets, nos bénéficiaires et l\'impact de nos actions. Plus de 50 photos grand format racontent l\'histoire de l\'espoir retrouvé grâce à la solidarité. Entrée libre, dons libres. Les photos seront vendues aux enchères au profit de nos projets.',
                'category' => 'Culture',
                'type' => 'event',
                'status' => 'planned',
                'location' => 'Galerie d\'Art Contemporain',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(1)->addDays(14)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/186077/pexels-photo-186077.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => true,
            ],
            [
                'title' => 'Atelier de cuisine africaine',
                'short_description' => 'Apprenez à cuisiner des plats traditionnels africains tout en soutenant nos projets.',
                'description' => 'Participez à un atelier de cuisine animé par des chefs africains qui vous apprendront à préparer des plats traditionnels. Chaque participant repart avec ses recettes et des produits locaux. Les bénéfices de l\'atelier financent nos programmes de nutrition pour les enfants. Limité à 20 participants.',
                'category' => 'Découverte',
                'type' => 'event',
                'status' => 'planned',
                'location' => 'École de cuisine',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->addWeeks(4)->format('Y-m-d'),
                'end_date' => Carbon::now()->addWeeks(4)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
            ],
            [
                'title' => 'Conférence : "L\'éducation, clé du développement"',
                'short_description' => 'Conférence-débat avec des experts sur l\'importance de l\'éducation dans le développement durable.',
                'description' => 'Assistez à une conférence inspirante sur le rôle de l\'éducation dans le développement durable. Intervenants : experts en éducation, représentants d\'ONG, et bénéficiaires de nos programmes qui témoigneront de leur parcours. Suivie d\'un débat et d\'un cocktail convivial. Entrée gratuite, inscription requise.',
                'category' => 'Éducation',
                'type' => 'event',
                'status' => 'planned',
                'location' => 'Université Libre de Bruxelles',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->addMonths(2)->addDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(2)->addDays(10)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/3184460/pexels-photo-3184460.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
            ],
            [
                'title' => 'Festival des cultures africaines',
                'short_description' => 'Week-end de festivités célébrant les cultures africaines avec musique, danse et artisanat.',
                'description' => 'Grand festival de 3 jours célébrant la richesse culturelle africaine. Au programme : concerts, spectacles de danse traditionnelle, stands d\'artisanat, cuisine africaine, ateliers pour enfants. Les bénéfices financeront nos projets d\'éducation et de santé. Prix d\'entrée : 15€, gratuit pour les moins de 12 ans.',
                'category' => 'Culture',
                'type' => 'event',
                'status' => 'planned',
                'location' => 'Parc des Expositions',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->addMonths(4)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(4)->addDays(2)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/1154196/pexels-photo-1154196.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => true,
            ],
        ];

        // Événements en cours (ongoing)
        $ongoingEvents = [
            [
                'title' => 'Campagne de collecte de fonds mensuelle',
                'short_description' => 'Collecte de fonds en cours pour financer nos projets d\'éducation en cours.',
                'description' => 'Campagne de collecte de fonds en cours pour soutenir nos projets d\'éducation dans les zones rurales. Chaque don, même petit, fait la différence. Les fonds collectés permettent d\'équiper des écoles, de fournir des fournitures scolaires et de former des enseignants. Campagne ouverte jusqu\'à la fin du mois.',
                'category' => 'Collecte de fonds',
                'type' => 'event',
                'status' => 'ongoing',
                'location' => 'En ligne',
                'country' => 'International',
                'start_date' => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end_date' => Carbon::now()->endOfMonth()->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/5905492/pexels-photo-5905492.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
            ],
        ];

        // Événements passés (completed)
        $pastEvents = [
            [
                'title' => 'Gala de bienfaisance 2024',
                'short_description' => 'Soirée de gala qui a réuni plus de 300 personnes et collecté 50 000€ pour nos projets.',
                'description' => 'Notre gala annuel 2024 a été un immense succès ! Plus de 300 personnes ont participé à cette soirée de solidarité qui a permis de collecter 50 000€ pour nos projets d\'éducation et de santé. Au programme : dîner gastronomique, témoignages touchants, vente aux enchères d\'œuvres d\'art, et prestation musicale exceptionnelle.',
                'category' => 'Collecte de fonds',
                'type' => 'event',
                'status' => 'completed',
                'location' => 'Hôtel Métropole',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->subMonths(6)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(6)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
                'amount_raised' => 50000.00,
            ],
            [
                'title' => 'Journée portes ouvertes',
                'short_description' => 'Journée d\'information et de découverte de nos activités pour le grand public.',
                'description' => 'Nous avons ouvert nos portes au public pour une journée de découverte de nos activités. Les visiteurs ont pu rencontrer notre équipe, découvrir nos projets, participer à des ateliers et visiter notre exposition. Plus de 500 personnes ont participé à cette journée enrichissante.',
                'category' => 'Sensibilisation',
                'type' => 'event',
                'status' => 'completed',
                'location' => 'Siège de l\'association',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/3184460/pexels-photo-3184460.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
            ],
            [
                'title' => 'Marche caritative 2024',
                'short_description' => 'Marche de solidarité qui a réuni plus de 1000 participants et collecté 25 000€.',
                'description' => 'Notre marche caritative annuelle a été un grand succès avec plus de 1000 participants de tous âges. Cette marche de 10 km à travers Bruxelles a permis de collecter 25 000€ pour nos projets d\'éducation. Une belle journée de solidarité et de convivialité sous le soleil !',
                'category' => 'Sensibilisation',
                'type' => 'event',
                'status' => 'completed',
                'location' => 'Parc de Bruxelles',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->subMonths(8)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(8)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/1062422/pexels-photo-1062422.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
                'amount_raised' => 25000.00,
            ],
            [
                'title' => 'Vente de charité',
                'short_description' => 'Vente de vêtements, objets et livres d\'occasion au profit de nos projets.',
                'description' => 'Grande vente de charité organisée avec la participation de nombreux bénévoles et donateurs. Vente de vêtements, livres, objets divers et artisanat. Les bénéfices ont permis de financer nos programmes de nutrition pour les enfants. Merci à tous les participants et donateurs !',
                'category' => 'Collecte de fonds',
                'type' => 'event',
                'status' => 'completed',
                'location' => 'Salle communale',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/159751/book-address-book-learning-learn-159751.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
                'amount_raised' => 12000.00,
            ],
            [
                'title' => 'Atelier de sensibilisation scolaire',
                'short_description' => 'Interventions dans les écoles pour sensibiliser les élèves à la solidarité internationale.',
                'description' => 'Nous avons visité 15 écoles primaires et secondaires pour sensibiliser plus de 2000 élèves à la solidarité internationale et aux défis du développement. Ateliers interactifs, témoignages, jeux éducatifs et collecte de fournitures scolaires. Les élèves ont montré un grand enthousiasme et une belle générosité.',
                'category' => 'Éducation',
                'type' => 'event',
                'status' => 'completed',
                'location' => 'Écoles de Bruxelles',
                'country' => 'Belgique',
                'start_date' => Carbon::now()->subMonths(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'image' => 'https://images.pexels.com/photos/2081199/pexels-photo-2081199.jpeg?auto=compress&cs=tinysrgb&w=800',
                'is_featured' => false,
            ],
        ];

        $allEvents = array_merge($futureEvents, $ongoingEvents, $pastEvents);

        foreach ($allEvents as $eventData) {
            Activity::create(array_merge($eventData, [
                'tags' => ['événement', 'solidarité', 'collecte de fonds'],
                'impact' => 'Cet événement contribue à sensibiliser le public et à collecter des fonds pour nos projets humanitaires.',
                'results' => 'Les résultats seront communiqués après l\'événement.',
                'views_count' => rand(50, 2000),
                'likes_count' => rand(10, 500),
                'is_public' => true,
                'include_in_reports' => true,
            ]));
        }

        $this->command->info(count($allEvents) . ' événements créés avec succès !');
    }
}
