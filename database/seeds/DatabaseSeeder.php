<?php

use CodeDelivery\Models\ClientsTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(CupomTableSeeder::class);
        $this->call(OAuthClientSeeder::class);

        Model::reguard();
    }
}