<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $update_at = $created_at = date('Y-m-d H:i:s');
        $areas = [
            [
                'id'            => 1,
                'area_name'     => 'Call Center',
                'description'   => null,
                'created_at'    => $created_at,
                'updated_at'    => $update_at,
            ],
            [
                'id'            => 2,
                'area_name'     => 'Web',
                'description'   => null,
                'created_at'    => $created_at,
                'updated_at'    => $update_at,
            ],
            [
                'id'            => 3,
                'area_name'     => 'Whatsapp',
                'description'   => null,
                'created_at'    => $created_at,
                'updated_at'    => $update_at,
            ],
            [
                'id'            => 4,
                'area_name'     => 'Freelance',
                'description'   => null,
                'created_at'    => $created_at,
                'updated_at'    => $update_at,
            ],
        ];
        Area::insert($areas);
    }
}
