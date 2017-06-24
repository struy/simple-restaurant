<?php

use Illuminate\Database\Seeder;
use App\Dishe;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dishe::class, 50)->create();

    }
}
