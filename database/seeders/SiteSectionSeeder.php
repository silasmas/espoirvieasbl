<?php

namespace Database\Seeders;

use App\Models\SiteSection;
use Illuminate\Database\Seeder;

/**
 * Insère les rubriques du site avec les textes corrigés d'après
 * l'historique de l'ONG Espoir Vie. Ne remplace pas une rubrique déjà modifiée.
 */
class SiteSectionSeeder extends Seeder
{
    /**
     * Crée chaque rubrique une seule fois, identifiée par sa clé.
     */
    public function run(): void
    {
        foreach ($this->sections() as $section) {
            SiteSection::query()->firstOrCreate(
                ['key' => $section['key']],
                $section
            );
        }
    }

    /**
     * Contenu initial, des informations générales vers les pages détaillées.
     *
     * @return list<array<string, mixed>>
     */
    private function sections(): array
    {
        return [
            $this->section(
                'global.identity',
                'global',
                'Identité de l\'association',
                'Nom, devise et présentation courte. Ces textes apparaissent dans le pied de page et comme référence de l\'organisation. Le logo remplace celui du site s\'il est renseigné.',
                1,
                'Enfant joyeux, sourire retrouvé.',
                'Espoir Vie ASBL',
                'Espoir Vie est une association sans but lucratif de droit congolais, à caractère humanitaire et socio-éducatif. Créée en 2000 à Kinshasa par Christian Izeidi Balondo Kweinkim, elle protège, soigne, éduque et accompagne les enfants orphelins et les personnes en situation de grande vulnérabilité.'
            ),
            $this->section(
                'global.contact',
                'global',
                'Coordonnées',
                'Adresse, e-mail, téléphone et carte. Le document historique ne donne pas de numéro officiel : laissez le téléphone vide tant que le numéro réel n\'est pas confirmé. Ces coordonnées sont reprises dans le pied de page, la page contact et les appels à l\'action.',
                2,
                null,
                'Nous contacter',
                null,
                extra: [
                    'address' => 'Kinshasa, République démocratique du Congo',
                    'email' => 'info@espoirvieasbl.org',
                    'phone' => '',
                    'map_embed' => 'https://maps.google.com/maps?q=Kinshasa,%20RDC&z=12&output=embed',
                ]
            ),
            $this->section(
                'global.social',
                'global',
                'Réseaux sociaux',
                'Collez l\'adresse complète de chaque réseau (https://...). Un champ vide masque l\'icône. N\'inventez pas de liens.',
                3,
                extra: [
                    'facebook' => '',
                    'twitter' => '',
                    'instagram' => '',
                    'linkedin' => '',
                    'youtube' => '',
                ]
            ),
            $this->section(
                'global.stats',
                'global',
                'Chiffres clés',
                'Ces chiffres viennent de l\'historique remis par l\'association (environ 3 000 enfants accompagnés depuis 2001, une cinquantaine de membres, création en 2000, moyenne estimée de 120 bénéficiaires par an). Vérifiez-les avant de les laisser affichés. Masquez la rubrique si un chiffre n\'est pas confirmé.',
                4,
                'En chiffres',
                'Ce que l\'historique retient',
                null,
                items: [
                    ['number' => '3 000+', 'text' => 'Enfants accompagnés depuis 2001', 'title' => '', 'image' => null],
                    ['number' => '50', 'text' => 'Membres engagés à l\'origine', 'title' => '', 'image' => null],
                    ['number' => '2000', 'text' => 'Année de création de l\'ONG', 'title' => '', 'image' => null],
                    ['number' => '120', 'text' => 'Bénéficiaires par an, en moyenne', 'title' => '', 'image' => null],
                ]
            ),
            $this->menu('menu.home', 1, 'Accueil'),
            $this->menu('menu.about', 2, 'À propos'),
            $this->menu('menu.team', 3, 'Notre équipe'),
            $this->menu('menu.events', 4, 'Événements'),
            $this->menu('menu.articles', 5, 'Articles'),
            $this->menu('menu.donate', 6, 'Faire un don'),
            $this->menu('menu.contact', 7, 'Nous contacter'),
            $this->section(
                'home.banner',
                'home',
                'Bannière d\'accueil',
                'Premier bloc de la page d\'accueil. Le chiffre affiché à côté du bouton ne doit pas être un nombre inventé : il reprend ici les enfants accompagnés cités dans l\'historique.',
                1,
                'Enfant joyeux, sourire retrouvé.',
                'Redonner espoir aux enfants orphelins et vulnérables',
                'Rejoignez Espoir Vie, association humanitaire et socio-éducative créée en 2000 à Kinshasa. Ensemble, nous protégeons, soignons, éduquons et accompagnons les enfants et les familles qui en ont le plus besoin.',
                'Faire un don',
                'donate',
                extra: [
                    'stat_number' => '3 000+',
                    'stat_label' => 'Enfants accompagnés',
                ]
            ),
            $this->section(
                'home.about',
                'home',
                'Présentation sur l\'accueil',
                'Résumé affiché sur l\'accueil. Le récit complet se modifie dans les rubriques de la page À propos.',
                2,
                'À propos de nous',
                'Une vocation personnelle devenue une organisation en 2000',
                'Dès l\'âge de 12 ans, Christian Izeidi Balondo Kweinkim consacre une partie de ses moyens aux personnes démunies. En 2000, face aux enfants abandonnés et vivant dans la rue, cette initiative devient Espoir Vie : une action collective et durable, au service de la dignité de l\'enfant.',
                'En savoir plus',
                'about',
                items: [
                    ['title' => '', 'number' => '', 'text' => 'Devise : Enfant joyeux, sourire retrouvé.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Soins, éducation, protection et réinsertion.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Ouverts aux partenaires et aux personnes de bonne volonté.', 'image' => null],
                ],
                extra: [
                    'block_title' => 'Notre engagement',
                ]
            ),
            $this->section(
                'home.donations',
                'home',
                'Projets à soutenir',
                'Titre du bandeau des projets. Les projets eux-mêmes (photo, montant, texte) se gèrent dans le menu Activités. Masquer cette rubrique retire tout le bandeau.',
                3,
                'Aidez-nous et faites un don',
                'Soutenir les enfants orphelins et les familles vulnérables',
                null,
                buttonLabel: 'Faire un don',
                buttonUrl: 'donate',
                extra: [
                    'stat_number' => '3 000+',
                    'stat_label' => 'Enfants accompagnés',
                ]
            ),
            $this->section(
                'home.donate_cta',
                'home',
                'Appel au don sur l\'accueil',
                'Bloc coloré d\'appel au don. Laissez « Montant collecté » et « Objectif » vides pour ne pas afficher une barre de progression fictive. Le bouton ouvre le vrai formulaire de don.',
                4,
                'Faire un don maintenant',
                'Soutenez les enfants orphelins et vulnérables',
                'Votre don finance l\'assistance médicale, l\'éducation, la protection et l\'accompagnement des enfants que la précarité prive de soins, d\'école et de dignité.',
                buttonLabel: 'Faire un don',
                buttonUrl: 'donate',
                extra: [
                    'raised' => '',
                    'goal' => '',
                ]
            ),
            $this->section(
                'home.events',
                'home',
                'Événements sur l\'accueil',
                'Titre du bloc événements. Les événements se créent dans Activités, avec le type « événement ». Masquer cette rubrique cache le bloc, pas la page Événements.',
                5,
                'Événements à venir',
                'Les rendez-vous d\'Espoir Vie',
                null,
                buttonLabel: 'Voir les événements',
                buttonUrl: 'events'
            ),
            $this->section(
                'home.why_join',
                'home',
                'Pourquoi nous soutenir',
                'Texte et accordéon. Chaque élément de la liste est un volet : titre + texte. L\'image se remplace par une photo réelle de l\'association.',
                6,
                'Rejoignez-nous',
                'Pourquoi soutenir Espoir Vie',
                'Pendant des années, Espoir Vie a financé ses actions surtout par les cotisations de ses membres. L\'association ouvre aujourd\'hui ses portes aux partenaires nationaux et internationaux, aux fondations, aux entreprises, aux parrains et aux personnes de bonne volonté.',
                items: [
                    ['title' => 'Accroître le nombre d\'enfants accompagnés', 'number' => '', 'text' => 'Les besoins dépassent les seules cotisations des membres. Un partenariat permet de soigner, scolariser et protéger davantage d\'enfants.', 'image' => null],
                    ['title' => 'Des programmes durables', 'number' => '', 'text' => 'Santé, éducation, formation, accueil et activités agro-pastorales : l\'objectif est de passer de l\'aide ponctuelle à un accompagnement qui restaure l\'autonomie.', 'image' => null],
                    ['title' => 'La même conviction depuis l\'origine', 'number' => '', 'text' => 'Partir d\'un besoin réel, agir avec les moyens disponibles, et construire peu à peu des solutions autour de la personne vulnérable.', 'image' => null],
                ]
            ),
            $this->section(
                'home.team',
                'home',
                'Équipe sur l\'accueil',
                'Titre du bloc équipe. Les personnes, photos et fonctions se gèrent dans Administrateurs : cochez « visible sur le site ». Masquer cette rubrique retire le bloc de l\'accueil.',
                7,
                'Notre équipe',
                'Des personnes engagées auprès des enfants vulnérables',
                null,
                buttonLabel: 'Voir toute l\'équipe',
                buttonUrl: 'team'
            ),
            $this->section(
                'home.testimonials',
                'home',
                'Témoignages sur l\'accueil',
                'Titre du bloc. Les témoignages se saisissent dans le menu Témoignages. Aucun témoignage fictif n\'est affiché si la liste est vide.',
                8,
                'Témoignages',
                'La parole de celles et ceux qui nous accompagnent',
                null
            ),
            $this->section(
                'home.blog',
                'home',
                'Actualités sur l\'accueil',
                'Titre du bloc articles. Les articles se rédigent dans le menu Articles. Masquer cette rubrique retire le bloc de l\'accueil.',
                9,
                'Derniers articles',
                'Les actions et les nouvelles d\'Espoir Vie',
                'Suivez les activités de terrain, les projets et les informations publiées par l\'association.',
                buttonLabel: 'Voir tous les articles',
                buttonUrl: 'articles'
            ),
            $this->section(
                'home.gallery',
                'home',
                'Galerie photos',
                'Ajoutez des photos réelles dans la liste. Tant qu\'aucune photo n\'est chargée, le site affiche les images d\'illustration du thème : remplacez-les dès que possible. Masquer la rubrique retire la galerie.',
                10,
                items: []
            ),
            $this->section(
                'about.intro',
                'about',
                'Introduction',
                'Premier texte de la page À propos : qui est Espoir Vie, et depuis quand.',
                1,
                'À propos de nous',
                'Protéger l\'enfant, lui rendre le sourire',
                'Espoir Vie est une ASBL de droit congolais. Elle œuvre d\'abord pour les enfants orphelins et vulnérables, et intervient aussi, selon ses moyens, dans d\'autres situations humanitaires. Sa conviction : chaque enfant mérite d\'être protégé, soigné, éduqué et accompagné.',
                'Faire un don',
                'donate',
                items: [
                    ['title' => '', 'number' => '', 'text' => 'Bienfaisance, solidarité et dignité humaine.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Protection de l\'enfant au cœur de l\'action.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Une cinquantaine de membres ont rejoint cette aventure.', 'image' => null],
                ],
                extra: [
                    'block_title' => 'Notre devise',
                ]
            ),
            $this->section(
                'about.mission',
                'about',
                'Mission',
                'Onglet Mission. Le texte long va dans « Texte ». Les puces se gèrent dans la liste.',
                2,
                null,
                'Notre mission',
                'Contribuer à l\'amélioration des conditions de vie des enfants orphelins et des personnes vivant dans une grande vulnérabilité, par l\'assistance médicale et sociale, l\'éducation, la protection, la formation et l\'accompagnement des familles.',
                items: [
                    ['title' => '', 'number' => '', 'text' => 'Assistance sociale aux enfants orphelins et vulnérables.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Accès aux soins, à la scolarisation et à la formation.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Promotion et défense des droits de l\'enfant.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Aide humanitaire aux personnes en grande précarité.', 'image' => null],
                ]
            ),
            $this->section(
                'about.vision',
                'about',
                'Vision',
                'Onglet Vision. Décrivez l\'avenir que l\'association veut rendre possible, sans promesses chiffrées non vérifiées.',
                3,
                null,
                'Notre vision',
                'Espoir Vie aspire à une société où aucun enfant ne serait privé de soins, d\'éducation, de protection et d\'une chance réelle de construire son avenir en raison de sa situation sociale ou familiale. L\'ambition est de transformer l\'aide ponctuelle en accompagnement durable.',
                items: [
                    ['title' => '', 'number' => '', 'text' => 'Retrouver la dignité, l\'autonomie et la confiance en l\'avenir.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Des structures de santé, d\'éducation et d\'accueil accessibles.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Des programmes qui préviennent l\'exclusion et la délinquance juvénile.', 'image' => null],
                ]
            ),
            $this->section(
                'about.history',
                'about',
                'Histoire',
                'Onglet Histoire. Résumé fidèle au document « Historique de l\'ONG Espoir Vie ». Vous pouvez le compléter, sans ajouter de faits qui n\'y figurent pas.',
                4,
                null,
                'Notre histoire',
                "L'histoire d'Espoir Vie commence avant sa création officielle, dans l'engagement de son fondateur, Christian Izeidi Balondo Kweinkim. Dès l'âge de 12 ans, élevé par ses grands-parents, il aide les enfants et les personnes démunies de son entourage.\n\nÀ partir de 1993, il rend visite chaque mois aux malades de l'Hôpital Saint-Joseph à Kinshasa/Limete et leur apporte sucre, lait et savon. L'action s'étend aux veuves et aux personnes vulnérables du quartier. Très jeune encore, il prend en charge l'opération d'une jeune fille de 13 ans, abandonnée à l'Hôpital Général de Kinshasa faute de moyens.\n\nEn 2000, un repas organisé pour des enfants vivant dans la rue, puis la visite d'un enfant qui n'avait pas pu y participer et celle du responsable communal de la jeunesse, le convainquent de créer une structure permanente. Espoir Vie naît alors, d'abord dans un local mis à disposition par la famille du fondateur. Sa devise : « Enfant joyeux, sourire retrouvé. »"
            ),
            $this->section(
                'about.objectives',
                'about',
                'Objectifs',
                'Liste des objectifs. Un élément = une ligne. Masquez la rubrique pour la retirer de la page À propos.',
                5,
                'Ce que nous poursuivons',
                'Nos objectifs',
                'Espoir Vie agit pour que l\'enfant vulnérable soit secouru, soigné, instruit, formé et, lorsque c\'est nécessaire, défendu.',
                items: [
                    ['title' => '', 'number' => '', 'text' => 'Assurer une assistance sociale aux enfants orphelins et vulnérables.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Favoriser leur accès aux soins de santé.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Contribuer à leur scolarisation et à leur éducation.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Encadrer et former les jeunes, favoriser leur autonomie et leur réinsertion.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Promouvoir et défendre les droits de l\'enfant, y compris par une assistance juridique.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Développer des structures de santé, d\'éducation, de formation et d\'accueil.', 'image' => null],
                    ['title' => '', 'number' => '', 'text' => 'Soutenir l\'action par des initiatives génératrices de revenus.', 'image' => null],
                ]
            ),
            $this->section(
                'about.domains',
                'about',
                'Domaines d\'intervention',
                'Liste des domaines. Masquez la rubrique si vous ne voulez pas l\'afficher.',
                6,
                'Une approche multisectorielle',
                'Nos domaines d\'intervention',
                null,
                items: [
                    ['title' => 'Santé et assistance médicale', 'number' => '', 'text' => '', 'image' => null],
                    ['title' => 'Éducation et instruction', 'number' => '', 'text' => '', 'image' => null],
                    ['title' => 'Protection et droits de l\'enfant', 'number' => '', 'text' => '', 'image' => null],
                    ['title' => 'Assistance humanitaire et sociale', 'number' => '', 'text' => '', 'image' => null],
                    ['title' => 'Formation et réinsertion', 'number' => '', 'text' => '', 'image' => null],
                    ['title' => 'Agriculture, élevage et environnement', 'number' => '', 'text' => '', 'image' => null],
                    ['title' => 'Sport, loisirs et infrastructures sociales', 'number' => '', 'text' => '', 'image' => null],
                ]
            ),
            $this->section(
                'about.actions',
                'about',
                'Réalisations',
                'Quelques actions citées dans l\'historique. Chaque élément a un titre et un résumé. Les chiffres (3 000 enfants, 50 enfants à la Polyclinique DIAP) sont ceux du document : vérifiez-les avant publication.',
                7,
                'Depuis 2000',
                'Actions menées sur le terrain',
                null,
                items: [
                    ['title' => 'Assistance médicale', 'number' => '', 'text' => 'De 2001 à ce jour, assistance à l\'Hôpital Général de Référence de Kinshasa pour environ 3 000 enfants, soit une moyenne estimée de 120 bénéficiaires par an. De 2014 à 2017, accompagnement d\'environ 50 enfants à la Polyclinique DIAP, avenue Luvungi n° 63, commune de Kinshasa. Depuis 2020, Centre Médical Espoir Vie et prise en charge de la malnutrition.', 'image' => null],
                    ['title' => 'Sensibilisation', 'number' => '', 'text' => 'Conférences sur la situation des enfants orphelins et vulnérables et sur la prévention du VIH/SIDA, des IST et des MST, notamment le 26 avril 2003 et les 18 et 19 octobre 2003.', 'image' => null],
                    ['title' => 'Protection', 'number' => '', 'text' => 'Accompagnement d\'enfants victimes de violences, d\'enlèvements ou de maltraitance, avec un collectif d\'avocats. En 2004 et 2005, participation aux ateliers provinciaux sur la paix dans la région des Grands Lacs.', 'image' => null],
                    ['title' => 'Aide sociale', 'number' => '', 'text' => 'Distribution de vêtements, interventions au Plateau des Batéké et au village Kitoyi, prise en charge de certaines factures d\'accouchement, repas de solidarité, aide aux personnes vivant avec le VIH/SIDA et aux enfants sans abri.', 'image' => null],
                ]
            ),
            $this->section(
                'about.perspectives',
                'about',
                'Perspectives',
                'Projets que l\'association souhaite développer. Ce ne sont pas des réalisations déjà achevées : le titre doit le faire comprendre.',
                8,
                'La suite',
                'Perspectives et projets',
                'Espoir Vie veut renforcer ses capacités, nouer des partenariats et étendre son action à davantage d\'enfants et de familles.',
                items: [
                    ['title' => 'Structures sanitaires', 'number' => '', 'text' => 'Créer et équiper des centres, notamment pédiatriques en milieu rural, pour des soins gratuits ou fortement subventionnés.', 'image' => null],
                    ['title' => 'Éducation et formation', 'number' => '', 'text' => 'Créer des écoles et des centres de formation professionnelle pour l\'autonomie des jeunes vulnérables.', 'image' => null],
                    ['title' => 'Agro-pastoral', 'number' => '', 'text' => 'Développer l\'agriculture et l\'élevage pour contribuer à l\'autofinancement des programmes sociaux.', 'image' => null],
                    ['title' => 'Enfants vivant avec le VIH', 'number' => '', 'text' => 'Renforcer l\'accompagnement social, médical et éducatif, et lutter contre les discriminations.', 'image' => null],
                    ['title' => 'Accueil et prévention', 'number' => '', 'text' => 'Accueillir les jeunes enfants privés de soutien familial, et prévenir la délinquance par l\'encadrement, la formation et la réinsertion.', 'image' => null],
                ]
            ),
            $this->section(
                'about.partner',
                'about',
                'Partenaire cité',
                'Le document mentionne un partenaire. N\'ajoutez un logo ou un nom que s\'il est confirmé.',
                9,
                'Partenaire',
                'MDH / The Carter Center – RDC',
                'Partenaire cité dans l\'historique de l\'organisation.'
            ),
            $this->section(
                'about.team',
                'about',
                'Équipe sur la page À propos',
                'Aperçu de l\'équipe. Les fiches se gèrent dans Administrateurs. Masquer la rubrique retire cet aperçu.',
                10,
                'Notre équipe',
                'Les personnes qui portent Espoir Vie',
                null,
                buttonLabel: 'Nous rejoindre',
                buttonUrl: 'contact'
            ),
            $this->section(
                'about.cta',
                'about',
                'Appel au don',
                'Bandeau en bas de la page À propos.',
                11,
                'Commencez à aider dès maintenant',
                'Les enfants vulnérables ont besoin de votre aide',
                null,
                buttonLabel: 'Faire un don',
                buttonUrl: 'donate'
            ),
            $this->section(
                'contact.intro',
                'contact',
                'Introduction du formulaire',
                'Titre au-dessus du formulaire. Les coordonnées viennent de « Infos de base → Coordonnées ».',
                1,
                'Nous contacter',
                'Écrivez-nous pour un don, un partenariat ou une question',
                'Espoir Vie accueille les messages des partenaires, des donateurs et des personnes de bonne volonté.'
            ),
            $this->section(
                'contact.map',
                'contact',
                'Carte',
                'Masquez cette rubrique pour retirer la carte. L\'adresse de la carte se modifie dans Infos de base → Coordonnées (champ Carte).',
                2
            ),
            $this->section(
                'team.intro',
                'team',
                'Introduction',
                'Texte d\'introduction de la page équipe. Les membres se gèrent dans Administrateurs.',
                1,
                'Notre équipe',
                'Des personnes engagées auprès des enfants vulnérables',
                'L\'équipe rassemble celles et ceux qui portent Espoir Vie au quotidien : direction, membres et bénévoles. Chaque fiche se modifie dans le menu Administrateurs.'
            ),
            $this->section(
                'events.intro',
                'events',
                'Introduction',
                'Texte d\'introduction de la page événements. Les événements se créent dans Activités.',
                1,
                'Sur le terrain',
                'Événements et activités publiques',
                'Retrouvez ici les rendez-vous annoncés par Espoir Vie : sensibilisation, solidarité et rencontres au service des enfants et des familles vulnérables.'
            ),
            $this->section(
                'articles.intro',
                'articles',
                'Introduction',
                'Texte d\'introduction du blog. Chaque article se rédige dans le menu Articles.',
                1,
                'Actualités',
                'Les nouvelles d\'Espoir Vie',
                'Comptes rendus d\'actions, informations sur les projets et nouvelles de l\'association.'
            ),
            $this->section(
                'donate.intro',
                'donate',
                'Introduction de la page dons',
                'Texte au-dessus de la liste des projets. Les projets se gèrent dans Activités.',
                1,
                'Votre soutien',
                'Faire un don à un projet',
                'Choisissez un projet pour soutenir l\'assistance médicale, l\'éducation, la protection ou l\'accompagnement des enfants vulnérables. Le paiement s\'effectue en dollars ou en francs congolais, par mobile money ou par carte.'
            ),
            $this->section(
                'donate.modal',
                'donate',
                'Fenêtre de don spontané',
                'Titre et texte de la fenêtre qui s\'ouvre depuis le bouton « Faire un don » de l\'en-tête.',
                2,
                null,
                'Faire un don',
                'Un don ponctuel soutient les actions d\'Espoir Vie auprès des enfants orphelins et des familles vulnérables. Le paiement se fait en USD ou en CDF, par mobile money ou par carte.'
            ),
        ];
    }

    /**
     * Construit une rubrique avec des valeurs par défaut explicites.
     *
     * @param  list<array<string, mixed>>|null  $items
     * @param  array<string, mixed>|null  $extra
     * @return array<string, mixed>
     */
    private function section(
        string $key,
        string $page,
        string $label,
        string $helpText,
        int $sortOrder,
        ?string $subtitle = null,
        ?string $title = null,
        ?string $body = null,
        ?string $buttonLabel = null,
        ?string $buttonUrl = null,
        ?array $items = null,
        ?array $extra = null,
    ): array {
        return [
            'key' => $key,
            'page' => $page,
            'label' => $label,
            'help_text' => $helpText,
            'is_visible' => true,
            'sort_order' => $sortOrder,
            'subtitle' => $subtitle,
            'title' => $title,
            'body' => $body,
            'image' => null,
            'button_label' => $buttonLabel,
            'button_url' => $buttonUrl,
            'items' => $items,
            'extra' => $extra,
        ];
    }

    /**
     * Construit un lien de menu que l'administrateur peut renommer ou masquer.
     *
     * @return array<string, mixed>
     */
    private function menu(string $key, int $sortOrder, string $label): array
    {
        return $this->section(
            $key,
            'menu',
            'Lien : ' . $label,
            'Masquer ce lien le retire du menu et du pied de page. La page reste accessible si quelqu\'un connaît son adresse. Le titre est le libellé affiché.',
            $sortOrder,
            null,
            $label
        );
    }
}
