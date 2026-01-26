<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Donner l\'éducation, c\'est le plus beau cadeau que l\'on puisse offrir',
                'slug' => 'donner-education-plus-beau-cadeau',
                'excerpt' => 'L\'éducation est la clé du développement. Découvrez comment nos programmes éducatifs transforment des vies et ouvrent des portes vers un avenir meilleur.',
                'content' => '<p>L\'éducation est la clé du développement durable. Chaque enfant mérite d\'avoir accès à une éducation de qualité, peu importe où il vit ou sa situation économique.</p>

<p>Chez Espoir Vie ASBL, nous croyons fermement que l\'éducation est le plus beau cadeau que l\'on puisse offrir à un enfant. C\'est pourquoi nous avons mis en place plusieurs programmes éducatifs qui ont déjà bénéficié à des milliers d\'enfants.</p>

<h3>Nos actions concrètes</h3>
<ul>
<li>Construction et rénovation d\'écoles dans les zones rurales</li>
<li>Distribution de fournitures scolaires</li>
<li>Formation des enseignants</li>
<li>Programmes de bourses pour les élèves méritants</li>
<li>Soutien scolaire et accompagnement</li>
</ul>

<p>Grâce à votre soutien, nous pouvons continuer à offrir ces opportunités à de nombreux enfants qui en ont besoin.</p>',
                'image' => 'https://images.pexels.com/photos/8613089/pexels-photo-8613089.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Éducation',
                'tags' => ['éducation', 'enfants', 'développement'],
                'author_name' => 'Équipe Espoir Vie',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(15),
                'views_count' => 245,
            ],
            [
                'title' => 'Ne traitons pas les océans comme des poubelles universelles',
                'slug' => 'ne-traitons-pas-oceans-poubelles',
                'excerpt' => 'La protection de l\'environnement fait partie de nos préoccupations. Ensemble, agissons pour préserver nos océans et notre planète.',
                'content' => '<p>La pollution des océans est un problème mondial qui affecte non seulement la vie marine mais aussi les communautés côtières qui dépendent de la pêche pour leur survie.</p>

<p>Chez Espoir Vie ASBL, nous intégrons la protection de l\'environnement dans nos projets de développement. Nous sensibilisons les communautés locales à l\'importance de préserver leur environnement.</p>

<h3>Nos initiatives environnementales</h3>
<ul>
<li>Campagnes de sensibilisation sur la gestion des déchets</li>
<li>Projets de nettoyage des plages et des cours d\'eau</li>
<li>Formation aux pratiques agricoles durables</li>
<li>Promotion de l\'utilisation de matériaux recyclables</li>
</ul>

<p>Chaque geste compte. Ensemble, nous pouvons faire la différence pour notre planète.</p>',
                'image' => 'https://images.pexels.com/photos/3186574/pexels-photo-3186574.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Environnement',
                'tags' => ['environnement', 'océans', 'sensibilisation'],
                'author_name' => 'Équipe Espoir Vie',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(10),
                'views_count' => 189,
            ],
            [
                'title' => 'Protéger nos plages pour les générations futures',
                'slug' => 'proteger-plages-generations-futures',
                'excerpt' => 'Les plages sont des écosystèmes précieux. Découvrez nos actions pour les préserver et les transmettre aux générations futures.',
                'content' => '<p>Les plages sont bien plus que des lieux de loisirs. Ce sont des écosystèmes fragiles qui abritent une biodiversité unique et jouent un rôle crucial dans la protection des côtes.</p>

<p>Dans le cadre de nos projets, nous travaillons avec les communautés locales pour protéger ces espaces naturels tout en promouvant un développement économique durable.</p>

<h3>Comment nous agissons</h3>
<ul>
<li>Organisation de journées de nettoyage avec les communautés locales</li>
<li>Sensibilisation des touristes et des résidents</li>
<li>Plantation de végétation côtière pour lutter contre l\'érosion</li>
<li>Soutien aux initiatives locales de protection</li>
</ul>

<p>La préservation de notre environnement est l\'affaire de tous. Rejoignez-nous dans cette mission importante.</p>',
                'image' => 'https://images.pexels.com/photos/1032650/pexels-photo-1032650.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Environnement',
                'tags' => ['environnement', 'plages', 'protection'],
                'author_name' => 'Équipe Espoir Vie',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(5),
                'views_count' => 156,
            ],
            [
                'title' => 'L\'accès à l\'eau potable : un droit fondamental',
                'slug' => 'acces-eau-potable-droit-fondamental',
                'excerpt' => 'L\'eau potable est essentielle à la vie. Découvrez nos projets pour apporter l\'eau aux communautés qui en ont le plus besoin.',
                'content' => '<p>L\'accès à l\'eau potable est un droit fondamental reconnu par les Nations Unies. Pourtant, des millions de personnes dans le monde n\'ont toujours pas accès à une eau propre et sûre.</p>

<p>Espoir Vie ASBL s\'engage à changer cette réalité en mettant en œuvre des projets d\'accès à l\'eau potable dans les communautés les plus vulnérables.</p>

<h3>Nos réalisations</h3>
<ul>
<li>Construction de puits et de forages</li>
<li>Installation de systèmes de filtration d\'eau</li>
<li>Formation aux bonnes pratiques d\'hygiène</li>
<li>Sensibilisation à la gestion durable des ressources en eau</li>
</ul>

<p>Chaque puits construit, c\'est une communauté entière qui retrouve l\'espoir et la santé.</p>',
                'image' => 'https://images.pexels.com/photos/2962135/pexels-photo-2962135.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Santé',
                'tags' => ['eau', 'santé', 'développement'],
                'author_name' => 'Équipe Espoir Vie',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(20),
                'views_count' => 312,
            ],
            [
                'title' => 'Témoignage : Comment votre don change des vies',
                'slug' => 'temoignage-comment-don-change-vies',
                'excerpt' => 'Découvrez l\'histoire touchante de familles dont la vie a été transformée grâce à la générosité de nos donateurs.',
                'content' => '<p>Chaque don, même le plus petit, a le pouvoir de transformer des vies. Aujourd\'hui, nous souhaitons partager avec vous quelques témoignages de familles qui ont bénéficié de votre générosité.</p>

<blockquote>
"Grâce à Espoir Vie, mes trois enfants peuvent maintenant aller à l\'école. C\'est un rêve qui devient réalité." - Marie, mère de famille
</blockquote>

<blockquote>
"L\'eau potable dans notre village a changé notre quotidien. Mes enfants ne sont plus malades comme avant." - Joseph, chef de village
</blockquote>

<p>Ces histoires nous rappellent pourquoi notre mission est si importante. Merci à tous nos donateurs qui rendent cela possible.</p>

<h3>L\'impact de vos dons</h3>
<ul>
<li>10€ = fournitures scolaires pour un enfant pendant un an</li>
<li>25€ = repas nutritifs pour une famille pendant un mois</li>
<li>50€ = accès à l\'eau potable pour une famille</li>
<li>100€ = formation professionnelle pour un jeune</li>
</ul>',
                'image' => 'https://images.pexels.com/photos/6646918/pexels-photo-6646918.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Témoignages',
                'tags' => ['don', 'impact', 'témoignages'],
                'author_name' => 'Équipe Espoir Vie',
                'is_published' => true,
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(3),
                'views_count' => 423,
            ],
            [
                'title' => 'Bilan annuel : Une année riche en réalisations',
                'slug' => 'bilan-annuel-annee-riche-realisations',
                'excerpt' => 'Retour sur une année exceptionnelle pour Espoir Vie ASBL. Découvrez nos réalisations et nos projets pour l\'avenir.',
                'content' => '<p>L\'année qui vient de s\'écouler a été riche en défis et en réalisations. Grâce à votre soutien indéfectible, nous avons pu accomplir beaucoup.</p>

<h3>Nos chiffres clés</h3>
<ul>
<li>5 000 enfants scolarisés</li>
<li>20 puits construits</li>
<li>1 500 familles aidées</li>
<li>50 enseignants formés</li>
<li>10 nouvelles communautés accompagnées</li>
</ul>

<h3>Perspectives pour l\'année à venir</h3>
<p>Nous avons de grands projets pour l\'année à venir, notamment l\'expansion de nos programmes dans de nouvelles régions et le lancement d\'initiatives innovantes en matière de formation professionnelle.</p>

<p>Merci à tous nos bénévoles, donateurs et partenaires qui rendent cette mission possible.</p>',
                'image' => 'https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=800',
                'category' => 'Actualités',
                'tags' => ['bilan', 'réalisations', 'perspectives'],
                'author_name' => 'Équipe Espoir Vie',
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(30),
                'views_count' => 567,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }

        $this->command->info(count($articles) . ' articles créés/mis à jour avec succès !');
    }
}
