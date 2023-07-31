<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Seeder;

class TitleTableSeeder extends Seeder
{

    public function run()
    {
        $taskStatuses = [
            [
                'id'   => 1,
                'title' => 'Mr',
            ],
            [
                'id'   => 2,
                'title' => 'Mrs',
            ],
            [
                'id'   => 3,
                'title' => 'Miss',
            ],
            [
                'id'   => 4,
                'title' => 'Master',
            ],
            [
                'id'   => 5,
                'title' => 'Pastor',
            ],
            [
                'id'   => 6,
                'title' => 'Dr',
            ],
            [
                'id'   => 7,
                'title' => 'Arch',
            ],
            [
                'id'   => 8,
                'title' => 'Evangelist',
            ],
            [
                'id'   => 9,
                'title' => 'Chief',
            ],
            [
                'id'   => 10,
                'title' => 'Chief Mrs',
            ],
            [
                'id'   => 11,
                'title' => 'Deacon',
            ],
            [
                'id'   => 12,
                'title' => 'Deaconess',
            ],
            [
                'id'   => 13,
                'title' => 'Pharm',
            ],
        ];

        foreach ($taskStatuses as $item) {
            Title::updateOrCreate(['id' => $item['id']], $item);
        }

    }
}
