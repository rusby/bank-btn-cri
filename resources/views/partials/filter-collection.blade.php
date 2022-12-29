<label style="color: #59595c">
    <strong>
        Filtering by :
    </strong>
</label>
@if (\Auth::user()->getRoleNames()->first() == 'admin cri')
    )
    <form action="{{ route('export.cri.collection_tabulasi') }}" method="POST">
    @else
        <form action="{{ route('export.collection_tabulasi') }}" method="POST">
@endif
@csrf
<div class="row">
    @if (\Auth::user()->getRoleNames()->first() == 'Kantor Pusat' ||
    \Auth::user()->getRoleNames()->first() == 'admin cri' ||
    \Auth::user()->getRoleNames()->first() == 'operasional' ||
    \Auth::user()->getRoleNames()->first() == 'operasional verifikator')
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Kantor Wilayah / KCK</strong></label>
                <select name="filter_kanwil" class="form-control" style="width: 200px">

                </select>
            </div>
        </div>
    @endif
    @if (\Auth::user()->getRoleNames()->first() == 'Kantor Pusat' ||
    \Auth::user()->getRoleNames()->first() == 'Kantor Wilayah' ||
    \Auth::user()->getRoleNames()->first() == 'Kantor Cabang' ||
    \Auth::user()->getRoleNames()->first() == 'admin cri' ||
    \Auth::user()->getRoleNames()->first() == 'operasional' ||
    \Auth::user()->getRoleNames()->first() == 'operasional verifikator')
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Unit Kerja BRI</strong></label>
                <select name="filter_kanca" class="form-control" style="width: 200px" disabled>
                    @if (\Auth::user()->getRoleNames()->first() == 'Kantor Pusat')
                        <option value="">Silakan Pilih Kantor Wilayah dahulu</option>
                    @endif
                </select>
            </div>
        </div>
    @endif
    <div class="col-md-4">
        <div class="form-group">
            <label><strong>Status</strong></label>
            <select name="filter_status" class="form-control" style="width: 200px">

            </select>
        </div>
    </div>
</div>
<div class="row" style="margin-top: -25px;">
    <div class="col-md-4">
        <div class="form-group">
            <label><strong>Jenis KPR</strong></label>
            <select name="filter_jenis_kpr" class="form-control" style="width: 200px">
                <option value="">Pilih Jenis KPR</option>
                <option value="KPR Subsidi FLPP (Fix Income)">KPR Subsidi FLPP (Fix Income)</option>
                <option value="KPR Komersial (Baru atau Secondary)">KPR Komersial (Baru atau Secondary)</option>
                <option value="KPR BP2BT (Non Fix Income)">KPR BP2BT (Non Fix Income)</option>
                <option value="KPR Tapera (Peserta Tapera)">KPR Tapera (Peserta Tapera)</option>
            </select>
        </div>
    </div>
    @if (\Auth::user()->getRoleNames()->first() == 'Kantor Pusat' ||
    \Auth::user()->getRoleNames()->first() == 'Kantor Wilayah' ||
    \Auth::user()->getRoleNames()->first() == 'Kantor Cabang')
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Dari Tanggal</strong></label>
                <input class="form-control flatpickr flatpickr-input active" type="text" name="filter_tanggal_mulai"
                    placeholder="Pilih Tanggal Mulai" value="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Sampai Tanggal</strong></label>
                <input class="form-control flatpickr flatpickr-input active" type="text" name="filter_tanggal_selesai"
                    placeholder="Pilih Tanggal Selesai" value="">
            </div>
        </div>
    @endif
</div>
@if (\Auth::user()->getRoleNames()->first() == 'Kantor Pusat' ||
    \Auth::user()->getRoleNames()->first() == 'Kantor Wilayah' ||
    \Auth::user()->getRoleNames()->first() == 'Kantor Cabang' ||
    \Auth::user()->getRoleNames()->first() == 'admin cri' ||
    \Auth::user()->getRoleNames()->first() == 'operasional' ||
    \Auth::user()->getRoleNames()->first() == 'operasional verifikator')
    <button type="submit" class="btn btn-primary float-right">Print Laporan</button>
@endif
</form>
