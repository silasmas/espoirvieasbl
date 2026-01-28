@extends('layouts.public')

@section('title', "Conditions d'utilisation - Espoir Vie ASBL")

@section('content')
    <x-breadcrumb
        title="Conditions d'utilisation"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Conditions d\'utilisation']
        ]"
    />

    <section class="ul-section-spacing ul-about wow animate__fadeInUp">
        <div class="ul-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="ul-section-title mb-3">Conditions d'utilisation du site Espoir Vie ASBL</h1>
                    <p class="ul-section-descr">
                        Les présentes conditions d'utilisation ont pour objectif de définir les modalités d'accès et d'utilisation
                        du site web d'<strong>Espoir Vie ASBL</strong>, une organisation à but non lucratif engagée pour
                        l'amélioration des conditions de vie des personnes vulnérables et la promotion de la solidarité.
                    </p>

                    <h2 class="mt-4 mb-2">1. Présentation de l'ONG</h2>
                    <p>
                        Espoir Vie ASBL est une organisation non gouvernementale qui œuvre pour
                        le soutien des enfants, des familles et des communautés en situation de précarité.
                        À travers des projets éducatifs, sociaux, sanitaires et humanitaires, nous cherchons
                        à redonner espoir et dignité aux personnes que nous accompagnons.
                    </p>

                    <h2 class="mt-4 mb-2">2. Acceptation des conditions</h2>
                    <p>
                        En accédant à ce site ou en l'utilisant, vous reconnaissez avoir pris connaissance
                        des présentes conditions et les accepter sans réserve. Si vous n'acceptez pas ces
                        conditions, nous vous invitons à ne pas utiliser le site.
                    </p>

                    <h2 class="mt-4 mb-2">3. Utilisation du site</h2>
                    <p>
                        Le site d'Espoir Vie ASBL est mis à disposition pour :
                    </p>
                    <ul>
                        <li>Découvrir notre mission, nos valeurs et nos projets ;</li>
                        <li>Suivre notre actualité (articles, événements, activités) ;</li>
                        <li>Effectuer des dons ponctuels ou réguliers pour soutenir nos actions ;</li>
                        <li>Devenir donateur ou bénévole, et entrer en contact avec notre équipe ;</li>
                        <li>S'abonner à notre newsletter et recevoir des informations sur nos activités.</li>
                    </ul>
                    <p>
                        Vous vous engagez à utiliser le site de manière loyale, responsable et conforme à
                        la législation en vigueur.
                    </p>

                    <h2 class="mt-4 mb-2">4. Comptes donateurs et accès sécurisé</h2>
                    <p>
                        Certains services (suivi des dons, espace donateur, etc.) nécessitent la création
                        d'un compte personnel. Vous êtes responsable de la confidentialité de vos identifiants
                        et de toutes les actions effectuées à l'aide de votre compte.
                    </p>
                    <p>
                        En cas de perte, d'oubli ou de suspicion d'utilisation frauduleuse de vos identifiants,
                        merci de nous contacter dans les meilleurs délais afin que nous puissions sécuriser votre compte.
                    </p>

                    <h2 class="mt-4 mb-2">5. Dons et soutien financier</h2>
                    <p>
                        Les dons effectués via notre site contribuent directement au financement de nos projets
                        et de nos actions sur le terrain. En validant un don, vous confirmez que vous êtes
                        légalement autorisé à utiliser le moyen de paiement choisi et que les informations
                        fournies sont exactes.
                    </p>
                    <p>
                        Nous nous engageons à utiliser les fonds collectés de manière rigoureuse, transparente
                        et conforme à notre mission. Des rapports d’activités et d’impact peuvent être mis à
                        disposition de nos donateurs et partenaires.
                    </p>

                    <h2 class="mt-4 mb-2">6. Propriété intellectuelle</h2>
                    <p>
                        L'ensemble des contenus présents sur le site (textes, images, logos, vidéos, éléments
                        graphiques, etc.) est la propriété d'Espoir Vie ASBL ou de ses partenaires, sauf mention
                        contraire. Toute reproduction, représentation, modification, distribution ou exploitation
                        de ces contenus, totale ou partielle, sans autorisation écrite préalable, est strictement interdite.
                    </p>

                    <h2 class="mt-4 mb-2">7. Liens externes</h2>
                    <p>
                        Le site peut contenir des liens vers d'autres sites ou ressources externes. Ces liens
                        sont fournis uniquement pour faciliter la navigation de l'utilisateur. Espoir Vie ASBL
                        ne peut être tenue responsable du contenu de ces sites tiers, ni des dommages pouvant
                        résulter de leur consultation.
                    </p>

                    <h2 class="mt-4 mb-2">8. Responsabilité</h2>
                    <p>
                        Nous mettons tout en œuvre pour assurer l'exactitude et la mise à jour des informations
                        publiées sur le site. Toutefois, des erreurs ou omissions peuvent survenir. Espoir Vie ASBL
                        ne saurait être tenue responsable :
                    </p>
                    <ul>
                        <li>De tout dommage direct ou indirect lié à l'utilisation du site ;</li>
                        <li>De toute interruption ou indisponibilité temporaire du service ;</li>
                        <li>De tout préjudice résultant de l'utilisation d'informations présentes sur le site.</li>
                    </ul>

                    <h2 class="mt-4 mb-2">9. Protection des données personnelles</h2>
                    <p>
                        Les données personnelles collectées via le site (formulaires de contact, dons,
                        inscription à la newsletter, création de compte, etc.) sont traitées conformément
                        à notre <a href="{{ route('privacy') }}">Politique de confidentialité</a>, qui détaille
                        la manière dont nous protégeons vos informations et vos droits.
                    </p>

                    <h2 class="mt-4 mb-2">10. Modification des conditions</h2>
                    <p>
                        Espoir Vie ASBL se réserve le droit de modifier à tout moment les présentes conditions
                        d'utilisation afin de les adapter à l'évolution du site, de ses services ou de la
                        législation en vigueur. La version à jour est celle publiée sur cette page à la date
                        de votre consultation.
                    </p>

                    <h2 class="mt-4 mb-2">11. Contact</h2>
                    <p>
                        Pour toute question concernant ces conditions d'utilisation, nos activités ou nos
                        projets, vous pouvez nous contacter via le formulaire disponible sur la page
                        <a href="{{ route('contact') }}">Nous contacter</a> ou par les coordonnées mentionnées dans le pied de page du site.
                    </p>

                    <p class="mt-4">
                        Merci de votre confiance et de votre engagement aux côtés d'<strong>Espoir Vie ASBL</strong>.
                        Ensemble, nous pouvons redonner espoir et construire un avenir meilleur pour les personnes
                        les plus vulnérables.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

