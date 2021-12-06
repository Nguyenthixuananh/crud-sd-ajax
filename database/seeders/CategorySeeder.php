<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
           ["name"=>"Family"],
           ["name"=>"School"],
           ["name"=>"Company"],
           ["name"=>"Learn"],
           ["name"=>"Work"],
           ["name"=>"Play"],
           ["name"=>"Relax"],
        ]);
    }
}
