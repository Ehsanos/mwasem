<?php

namespace Database\Seeders;

use App\Enums\ActivateStatusEnum;
use App\Models\City;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        City::create([
            'name' => 'إدلب',
        ]);

        City::create([
            'name' => 'الدانا',

        ]);
        City::create([
            'name' => 'سرمدا',

        ]);
        City::create([
            'name' => 'اعزاز',
        ]);

        City::create([
            'name' => 'الباب',

        ]);
        City::create([
            'name' => 'اطمة',

        ]);
//------------------------------
        Category::create([
            'name' => 'ملابس'
        ]);
        Category::create([
            'name' => 'طعام'
        ]);
        Category::create([
            'name' => 'موبايلات'
        ]);
        Category::create([
            'name' => 'شاشات'
        ]);

//        Products Seeder

        Product::create([
            'category_id' => 1,
            'user_id'=>1,
            'name'=>'عرض1',
            'start'=>now()->format('Y-m-d'),
            'end'=>now()->format('Y-m-d'),
            'is_active'=>true,
            'price_before'=>100,
            'price_after'=>80,
            'quantity'=>20,
            'city_id'=>1

        ]);
        Product::create([
            'category_id' => 1,
            'user_id'=>2,
            'name'=>'عرض2',
            'start'=>now()->format('Y-m-d'),
            'end'=>now()->format('Y-m-d'),
            'is_active'=>false,
            'price_before'=>100,
            'price_after'=>80,
            'quantity'=>20,
            'city_id'=>2

        ]);
        Product::create([
            'category_id' => 2,
            'user_id'=>3,
            'name'=>'عرض3',
            'start'=>now()->format('Y-m-d'),
            'end'=>now()->format('Y-m-d'),
            'is_active'=>true,
            'price_before'=>100,
            'price_after'=>80,
            'quantity'=>20,
            'city_id'=>3

        ]);
        Product::create([
            'category_id' => 3,
            'user_id'=>5,
            'name'=>'عرض4',
            'start'=>now()->format('Y-m-d'),
            'end'=>now()->format('Y-m-d'),
            'is_active'=>true,
            'price_before'=>100,
            'price_after'=>80,
            'quantity'=>20,
            'city_id'=>3

        ]);
        Product::create([
            'category_id' => 1,
            'user_id'=>1,
            'name'=>'عرض5',
            'start'=>now()->format('Y-m-d'),
            'end'=>now()->format('Y-m-d'),
            'is_active'=>true,
            'price_before'=>100,
            'price_after'=>80,
            'quantity'=>20,
            'city_id'=>3

        ]);


    }
}
