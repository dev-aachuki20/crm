<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::truncate();
        $update_at = $created_at = date('Y-m-d H:i:s');

        $languages = [
            [
                'id'             => 1,
                'code'           => 'en',
                'name'           => 'english',
                'icon'           => 'images/eng.svg',
                'created_at'     => $created_at,
                'updated_at'     => $update_at,
            ],

            [
                'id'             => 2,
                'code'           => 'es',
                'name'           => 'spanish',
                'icon'           => 'images/japan.svg',
                'created_at'     => $created_at,
                'updated_at'     => $update_at,
            ],
        ];
        Language::insert($languages);
    }
}
