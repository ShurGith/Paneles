<?php

    namespace App\Providers\Filament;

    use Agencetwogether\HooksHelper\HooksHelperPlugin;
    use Filament\Http\Middleware\Authenticate;
    use Filament\Http\Middleware\AuthenticateSession;
    use Filament\Http\Middleware\DisableBladeIconComponents;
    use Filament\Http\Middleware\DispatchServingFilamentEvent;
    use Filament\Infolists\Infolist;
    use Filament\Navigation\MenuItem;
    use Filament\Pages;
    use Filament\Panel;
    use Filament\PanelProvider;
    use Filament\Support\Colors\Color;
    use Filament\Support\Facades\FilamentIcon;
    use Filament\Widgets;
    use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
    use Illuminate\Cookie\Middleware\EncryptCookies;
    use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
    use Illuminate\Routing\Middleware\SubstituteBindings;
    use Illuminate\Session\Middleware\StartSession;
    use Illuminate\View\Middleware\ShareErrorsFromSession;
    use Saasykit\FilamentOops\FilamentOopsPlugin;


    class AdminPanelProvider extends PanelProvider
    {
        public function configure(): void
        {
            FilamentIcon::register([
                'panels::global-search.field' => 'icon-linux',
                'panels::sidebar.group.collapse-button' => view('icons.chevron-up'),
            ]);
        }

        public function boot(): void
        {
            Infolist::$defaultNumberLocale = 'es';
        }

        public function panel(Panel $panel): Panel
        {
            return $panel
                ->default()
                ->id('admin')
                ->path('admin')
                ->login()
                ->sidebarCollapsibleOnDesktop()
                //->sidebarFullyCollapsibleOnDesktop()
                ->collapsedSidebarWidth('2rem')
                ->colors([

                    'danger' => Color::hex('#B70F00FF'), //Red
                    'gray' => Color::hex('#5F6978FF'), //Zinc,
                    'info' => Color::hex('#2E5DA9FF'),//Info
                    'primary' => Color::hex('#D78700FF'), //Amber,
                    'success' => Color::hex('#108739FF'), //Green
                    'warning' => Color::hex('#D78700FF'), //Amber,
                ])
                ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
                ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
                ->pages([
                    Pages\Dashboard::class,
                ])
                ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
                ->widgets([
                    Widgets\AccountWidget::class,
                    Widgets\FilamentInfoWidget::class,
                ])
                ->userMenuItems([ //Selector de Paneles
                    MenuItem::make()
                        ->label('Home')
                        ->url('/')
                        ->icon('heroicon-o-cog-6-tooth'),
                ])
                ->middleware([
                    EncryptCookies::class,
                    AddQueuedCookiesToResponse::class,
                    StartSession::class,
                    AuthenticateSession::class,
                    ShareErrorsFromSession::class,
                    VerifyCsrfToken::class,
                    SubstituteBindings::class,
                    DisableBladeIconComponents::class,
                    DispatchServingFilamentEvent::class,
                ])
                ->plugins([
                    HooksHelperPlugin::make(),
                    FilamentOopsPlugin::make()->addEnvironment('local', 'Local', '#008000'),
                ])
                ->authMiddleware([
                    Authenticate::class,
                ]);
        }
    }
