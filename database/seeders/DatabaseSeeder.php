<<?php


namespace Database\Seeders;

use App\Models\Trainer;
use App\Models\Les;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $trainer1 = Trainer::firstOrCreate(
            ['naam' => 'Dexx Brodie']
        );

        $trainer2 = Trainer::firstOrCreate(
            ['naam' => 'Nikita Moskalenko']
        );

        $trainer3 = Trainer::firstOrCreate(
            ['naam' => 'Walid Ettejdirti']
        );

        Les::firstOrCreate(
            [
                'datum' => '2026-10-10',
                'tijd' => '10:00:00',
                'activiteit' => 'Spinning',
            ],
            [
                'trainer_id' => $trainer1->id,
            ]
        );

        Les::firstOrCreate(
            [
                'datum' => '2026-10-11',
                'tijd' => '14:00:00',
                'activiteit' => 'Yoga',
            ],
            [
                'trainer_id' => $trainer2->id,
            ]
        );

        Les::firstOrCreate(
            [
                'datum' => '2026-10-10',
                'tijd' => '12:00:00',
                'activiteit' => 'Aqua',
            ],
            [
                'trainer_id' => $trainer3->id,
            ]
        );
    }
}
