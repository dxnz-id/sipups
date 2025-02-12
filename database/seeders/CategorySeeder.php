<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Fiction'],
            ['name' => 'Science Fiction'],
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Thriller'],
            ['name' => 'Romance'],
            ['name' => 'Historical Fiction'],
            ['name' => 'Horror'],
            ['name' => 'Young Adult'],
            ['name' => 'Children\'s'],
            ['name' => 'Biography'],
            ['name' => 'Autobiography'],
            ['name' => 'Science'],
            ['name' => 'History'],
            ['name' => 'Self-Help'],
            ['name' => 'Business'],
            ['name' => 'Cooking'],
            ['name' => 'Travel'],
            ['name' => 'Poetry'],
            ['name' => 'Drama'],
        ]);
    }
}