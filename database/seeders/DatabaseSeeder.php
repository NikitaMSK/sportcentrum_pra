
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Trainer;
use App\Models\Les;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Trainer::firstOrCreate(
            ['id' => 1],
            ['naam' => 'Jan Jansen']
        );

        Trainer::firstOrCreate(
            ['id' => 2],
            ['naam' => 'Sara de Vries']
        );

        Les::firstOrCreate(
            [
                'datum' => '2026-10-10',
                'tijd' => '10:00:00',
                'activiteit' => 'Fitness',
            ],
            [
                'trainer_id' => 1,
            ]
        );

        Les::firstOrCreate(
            [
                'datum' => '2026-10-11',
                'tijd' => '14:00:00',
                'activiteit' => 'Yoga',
            ],
            [
                'trainer_id' => 2,
            ]
        );
    }
}
