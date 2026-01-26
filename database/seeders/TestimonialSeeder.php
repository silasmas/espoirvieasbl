<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Marie Dupont',
                'role' => 'Bénévole',
                'photo' => 'https://images.pexels.com/photos/1065084/pexels-photo-1065084.jpeg?auto=compress&cs=tinysrgb&w=400',
                'content' => 'Espoir Vie ASBL a fait une différence incroyable dans ma vie et celle de ma famille. Leur dévouement et leur compassion sont vraiment remarquables. Je suis reconnaissante pour tout ce qu\'ils font pour la communauté.',
                'rating' => 5,
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Pierre Dubois',
                'role' => 'Donateur',
                'photo' => 'https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=400',
                'content' => 'Merci à Espoir Vie ASBL pour leur engagement exceptionnel. Votre travail fait vraiment une différence dans notre communauté. Je suis fier de soutenir votre cause depuis plusieurs années.',
                'rating' => 5,
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Claire Bernard',
                'role' => 'Partenaire',
                'photo' => 'https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg?auto=compress&cs=tinysrgb&w=400',
                'content' => 'Espoir Vie ASBL transforme des vies chaque jour. Leur transparence et leur dévouement sont exemplaires. En tant que partenaire, je peux témoigner de l\'impact réel de leurs actions sur le terrain.',
                'rating' => 5,
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'Sophie Martin',
                'role' => 'Bénévole',
                'photo' => 'https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=400',
                'content' => 'Grâce à Espoir Vie ASBL, j\'ai pu redonner espoir à ma famille. Leur aide a été déterminante dans une période difficile de notre vie. Merci pour votre générosité et votre soutien constant.',
                'rating' => 5,
                'is_active' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'Jean-Marc Leroy',
                'role' => 'Bénéficiaire',
                'photo' => 'https://images.pexels.com/photos/91227/pexels-photo-91227.jpeg?auto=compress&cs=tinysrgb&w=400',
                'content' => 'L\'association m\'a aidé à surmonter des moments très difficiles. Leur équipe est toujours disponible et à l\'écoute. Je recommande vivement Espoir Vie à tous ceux qui cherchent de l\'aide.',
                'rating' => 5,
                'is_active' => true,
                'display_order' => 5,
            ],
            [
                'name' => 'Isabelle Moreau',
                'role' => 'Entreprise partenaire',
                'photo' => 'https://images.pexels.com/photos/1181695/pexels-photo-1181695.jpeg?auto=compress&cs=tinysrgb&w=400',
                'content' => 'Notre entreprise est fière de collaborer avec Espoir Vie ASBL. Leur professionnalisme et leur engagement envers leur mission sont inspirants. Ensemble, nous faisons la différence.',
                'rating' => 4,
                'is_active' => true,
                'display_order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'role' => $testimonial['role']],
                $testimonial
            );
        }

        $this->command->info(count($testimonials) . ' témoignages créés/mis à jour avec succès !');
    }
}
