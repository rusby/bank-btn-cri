<?php

namespace Database\Seeders;

use Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Kota,
    UserBri,
    KantorCabang
};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pusat = User::firstOrCreate(
            [
                'email' => 'pusat@mail.com'
            ],
            [
                'name'        => 'Kantor Pusat',
                'username'    => 'pusat',
                'password'    => Hash::make('123123'),
                'email_verified_at' => Carbon::now(),
                'is_approved' => true
            ]);
        $pusat->assignRole('Kantor Pusat');    

        $admin = User::firstOrCreate(
            [
                'email' => 'super@admin.id'
            ],
            [
                'name'     => 'Super Admin',
                'username' => 'admin',
                'password' => Hash::make('123123'),
                'email_verified_at' => Carbon::now(),
                'is_approved' => true
            ]);
        $admin->assignRole('superadmin');

        $operasional = User::firstOrCreate(
            [
                'email' => 'ops@ops.id'
            ],
            [
                'name'     => 'Operasional Officer',
                'username' => 'ops',
                'password' => Hash::make('123123'),
                'email_verified_at' => Carbon::now(),
                'is_approved' => true
            ]);
        $operasional->assignRole('operasional');

        $operasionalVer = User::firstOrCreate(
            [
                'email' => 'verif@verif.id'
            ],
            [
                'name'     => 'Operasional Verifikatorr 1',
                'username' => 'verif1',
                'password' => Hash::make('123123'),
                'email_verified_at' => Carbon::now(),
                'is_approved' => true
            ]);
        $operasionalVer->assignRole('operasional verifikator');

        // $wilayah = User::firstOrCreate(
        //     [
        //         'email' => 'denpasar@wilayah.com'
        //     ],
        //     [
        //         'name'     => 'Kantor Wilayah Denpasar',
        //         'username' => 'wil_denpasar',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $wilayah->assignRole('Kantor Wilayah');

        // $cabang = User::firstOrCreate(
        //     [
        //         'email' => 'kuta@cabang.com'
        //     ],
        //     [
        //         'name'     => 'Kantor Cabang Kuta',
        //         'username' => 'kuta_cabang',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $cabang->assignRole('Kantor Cabang');

        // $kcp = User::firstOrCreate(
        //     [
        //         'email' => 'seminyak@kcp.com'
        //     ],
        //     [
        //         'name'     => 'Kantor Kcp Seminyak',
        //         'username' => 'seminyak_kcp',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $kcp->assignRole('Kantor Cabang Pembantu');

        // $kck = User::firstOrCreate(
        //     [
        //         'email' => 'user@kcp.com'
        //     ],
        //     [
        //         'name'     => 'Kantor Cabang Khusus',
        //         'username' => 'user_kck',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $kck->assignRole('Kantor Cabang Khusus');

        // $kanwilId = Kota::whereKota('Denpasar')->first()->id;
        // $kancaId  = KantorCabang::whereNama('Kuta')->first()->id;

        // UserBri::insert([
        //     [
        //         'user_id'         => $pusat->id,
        //         'is_kantor_pusat' => true,
        //         'kanwil_id'       => null,
        //         'kanca_kode'      => null
        //     ],
        //     [
        //         'user_id'         => $wilayah->id,
        //         'is_kantor_pusat' => false,
        //         'kanwil_id'       => $kanwilId,
        //         'kanca_kode'      => null
        //     ],
        //     [
        //         'user_id'         => $cabang->id,
        //         'is_kantor_pusat' => false,
        //         'kanwil_id'       => $kanwilId,
        //         'kanca_kode'      => $kancaId
        //     ]
        // ]);
        // UserBri::create([
        //     'user_id'   => $kcp->id,
        //     'kcp_kode'  => 2134
        // ]);
        // UserBri::create([
        //     'user_id'   => $kck->id,
        //     'is_kck'    => true
        // ]);        

        // $collection = User::firstOrCreate(
        //     [
        //         'email' => 'collection@lpkn.id'
        //     ],
        //     [
        //         'name'     => 'Collection Officer',
        //         'username' => 'col',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $collection->assignRole('collection');

        // $developer = User::firstOrCreate(
        //     [
        //         'email' => 'developer@lpkn.id'
        //     ],
        //     [
        //         'name'     => 'Developer Officer',
        //         'username' => 'dev',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $developer->assignRole('sales developer');

        // $sales = User::firstOrCreate(
        //     [
        //         'email' => 'sales@lpkn.id'
        //     ],
        //     [
        //         'name'     => 'Sales Officer',
        //         'username' => 'sal',
        //         'password' => Hash::make('123123'),
        //         'email_verified_at' => Carbon::now(),
        //         'is_approved' => true
        //     ]);
        // $sales->assignRole('sales lepas');
    }
}
