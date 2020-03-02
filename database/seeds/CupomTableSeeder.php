<?php

use CodeDelivery\Models\Category;
use CodeDelivery\Models\Cupom;
use CodeDelivery\Models\Product;
use Illuminate\Database\Seeder;

class CupomTableSeeder extends Seeder
{
    public function run()
    {
        factory(Cupom::class, 10)->create();
    }
}
