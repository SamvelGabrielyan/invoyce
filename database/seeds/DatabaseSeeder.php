<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Defining table names which need to be truncated before seeders run.
     */
    protected $toTruncate = ['industries', 'states'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $this->call(IndustriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
    }
}
