<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'khalid',
            'email' => 'khalid@gmail.com',
            'password' => bcrypt('khalid123'),
            'role' => 0 ,//admin
            'adresse'=>"tiflet",
            "telephonne"=>"+212766933356",
            "cin"=>"XA1111"

        ]);
        \App\Models\User::factory()->create([
            'name' => 'aziz',
            'email' => 'aziz@gmail.com',
            'password' => bcrypt('aziz123'),
            'role' => 1 ,//cleint
            'adresse'=>"tiflet",
            "telephonne"=>"+212766933356",
            "cin"=>"XA202020"

        ]);
        \App\Models\User::factory()->create([
            'name' => 'yahya',
            'email' => 'yahya@gmail.com',
            'password' => bcrypt('yahya123'),
            'role' => 2 ,//fournisseur
            'adresse'=>"eljadida",
            "telephonne"=>"+212766933356",
            "cin"=>"XA131525"

        ]);
        \App\Models\User::factory()->create([
            'name' => 'maher',
            'email' => 'maher@gmail.com',
            'password' => bcrypt('maher123'),
            'role' => 3, //livreur
            'adresse'=>"khemisset",
            "telephonne"=>"+212766933356",
            "cin"=>"XA184596"

        ]);
    }
}
