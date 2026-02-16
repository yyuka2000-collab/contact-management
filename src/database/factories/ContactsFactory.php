<?php

namespace Database\Factories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Contacts::class;

    // ① コンストラクタで日本語Fakerを設定
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->faker = Faker::create('ja_JP'); // 日本語化
    }

    public function definition()
    {
        return [
            'categry_id' => \App\Models\Categories::inRandomOrder()->value('id'),
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,

            // 1:男性 2:女性 3:その他
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            // ハイフンなしの電話番号（10桁または11桁）
            'tel'   => '0' . $this->faker->numerify('##########'), // 11桁の例: 09012345678
            'address' => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->realText(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
