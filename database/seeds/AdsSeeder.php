<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = ['simple', 'markup', 'img', 'simple_img', 'markup_img'];
        $bg_type = ['normal', 'custom_image'];
        $priority = ['EXCEPTIONAL', 'high', 'medium', 'low'];


        for ($i = 0; $i < 100; $i++) {
            $time = new DateTime();
            $time->add(new DateInterval("P" . rand(2, 5) . "D"));
            DB::table('ads_table')->insert([

                'name'          => str_random(rand(1, 64)),
                'owner'         => str_random(rand(6, 20)),
                'type'          => $type[rand(0, 4)],
                'text'          => str_random(rand(30, 150)),
                'image_name'    => (string) Str::uuid(),
                'scaling'       => rand(1, 100) / rand(1, 100),
                'bg_type'       => $bg_type[rand(0, 1)],
                'bg_image_name' => str_random(rand(1, 32)),
                'starts_at'     => $time,
                'finishes_at'   => $time,
                'created_at'    => new DateTime,
                'priority'      => $priority[rand(0, 3)],
                'enabled'       => rand(0, 1) == 1 ? true : false,

            ]);
        }
    }
}
