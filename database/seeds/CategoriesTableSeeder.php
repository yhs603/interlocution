<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'pid'        => 0,
                'name'       => '默认',
                'alias'      => 'default',
                'sort'       => 0,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'pid'        => 0,
                'name'       => '文艺',
                'alias'      => 'literature',
                'sort'       => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'pid'        => 0,
                'name'       => '军事',
                'alias'      => 'military',
                'sort'       => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'pid'        => 0,
                'name'       => '科技',
                'alias'      => 'technology',
                'sort'       => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'pid'        => 0,
                'name'       => '娱乐',
                'alias'      => 'entertainment',
                'sort'       => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'pid'        => 0,
                'name'       => '生活',
                'alias'      => 'life',
                'sort'       => 1,
                'status'     => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
