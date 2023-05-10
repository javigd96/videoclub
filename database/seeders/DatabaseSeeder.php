<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            FilmSeeder::class,
            
       ]);
      
       $this->call(RoleSeeder::class);
       
         User::factory(5)->create();

          User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'email_verified_at' =>now(),
            'password' =>Hash::make('password')
        ])->assignRole('admin');
        
    
         
    }


    
}
