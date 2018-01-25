<?php

use Illuminate\Database\Seeder;
use App\Model2\order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $orders =[
        [
            'city' => '台北市',
        ],
        [
            'city' => '新北市',
        ],
        [
            'city' => '基隆',
        ],
        [
            'city' => '桃園',
        ],
        [
            'city' => '新竹',
        ],
        [
            'city' => '苗栗',
        ],
        [
            'city' => '台中市',
        ],
        [
            'city' => '彰化',
        ],
        [
            'city' => '南投',
        ],
        [
            'city' => '雲林',
        ],
        [
            'city' => '嘉義',
        ],
        [
            'city' => '台南市',
        ],
        [
            'city' => '高雄市',
        ],
        [
            'city' => '屏東',
        ],
        [
            'city' => '宜蘭',
        ],
        [
            'city' => '花蓮',
        ],
        [
            'city' => '台東',
        ],
        [
            'city' => '外島',
        ],
        [
            'city' => '其他',
        ],

    ];

    DB::table('order')->delete();
  foreach ($orders as $order){
      order::create($order);
      }
    }
}
