<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('todos')->insert([
            'content' => 'Learn Laravel',
            'checked' => false,
            'completed' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
