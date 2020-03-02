<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CodeDelivery\Oauth2\OAuthClient::create(['id' => 'appid01',
                                                  'secret' => 'secret',
                                                  'name' => 'Minha App Mobile']);

    }
}
