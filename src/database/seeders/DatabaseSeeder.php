<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contacts;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // categoriesテーブル
        $this->call(CategoriesTableSeeder::class);

        // contactsテーブル（35件作成）
        Contacts::factory(35)->create();
    }
}
