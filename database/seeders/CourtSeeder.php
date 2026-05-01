<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    public function run(): void
    {
        Court::create([
            'name' => 'フットサルコートA',
            'description' => '人工芝を使用した本格的なフットサルコートです。更衣室・シャワー完備。',
        ]);
    }
}
