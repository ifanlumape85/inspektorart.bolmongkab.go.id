<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'layanan-list',
            'layanan-create',
            'layanan-edit',
            'layanan-delete',
            'pengaduan-list',
            'pengaduan-create',
            'pengaduan-edit',
            'pengaduan-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
