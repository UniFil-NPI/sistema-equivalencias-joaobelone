<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model as Eloquent;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Eloquent::unguard();

        // $this->call('UserTableSeeder');
        // $this->command->info('User table seeded!');

        $path = 'database/helpers/CC/full_script.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Grades e Disciplinas de CC inseridas!');
    }
}
