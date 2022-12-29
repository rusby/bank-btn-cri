<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KantorCabang;
use Illuminate\Support\Str;

class KantorCabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KantorCabang::create([
            'nama'    => "Kantor Cabang Khusus",
            'kode'    => 206,
            'kota_id' => null,
            'is_kck'  => true
        ]);
        KantorCabang::insert([
        	[
        		'nama' 	  => "Arga Makmur",
        		'kode'	  => 318,
        		'kota_id' => 206
        	],
            [
                'nama'    => "Bandarjaya",
                'kode'    => 357,
                'kota_id' => 206
            ],
            [
                'nama'    => "Bengkulu",
                'kode'    => 115,
                'kota_id' => 206
            ],
            [
                'nama'    => "Curup",
                'kode'    => 108,
                'kota_id' => 206
            ],
            [
                'nama'    => "Kalianda",
                'kode'    => 503,
                'kota_id' => 206
            ],
            [
                'nama'    => "Kota Bumi",
                'kode'    => 155,
                'kota_id' => 206
            ],
            [
                'nama'    => "Liwa",
                'kode'    => 603,
                'kota_id' => 206
            ],
            [
                'nama'    => "Manna",
                'kode'    => 150,
                'kota_id' => 206
            ],
            [
                'nama'    => "Metro",
                'kode'    => 130,
                'kota_id' => 206
            ],
            [
                'nama'    => "Muko-Muko",
                'kode'    => 1101,
                'kota_id' => 206
            ],
            [
                'nama'    => "Pringsewu",
                'kode'    => 358,
                'kota_id' => 206
            ],
            [
                'nama'    => "Tanjung Karang",
                'kode'    => 98,
                'kota_id' => 206
            ],
            [
                'nama'    => "Teluk Betung",
                'kode'    => 285,
                'kota_id' => 206
            ],
            [
                'nama'    => "Tulang Bawang",
                'kode'    => 605,
                'kota_id' => 206
            ],
            [
                'nama'    => "Bandung AH Nasution",
                'kode'    => 354,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Asia Afrika",
                'kode'    => 5,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Dago",
                'kode'    => 405,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Dewi Sartika",
                'kode'    => 286,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Kopo",
                'kode'    => 401,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Marthadinata",
                'kode'    => 389,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Naripan",
                'kode'    => 337,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Setiabudi",
                'kode'    => 408,
                'kota_id' => 67
            ],
            [
                'nama'    => "Bandung Soekarno Hatta",
                'kode'    => 407,
                'kota_id' => 67
            ],
            [
                'nama'    => "Banjar",
                'kode'    => 162,
                'kota_id' => 67
            ],
            [
                'nama'    => "Ciamis",
                'kode'    => 104,
                'kota_id' => 67
            ],
            [
                'nama'    => "Cianjur",
                'kode'    => 105,
                'kota_id' => 67
            ],
            [
                'nama'    => "Cibadak",
                'kode'    => 181,
                'kota_id' => 67
            ],
            [
                'nama'    => "Cimahi",
                'kode'    => 137,
                'kota_id' => 67
            ],
            [
                'nama'    => "Cirebon Gunung Jati",
                'kode'    => 406,
                'kota_id' => 67
            ],
            [
                'nama'    => "Cirebon Kartini",
                'kode'    => 107,
                'kota_id' => 67
            ],
            [
                'nama'    => "Garut",
                'kode'    => 25,
                'kota_id' => 67
            ],
            [
                'nama'    => "Indramayu",
                'kode'    => 28,
                'kota_id' => 67
            ],
            [
                'nama'    => "Jatibarang",
                'kode'    => 165,
                'kota_id' => 67
            ],
            [
                'nama'    => "Kuningan",
                'kode'    => 133,
                'kota_id' => 67
            ],
            [
                'nama'    => "Majalaya",
                'kode'    => 132,
                'kota_id' => 67
            ],
            [
                'nama'    => "Majalengka",
                'kode'    => 46,
                'kota_id' => 67
            ],
            [
                'nama'    => "Pamanukan",
                'kode'    => 355,
                'kota_id' => 67
            ],
            [
                'nama'    => "Purwakarta",
                'kode'    => 75,
                'kota_id' => 67
            ],
            [
                'nama'    => "Singaparna",
                'kode'    => 161,
                'kota_id' => 67
            ],
            [
                'nama'    => "Soreang",
                'kode'    => 544,
                'kota_id' => 67
            ],
            [
                'nama'    => "Subang",
                'kode'    => 123,
                'kota_id' => 67
            ],
            [
                'nama'    => "Sukabumi",
                'kode'    => 92,
                'kota_id' => 67
            ],
            [
                'nama'    => "Sumedang",
                'kode'    => 94,
                'kota_id' => 67
            ],
            [
                'nama'    => "Tasikmalaya",
                'kode'    => 100,
                'kota_id' => 67
            ],
            [
                'nama'    => "Amuntai",
                'kode'    => 147,
                'kota_id' => 160
            ],
            [
                'nama'    => "Balikpapan Ahmad Yani",
                'kode'    => 630,
                'kota_id' => 160
            ],
            [
                'nama'    => "Balikpapan Sudirman",
                'kode'    => 121,
                'kota_id' => 160
            ],
            [
                'nama'    => "Banjarmasin Samudera",
                'kode'    => 3,
                'kota_id' => 160
            ],
            [
                'nama'    => "Banjarmasin Ahmad Yani",
                'kode'    => 623,
                'kota_id' => 160
            ],
            [
                'nama'    => "Barabai",
                'kode'    => 143,
                'kota_id' => 160
            ],
            [
                'nama'    => "Batulicin",
                'kode'    => 126,
                'kota_id' => 160
            ],
            [
                'nama'    => "Bontang",
                'kode'    => 333,
                'kota_id' => 160
            ],
            [
                'nama'    => "Buntok",
                'kode'    => 303,
                'kota_id' => 160
            ],
            [
                'nama'    => "Kandangan",
                'kode'    => 31,
                'kota_id' => 160
            ],
            [
                'nama'    => "Kotabaru",
                'kode'    => 127,
                'kota_id' => 160
            ],
            [
                'nama'    => "Kuala Kapuas",
                'kode'    => 180,
                'kota_id' => 160
            ],
            [
                'nama'    => "Marabahan",
                'kode'    => 244,
                'kota_id' => 160
            ],
            [
                'nama'    => "Martapura",
                'kode'    => 242,
                'kota_id' => 160
            ],
            [
                'nama'    => "Muara Teweh",
                'kode'    => 209,
                'kota_id' => 160
            ],
            [
                'nama'    => "Nunukan",
                'kode'    => 627,
                'kota_id' => 160
            ],
            [
                'nama'    => "Palangkaraya",
                'kode'    => 243,
                'kota_id' => 160
            ],
            [
                'nama'    => "Pangkalan Bun",
                'kode'    => 282,
                'kota_id' => 160
            ],
            [
                'nama'    => "Pelaihari",
                'kode'    => 239,
                'kota_id' => 160
            ],
            [
                'nama'    => "Rantau",
                'kode'    => 210,
                'kota_id' => 160
            ],
            [
                'nama'    => "Samarinda",
                'kode'    => 82,
                'kota_id' => 160
            ],
            [
                'nama'    => "Samarinda II",
                'kode'    => 448,
                'kota_id' => 160
            ],
            [
                'nama'    => "Sampit",
                'kode'    => 163,
                'kota_id' => 160
            ],
            [
                'nama'    => "Sangatta",
                'kode'    => 563,
                'kota_id' => 160
            ],
            [
                'nama'    => "Sendawar",
                'kode'    => 626,
                'kota_id' => 160
            ],
            [
                'nama'    => "Tanah Grogot",
                'kode'    => 214,
                'kota_id' => 160
            ],
            [
                'nama'    => "Tanjung Tabalong",
                'kode'    => 249,
                'kota_id' => 160
            ],
            [
                'nama'    => "Tanjung Redep",
                'kode'    => 213,
                'kota_id' => 160
            ],
            [
                'nama'    => "Tanjung Selor",
                'kode'    => 306,
                'kota_id' => 160
            ],
            [
                'nama'    => "Tarakan",
                'kode'    => 183,
                'kota_id' => 160
            ],
            [
                'nama'    => "Tenggarong",
                'kode'    => 212,
                'kota_id' => 160
            ],
            [
                'nama'    => "Amlapura",
                'kode'    => 241,
                'kota_id' => 9
            ],
            [
                'nama'    => "Atambua",
                'kode'    => 267,
                'kota_id' => 9
            ],
            [
                'nama'    => "Bajawa",
                'kode'    => 274,
                'kota_id' => 9
            ],
            [
                'nama'    => "Bangli",
                'kode'    => 233,
                'kota_id' => 9
            ],
            [
                'nama'    => "Denpasar Gajah Mada",
                'kode'    => 17,
                'kota_id' => 9
            ],
            [
                'nama'    => "Denpasar Gatot Subroto",
                'kode'    => 572,
                'kota_id' => 9
            ],
            [
                'nama'    => "Denpasar Renon",
                'kode'    => 368,
                'kota_id' => 9
            ],
            [
                'nama'    => "Dompu",
                'kode'    => 272,
                'kota_id' => 9
            ],
            [
                'nama'    => "Ende",
                'kode'    => 24,
                'kota_id' => 9
            ],
            [
                'nama'    => "Gianyar",
                'kode'    => 248,
                'kota_id' => 9
            ],
            [
                'nama'    => "Kalabahi",
                'kode'    => 278,
                'kota_id' => 9
            ],
            [
                'nama'    => "Kefamenanu",
                'kode'    => 276,
                'kota_id' => 9
            ],
            [
                'nama'    => "Kupang",
                'kode'    => 39,
                'kota_id' => 9
            ],
            [
                'nama'    => "Kuta",
                'kode'    => 556,
                'kota_id' => 9
            ],
            [
                'nama'    => "Larantuka",
                'kode'    => 246,
                'kota_id' => 9
            ],
            [
                'nama'    => "Mataram",
                'kode'    => 52,
                'kota_id' => 9
            ],
            [
                'nama'    => "Maumere",
                'kode'    => 119,
                'kota_id' => 9
            ],
            [
                'nama'    => "Negara",
                'kode'    => 125,
                'kota_id' => 9
            ],
            [
                'nama'    => "Praya",
                'kode'    => 191,
                'kota_id' => 9
            ],
            [
                'nama'    => "Raba Bima",
                'kode'    => 79,
                'kota_id' => 9
            ],
            [
                'nama'    => "Ruteng",
                'kode'    => 273,
                'kota_id' => 9
            ],
            [
                'nama'    => "Selong",
                'kode'    => 157,
                'kota_id' => 9
            ],
            [
                'nama'    => "Semarapura",
                'kode'    => 114,
                'kota_id' => 9
            ],
            [
                'nama'    => "Singaraja",
                'kode'    => 88,
                'kota_id' => 9
            ],
            [
                'nama'    => "Soe",
                'kode'    => 277,
                'kota_id' => 9
            ],
            [
                'nama'    => "Sumbawa Besar",
                'kode'    => 93,
                'kota_id' => 9
            ],
            [
                'nama'    => "Tabanan",
                'kode'    => 124,
                'kota_id' => 9
            ],
            [
                'nama'    => "Tabanan Kediri",
                'kode'    => 573,
                'kota_id' => 9
            ],
            [
                'nama'    => "Ubud",
                'kode'    => 590,
                'kota_id' => 9
            ],
            [
                'nama'    => "Waikabubak",
                'kode'    => 235,
                'kota_id' => 9
            ],
            [
                'nama'    => "Waingapu",
                'kode'    => 141,
                'kota_id' => 9
            ],
            [
                'nama'    => "Jakarta Artha Gading",
                'kode'    => 416,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Cempaka Mas",
                'kode'    => 434,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Cut Mutiah",
                'kode'    => 230,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Gading Boulevard",
                'kode'    => 439,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Gunung Sahari",
                'kode'    => 345,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Hayam Wuruk",
                'kode'    => 332,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Jatinegara",
                'kode'    => 122,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Kalimalang",
                'kode'    => 419,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Kelapa Gading",
                'kode'    => 320,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Kemayoran",
                'kode'    => 356,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Kramat",
                'kode'    => 335,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Krekot",
                'kode'    => 261,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Mall Ambasador",
                'kode'    => 1223,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Mangga Dua",
                'kode'    => 346,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Otista",
                'kode'    => 340,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Pantai Indah Kapuk",
                'kode'    => 440,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Pluit",
                'kode'    => 415,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Rasuna Said",
                'kode'    => 378,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Rawamangun",
                'kode'    => 386,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Segitiga Senen",
                'kode'    => 361,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Sudirman 1",
                'kode'    => 376,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Tanah Abang",
                'kode'    => 18,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Tanjung Priok",
                'kode'    => 186,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Veteran",
                'kode'    => 329,
                'kota_id' => 491
            ],
            [
                'nama'    => "Sunter",
                'kode'    => 441,
                'kota_id' => 491
            ],
            [
                'nama'    => "Jakarta Ampera",
                'kode'    => 425,
                'kota_id' => 492
            ],
            [
                'nama'    => "Bekasi",
                'kode'    => 139,
                'kota_id' => 492
            ],
            [
                'nama'    => "Bekasi Harapan Indah",
                'kode'    => 424,
                'kota_id' => 492
            ],
            [
                'nama'    => "Bogor Dewi Sartika",
                'kode'    => 12,
                'kota_id' => 492
            ],
            [
                'nama'    => "Bogor Padjajaran",
                'kode'    => 387,
                'kota_id' => 492
            ],
            [
                'nama'    => "Bursa Efek Indonesia",
                'kode'    => 671,
                'kota_id' => 492
            ],
            [
                'nama'    => "Cibinong",
                'kode'    => 421,
                'kota_id' => 492
            ],
            [
                'nama'    => "Cibubur",
                'kode'    => 384,
                'kota_id' => 492
            ],
            [
                'nama'    => "Cikampek",
                'kode'    => 302,
                'kota_id' => 492
            ],
            [
                'nama'    => "Cikarang",
                'kode'    => 319,
                'kota_id' => 492
            ],
            [
                'nama'    => "Cimanggis",
                'kode'    => 422,
                'kota_id' => 492
            ],
            [
                'nama'    => "Depok",
                'kode'    => 538,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Lebak Bulus",
                'kode'    => 428,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Fatmawati",
                'kode'    => 330,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Gatot Subroto",
                'kode'    => 359,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Menara BRILiaN",
                'kode'    => 426,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Kebayoran Baru",
                'kode'    => 193,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Kramat Jati",
                'kode'    => 442,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Pancoran",
                'kode'    => 390,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Panglima Polim",
                'kode'    => 420,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Pasar Minggu",
                'kode'    => 339,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Pondok Indah",
                'kode'    => 362,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Radio Dalam",
                'kode'    => 430,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Soepomo",
                'kode'    => 427,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta TB Simatupang",
                'kode'    => 443,
                'kota_id' => 492
            ],
            [
                'nama'    => "Jakarta Warung Buncit",
                'kode'    => 341,
                'kota_id' => 492
            ],
            [
                'nama'    => "Karawang",
                'kode'    => 116,
                'kota_id' => 492
            ],
            [
                'nama'    => "Mabes TNI Cilangkap",
                'kode'    => 2101,
                'kota_id' => 492
            ],
            [
                'nama'    => "Pekayon",
                'kode'    => 423,
                'kota_id' => 492
            ],
            [
                'nama'    => "Pondok Gede",
                'kode'    => 385,
                'kota_id' => 492
            ],
            [
                'nama'    => "Tambun",
                'kode'    => 444,
                'kota_id' => 492
            ],
            [
                'nama'    => "Balaraja",
                'kode'    => 437,
                'kota_id' => 493
            ],
            [
                'nama'    => "Bandara Soekarno Hatta",
                'kode'    => 1144,
                'kota_id' => 493
            ],
            [
                'nama'    => "Bintaro",
                'kode'    => 393,
                'kota_id' => 493
            ],
            [
                'nama'    => "Bumi Serpong Damai",
                'kode'    => 509,
                'kota_id' => 493
            ],
            [
                'nama'    => "Ciledug",
                'kode'    => 392,
                'kota_id' => 493
            ],
            [
                'nama'    => "Cilegon",
                'kode'    => 188,
                'kota_id' => 493
            ],
            [
                'nama'    => "Ciputat",
                'kode'    => 382,
                'kota_id' => 493
            ],
            [
                'nama'    => "Gading Serpong",
                'kode'    => 1145,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Daan Mogot",
                'kode'    => 379,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Jelambar",
                'kode'    => 418,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Joglo",
                'kode'    => 396,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Kalideres",
                'kode'    => 399,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Kebon Jeruk",
                'kode'    => 377,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Kota",
                'kode'    => 19,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Palmerah",
                'kode'    => 397,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Puri Niaga",
                'kode'    => 398,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Roxi",
                'kode'    => 338,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta S. Parman",
                'kode'    => 417,
                'kota_id' => 493
            ],
            [
                'nama'    => "Jakarta Tanjung Duren",
                'kode'    => 395,
                'kota_id' => 493
            ],
            [
                'nama'    => "Ketapang",
                'kode'    => 208,
                'kota_id' => 493
            ],
            [
                'nama'    => "Labuan",
                'kode'    => 166,
                'kota_id' => 493
            ],
            [
                'nama'    => "Melawi",
                'kode'    => 1162,
                'kota_id' => 493
            ],
            [
                'nama'    => "Mempawah",
                'kode'    => 207,
                'kota_id' => 493
            ],
            [
                'nama'    => "Pamulang",
                'kode'    => 1127,
                'kota_id' => 493
            ],
            [
                'nama'    => "Pandeglang",
                'kode'    => 62,
                'kota_id' => 493
            ],
            [
                'nama'    => "Pontianak",
                'kode'    => 71,
                'kota_id' => 493
            ],
            [
                'nama'    => "Pontianak Gajah Mada",
                'kode'    => 569,
                'kota_id' => 493
            ],
            [
                'nama'    => "Putussibau",
                'kode'    => 305,
                'kota_id' => 493
            ],
            [
                'nama'    => "Rangkasbitung",
                'kode'    => 80,
                'kota_id' => 493
            ],
            [
                'nama'    => "Sanggau",
                'kode'    => 322,
                'kota_id' => 493
            ],
            [
                'nama'    => "Serang",
                'kode'    => 84,
                'kota_id' => 493
            ],
            [
                'nama'    => "Singkawang",
                'kode'    => 89,
                'kota_id' => 493
            ],
            [
                'nama'    => "Sintang",
                'kode'    => 304,
                'kota_id' => 493
            ],
            [
                'nama'    => "Tangerang Ahmad Yani",
                'kode'    => 120,
                'kota_id' => 493
            ],
            [
                'nama'    => "Tangerang City",
                'kode'    => 438,
                'kota_id' => 493
            ],
            [
                'nama'    => "Tangerang Merdeka",
                'kode'    => 445,
                'kota_id' => 493
            ],
            [
                'nama'    => "Abepura",
                'kode'    => 446,
                'kota_id' => 302
            ],
            [
                'nama'    => "Biak",
                'kode'    => 308,
                'kota_id' => 302
            ],
            [
                'nama'    => "Bintuni",
                'kode'    => 1080,
                'kota_id' => 302
            ],
            [
                'nama'    => "Fak-Fak",
                'kode'    =>  1081,
                'kota_id' => 302
            ],
            [
                'nama'    => "Jayapura",
                'kode'    => 307,
                'kota_id' => 302
            ],
            [
                'nama'    => "Manokwari",
                'kode'    => 353,
                'kota_id' => 302
            ],
            [
                'nama'    => "Merauke",
                'kode'    => 352,
                'kota_id' => 302
            ],
            [
                'nama'    => "Nabire",
                'kode'    => 687,
                'kota_id' => 302
            ],
            [
                'nama'    => "Sentani",
                'kode'    => 1082,
                'kota_id' => 302
            ],
            [
                'nama'    => "Serui",
                'kode'    => 309,
                'kota_id' => 302
            ],
            [
                'nama'    => "Sorong",
                'kode'    => 310,
                'kota_id' => 302
            ],
            [
                'nama'    => "Timika",
                'kode'    => 561,
                'kota_id' => 302
            ],
            [
                'nama'    => "Wamena",
                'kode'    => 311,
                'kota_id' => 302
            ],
            [
                'nama'    => "Ambon",
                'kode'    => 1,
                'kota_id' => 365
            ],
            [
                'nama'    => "Bantaeng",
                'kode'    => 240,
                'kota_id' => 365
            ],
            [
                'nama'    => "Barru",
                'kode'    => 222,
                'kota_id' => 365
            ],
            [
                'nama'    => "Bau-Bau",
                'kode'    => 326,
                'kota_id' => 365
            ],
            [
                'nama'    => "Benteng Selayar",
                'kode'    => 257,
                'kota_id' => 365
            ],
            [
                'nama'    => "Bulukumba",
                'kode'    => 253,
                'kota_id' => 365
            ],
            [
                'nama'    => "Enrekang",
                'kode'    => 220,
                'kota_id' => 365
            ],
            [
                'nama'    => "Jeneponto",
                'kode'    => 252,
                'kota_id' => 365
            ],
            [
                'nama'    => "Kendari By Pass",
                'kode'    => 646,
                'kota_id' => 365
            ],
            [
                'nama'    => "Kendari Samratulangi",
                'kode'    => 192,
                'kota_id' => 365
            ],
            [
                'nama'    => "Kolaka",
                'kode'    => 216,
                'kota_id' => 365
            ],
            [
                'nama'    => "Majene",
                'kode'    => 47,
                'kota_id' => 365
            ],
            [
                'nama'    => "Makassar Ahmad Yani",
                'kode'    => 50,
                'kota_id' => 365
            ],
            [
                'nama'    => "Makassar Somba Opu",
                'kode'    => 343,
                'kota_id' => 365
            ],
            [
                'nama'    => "Mamuju",
                'kode'    => 218,
                'kota_id' => 365
            ],
            [
                'nama'    => "Maros",
                'kode'    => 224,
                'kota_id' => 365
            ],
            [
                'nama'    => "Masamba",
                'kode'    => 641,
                'kota_id' => 365
            ],
            [
                'nama'    => "Masohi",
                'kode'    => 260,
                'kota_id' => 365
            ],
            [
                'nama'    => "Palopo",
                'kode'    => 187,
                'kota_id' => 365
            ],
            [
                'nama'    => "Panakkukang",
                'kode'    => 642,
                'kota_id' => 365
            ],
            [
                'nama'    => "Pangkep",
                'kode'    => 223,
                'kota_id' => 365
            ],
            [
                'nama'    => "Pare-Pare",
                'kode'    => 64,
                'kota_id' => 365
            ],
            [
                'nama'    => "Pinrang",
                'kode'    => 219,
                'kota_id' => 365
            ],
            [
                'nama'    => "Polewali",
                'kode'    => 259,
                'kota_id' => 365
            ],
            [
                'nama'    => "Raha",
                'kode'    => 217,
                'kota_id' => 365
            ],
            [
                'nama'    => "Rantepao",
                'kode'    => 232,
                'kota_id' => 365
            ],
            [
                'nama'    => "Saumlaki",
                'kode'    => 643,
                'kota_id' => 365
            ],
            [
                'nama'    => "Sengkang",
                'kode'    => 195,
                'kota_id' => 365
            ],
            [
                'nama'    => "Sidrap",
                'kode'    => 221,
                'kota_id' => 365
            ],
            [
                'nama'    => "Sinjai",
                'kode'    => 258,
                'kota_id' => 365
            ],
            [
                'nama'    => "Sungguminasa",
                'kode'    => 225,
                'kota_id' => 365
            ],
            [
                'nama'    => "Takalar",
                'kode'    => 250,
                'kota_id' => 365
            ],
            [
                'nama'    => "Tamalanrea",
                'kode'    => 403,
                'kota_id' => 365
            ],
            [
                'nama'    => "Tual",
                'kode'    => 281,
                'kota_id' => 365
            ],
            [
                'nama'    => "Watampone",
                'kode'    => 111,
                'kota_id' => 365
            ],
            [
                'nama'    => "Watansoppeng",
                'kode'    => 118,
                'kota_id' => 365
            ],
            [
                'nama'    => "Banyuwangi",
                'kode'    => 7,
                'kota_id' => 126
            ],
            [
                'nama'    => "Blitar",
                'kode'    => 9,
                'kota_id' => 126
            ],
            [
                'nama'    => "Bondowoso",
                'kode'    => 13,
                'kota_id' => 126
            ],
            [
                'nama'    => "Genteng",
                'kode'    => 577,
                'kota_id' => 126
            ],
            [
                'nama'    => "Jember",
                'kode'    => 21,
                'kota_id' => 126
            ],
            [
                'nama'    => "Kediri",
                'kode'    => 33,
                'kota_id' => 126
            ],
            [
                'nama'    => "Kepanjen",
                'kode'    => 516,
                'kota_id' => 126
            ],
            [
                'nama'    => "Lumajang",
                'kode'    => 44,
                'kota_id' => 126
            ],
            [
                'nama'    => "Madiun",
                'kode'    => 45,
                'kota_id' => 126
            ],
            [
                'nama'    => "Magetan",
                'kode'    => 49,
                'kota_id' => 126
            ],
            [
                'nama'    => "Malang Kawi",
                'kode'    => 51,
                'kota_id' => 126
            ],
            [
                'nama'    => "Malang Marthadinata",
                'kode'    => 344,
                'kota_id' => 126
            ],
            [
                'nama'    => "Malang Soekarno Hatta",
                'kode'    => 579,
                'kota_id' => 126
            ],
            [
                'nama'    => "Malang Sutoyo",
                'kode'    => 429,
                'kota_id' => 126
            ],
            [
                'nama'    => "Nganjuk",
                'kode'    => 56,
                'kota_id' => 126
            ],
            [
                'nama'    => "Ngawi",
                'kode'    => 57,
                'kota_id' => 126
            ],
            [
                'nama'    => "Pacitan",
                'kode'    => 67,
                'kota_id' => 126
            ],
            [
                'nama'    => "Pare",
                'kode'    => 555,
                'kota_id' => 126
            ],
            [
                'nama'    => "Pasuruan",
                'kode'    => 65,
                'kota_id' => 126
            ],
            [
                'nama'    => "Ponorogo",
                'kode'    => 70,
                'kota_id' => 126
            ],
            [
                'nama'    => "Probolinggo",
                'kode'    => 73,
                'kota_id' => 126
            ],
            [
                'nama'    => "Situbondo",
                'kode'    => 90,
                'kota_id' => 126
            ],
            [
                'nama'    => "Trenggalek",
                'kode'    => 177,
                'kota_id' => 126
            ],
            [
                'nama'    => "Tulungagung",
                'kode'    => 110,
                'kota_id' => 126
            ],
            [
                'nama'    => "Bitung",
                'kode'    => 168,
                'kota_id' => 417
            ],
            [
                'nama'    => "Gorontalo",
                'kode'    => 27,
                'kota_id' => 417
            ],
            [
                'nama'    => "Kotamubagu",
                'kode'    => 36,
                'kota_id' => 417
            ],
            [
                'nama'    => "Limboto",
                'kode'    => 279,
                'kota_id' => 417
            ],
            [
                'nama'    => "Luwuk",
                'kode'    => 167,
                'kota_id' => 417
            ],
            [
                'nama'    => "Manado",
                'kode'    => 54,
                'kota_id' => 417
            ],
            [
                'nama'    => "Manado Boulevard",
                'kode'    => 2003,
                'kota_id' => 417
            ],
            [
                'nama'    => "Marisa",
                'kode'    => 648,
                'kota_id' => 417
            ],
            [
                'nama'    => "Morowali",
                'kode'    => 2025,
                'kota_id' => 417
            ],
            [
                'nama'    => "Palu",
                'kode'    => 60,
                'kota_id' => 417
            ],
            [
                'nama'    => "Parigi",
                'kode'    => 363,
                'kota_id' => 417
            ],
            [
                'nama'    => "Poso",
                'kode'    => 72,
                'kota_id' => 417
            ],
            [
                'nama'    => "Soa-Sio",
                'kode'    => 280,
                'kota_id' => 417
            ],
            [
                'nama'    => "Tahuna",
                'kode'    => 226,
                'kota_id' => 417
            ],
            [
                'nama'    => "Ternate",
                'kode'    => 103,
                'kota_id' => 417
            ],
            [
                'nama'    => "Tobelo",
                'kode'    => 1114,
                'kota_id' => 417
            ],
            [
                'nama'    => "Toli-Toli",
                'kode'    => 227,
                'kota_id' => 417
            ],
            [
                'nama'    => "Tondano",
                'kode'    => 237,
                'kota_id' => 417
            ],
            [
                'nama'    => "Balige",
                'kode'    => 314,
                'kota_id' => 471
            ],
            [
                'nama'    => "Binjai",
                'kode'    => 238,
                'kota_id' => 471
            ],
            [
                'nama'    => "Gunung Sitoli",
                'kode'    => 176,
                'kota_id' => 471
            ],
            [
                'nama'    => "Kabanjahe",
                'kode'    => 144,
                'kota_id' => 471
            ],
            [
                'nama'    => "Kisaran",
                'kode'    => 323,
                'kota_id' => 471
            ],
            [
                'nama'    => "Kota Pinang",
                'kode'    => 2062,
                'kota_id' => 471
            ],
            [
                'nama'    => "Lubuk Pakam",
                'kode'    => 266,
                'kota_id' => 471
            ],
            [
                'nama'    => "Medan Gatot Subroto",
                'kode'    => 404,
                'kota_id' => 471
            ],
            [
                'nama'    => "Medan Iskandar Muda",
                'kode'    => 336,
                'kota_id' => 471
            ],
            [
                'nama'    => "Medan Putri Hijau",
                'kode'    => 53,
                'kota_id' => 471
            ],
            [
                'nama'    => "Medan Sisingamangaraja",
                'kode'    => 367,
                'kota_id' => 471
            ],
            [
                'nama'    => "Medan Thamrin",
                'kode'    => 633,
                'kota_id' => 471
            ],
            [
                'nama'    => "Padang Sidempuan",
                'kode'    => 135,
                'kota_id' => 471
            ],
            [
                'nama'    => "Panyabungan",
                'kode'    => 637,
                'kota_id' => 471
            ],
            [
                'nama'    => "Pematangsiantar",
                'kode'    => 113,
                'kota_id' => 471
            ],
            [
                'nama'    => "Perdagangan",
                'kode'    => 636,
                'kota_id' => 471
            ],
            [
                'nama'    => "Rantau Prapat",
                'kode'    => 228,
                'kota_id' => 471
            ],
            [
                'nama'    => "Sibolga",
                'kode'    => 85,
                'kota_id' => 471
            ],
            [
                'nama'    => "Sibuhuan",
                'kode'    => 1097,
                'kota_id' => 471
            ],
            [
                'nama'    => "Sidikalang",
                'kode'    => 194,
                'kota_id' => 471
            ],
            [
                'nama'    => "Stabat",
                'kode'    => 638,
                'kota_id' => 471
            ],
            [
                'nama'    => "Tanjung Balai",
                'kode'    => 154,
                'kota_id' => 471
            ],
            [
                'nama'    => "Tarutung",
                'kode'    => 99,
                'kota_id' => 471
            ],
            [
                'nama'    => "Tebing Tinggi",
                'kode'    => 283,
                'kota_id' => 471
            ],
            [
                'nama'    => "Batusangkar",
                'kode'    => 169,
                'kota_id' => 428
            ],
            [
                'nama'    => "Bukittinggi",
                'kode'    => 15,
                'kota_id' => 428
            ],
            [
                'nama'    => "Dharmasraya",
                'kode'    => 616,
                'kota_id' => 428
            ],
            [
                'nama'    => "Khatib Sulaiman",
                'kode'    => 669,
                'kota_id' => 428
            ],
            [
                'nama'    => "Lubuk Sikaping",
                'kode'    => 269,
                'kota_id' => 428
            ],
            [
                'nama'    => "Padang",
                'kode'    => 58,
                'kota_id' => 428
            ],
            [
                'nama'    => "Padang Panjang",
                'kode'    => 231,
                'kota_id' => 428
            ],
            [
                'nama'    => "Painan",
                'kode'    => 270,
                'kota_id' => 428
            ],
            [
                'nama'    => "Pariaman",
                'kode'    => 321,
                'kota_id' => 428
            ],
            [
                'nama'    => "Payakumbuh",
                'kode'    => 256,
                'kota_id' => 428
            ],
            [
                'nama'    => "Sijunjung",
                'kode'    => 271,
                'kota_id' => 428
            ],
            [
                'nama'    => "Simpang Empat",
                'kode'    => 615,
                'kota_id' => 428
            ],
            [
                'nama'    => "Solok",
                'kode'    => 91,
                'kota_id' => 428
            ],
            [
                'nama'    => "Sungai Penuh",
                'kode'    => 117,
                'kota_id' => 428
            ],
            [
                'nama'    => "Abunjani Sipin",
                'kode'    => 606,
                'kota_id' => 455
            ],
            [
                'nama'    => "Bangko",
                'kode'    => 275,
                'kota_id' => 455
            ],
            [
                'nama'    => "Baturaja",
                'kode'    => 8,
                'kota_id' => 455
            ],
            [
                'nama'    => "Jambi",
                'kode'    => 20,
                'kota_id' => 455
            ],
            [
                'nama'    => "Kayu Agung",
                'kode'    => 30,
                'kota_id' => 455
            ],
            [
                'nama'    => "Kuala Tungkal",
                'kode'    => 179,
                'kota_id' => 455
            ],
            [
                'nama'    => "Lahat",
                'kode'    => 40,
                'kota_id' => 455
            ],
            [
                'nama'    => "Lubuk Linggau",
                'kode'    => 129,
                'kota_id' => 455
            ],
            [
                'nama'    => "Muara Bulian",
                'kode'    => 315,
                'kota_id' => 455
            ],
            [
                'nama'    => "Muara Bungo",
                'kode'    => 160,
                'kota_id' => 455
            ],
            [
                'nama'    => "Muara Enim",
                'kode'    => 128,
                'kota_id' => 455
            ],
            [
                'nama'    => "Pagar Alam",
                'kode'    => 138,
                'kota_id' => 455
            ],
            [
                'nama'    => "Palembang A. Rivai",
                'kode'    => 59,
                'kota_id' => 455
            ],
            [
                'nama'    => "Palembang Sriwijaya",
                'kode'    => 342,
                'kota_id' => 455
            ],
            [
                'nama'    => "Pangkal Pinang",
                'kode'    => 63,
                'kota_id' => 455
            ],
            [
                'nama'    => "Prabumulih",
                'kode'    => 184,
                'kota_id' => 455
            ],
            [
                'nama'    => "Rimbo Bujang",
                'kode'    => 607,
                'kota_id' => 455
            ],
            [
                'nama'    => "Sarolangun",
                'kode'    => 604,
                'kota_id' => 455
            ],
            [
                'nama'    => "Sekayu",
                'kode'    => 164,
                'kota_id' => 455
            ],
            [
                'nama'    => "Sungai Liat",
                'kode'    => 324,
                'kota_id' => 455
            ],
            [
                'nama'    => "Tanjung Pandan",
                'kode'    => 131,
                'kota_id' => 455
            ],
            [
                'nama'    => "Bagan Batu",
                'kode'    => 619,
                'kota_id' => 343
            ],
            [
                'nama'    => "Bagansiapiapi",
                'kode'    => 2,
                'kota_id' => 343
            ],
            [
                'nama'    => "Bangkinang",
                'kode'    => 268,
                'kota_id' => 343
            ],
            [
                'nama'    => "Batam Nagoya",
                'kode'    => 331,
                'kota_id' => 343
            ],
            [
                'nama'    => "Batam Center",
                'kode'    => 621,
                'kota_id' => 343
            ],
            [
                'nama'    => "Bengkalis",
                'kode'    => 189,
                'kota_id' => 343
            ],
            [
                'nama'    => "Dumai",
                'kode'    => 159,
                'kota_id' => 343
            ],
            [
                'nama'    => "Duri",
                'kode'    => 560,
                'kota_id' => 343
            ],
            [
                'nama'    => "Pangkalan Kerinci",
                'kode'    => 622,
                'kota_id' => 343
            ],
            [
                'nama'    => "Pasir Pengaraian",
                'kode'    => 1099,
                'kota_id' => 343
            ],
            [
                'nama'    => "Pekanbaru Lancang Kuning",
                'kode'    => 1079,
                'kota_id' => 343
            ],
            [
                'nama'    => "Pekanbaru Sudirman",
                'kode'    => 170,
                'kota_id' => 343
            ],
            [
                'nama'    => "Pekanbaru Tuanku Tambusai",
                'kode'    => 696,
                'kota_id' => 343
            ],
            [
                'nama'    => "Perawang",
                'kode'    => 666,
                'kota_id' => 343
            ],
            [
                'nama'    => "Rengat",
                'kode'    => 284,
                'kota_id' => 343
            ],
            [
                'nama'    => "Selat Panjang",
                'kode'    => 171,
                'kota_id' => 343
            ],
            [
                'nama'    => "Siak",
                'kode'    => 1190,
                'kota_id' => 343
            ],
            [
                'nama'    => "Tanjung Balai Karimun",
                'kode'    => 618,
                'kota_id' => 343
            ],
            [
                'nama'    => "Tanjung Pinang",
                'kode'    => 174,
                'kota_id' => 343
            ],
            [
                'nama'    => "Teluk Kuantan",
                'kode'    => 668,
                'kota_id' => 343
            ],
            [
                'nama'    => "Tembilahan",
                'kode'    => 175,
                'kota_id' => 343
            ],
            [
                'nama'    => "Ujung Batu",
                'kode'    => 620,
                'kota_id' => 343
            ],
            [
                'nama'    => "Batang",
                'kode'    => 156,
                'kota_id' => 101
            ],
            [
                'nama'    => "Blora",
                'kode'    => 10,
                'kota_id' => 101
            ],
            [
                'nama'    => "Brebes",
                'kode'    => 14,
                'kota_id' => 101
            ],
            [
                'nama'    => "Bumiayu",
                'kode'    => 190,
                'kota_id' => 101
            ],
            [
                'nama'    => "Cepu",
                'kode'    => 215,
                'kota_id' => 101
            ],
            [
                'nama'    => "Demak",
                'kode'    => 16,
                'kota_id' => 101
            ],
            [
                'nama'    => "Jepara",
                'kode'    => 22,
                'kota_id' => 101
            ],
            [
                'nama'    => "Kendal",
                'kode'    => 34,
                'kota_id' => 101
            ],
            [
                'nama'    => "Kudus",
                'kode'    => 38,
                'kota_id' => 101
            ],
            [
                'nama'    => "Pati",
                'kode'    => 66,
                'kota_id' => 101
            ],
            [
                'nama'    => "Pekalongan",
                'kode'    => 68,
                'kota_id' => 101
            ],
            [
                'nama'    => "Pemalang",
                'kode'    => 69,
                'kota_id' => 101
            ],
            [
                'nama'    => "Purwodadi",
                'kode'    => 76,
                'kota_id' => 101
            ],
            [
                'nama'    => "Rembang",
                'kode'    => 142,
                'kota_id' => 101
            ],
            [
                'nama'    => "Salatiga",
                'kode'    => 81,
                'kota_id' => 101
            ],
            [
                'nama'    => "Semarang Ahmad Yani",
                'kode'    => 609,
                'kota_id' => 101
            ],
            [
                'nama'    => "Semarang Brigjen Sudiarto",
                'kode'    => 435,
                'kota_id' => 101
            ],
            [
                'nama'    => "Semarang Pandanaran",
                'kode'    => 325,
                'kota_id' => 101
            ],
            [
                'nama'    => "Semarang Patimura",
                'kode'    => 83,
                'kota_id' => 101
            ],
            [
                'nama'    => "Slawi",
                'kode'    => 661,
                'kota_id' => 101
            ],
            [
                'nama'    => "Tegal",
                'kode'    => 101,
                'kota_id' => 101
            ],
            [
                'nama'    => "Ungaran",
                'kode'    => 327,
                'kota_id' => 101
            ],
            [
                'nama'    => "Bangkalan",
                'kode'    => 6,
                'kota_id' => 139
            ],
            [
                'nama'    => "Bojonegoro",
                'kode'    => 11,
                'kota_id' => 139
            ],
            [
                'nama'    => "Gresik",
                'kode'    => 26,
                'kota_id' => 139
            ],
            [
                'nama'    => "Jombang",
                'kode'    => 23,
                'kota_id' => 139
            ],
            [
                'nama'    => "Krian",
                'kode'    => 553,
                'kota_id' => 139
            ],
            [
                'nama'    => "Lamongan",
                'kode'    => 41,
                'kota_id' => 139
            ],
            [
                'nama'    => "Manukan",
                'kode'    => 583,
                'kota_id' => 139
            ],
            [
                'nama'    => "Mojokerto",
                'kode'    => 55,
                'kota_id' => 139
            ],
            [
                'nama'    => "Mulyosari",
                'kode'    => 587,
                'kota_id' => 139
            ],
            [
                'nama'    => "Pamekasan",
                'kode'    => 61,
                'kota_id' => 139
            ],
            [
                'nama'    => "Sampang",
                'kode'    => 148,
                'kota_id' => 139
            ],
            [
                'nama'    => "Sidoarjo",
                'kode'    => 86,
                'kota_id' => 139
            ],
            [
                'nama'    => "Sumenep",
                'kode'    => 95,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Diponegoro",
                'kode'    => 1156,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya HR. Muhammad",
                'kode'    => 584,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Jemursari",
                'kode'    => 412,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Kaliasin",
                'kode'    => 96,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Kapas Krampung",
                'kode'    => 394,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Kertajaya",
                'kode'    => 411,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Kusuma Bangsa",
                'kode'    => 360,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Pahlawan",
                'kode'    => 211,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Rajawali",
                'kode'    => 172,
                'kota_id' => 139
            ],
            [
                'nama'    => "Surabaya Tanjung Perak",
                'kode'    => 328,
                'kota_id' => 139
            ],
            [
                'nama'    => "Tuban",
                'kode'    => 109,
                'kota_id' => 139
            ],
            [
                'nama'    => "Waru",
                'kode'    => 684,
                'kota_id' => 139
            ],
            [
                'nama'    => "Ajibarang",
                'kode'    => 151,
                'kota_id' => 34
            ],
            [
                'nama'    => "Banjarnegara",
                'kode'    => 4,
                'kota_id' => 34
            ],
            [
                'nama'    => "Bantul",
                'kode'    => 236,
                'kota_id' => 34
            ],
            [
                'nama'    => "Boyolali",
                'kode'    => 173,
                'kota_id' => 34
            ],
            [
                'nama'    => "Cilacap",
                'kode'    => 106,
                'kota_id' => 34
            ],
            [
                'nama'    => "Gombong",
                'kode'    => 134,
                'kota_id' => 34
            ],
            [
                'nama'    => "Karanganyar",
                'kode'    => 149,
                'kota_id' => 34
            ],
            [
                'nama'    => "Kebumen",
                'kode'    => 32,
                'kota_id' => 34
            ],
            [
                'nama'    => "Klaten",
                'kode'    => 35,
                'kota_id' => 34
            ],
            [
                'nama'    => "Kutoarjo",
                'kode'    => 136,
                'kota_id' => 34
            ],
            [
                'nama'    => "Magelang",
                'kode'    => 48,
                'kota_id' => 34
            ],
            [
                'nama'    => "Majenang",
                'kode'    => 185,
                'kota_id' => 34
            ],
            [
                'nama'    => "Muntilan",
                'kode'    => 251,
                'kota_id' => 34
            ],
            [
                'nama'    => "Parakan",
                'kode'    => 262,
                'kota_id' => 34
            ],
            [
                'nama'    => "Purbalingga",
                'kode'    => 74,
                'kota_id' => 34
            ],
            [
                'nama'    => "Purwokerto",
                'kode'    => 77,
                'kota_id' => 34
            ],
            [
                'nama'    => "Purworejo",
                'kode'    => 78,
                'kota_id' => 34
            ],
            [
                'nama'    => "Sleman",
                'kode'    => 247,
                'kota_id' => 34
            ],
            [
                'nama'    => "Solo Baru",
                'kode'    => 1063,
                'kota_id' => 34
            ],
            [
                'nama'    => "Solo Kartasura",
                'kode'    => 182,
                'kota_id' => 34
            ],
            [
                'nama'    => "Solo Slamet Riadi",
                'kode'    => 334,
                'kota_id' => 34
            ],
            [
                'nama'    => "Sragen",
                'kode'    => 140,
                'kota_id' => 34
            ],
            [
                'nama'    => "Sukoharjo",
                'kode'    => 511,
                'kota_id' => 34
            ],
            [
                'nama'    => "Solo Sudirman",
                'kode'    => 97,
                'kota_id' => 34
            ],
            [
                'nama'    => "Temanggung",
                'kode'    => 102,
                'kota_id' => 34
            ],
            [
                'nama'    => "Wates",
                'kode'    => 152,
                'kota_id' => 34
            ],
            [
                'nama'    => "Wonogiri",
                'kode'    => 158,
                'kota_id' => 34
            ],
            [
                'nama'    => "Wonosari",
                'kode'    => 153,
                'kota_id' => 34
            ],
            [
                'nama'    => "Wonosobo",
                'kode'    => 112,
                'kota_id' => 34
            ],
            [
                'nama'    => "Yogya Cik Ditiro",
                'kode'    => 29,
                'kota_id' => 34
            ],
            [
                'nama'    => "Yogya Katamso",
                'kode'    => 245,
                'kota_id' => 34
            ],
            [
                'nama'    => "Yogyakarta Adisucipto",
                'kode'    => 410,
                'kota_id' => 34
            ],
            [
                'nama'    => "Yogyakarta Mlati",
                'kode'    => 409,
                'kota_id' => 34
            ]
        ]);
    }
}
