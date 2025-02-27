<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use App\Http\Middleware\OfficerPanelMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Andreia\FilamentNordTheme\FilamentNordThemePlugin;
use App\Filament\Widgets\NewestBook;
use App\Filament\Widgets\StatsOverview;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Cmsmaxinc\FilamentErrorPages\FilamentErrorPagesPlugin;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use Filament\Navigation\MenuItem;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class OfficerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandName('Officer | SIPUPS')
            ->favicon(asset('storage/icons/favicon.svg'))
            ->id('officer')
            ->path('officer')
            ->login()
            ->colors([
                'primary' => Color::Violet,
            ])
            ->discoverResources(in: app_path('Filament/Officer/Resources'), for: 'App\\Filament\\Officer\\Resources')
            ->discoverPages(in: app_path('Filament/Officer/Pages'), for: 'App\\Filament\\Officer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Officer/Widgets'), for: 'App\\Filament\\Officer\\Widgets')
            ->widgets([
                StatsOverview::class,
                NewestBook::class,
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
                OfficerPanelMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => Filament::auth()->user()->name)
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ])
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                FilamentErrorPagesPlugin::make(),
                LightSwitchPlugin::make(),
                EasyFooterPlugin::make()
                    ->withFooterPosition('footer')
                    ->withSentence('DXNZiD'),
                FilamentEditProfilePlugin::make()
                    ->setTitle('My Profile')
                    ->setNavigationLabel('My Profile')
                    ->setNavigationGroup('My Account')
                    ->setIcon('heroicon-o-user')
                    ->setSort(10)
                    ->shouldShowBrowserSessionsForm()
            ]);
    }
}
