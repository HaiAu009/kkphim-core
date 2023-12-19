<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use KKPhim\Core\Database\Seeders\CategoriesTableSeeder;
use KKPhim\Core\Database\Seeders\SettingsTableSeeder;
use KKPhim\Core\Database\Seeders\RegionsTableSeeder;
use KKPhim\Core\Database\Seeders\ThemesTableSeeder;
use KKPhim\Core\Database\Seeders\MenusTableSeeder;
use KKPhim\Core\Models\Actor;
use KKPhim\Core\Models\Category;
use KKPhim\Core\Models\Director;
use KKPhim\Core\Models\Episode;
use KKPhim\Core\Models\Movie;
use KKPhim\Core\Models\Region;
use KKPhim\Core\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function test()
    {
        $this->call([
            CategoriesTableSeeder::class,
            RegionsTableSeeder::class,
            ThemesTableSeeder::class,
            MenusTableSeeder::class,
            SettingsTableSeeder::class,
        ]);

        Actor::factory(100)->create();
        Director::factory(100)->create();
        Tag::factory(100)->create();

        for ($i = 1; $i < 1000; $i++) {
            Movie::factory(1)
                ->state([
                    'publish_year' => rand(2018, 2022)
                ])
                ->hasAttached(Region::all()->random())
                ->hasAttached(Category::all()->random(3))
                ->hasAttached(Actor::all()->random(rand(1, 5)))
                ->hasAttached(Director::all()->random(1))
                ->hasAttached(Tag::all()->random(5))
                ->has(Episode::factory(5)->state([
                    'server' => '#Hà Nội',
                    'type' => 'embed',
                    'link' => 'https://player.phimapi.com/player/?url=https://s1.phim1280.tv/20231216/1glT3LWS/index.m3u8'
                ]))
                ->create();
        }
    }
}
