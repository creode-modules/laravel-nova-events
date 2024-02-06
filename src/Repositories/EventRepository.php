<?php

namespace Creode\LaravelNovaBlog\Repositories;

use Creode\LaravelRepository\BaseRepository;

class EventRepository extends BaseRepository
{
    /**
     * {@inheritdoc}
     */
    protected function getModel(): string
    {
        return config('nova-events.event_model', \Creode\LaravelNovaEvents\Entities\Event::class);
    }
}
