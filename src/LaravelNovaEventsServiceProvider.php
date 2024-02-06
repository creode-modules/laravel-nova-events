<?php

namespace Creode\LaravelNovaEvents;

use Creode\LaravelNovaEvents\Nova\Event;
use Laravel\Nova\Nova;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelNovaEventsServiceProvider extends PackageServiceProvider
{

    public function boot()
    {
        parent::boot();

        $this->registerResources();
    }

    public function registerResources()
    {
        Event::$model = config('nova-events.event_model', \Creode\LaravelNovaEvents\Entities\Event::class);
        Nova::resources([
            Event::class,
        ]);
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-nova-events')
            ->hasViews()
            ->hasConfigFile()
            ->hasMigrations(
                [
                    '2023_08_15_075403_create_event_categories_table',
                    '2023_08_15_090016_create_events_sub_categories_table',
                    '2023_08_15_160635_create_events_table',
                    '2023_08_16_093046_add_slug_field_to_events_table',
                    '2023_08_16_140223_add_slug_field_to_event_categories_table',
                    '2023_08_16_140352_add_slug_field_to_events_sub_categories_table',
                    '2024_02_05_150518_remove_event_subcategories_table',
                    '2024_02_05_155914_remove_event_categories_table',
                ]
            )
            ->runsMigrations();
    }
}
