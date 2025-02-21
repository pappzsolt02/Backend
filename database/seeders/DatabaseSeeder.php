<?php

namespace Database\Seeders;

use App\Models\Foods;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Sample

        // "ID": 1,
        // "Name": "Csirkemell",
        // "Weight": 200,
        // "Calories": 165.0,
        // "Protein": 31.0,
        // "Carbohydrate": 0.0,
        // "Fat": 3.6,
        // "Type": "Fehérje"

        $json = File::get('database/data/foods.json');
        $foods = json_decode($json);
        foreach ($foods as $key => $value) {
            Foods::create([
                'Name' => $value->Name,
                'Weight' => $value->Weight,
                'Calories' => $value->Calories,
                'Protein' => $value->Protein,
                'Carbohydrate' => $value->Carbohydrate,
                'Fat' => $value->Fat,
                'Type' => $value->Type,
            ]);
        }
    }
}
