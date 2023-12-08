<?php

namespace Modules\Events\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class EventsNovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        $this->registerResources();
    }

    public function registerResources()
    {
        Nova::resources([
            \Modules\Events\Nova\Event::class,
            \Modules\Events\Nova\EventSubCategory::class,
            \Modules\Events\Nova\EventCategory::class,
        ]);
    }
}
