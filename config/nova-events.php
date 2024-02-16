<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Event Model
    |--------------------------------------------------------------------------
    |
    | The model which will be used to handle events.
    |
    */

    'event_model' => \Creode\LaravelNovaEvents\Entities\Event::class,

    /*
    |--------------------------------------------------------------------------
    | Image Disk
    |--------------------------------------------------------------------------
    |
    | The filesystem disk to use for storing images.
    |
    */

    'image_disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Traffic Cop
    |--------------------------------------------------------------------------
    |
    | Indicates whether Nova should check for modifications between viewing
    | and updating a resource.
    |
    */
    'traffic_cop' => true,
];
