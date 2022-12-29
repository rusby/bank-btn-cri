<?php
$exp = explode('_', $name);
if (count($exp) > 2) {
	$prefix = "${exp[1]}_${exp[2]}_lolos";
}else{
	$prefix = "${exp[1]}_lolos";
}
?>
@if(is_null($is_lolos))
<select name="{{$name}}" class="form-control" id="{{str_replace('_lolos', '', $prefix)}}">
	<option value="">Pilih </option>
	<option value="1">Lolos</option>
	<option value="0">Tidak Lolos</option>
</select>
@else
<select name="{{$name}}" class="form-control" id="{{str_replace('_lolos', '', $prefix)}}">
	<option value="">Pilih</option>
	<option value="1" {{$is_lolos->$prefix ? 'selected' : ''}}>Lolos</option>
	<option value="0" {{!$is_lolos->$prefix ? 'selected' : ''}}>Tidak Lolos</option>
</select>
@endif