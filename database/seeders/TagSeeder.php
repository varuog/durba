<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $health=['Diabetic Care', 'Liver Care', 'Stomach Care'];
        $blog = ['Health expert'];

        // foreach($health  as $htag) {
        //     $tag = Tag::create($htag, 'health');
        // }

        // foreach($blog  as $btag) {
        //     $tag = Tag::create($btag, 'blog');
        // }
    }
}
