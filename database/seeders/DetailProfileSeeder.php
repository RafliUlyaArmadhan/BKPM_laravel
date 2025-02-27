<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;




class DetailProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //insert data
        DB::table('detail_profile')->insert([
            'address' => 'jember',
            'nomor_tlp' => '08***',
            'ttl' => '2024-11-04',
            'foto' => 'picture.png'
        ]);
    }
}