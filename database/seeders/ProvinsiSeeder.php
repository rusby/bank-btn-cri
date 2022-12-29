<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi as provinsi;

class ProvinsiSeeder extends Seeder
{
    /**
     *Runthedatabaseseeds.
     *
     *@returnvoid
     */
    public function run()
    {   
        if(provinsi::get()->count() < 1) {
            provinsi::insert(
                array(
                    [
                        "provinsi"=>"Bali",
                        "kode"=>"51"
                    ],
                    [
                        "provinsi"=>"Bangka Belitung",
                        "kode"=>"19"
                    ],
                    [
                        "provinsi"=>"Banten",
                        "kode"=>"36"
                    ],
                    [
                        "provinsi"=>"Bengkulu",
                        "kode"=>"17"
                    ],
                    [
                        "provinsi"=>"DI Yogyakarta",
                        "kode"=>"34"
                    ],
                    [
                        "provinsi"=>"DKI Jakarta",
                        "kode"=>"31"
                    ],
                    [
                        "provinsi"=>"Gorontalo",
                        "kode"=>"75"
                    ],
                    [
                        "provinsi"=>"Jambi",
                        "kode"=>"15"
                    ],
                    [
                        "provinsi"=>"Jawa Barat",
                        "kode"=>"32"
                    ],
                    [
                        "provinsi"=>"Jawa Tengah",
                        "kode"=>"33"
                    ],
                    [
                        "provinsi"=>"Jawa Timur",
                        "kode"=>"35"
                    ],
                    [
                        "provinsi"=>"Kalimantan Barat",
                        "kode"=>"61"
                    ],
                    [
                        "provinsi"=>"Kalimantan Selatan",
                        "kode"=>"63"
                    ],
                    [
                        "provinsi"=>"Kalimantan Tengah",
                        "kode"=>"62"
                    ],
                    [
                        "provinsi"=>"Kalimantan Timur",
                        "kode"=>"64"
                    ],
                    [
                        "provinsi"=>"Kalimantan Utara",
                        "kode"=>"65"
                    ],
                    [
                        "provinsi"=>"Kepulauan Riau",
                        "kode"=>"21"
                    ],
                    [
                        "provinsi"=>"Lampung",
                        "kode"=>"18"
                    ],
                    [
                        "provinsi"=>"Maluku",
                        "kode"=>"81"
                    ],
                    [
                        "provinsi"=>"Maluku Utara",
                        "kode"=>"82"
                    ],
                    [
                        "provinsi"=>"Nanggroe Aceh Darussalam(NAD)",
                        "kode"=>"11"
                    ],
                    [
                        "provinsi"=>"Nusa Tenggara Barat",
                        "kode"=>"52"
                    ],
                    [
                        "provinsi"=>"Nusa Tenggara Timur",
                        "kode"=>"53"
                    ],
                    [
                        "provinsi"=>"Papua",
                        "kode"=>"94"
                    ],
                    [
                        "provinsi"=>"Papua Barat",
                        "kode"=>"91"
                    ],
                    [
                        "provinsi"=>"Riau",
                        "kode"=>"14"
                    ],
                    [
                        "provinsi"=>"Sulawesi Barat",
                        "kode"=>"76"
                    ],
                    [
                        "provinsi"=>"Sulawesi Selatan",
                        "kode"=>"73"
                    ],
                    [
                        "provinsi"=>"Sulawesi Tengah",
                        "kode"=>"72"
                    ],
                    [
                        "provinsi"=>"Sulawesi Tenggara",
                        "kode"=>"74"
                    ],
                    [
                        "provinsi"=>"Sulawesi Utara",
                        "kode"=>"71"
                    ],
                    [
                        "provinsi"=>"Sumatera Barat",
                        "kode"=>"13"
                    ],
                    [
                        "provinsi"=>"Sumatera Selatan",
                        "kode"=>"16"
                    ],
                    [
                        "provinsi"=>"Sumatera Utara",
                        "kode"=>"12"
                    ]
                )
            );
        }
    }
}
