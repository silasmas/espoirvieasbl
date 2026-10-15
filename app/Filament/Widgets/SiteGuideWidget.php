<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

/**
 * Guide affiché sur le tableau de bord pour orienter les administrateurs.
 */
class SiteGuideWidget extends Widget
{
    protected static ?int $sort = -5;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.site-guide';
}
