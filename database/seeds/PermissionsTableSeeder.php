<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'categories.manage',
                'display_name' => '管理报修种类',
            ],
            [
                'name' => 'dorms.manage',
                'display_name' => '管理宿舍楼',
            ],
            [
                'name' => 'repairs.manage',
                'display_name' => '管理报修',
            ],
            [
                'name' => 'admins.manage',
                'display_name' => '管理管理员及权限',
            ],

        ];

        foreach ($data as $item) {
            Permission::create($item);
        }
    }
}
