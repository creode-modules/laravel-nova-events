<?php

namespace Creode\LaravelNovaEvents\Database\Factories;

use Illuminate\Support\Facades\Storage;
use Creode\LaravelNovaEvents\Entities\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of \Creode\LaravelNovaEvents\Event
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        $start_date = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $randomDay = $this->faker->numberBetween(1, 10);

        return [
            'published_at' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('-1 year', 'now')]),
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'start_date' => $start_date,
            'end_date' => $start_date->modify("+$randomDay day"),
            'venue' => $this->faker->company,
            'address' => $this->faker->address,
            'featured_image' => $this->faker->image(
                Storage::disk(config('nova-events.image_disk', 'public'))->path(''),
                640,
                480,
                null,
                false
            ),
            'cta_link' => $this->faker->url,
        ];
    }
}
