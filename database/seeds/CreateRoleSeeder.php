<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'=>'admin','display_name'=>'quản trị hệ thống'],
            ['name'=>'guest','display_name'=>'khách hàng'],
            ['name'=>'developer','display_name'=>'phát triển hệ thống'],
            ['name'=>'content','display_name'=>'chỉnh sửa nội dung'],
        ]);
    }
}
