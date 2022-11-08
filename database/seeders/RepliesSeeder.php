<?php

namespace Database\Seeders;

use App\Models\Reply;
use Illuminate\Database\Seeder;

class RepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Reply::factory()->times(1000)->create();
    }
}
