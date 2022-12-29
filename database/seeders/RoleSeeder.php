<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_array = [
            'superadmin',
            'admin bri',
            'admin cri',
            'Kantor Pusat',
            'Kantor Wilayah',
            'Kantor Cabang',
            'Kantor Cabang Pembantu',
            'Kantor Cabang Khusus',
            'operasional',
            'operasional verifikator',
            'sales developer',
            'sales lepas',
            'Marketing SFT BRI'
        ];

        foreach ($role_array as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
