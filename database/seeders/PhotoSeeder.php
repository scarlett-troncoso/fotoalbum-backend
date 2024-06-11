<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Photo;
use Illuminate\Support\Str;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 18; $i++) { 
            $photo = new Photo();
            $photo->title = $faker->words(8, true);
            $photo->upload_image = $faker->imageUrl(600, 400, 'Photos', true, $photo->title, true, 'jpg');
            $photo->description = $faker->paragraphs(4, true);
            $photo->slug = Str::of($photo->title)->slug('-');
            $photo->category = $faker->words(2, true);
            $photo->in_evidenza = false;
            $photo->save();
        }
    }
}
