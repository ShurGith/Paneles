<?php

    namespace App\Providers;

    use Filament\Infolists\Infolist;
    use Filament\Support\Facades\FilamentView;
    use Filament\View\PanelsRenderHook;
    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Infolist::$defaultNumberLocale = 'es';

        }


        /**
         * Register any application services.
         */
        public function register(): void
        {
            FilamentView::registerRenderHook(
                PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE,
                fn(): string => Blade::render('Aqui va el boton'),

            );
        }
    }
