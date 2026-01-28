@extends('layouts.public')

@section('title', 'Politique de confidentialité - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="Politique de confidentialité"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Politique de confidentialité']
        ]"
    />

    <section class="ul-section-spacing ul-about wow animate__fadeInUp">
        <div class="ul-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="ul-section-title mb-3">Politique de confidentialité d'Espoir Vie ASBL</h1>
                    <p class="ul-section-descr">
                        La présente politique de confidentialité explique comment <strong>Espoir Vie ASBL</strong>
                        collecte, utilise, protège et partage vos données personnelles lorsque vous utilisez notre site web,
                        soutenez nos actions ou interagissez avec nos équipes.
                    </p>

                    <h2 class="mt-4 mb-2">1. Qui sommes-nous ?</h2>
                    <p>
                        Espoir Vie ASBL est une organisation à but non lucratif engagée pour la protection et
                        l'accompagnement des personnes vulnérables. À travers des projets éducatifs, sociaux,
                        sanitaires et humanitaires, nous œuvrons pour redonner espoir et dignité aux enfants,
                        familles et communautés que nous accompagnons.
                    </p>

                    <h2 class="mt-4 mb-2">2. Quelles données collectons-nous ?</h2>
                    <p>
                        Selon votre interaction avec notre ONG, nous pouvons être amenés à collecter différentes
                        catégories de données :
                    </p>
                    <ul>
                        <li><strong>Données d’identification</strong> : nom, prénom, civilité ;</li>
                        <li><strong>Coordonnées</strong> : adresse e-mail, numéro de téléphone, adresse postale le cas échéant ;</li>
                        <li><strong>Données liées aux dons</strong> : montants, fréquence, mode de paiement, références de transaction
                            (les données bancaires sont traitées de manière sécurisée par nos prestataires de paiement) ;</li>
                        <li><strong>Données de connexion et de navigation</strong> : adresse IP, type de navigateur, pages consultées,
                            temps de visite, etc. ;</li>
                        <li><strong>Données liées à votre engagement</strong> : inscription à la newsletter, participation à des
                            événements, demandes d’information, volontariat, témoignages.</li>
                    </ul>

                    <h2 class="mt-4 mb-2">3. Comment collectons-nous vos données ?</h2>
                    <p>
                        Vos données peuvent être collectées :
                    </p>
                    <ul>
                        <li>Lors de la réalisation d’un don en ligne ;</li>
                        <li>Lors de la création d’un compte donateur ou d’un espace personnel ;</li>
                        <li>Lors de l’inscription à notre newsletter ;</li>
                        <li>Lors de l’envoi d’un message via notre formulaire de contact ;</li>
                        <li>Lors de votre participation à un événement ou à une activité de l’ONG ;</li>
                        <li>Lors de votre navigation sur notre site (cookies et outils de mesure d’audience).</li>
                    </ul>

                    <h2 class="mt-4 mb-2">4. Pour quelles finalités utilisons-nous vos données ?</h2>
                    <p>
                        Espoir Vie ASBL utilise vos données personnelles uniquement pour des finalités légitimes et
                        proportionnées, notamment :
                    </p>
                    <ul>
                        <li>Gérer vos dons et assurer le suivi de votre soutien à l’ONG ;</li>
                        <li>Vous envoyer des reçus, confirmations ou documents liés à vos contributions ;</li>
                        <li>Gérer votre compte donateur et vous donner accès à l’historique de vos dons ;</li>
                        <li>Vous informer de nos actions, projets, campagnes et besoins (newsletter, emails d’information) ;</li>
                        <li>Répondre à vos demandes de contact ou d’information ;</li>
                        <li>Améliorer la qualité de notre site, de nos services et de votre expérience utilisateur ;</li>
                        <li>Respecter nos obligations légales, comptables et fiscales.</li>
                    </ul>

                    <h2 class="mt-4 mb-2">5. Fondements juridiques du traitement</h2>
                    <p>
                        Selon le type de traitement, nous nous appuyons sur différents fondements juridiques :
                    </p>
                    <ul>
                        <li><strong>Votre consentement</strong> (par exemple pour l’envoi de la newsletter) ;</li>
                        <li><strong>L’exécution d’un contrat</strong> ou de mesures précontractuelles
                            (gestion de votre don, création de compte) ;</li>
                        <li><strong>Le respect d’obligations légales</strong> (obligations comptables et fiscales liées aux dons) ;</li>
                        <li><strong>L’intérêt légitime</strong> de l’ONG (amélioration du site, prévention de la fraude, sécurité).</li>
                    </ul>

                    <h2 class="mt-4 mb-2">6. Avec qui partageons-nous vos données ?</h2>
                    <p>
                        Vos données ne sont jamais vendues. Elles peuvent être transmises uniquement à :
                    </p>
                    <ul>
                        <li>Nos équipes internes, strictement dans le cadre de leurs fonctions et de la mission de l’ONG ;</li>
                        <li>Nos prestataires de services (hébergement, outils de newsletter, prestataires de paiement,
                            maintenance technique), soumis à des obligations de confidentialité ;</li>
                        <li>Les autorités administratives ou judiciaires, uniquement si la loi l’exige.</li>
                    </ul>

                    <h2 class="mt-4 mb-2">7. Combien de temps conservons-nous vos données ?</h2>
                    <p>
                        Nous conservons vos données personnelles pendant une durée strictement nécessaire aux finalités
                        pour lesquelles elles ont été collectées, et dans le respect des délais légaux applicables.
                        Par exemple, certaines données liées aux dons peuvent être conservées plusieurs années pour des
                        raisons comptables ou fiscales.
                    </p>

                    <h2 class="mt-4 mb-2">8. Sécurité de vos données</h2>
                    <p>
                        Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger
                        vos données personnelles contre la perte, l’accès non autorisé, la divulgation, l’altération ou
                        la destruction. Lorsque vous effectuez un don, les informations de paiement sont traitées via
                        des canaux sécurisés par nos prestataires spécialisés.
                    </p>

                    <h2 class="mt-4 mb-2">9. Vos droits</h2>
                    <p>
                        Conformément aux législations applicables en matière de protection des données, vous disposez
                        notamment des droits suivants (dans les limites prévues par ces textes) :
                    </p>
                    <ul>
                        <li>Droit d’accès à vos données personnelles ;</li>
                        <li>Droit de rectification de données inexactes ou incomplètes ;</li>
                        <li>Droit à l’effacement (dans certains cas) ;</li>
                        <li>Droit à la limitation du traitement ;</li>
                        <li>Droit d’opposition à certains traitements (notamment prospection) ;</li>
                        <li>Droit de retirer votre consentement à tout moment, lorsque le traitement est fondé sur celui-ci ;</li>
                        <li>Droit à la portabilité de vos données, lorsque cela est applicable.</li>
                    </ul>
                    <p>
                        Pour exercer vos droits, vous pouvez nous contacter via la page
                        <a href="{{ route('contact') }}">Nous contacter</a> ou par les coordonnées figurant dans le pied de page.
                    </p>

                    <h2 class="mt-4 mb-2">10. Newsletter et communications</h2>
                    <p>
                        En vous abonnant à notre newsletter, vous acceptez de recevoir des informations régulières
                        sur nos projets, campagnes, événements et actualités. Vous pouvez à tout moment vous
                        désabonner en utilisant le lien de désinscription présent dans chaque e-mail, ou via
                        la page dédiée accessible à partir de nos communications.
                    </p>

                    <h2 class="mt-4 mb-2">11. Cookies et suivi de navigation</h2>
                    <p>
                        Notre site peut utiliser des cookies ou technologies similaires pour améliorer votre expérience,
                        mesurer l’audience et adapter certains contenus. Vous pouvez configurer votre navigateur pour
                        refuser tout ou partie des cookies, mais certaines fonctionnalités du site pourraient alors
                        être limitées.
                    </p>

                    <h2 class="mt-4 mb-2">12. Mise à jour de la politique de confidentialité</h2>
                    <p>
                        La présente politique de confidentialité peut être amenée à évoluer afin de refléter
                        les changements de nos pratiques, de nos services ou du cadre légal. La version à jour
                        est celle publiée sur cette page à la date de votre consultation.
                    </p>

                    <h2 class="mt-4 mb-2">13. Contact</h2>
                    <p>
                        Pour toute question relative à cette politique de confidentialité, à l’utilisation de vos données
                        personnelles ou à l’exercice de vos droits, vous pouvez nous contacter via la page
                        <a href="{{ route('contact') }}">Nous contacter</a>.
                    </p>

                    <p class="mt-4">
                        En utilisant notre site et en soutenant <strong>Espoir Vie ASBL</strong>, vous contribuez directement
                        à notre mission de solidarité et de soutien aux personnes les plus vulnérables. Nous vous remercions
                        pour votre confiance et votre engagement.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

