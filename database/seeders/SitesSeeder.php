<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sites;

class SitesSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Head Office
        Sites::create([
            'name' => 'Head Office',
            'category' => 'branch',
            'address' => 'Jakarta',
        ]);

        // 10 Cabang
        $branches = [
            'Cabang Medan',
            'Cabang Surabaya',
            'Cabang Makassar',
            'Cabang Balikpapan',
            'Cabang Bandung',
            'Cabang Semarang',
            'Cabang Palembang',
            'Cabang Pekanbaru',
            'Cabang Banjarmasin',
            'Cabang Pontianak',
        ];

        foreach ($branches as $branch) {
            Sites::create([
                'name' => $branch,
                'category' => 'branch',
                'address' => null,
            ]);
        }

        // 14 Representative
        for ($i = 1; $i <= 14; $i++) {
            Sites::create([
                'name' => "Representative $i",
                'category' => 'representative',
                'address' => null,
            ]);
        }

        // 15 Site Obvitnas / High Risk
        for ($i = 1; $i <= 15; $i++) {
            Sites::create([
                'name' => "Site High Risk $i",
                'category' => 'site',
                'address' => null,
            ]);
        }
    }
}
