<x-filament-widgets::widget>
    <x-filament::section heading="Comment modifier le site">
        <div class="space-y-4 text-sm leading-6">
            <p>
                Le site public reprend l'historique d'Espoir Vie. Vous pouvez changer les textes, les photos, et masquer une rubrique sans la supprimer.
            </p>
            <ol class="list-decimal space-y-2 ps-5">
                <li>
                    <strong>Infos de base.</strong>
                    Dans <a class="underline" href="{{ \App\Filament\Resources\SiteSectionResource::getUrl('index', ['tableFilters' => ['page' => ['value' => 'global']]]) }}">Textes et rubriques</a>,
                    filtrez « 1. Infos de base » : nom, devise, adresse, e-mail, téléphone, logo et chiffres.
                    Le téléphone est vide tant que le numéro officiel n'est pas confirmé.
                </li>
                <li>
                    <strong>Menu.</strong>
                    Filtrez « 2. Menu du site ». Décochez « Affichée » pour retirer un lien du menu et du pied de page.
                </li>
                <li>
                    <strong>Pages.</strong>
                    Accueil, À propos, Contact, Équipe, Événements, Articles, Dons.
                    Ouvrez une rubrique, modifiez le titre, le texte ou la photo, puis enregistrez.
                </li>
                <li>
                    <strong>Masquer un bloc.</strong>
                    Décochez « Afficher sur le site ». Le texte reste enregistré et peut être réaffiché plus tard.
                </li>
                    <li>
                        <strong>Contenus plus détaillés.</strong>
                        Les projets et événements se gèrent dans Activités, les articles dans Articles, les membres dans Équipe (cochez la visibilité sur le site), les avis dans Témoignages.
                    </li>
            </ol>
            <p>
                N'ajoutez pas de chiffre, de témoignage ou de partenaire qui n'est pas confirmé. Les chiffres actuels viennent du document historique et restent à vérifier.
            </p>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
