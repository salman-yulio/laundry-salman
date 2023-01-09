<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;

class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_outlet' => $this->faker->numberBetween(1, 1),
            'jenis' => $this->faker->randomElement(['kiloan', 'selimut', 'bed_cover', 'kaos', 'lainnya']),
            'nama_paket' => $this->faker->randomElement(['pahe spesial', 'biasa', 'money laundry', 'hemat 01', 'spesial', 'cuci kering', 'pahe 02']),
            'harga' => $this->faker->numberBetween(10000, 250000)
        ];
    }
}
