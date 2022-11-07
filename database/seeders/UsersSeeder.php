<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // 生成数据集合
        User::factory()->count(100)->create();

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = '翟宇鑫';
        $user->email = 'zhaiyuxin103@hotmail.com';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Admin');
    }
}
