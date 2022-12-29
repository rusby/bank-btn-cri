@if(isset($dokumen_tambahan))
<tr class="{{!is_null($data->dokumenUtamaTambahan->dokumenTambahanKualifikasi) && !$data->dokumenUtamaTambahan->dokumenTambahanKualifikasi->$fix ? 'dokumendiTolak' : ''}}">
    <td width="30%">{{$label}}</td>
    <td>
        @if (count(explode('.', $data->dokumenUtamaTambahan->$fix) ) > 1)
        @if (explode('.', $data->dokumenUtamaTambahan->$fix) [1] == 'pdf')
        <a href="{{ \Helper::showImage($data->dokumenUtamaTambahan->folder, $data->dokumenUtamaTambahan->$fix ?? 'default.jpg') }}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>
        @else
        <a href="{{ \Helper::showImage($data->dokumenUtamaTambahan->folder, $data->dokumenUtamaTambahan->$fix) }}" target="_blank"> <img class="img-thumbnail" src="{{ \Helper::showImage($data->dokumenUtamaTambahan->folder, $data->dokumenUtamaTambahan->$fix) }}" alt="" style="max-width: 150px;">
        </a>
        @endif
        @else
        -
        @endif
    </td>
    <td>
        <div class="n-chk new-checkbox checkbox-outline-primary">
            <label class="new-control new-checkbox checkbox-outline-primary">
                <input type="checkbox" class="new-control-input" value="1" name="{{'keterangan_'.$fix}}" {{ $data->dokumenUtamaTambahan->dokumenTambahanKualifikasi ? ($data->dokumenUtamaTambahan->dokumenTambahanKualifikasi->$fix ? 'checked' : '') : '' }} {{ count(explode('.', $data->dokumenUtamaTambahan->$fix)) > 1 ? '' : 'disabled' }}>
            </label>
        </div>
    </td>
</tr>
@else
<tr class="{{!is_null($data->dokumenUtama->dokumenKualifikasi) && count(explode('.', $data->dokumenUtama->$fix) ) > 1 && !$data->dokumenUtama->dokumenKualifikasi->$fix ? 'dokumendiTolak' : ''}}">
    <td width="35%">{{$label}}</td>
    <td>
        @if (count(explode('.', $data->dokumenUtama->$fix) ) > 1)
        @if (explode('.', $data->dokumenUtama->$fix) [1] == 'pdf')
        <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->$fix ?? 'default.jpg') }}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>
        @else
        <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->$fix) }}" target="_blank"> <img class="img-thumbnail" src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->$fix) }}" alt="" style="max-width: 150px;">
        </a>
        @endif
        @else
        -
        @endif
    </td>
    <td>
        <div class="n-chk new-checkbox checkbox-outline-primary">
            <label class="new-control new-checkbox checkbox-outline-primary">
                <input type="checkbox" class="new-control-input" value="1" name="{{'keterangan_'.$fix}}" {{ $data->dokumenUtama->dokumenKualifikasi ? ($data->dokumenUtama->dokumenKualifikasi->$fix ? 'checked' : '') : '' }} {{ count(explode('.', $data->dokumenUtama->$fix)) > 1 ? '' : 'disabled' }}>
            </label>
        </div>
    </td>
</tr>
@endif