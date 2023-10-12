<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ContentSeeder extends Seeder
{
    public function run()
    {
        $properties = [
            [
                'name' => 'Цвет',
                'name_en' => 'Color',
                'options' => [
                    [
                        'name' => 'Белый',
                        'name_en' => 'White',
                    ],
                    [
                        'name' => 'Черный',
                        'name_en' => 'Black',
                    ],
                    [
                        'name' => 'Серебристый',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Золотой',
                        'name_en' => 'Gold',
                    ],
                    [
                        'name' => 'Синий',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Красный',
                        'name_en' => 'Red',
                    ],
                ],
            ],
            [
                'name' => 'Внутрення память',
                'name_en' => 'Memory',
                'options' => [
                    [
                        'name' => '32 гб',
                        'name_en' => '32 gb',
                    ],
                    [
                        'name' => '64 гб',
                        'name_en' => '64 gb',
                    ],
                    [
                        'name' => '128 гб',
                        'name_en' => '128 gb',
                    ],
                ]
            ],
        ];
        foreach ($properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();
            $options = $property['options'];
            unset($property['options']);
            $propertyId = DB::table('properties')->insertGetId($property);

            foreach ($options as $option) {
                $option['created_at'] = Carbon::now();
                $option['updated_at'] = Carbon::now();
                $option['property_id'] = $propertyId;
                DB::table('property_options')->insert($option);
            }
        }

        $categories = [
            [
                'name' => 'Мобильные телефоны',
                'name_en' => 'Mobile phones',
                'code' => 'mobiles',
                'description' => 'Сотовые телефоны соединяют вас и ваших близких',
                'description_en' => 'Cell phones connect you and your loved ones',
                'image' => 'categories/mobiles.jpeg',
                'products' =>
                    [
                        [
                            'name' => 'IPhone XI',
                            'name_en' => 'IPhone XI',
                            'code' => 'iphone_x_64',
                            'description' => 'Сверхтехнологичное устройство',
                            'description_en' => 'Super technological device',
                            'image' => 'products/iphone_x_64.jpeg',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    1, 7,
                                ],
                                [
                                    1, 8,
                                ],
                                [
                                    2, 7,
                                ],
                                [
                                    2, 8,
                                ],
                                [
                                    3, 7,
                                ],
                                [
                                    3, 8,
                                ],
                                [
                                    4, 7,
                                ],
                                [
                                    4, 8,
                                ],
                            ],
                        ],
                        [
                            'name' => 'IPhone X',
                            'name_en' => 'IPhone X',
                            'code' => 'iphone_x',
                            'description' => 'Технологии у вас в кармане',
                            'description_en' => 'Technologies are in your pocket',
                            'image' => 'products/iphone_x_256.webp',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    1, 8,
                                ],
                                [
                                    1, 9,
                                ],
                                [
                                    2, 8,
                                ],
                                [
                                    2, 9,
                                ],
                                [
                                    3, 8,
                                ],
                                [
                                    3, 9,
                                ],
                                [
                                    4, 8,
                                ],
                                [
                                    4, 9,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Samsung A71',
                            'name_en' => 'Samsung A71',
                            'code' => 'samsung_a71',
                            'description' => 'Умный и идеальный вариант по разумной цене',
                            'description_en' => 'Smart and perfect for a reasonable price',
                            'image' => 'products/samsung_a71.jpeg',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    1, 8,
                                ],
                                [
                                    1, 9,
                                ],
                                [
                                    2, 8,
                                ],
                                [
                                    2, 9,
                                ],
                                [
                                    3, 8,
                                ],
                                [
                                    3, 9,
                                ],
                                [
                                    4, 8,
                                ],
                                [
                                    4, 9,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Huawei Honor P90',
                            'name_en' => 'Huawei Honor P90',
                            'code' => 'huawei_honor_p90',
                            'description' => 'Самый продаваемый телефон в Южной Корее',
                            'description_en' => 'The most selling phone in South Korea',
                            'image' => 'products/huawei_honor_p90.jpeg',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    2, 7,
                                ],
                                [
                                    2, 8,
                                ],
                            ],
                        ],
                    ],
            ],
            [
                'name' => 'Портативная техника',
                'name_en' => 'Portable devices',
                'code' => 'portable',
                'description' => 'Портативные девайсы делают жизнь комфортной',
                'description_en' => 'Portable devices make your life comfortable',
                'image' => 'categories/portable.jpeg',
                'products' => [
                    [
                        'name' => 'Camera GoPro 2',
                        'name_en' => 'Camera GoPro 2',
                        'code' => 'go_pro2',
                        'description' => 'Проактивная камера для запечатления ваших лучших эмоций',
                        'description_en' => 'Proactive camera for capturing your best emotions',
                        'image' => 'products/go_pro2.jpeg',
                    ],
                    [
                        'name' => 'Samsung EarBuds 3',
                        'name_en' => 'Samsung EarBuds 3',
                        'code' => 'samsung_earbuds3',
                        'description' => 'Самый чистый звук легко соединил ваш телефон и ваше сердце на протяжении многих лет',
                        'description_en' => 'The most pure sound easily connected your phone and your heart through ears',
                        'image' => 'products/samsung_earbuds3.webp',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ]
                        ],
                    ],
                    [
                        'name' => 'Apple AirPods 2',
                        'name_en' => 'Apple AirPods 2',
                        'code' => 'apple_airpods2',
                        'description' => 'Легендарные наушники для наилучшего прослушивания ваших любимых песен',
                        'description_en' => 'Legendary headphones for the best experience with your favorite songs',
                        'image' => 'products/apple_airpods2.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ]
                        ],
                    ],

                ],
            ],
            [
                'name' => 'Бытовая техника',
                'name_en' => 'Appliances',
                'code' => 'appliances',
                'description' => 'С бытовой техникой домашние дела становятся удовольствием',
                'description_en' => 'With house appliances house chores are pleasure for you',
                'image' => 'categories/appliances.jpeg',
                'products' => [
                    [
                        'name' => 'Philips Teapot Ml',
                        'name_en' => 'Philips Teapot Ml',
                        'code' => 'philips_teapot_s',
                        'description' => 'Горячая вода для ваших напитков 24/7',
                        'description_en' => 'Hot water for your drinks 24/7',
                        'image' => 'products/philips_teapot_s.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Haier Dishwasher',
                        'name_en' => 'Haier Dishwasher',
                        'code' => 'haier_dishwasher',
                        'description' => 'Отныне чистота - это второе название вашей столовой посуды',
                        'description_en' => 'Cleanliness is the second name of your dining tableware from now on',
                        'image' => 'products/haier_dishwasher.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                3,
                            ]
                        ],
                    ],
                    [
                        'name' => 'Apple Station Smart Home',
                        'name_en' => 'Apple Station Smart Home',
                        'code' => 'apple_station_smart_home',
                        'description' => 'Ваш дом может быть защищен от вторжений',
                        'description_en' => 'Your home can be protected from invasions',
                        'image' => 'products/apple_station_smart_home.jpeg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],


                ],
            ],

        ];

        Storage::makeDirectory('categories');
        Storage::makeDirectory('products');
        Artisan::call('storage:link');

        foreach ($categories as $category) {
            File::copy("resources/images/{$category['image']}", storage_path("app/public/{$category['image']}"));
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();
            $products = $category['products'];
            unset($category['products']);
            $categoryId = DB::table('categories')->insertGetId($category);
            foreach ($products as $product) {
                $product['created_at'] = Carbon::now();
                $product['hit'] = rand(0, 1);
                $product['recommended'] = rand(0, 1);
                $product['new'] = rand(0, 1);
                $product['updated_at'] = Carbon::now();
                $product['category_id'] = $categoryId;
                if (isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                }
                if (isset($product['options'])) {
                    $options = $product['options'];
                    unset($product['options']);
                }

                $productId = DB::table('products')->insertGetId($product);
                File::copy("resources/images/{$product['image']}", storage_path("app/public/{$product['image']}"));

                if (isset($properties)) {
                    foreach ($properties as $propertyId) {
                        DB::table('property_product')->insert(
                            [
                                'property_id' => $propertyId,
                                'product_id' => $productId,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]
                        );

                    }
                    unset($properties);
                }
                if (isset($options)) {
                    foreach ($options as $sku_options) {
                        $skuId = DB::table('skus')->insertGetId(
                            [
                                'product_id' => $productId,
                                'count' => rand(0, 100),
                                'price' => rand(5000, 150000),
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]
                        );
                        foreach ($sku_options as $option) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $option;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();

                            DB::table('sku_property_option')->insert($skuData);

                        }

                    }
                    unset($options);
                } else {
                    DB::table('skus')->insert(
                        [
                            'product_id' => $productId,
                            'count' => rand(0, 100),
                            'price' => rand(5000, 150000),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    );
                }

            }
        }
    }
}
