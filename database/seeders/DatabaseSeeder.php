<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\seeders\CategorySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
     
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '09794257469',
            'address' => 'Yangon',
            'role' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin123'),
        ]);

         $category = ['Neapolitan Pizza','Chicago Pizza','New York Pizza','Sicilian Pizza','Greek Pizza'];

        foreach ($category as $c) {
            Category::create([
                'name' => $c
            ]);
        };

        $product = ['Pizza Flavors','Pizza Toppings','Pizza Restaurant','Pizza Restaurant'];

        foreach($product as $p){
             Product::create([
               'name' => $p,
               'description' => 'Discover Pinterest’s 10 best ideas and inspiration for Pizza names. Get inspired and try out new things.',
               'price' => 25000,
               'waiting_time' => 10,
               'category_id' => rand(1,5)
             ]);
        };
    }
}
