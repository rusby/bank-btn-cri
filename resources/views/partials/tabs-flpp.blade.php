@if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
@if(\Auth::user()->getRoleNames()->first() == "operasional")
<div class="tab-pane fade active show" id="tab-datadiri" role="tabpanel">
@else
<div class="tab-pane fade" id="tab-datadiri" role="tabpanel">
@endif
    <div class="card component-card_1" style="width: 100%;">
        <div class="card-body">
            <form method="POST" action="{{ url('operasional/data-diri/' . $collection->id) }}" id="form-datadiri">
                @csrf
                <input type="hidden" name="collection_files_id" value="{{ $collection->id }}">
                <input type="hidden" name="createdBy" value="{{ \Auth::user()->id }}">
                <div class="form-row">
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nama Calon Debitur</label>
                        <input type="text" value="{{ $collection->nama_calon_debitur ?? '' }}" name="nama_calon_debitur" class="form-control" placeholder="Nama calon debitur">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nomor ktp</label>
                        <input type="number" value="{{ $collection->no_ktp ?? '' }}" name="no_ktp" class="form-control" placeholder="Nomor ktp" readonly oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nomor Kartu Keluarga</label>
                        <input type="number" value="{{ $collection->dataDiri->no_kk ?? '' }}" name="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <label for="inputEmail4">Tanggal lahir</label>
                        <input class="form-control flatpickr flatpickr-input active" type="text" value="{{ $collection->dataDiri->tanggal_lahir ?? '' }}" name="tanggal_lahir" placeholder="Pilih Tanggal Lahir..">
                    </div>
                    <div class="form-group col-md-6 mb-1">
                        <p>Status Pernikahan</p>
                        @if(\Auth::user()->getRoleNames()->first() == "operasional")
                        <select name="status_pernikahan" class="form-control" disabled>
                        @else
                        <select name="status_pernikahan" class="form-control">
                        @endif
                            <?php $status = ['Menikah', 'Belum Menikah', 'Cerai']; ?>
                            <option value="">Pilih Status Pernikahan</option>
                            @foreach ($status as $s)
                            <option value="{{ $s }}" {{ $collection->status_pernikahan == $s ? 'selected' : '' }}> {{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-1" id="div-pasangan_meninggal" style="display: {{ $collection->status_pernikahan == 'Menikah' ? 'block' : 'none' }}">
                        <p>Pasangan Meninggal Dunia</p>
                        @if(\Auth::user()->getRoleNames()->first() == "operasional")
                        <select name="is_pasangan_meninggal" class="form-control" disabled>
                        @else
                        <select name="is_pasangan_meninggal" class="form-control">
                        @endif
                            <?php $data = [0, 1]; ?>
                            <option value="">Pilih</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->is_pasangan_meninggal == $d ? 'selected' : '' }}> {{ $d == 0 ? 'Tidak' : 'Ya' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4 mb-3" id="div-pasangan" style="display: none">
                        <label for="inputEmail4">Nomor ktp pasangan</label>
                        <input type="number" value="{{ $collection->dataDiri->pasangan->no_ktp_pasangan ?? '' }}" name="no_ktp_pasangan" class="form-control" placeholder="Nomor ktp pasangan" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                    </div>
                    <div class="form-group col-md-4 mb-3" id="div-pasangan" style="display: none">
                        <label for="inputEmail4">Nama Pasangan</label>
                        <input type="text" value="{{ $collection->dataDiri->pasangan->nama_pasangan ?? '' }}" name="nama_pasangan" class="form-control" placeholder="Nama Pasangan">
                    </div>
                    <div class="form-group col-md-4 mb-3" id="div-pasangan" style="display: none">
                        <label for="inputEmail4">Tanggal lahir pasangan</label>
                        <input value="{{ date('d-m-Y') }}" class="form-control flatpickr flatpickr-input active" type="text" value="{{ $collection->dataDiri->pasangan->tgl_lahir_pasangan ?? '' }}" name="tgl_lahir_pasangan" placeholder="Pilih Tanggal Lahir Pasangan..">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Program pemasaran</label>
                        <input type="text" value="{{ $collection->jenis_kredit ?? '' }}" name="program_pemasaran" class="form-control" placeholder="Program pemasaran" readonly>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Jenis debitur</label>
                        <input type="text" value="Individu" name="jenis_debitur" class="form-control" placeholder="Jenis debitur" readonly>
                    </div>
                    <div class="form-group col-md-6 mb-1">
                        <p>Pendidikan Terakhir</p>
                        <select name="pendidikan_terakhir" class="form-control">
                            <?php $pendidikan = ['SD/SMP/SMA', 'D1/D3/D4', 'S1/S2/S3', 'lainnya']; ?>
                            <option value="">Pilih Pendidikan Terakhir</option>
                            @foreach ($pendidikan as $p)
                            <option value="{{ $p }}" {{ $collection->dataDiri ? ($collection->dataDiri->pendidikan_terakhir == $p ? 'selected' : '') : '' }}> {{ $p }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-1">
                        <p>Jenis kelamin</p>
                        <select name="jenis_kelamin" class="form-control">
                            <?php $jenkel = ['P', 'L']; ?>
                            <option value="">Pilih Jenkel</option>
                            @foreach ($jenkel as $j)
                            <option value="{{ $j }}" {{ $collection->dataDiri ? ($collection->dataDiri->jenis_kelamin == $j ? 'selected' : '') : '' }}> {{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Alamat Domisili</label>
                        <textarea name="alamat_domisili" rows="2" class="form-control" placeholder="Alamat Domisili">{{ $collection->dataDiri->alamat_domisili ?? '' }}</textarea>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_equals_ktpdomisili" value="1" {{ $collection->dataDiri && $collection->dataDiri->alamat_domisili == $collection->dataDiri->alamat_ktp? 'checked': '' }}>
                            <label class="form-check-label" for="exampleCheck1">Alamat ktp sama
                            dengan alamat domisili</label>
                        </div>
                    </div> 
                    <div class="form-group col-md-3 mb-1">
                        <p>Kepemilikan tempat tinggal</p>
                        <select name="kepemilikan_tempat_tinggal" class="form-control">
                            <?php $data = ['Milik Keluarga', 'Milik Dinas', 'Kontrak / Sewa']; ?>
                            <option value="">Pilih Kepemilikan</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri ? ($collection->dataDiri->kepemilikan_tempat_tinggal == $d ? 'selected' : '') : '' }}> {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Lama menetap (tahun)</label>
                        <input type="number" value="{{ $collection->dataDiri->lama_menetap ?? '' }}" name="lama_menetap" class="form-control" placeholder="Lama menetap">
                    </div>                   
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3" id="div-alamat_ktp" style="display: {{ $collection->dataDiri && $collection->dataDiri->alamat_domisili != $collection->dataDiri->alamat_ktp? 'block': 'none' }}">
                        <label for="inputEmail4">Alamat Sesuai KTP</label>
                        <textarea name="alamat_ktp" rows="2" class="form-control" placeholder="Alamat Sesuai KTP">{{ $collection->dataDiri->alamat_ktp ?? '' }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3 mb-3">
                        <p>Provinsi</p>
                        <select name="provinsi_id" class="form-control">

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <p>Kota</p>
                        <select name="kota_id" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <p>Kecamatan</p>
                        <select name="kecamatan_id" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <p>Kelurahan</p>
                        <select name="kelurahan_id" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nomor npwp</label>
                        <input type="text" value="{{ $collection->dataDiri->no_npwp ?? '' }}" name="no_npwp" class="form-control" placeholder="Nomor npwp">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nama gadis ibu kandung</label>
                        <input type="text" value="{{ $collection->dataDiri->nama_gadis_ibu_kandung ?? '' }}" name="nama_gadis_ibu_kandung" class="form-control" placeholder="Nama gadis ibu kandung">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nomor telp Fixed Line(rumah)</label>
                        <input type="number" value="{{ $collection->dataDiri->no_telp ?? '' }}" name="no_telp" class="form-control" placeholder="Nomor telp Fixed Line(rumah)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
                    </div>
                    <div class="form-group col-md-3 mb-3" style="display: none">
                        <label for="inputEmail4">Nomor Handphone</label>
                        <input type="number" value="{{ $collection->no_hp ?? '' }}" name="no_hp" class="form-control" placeholder="Nomor Handphone">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Email</label>
                        <input type="text" value="{{ $collection->dataDiri->email ?? '' }}" name="email" class="form-control" placeholder="Masukkan email">
                    </div>

                    <div class="form-group col-md-4 mb-3" style="display: none;">
                        <label for="inputEmail4">Tanggal kadaluarsa ktp</label>
                        <input class="form-control" type="text" value="Seumur Hidup" name="tanggal_kadaluarsa_ktp" placeholder="Tanggal kadaluarsa ktp" readonly>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nama perusahaan</label>
                        <input type="text" value="{{ $collection->dataDiri->nama_perusahaan ?? '' }}" name="nama_perusahaan" class="form-control" placeholder="Nama perusahaan">
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <p>Status kepegawaian</p>
                        <select name="status_kepegawaian" class="form-control">
                            <?php $data = ['Karyawan Tetap', 'Karyawan Kontrak']; ?>
                            <option value="">Pilih Status Kepegawaian</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri ? ($collection->dataDiri->status_kepegawaian == $d ? 'selected' : '') : '' }}>
                            {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Jenis pekerjaan</label>
                        <?php $data = ['Karyawan Swasta', 'Honorer', 'Pegawai']; ?>
                            <select name="jenis_pekerjaan" class="form-control">
                            <option value="">Pilih Jenis Pekerjaan</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri ? ($collection->dataDiri->jenis_pekerjaan == $d ? 'selected' : '') : '' }}>
                            {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Lama bekerja (tahun)</label>
                        <input type="number" value="{{ $collection->dataDiri->lama_berkerja ?? '' }}" name="lama_berkerja" class="form-control" placeholder="Lama berkerja">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nomor sk kenaikan pangkat</label>
                        <input type="text" value="{{ $collection->dataDiri->no_sk_kenaikan_pangkat ?? '' }}" name="no_sk_kenaikan_pangkat" class="form-control" placeholder="Nomor sk kenaikan pangkat">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Usia pensiun(tahun)</label>
                        <input type="number"
                        value="{{ $collection->dataDiri->usia_masa_persiapan_pensiun ?? '' }}" name="usia_masa_persiapan_pensiun" class="form-control" placeholder="Usia masa persiapan">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Sumber penghasilan</label>
                        <input type="text" value="Gaji" name="sumber_penghasilan" class="form-control" placeholder="Sumber penghasilan" readonly>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nama keluarga dekat</label>
                        <input type="text" value="{{ $collection->dataDiri->nama_keluarga_dekat ?? '' }}" name="nama_keluarga_dekat" class="form-control" placeholder="Nama keluarga dekat">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nomor telpon keluarga dekat</label>
                        <input type="number" value="{{ $collection->dataDiri->no_telp_keluarga_dekat ?? '' }}" name="no_telp_keluarga_dekat" class="form-control" placeholder="Nomor telp keluarga dekat" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <p>Memiliki simpanan bri ? </p>
                        <select value="{{ $collection->dataDiri->memiliki_simpanan_bri ?? '' }}" name="memiliki_simpanan_bri" class="form-control">
                            <?php $data = ['Ya', 'Tidak']; ?>
                            <option value="">Pilih</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri ? ($collection->dataDiri->memiliki_simpanan_bri == $d ? 'selected' : '') : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3" id="div-rekeningBri" style="display: {{ $collection->dataDiri()->exists() && $collection->dataDiri->no_rek_bri ? 'block' : 'none' }}">
                        <label for="inputEmail4">Nomor rekening BRI</label>
                        <input type="number" value="{{ $collection->dataDiri()->exists() && $collection->dataDiri->no_rek_bri? $collection->dataDiri->no_rek_bri: '' }}" name="no_rek_bri" class="form-control" placeholder="Masukkan nomor rekening bri" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="15">
                    </div>
                </div>
                @if(\Request::route()->getName() != "operasional.collection.edit")
                <a class="btn btn-warning mt-3" id="backMappingName">Sebelumnya</a>
                @endif
                <button type="submit" class="btn btn-success float-right mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="tab-analisa-finansial" role="tabpanel">
    <div class="card component-card_1" style="width: 100%;">
        <div class="card-body">
            <form method="POST" action="{{ url('operasional/data-analisa-finansial/' . $collection->id) }}" id="form-analisa-finansial">
                @csrf
                <input type="hidden" name="data_diri_id" value="{{ $collection->dataDiri ? $collection->dataDiri->id : '' }}">
                <input type="hidden" name="createdBy" value="{{ \Auth::user()->id }}">
                <div class="form-row">
                    <div class="form-group col-md-4 mb-3">
                        <label for="inputEmail4">Pendapatan Bersih (Rp. penuh)</label>
                        <input type="text" value="{{ $collection->dataDiri->analisaFinansial->pendapatan_bersih ?? '' }}" name="pendapatan_bersih" class="form-control" placeholder="Pendapatan Bersih">
                    </div>
                    @if ($collection->status_pernikahan == 'Menikah')
                    <div class="form-group col-md-4 mb-3">
                        <label for="inputEmail4">Penghasilan pasangan (Rp. penuh)</label>
                        <input type="text" value="{{ $collection->dataDiri->analisaFinansial->penghasilan_pasangan ?? '' }}" name="penghasilan_pasangan" class="form-control" placeholder="Penghasilan Pasangan">
                    </div>
                    @endif
                    <div class="form-group col-md-4 mb-3">
                        <label for="inputEmail4">Penghasilan lainnya (Rp. penuh)</label>
                        <input type="text" value="{{ $collection->dataDiri->analisaFinansial->penghasilan_lainnya ?? '' }}" name="penghasilan_lainnya" class="form-control" placeholder="Penghasilan lainnya">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Angsuran pinjaman lain (Rp. penuh)(jika ada)</label>
                        <input type="text" value="{{ $collection->dataDiri->analisaFinansial->angsuran_pinjaman_lain ?? '' }}" name="angsuran_pinjaman_lain" class="form-control" placeholder="Angsuran pinjaman lain">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Sisa Jangka Waktu Kredit (jika ada) (bulan)</label>
                        <input type="number" value="{{ $collection->dataDiri->analisaFinansial->jangka_waktu_kredit ?? '' }}" name="jangka_waktu_kredit" class="form-control" placeholder="Sisa Jangka Waktu Kredit">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Harga Rumah (Rp. penuh)</label>
                        <input type="text" value="{{ $collection->dataDiri->analisaFinansial->harga_rumah ?? '' }}" name="harga_rumah" class="form-control" placeholder="Harga Rumah">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Uang Muka (Rp. penuh)(1% + SBUM)</label>
                        <input type="text" value="{{ $collection->dataDiri->analisaFinansial->uang_muka ?? '' }}" name="uang_muka" class="form-control" placeholder="Uang Muka (1% + SBUM)">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Jumlah Permohonan Kredit (otomatis) (Rp. penuh)</label>
                        <input type="text" class="form-control" placeholder="Masukkan Jumlah Permohonan Kredit" name="jumlah_permohonan_kredit" value="{{ $collection->jumlah_permohonan_kredit ?? '' }}" readonly>
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <p>Pernah pinjam dibank lain ?</p>
                        <select value="{{ $collection->dataDiri->analisaFinansial->pernah_pinjam_di_bank_lain ?? '' }}" name="pernah_pinjam_di_bank_lain" class="form-control">
                            <?php $data = ['Ya', 'Tidak']; ?>
                            <option value="">Pilih</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri && $collection->dataDiri->analisaFinansial? ($collection->dataDiri->analisaFinansial->pernah_pinjam_di_bank_lain == $d? 'selected': ''): '' }}> {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <p>Jenis fasilitas dibank lain ?</p>
                        <select value="{{ $collection->dataDiri->analisaFinansial->jenis_fasilitas_di_bank_lain ?? '' }}" name="jenis_fasilitas_di_bank_lain" class="form-control">
                            <?php $data = ['Simpanan', 'Pinjaman', 'Tidak']; ?>
                            <option value="">Pilih</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri && $collection->dataDiri->analisaFinansial? ($collection->dataDiri->analisaFinansial->jenis_fasilitas_di_bank_lain == $d? 'selected': ''): '' }}> {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a class="btn btn-warning mt-3" id="backDataDiri">Sebelumnya</a>
                <button type="submit" class="btn btn-success float-right mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="tab-agunan" role="tabpanel">
    <div class="card component-card_1" style="width: 100%;">
        <div class="card-body">
            <form method="POST" action="{{ url('operasional/data-agunan/' . $collection->id) }}"
                id="form-agunan">
                @csrf
                <input type="hidden" name="data_diri_id"
                value="{{ $collection->dataDiri ? $collection->dataDiri->id : '' }}">
                <input type="hidden" name="createdBy" value="{{ \Auth::user()->id }}">
                <div class="form-row">

                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Lokasi Tanah (Alamat lengkap beserta nomor&blok rumah)</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->lokasi_tanah ?? '' }}" name="lokasi_tanah" class="form-control" placeholder="Lokasi Tanah">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Jarak Agunan ke pusat Kota(km)</label>
                        <input type="number" value="{{ $collection->dataDiri->agunan->jarak_agunan ?? '' }}" name="jarak_agunan" class="form-control" placeholder="Jarak Agunan ke pusat Kota">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Batas Utara (kavling)</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->batas_utara_tanah ?? '' }}" name="batas_utara_tanah" class="form-control" placeholder="Batas Utara Tanah">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Batas Timur (kavling)</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->batas_timur_tanah ?? '' }}" name="batas_timur_tanah" class="form-control" placeholder="Batas Timur Tanah">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Batas Selatan (kavling)</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->batas_selatan_tanah ?? '' }}" name="batas_selatan_tanah" class="form-control" placeholder="Batas Selatan Tanah">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Batas Barat (kavling)</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->batas_barat_tanah ?? '' }}" name="batas_barat_tanah" class="form-control" placeholder="Batas Barat Tanah">
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <p>Provinsi</p>
                        <select name="provinsi_id" class="form-control">

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <p>Kota</p>
                        <select name="kota_id" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <p>Kecamatan</p>
                        <select name="kecamatan_id" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-1">
                        <p>Kelurahan</p>
                        <select name="kelurahan_id" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">RT</label>
                        <input type="number" value="{{ $collection->dataDiri->agunan->rt ?? '' }}" name="rt" class="form-control" placeholder="RT">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">RW</label>
                        <input type="number" value="{{ $collection->dataDiri->agunan->rw ?? '' }}" name="rw" class="form-control" placeholder="RW">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Bentuk Tanah (persegi, atau lainnya)</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->bentuk_tanah ?? '' }}" name="bentuk_tanah" class="form-control" placeholder="Bentuk Tanah (persegi, atau lainnya)">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Jarak Terhadap Jalan Perumahan (m)</label>
                        <input type="number" value="{{ $collection->dataDiri->agunan->jarak_terhadap_jalan ?? '' }}" name="jarak_terhadap_jalan" class="form-control" placeholder="Jarak Terhadap Jalan Perumahan(m)">
                    </div>
                    <div class="form-group col-md-3 mt-4 mb-3">
                        <label for="inputEmail4">Permukaan Tanah</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->permukaan_tanah ?? '' }}" name="permukaan_tanah" class="form-control" placeholder="Permukaan Tanah (rata, berbatu, miring, lainnya) ">
                    </div>
                    <div class="form-group col-md-3 mt-4 mb-3">
                        <label for="inputEmail4">Luas Tanah (m2)</label>
                        <input type="number" value="{{ $collection->dataDiri->agunan->luas_tanah ?? '' }}" name="luas_tanah" class="form-control" placeholder="Luas Tanah">
                    </div>
                    <div class="form-group col-md-3 mt-4 mb-3">
                        <p>Jenis kepemilikan</p>
                        <select name="jenis_kepemilikan" class="form-control">
                            <?php $data = ['SHM', 'SHGB', 'lainnya']; ?>
                            <option value="">Pilih Jenis Kepemilikan</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri && $collection->dataDiri->agunan->jenis_kepemilikan == $d ? 'selected' : '' }}> {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="inputEmail4">Nomor surat tanah</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->no_surat_tanah ?? '' }}" name="no_surat_tanah" class="form-control" placeholder="Nomor surat tanah">
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="inputEmail4">Atas Nama</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->atas_nama_surat_tanah ?? '' }}" name="atas_nama_surat_tanah" class="form-control" placeholder="Atas Nama">
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="inputEmail4">Tanggal Surat Tanah</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->tgl_surat_tanah ?? date('d-m-Y') }}" name="tgl_surat_tanah" class="form-control flatpickr flatpickr-input active" placeholder="Tanggal Surat Tanah">
                    </div>
                    
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Nama kantor bpn</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->nama_kantor_bpn ?? '' }}" name="nama_kantor_bpn" class="form-control" placeholder="Nama kantor bpn">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Nomor IMB / PBG</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->no_imb ?? '' }}" name="no_imb" class="form-control" placeholder="Nomor IMB">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Tanggal IMB</label>
                        <input type="text" value="{{ $collection->dataDiri->agunan->tgl_imb ?? '' }}" name="tgl_imb" class="form-control flatpickr flatpickr-input active" placeholder="Tanggal IMB">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Luas Bangunan (m2)</label>
                        <input type="number" value="{{ $collection->dataDiri->agunan->luas_bangunan ?? '' }}" name="luas_bangunan" class="form-control" placeholder="Luas Bangunan">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Tahun Mendirikan Bangunan</label>
                        <input type="text"
                        value="{{ $collection->dataDiri->agunan->tahun_mendirikan_bangunan ?? '' }}" name="tahun_mendirikan_bangunan" class="form-control" placeholder="Tahun Mendirikan Bangunan">
                    </div>
                </div>
                <a class="btn btn-warning mt-3" id="backAnalisaFinansial">Sebelumnya</a>

                <button type="submit" class="btn btn-success float-right mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="tab-flpp" role="tabpanel">
    <div class="card component-card_1" style="width: 100%;">
        <div class="card-body">
            <form method="POST" action="{{ url('operasional/data-uji-flpp/' . $collection->id) }}"
                id="form-uji-flpp" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="data_diri_id"
                value="{{ $collection->dataDiri ? $collection->dataDiri->id : '' }}">
                <input type="hidden" name="createdBy" value="{{ \Auth::user()->id }}">
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <p>Jenis Badan Hukum Developer</p>
                        <select name="jenis_badan_hukum_developer" class="form-control">
                            <?php $data = ['PT', 'CV', 'Perseorangan', 'lainnya']; ?>
                            <option value="">Pilih Jenis Hukum Developer</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}" {{ $collection->dataDiri && $collection->dataDiri->ujiFlpp->jenis_badan_hukum_developer == $d ? 'selected' : '' }}> {{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Nama Badan Hukum Developer (Nama
                        Perusahaan)</label>
                        <input type="text"
                        value="{{ $collection->dataDiri->ujiFlpp->nama_badan_hukum_developer ?? '' }}" name="nama_badan_hukum_developer" class="form-control" placeholder="Nama Badan Hukum Developer" {{\Auth::user()->getRoleNames()->first() == "operasional" ? '' : 'readonly'}}>
                    </div>
                    <div class="form-group col-md-12 mb-3">
                        <label for="inputEmail4">Nama Perumahan</label>
                        <span style="color: red;font-size: 12px;">*penulisan harus sama dengan
                        inputan sikasep</span>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->nama_perumahan ?? '' }}" name="nama_perumahan" class="form-control" placeholder="Nama Perumahan" {{\Auth::user()->getRoleNames()->first() == "operasional" ? '' : 'readonly'}}>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Subsidi Uang Muka (Rp. penuh)</label>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->subsidi_uang_muka ?? '' }}" name="subsidi_uang_muka" class="form-control" placeholder="Subsidi Uang Muka">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">NPWP Pengembang</label>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->npwp_pengembang ?? '' }}" name="npwp_pengembang" class="form-control" placeholder="NPWP Pengembang">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Id Rumah</label>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->id_rumah ?? '' }}" name="id_rumah" class="form-control" placeholder="Id Rumah">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Id Struktur</label>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->id_struktur ?? '' }}" name="id_struktur" class="form-control" placeholder="Id Struktur">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Nomor slf (dapat dipenuhi saat akad kredit)</label>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->no_slf ?? '' }}" name="no_slf" class="form-control" placeholder="Nomor slf">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Tanggal SLF (dapat dipenuhi saat akad kredit)</label>
                        <input type="text" value="{{ $collection->dataDiri->ujiFlpp->tanggal_slf ?? '' }} " name="tanggal_slf" class="form-control" placeholder="Masukkan Tanggal SLF (20-05-2020)">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nama Bank Penerima SBUM(ex: BRI, dll)</label>
                        <input type="text"
                        value="{{ $collection->dataDiri->ujiFlpp->nama_bank_penerima_sbum ?? '' }}" name="nama_bank_penerima_sbum" class="form-control" placeholder="Nama Bank Penerima SBUM">
                    </div>
                    <div class="form-group col-md-3 mb-3 mt-4">
                        <label for="inputEmail4">No Rek Penerima SBUM</label>
                        <input type="number"
                        value="{{ $collection->dataDiri->ujiFlpp->no_rek_penerima_sbum ?? '' }}" name="no_rek_penerima_sbum" class="form-control" placeholder="Nomor Rek Penerima SBUM">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="inputEmail4">Nama Bank Developer(ex: BRI, dll)</label>
                        <input type="text"
                        value="{{ $collection->dataDiri->ujiFlpp->nama_bank_developer ?? '' }}" name="nama_bank_developer" class="form-control" placeholder="Nama Bank Developer">
                    </div>
                    <div class="form-group col-md-3 mb-3 mt-4">
                        <label for="inputEmail4">Nomor Rek Developer</label>
                        <input type="number" value="{{ $collection->dataDiri->ujiFlpp->no_rek_developer ?? '' }}" name="no_rek_developer" class="form-control" placeholder="Nomor Rek Developer">
                    </div>
                    @if ($collection->status_id == 6 && \Auth::user()->getRoleNames()->first() == "operasional")
                    <div class="form-group col-md-12 mb-3">
                        <label for="inputEmail4">Sanggah Perbaikan</label>
                        <textarea name="sanggah_tolak_verifikasi" rows="3" class="form-control" placeholder="Masukkan keterangan perbaikan"></textarea>
                    </div>
                    @endif
                </div>
                <a class="btn btn-warning mt-3" id="backAgunan">Sebelumnya</a>
                <button type="submit" class="btn btn-success float-right mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endif
