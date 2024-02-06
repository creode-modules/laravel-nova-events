<?php

namespace Creode\LaravelNovaEvents\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EventsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Creode\LaravelNovaEvents\Entities\Event::factory(30)->create();
    }
}
