<?php

namespace Creode\LaravelNovaEvents\Database\Factories;

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

        return [
            'published_at' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('-1 year', 'now')]),
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'end_date' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('+1 year', '+2 years')]),
            'venue' => $this->faker->company,
            'address' => $this->faker->address,
            'cta_link' => $this->faker->url,
        ];
    }
}
