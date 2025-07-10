<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'キウイ',
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 800,
                'image' => 'default_images/kiwi.png',
            ],
            [
                'id' => 2,
                'name' => 'ストロベリー',
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 1200,
                'image' => 'default_images/strawberry.png',
            ],
            [
                'id' => 3,
                'name' => 'オレンジ',
                'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージをお召し上がりください！',
                'price' => 850,
                'image' => 'default_images/orange.png',
            ],
            [
                'id' => 4,
                'name' => 'スイカ',
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 700,
                'image' => 'default_images/watermelon.png',
            ],
            [
                'id' => 5,
                'name' => 'ピーチ',
                'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 1000,
                'image' => 'default_images/peach.png',
            ],
            [
                'id' => 6,
                'name' => 'シャインマスカット',
                'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカットは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 1400,
                'image' => 'default_images/muscat.png',
            ],
            [
                'id' => 7,
                'name' => 'パイナップル',
                'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージをお召し上がりください！',
                'price' => 1500,
                'image' => 'default_images/pineapple.png',
            ],
            [
                'id' => 8,
                'name' => 'ブドウ',
                'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 1100,
                'image' => 'default_images/grapes.png',
            ],
            [
                'id' => 9,
                'name' => 'バナナ',
                'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめの商品です。1杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 600,
                'image' => 'default_images/banana.png',
            ],
            [
                'id' => 10,
                'name' => 'メロン',
                'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！',
                'price' => 900,
                'image' => 'default_images/melon.png',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
