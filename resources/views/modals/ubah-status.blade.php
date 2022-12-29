<div class="modal fade" id="modalUbahStatus" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('kantor.ubah_status') }}" method="POST" id="form-ubahstatus"
            enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    @csrf
                    <h4>Ubah Status</h4>
                    <hr>
                    <div class="form-row">
                        <input type="hidden" name="collection_id">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nama Debitur</label>
                            <input type="text" class="form-control" name="sel_nama_debitur" disabled
                                placeholder="Nama Debitur">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">No KTP</label>
                            <input type="text" class="form-control" name="sel_no_ktp" disabled placeholder="No KTP">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nama Project</label>
                            <input type="text" class="form-control" name="sel_nama_project" disabled
                                placeholder="Nama Project">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Kantor Wilayah</label>
                            <input type="text" class="form-control" name="sel_kanwil" disabled
                                placeholder="Kantor Wilayah">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Kantor Cabang</label>
                            <input type="text" class="form-control" name="sel_kanca" disabled
                                placeholder="Kantor Cabang">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Status</label>
                            <select name="status" class="form-control" disabled>

                            </select>
                        </div>
                        <div class="form-group col-md-12" id="div-alasan_perbaikan" style="display: none;">
                            <label for="inputEmail4">Alasan Perbaikan</label>
                            <textarea class="form-control" name="alasan_perbaikan_bri" rows="2"
                                placeholder="Masukkan alasan Perbaikan"></textarea>
                        </div>
                        <div class="form-group col-md-12" id="div-alasan_tolak" style="display: none;">
                            <label for="inputEmail4">Alasan Tolak</label>
                            <textarea class="form-control" name="alasan_tolak_bri" rows="2" placeholder="Masukkan alasan tolak"></textarea>
                        </div>
                        <div class="form-group col-md-12" id="div-nominal" style="display: none;">
                            <label for="inputEmail4">Nominal Plafond Kredit</label>
                            <input type="text" name="nominal_cair" class="form-control"
                                placeholder="Masukkan nominal plafond kredit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="15">
                        </div>
                        <div class="form-group col-md-12" id="div-norek_kredit" style="display: none;">
                            <label for="inputEmail4">Norek Kredit</label>
                            <input type="number" name="norek_kredit" class="form-control"
                                placeholder="Masukkan norek kredit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="15">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                        Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnUbahStatus">Ubah Status</button>
                </div>
        </form>
    </div>
</div>
</div>
