<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Laravel',
                'children' => [
                    ['name' => '翻译'],
                    ['name' => '工作'],
                    ['name' => '作品'],
                    ['name' => '问答'],
                    [
                        'name' => '面试题',
                        'children' => [
                            ['name' => 'Redis'],
                            ['name' => 'MySQL'],
                        ],
                    ],
                    ['name' => '代码速记'],
                ],
            ],
            [
                'name' => 'Golang',
                'children' => [
                    ['name' => '翻译'],
                    ['name' => '工作'],
                    ['name' => '作品'],
                    ['name' => '问答'],
                    ['name' => '面试题'],
                    ['name' => '代码速记'],
                ],
            ],
            [
                'name' => 'AdonisJS',
                'children' => [
                    ['name' => '翻译'],
                    ['name' => '工作'],
                    ['name' => '作品'],
                    ['name' => '问答'],
                    ['name' => '面试题'],
                    ['name' => '代码速记'],
                ],
            ],
            [
                'name' => 'Flutter',
                'children' => [
                    ['name' => '翻译'],
                    ['name' => '工作'],
                    ['name' => '作品'],
                    ['name' => '问答'],
                    ['name' => '面试题'],
                    ['name' => '代码速记'],
                ],
            ],
        ];

        foreach ($categories as $data) {
            $this->createCategory($data);
        }
    }

    protected function createCategory($data, $parent = null): void
    {
        // 创建一个新的类目对象
        $category = new Category(['name' => $data['name']]);
        // 如果有 children 字段则代表这是一个父类目
        $category->is_directory = isset($data['children']);
        // 如果有传入 $parent 参数，代表有父类目
        if (! is_null($parent)) {
            $category->parent()->associate($parent);
        }
        // 保存到数据库
        $category->save();
        // 如果有 children 字段并且 children 字段是一个数组
        if (isset($data['children']) && is_array($data['children'])) {
            // 遍历 children 字段
            foreach ($data['children'] as $child) {
                // 递归调用 createCategory 方法，第二个参数即为刚刚创建的类目
                $this->createCategory($child, $category);
            }
        }
    }
}
