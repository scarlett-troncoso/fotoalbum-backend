<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Matrimoni', 'Cerimonie', 'Famiglia', 'Amore', 'Paesaggi', 'Eventi', 'Aziende', 'Natura', 'Ritratti', 'Publicitá', 'Newborn e Maternity', 'Animali'];

        foreach ($categories as $cat) {
            $category = new Category();
            $category->name = $cat;
            $category->slug = Str::slug($cat, '-');
            $category->save();
        } 
    }
}
