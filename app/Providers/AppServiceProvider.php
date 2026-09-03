<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Enums\TwitterCard;
use Laravel\Head\Facades\Head;
use Laravel\Head\HeadBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Head::defaults(function (HeadBuilder $head) {
            $head
                ->title('Verrips Family')
                ->description('Updates and details about Roy, Angela, Nathan, Luke and Don Verrips — a Christian family in Reidville, South Carolina.')
                ->canonical()
                ->searchableByRobots()
                ->og(siteName: 'Verrips Family', type: OgType::Website)
                ->ogImage(Vite::asset('resources/images/verrips-2025.png'))
                ->twitter(card: TwitterCard::SummaryWithLargeImage)
                ->favicon(asset('docs/favicon.ico'));
        });
    }
}
