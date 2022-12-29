<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Kelurahan as kelurahan;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  file_get_contents(public_path('json/kelurahan.json'));
        $data = json_decode($data);

        if(kelurahan::get()->count() < 1) {
            foreach(array_chunk($data, 1000) as $orders){
                $out = array();
                foreach($orders as $i){
                    $out[] = array(
                        "id" => $i->id,
                        "kelurahan" => $i->kelurahan,
                        "id_kecamatan" => $i->id_kecamatan,
                        "id_kode_pos" => $i->id_kode_pos
                    );
                }
                DB::table('kelurahan')->insert($out);
            }
        }
        
    }
}
