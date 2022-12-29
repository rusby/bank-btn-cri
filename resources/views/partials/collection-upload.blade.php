<style>
	#form-kelengkapan_berkas1 p, #form-kelengkapan_berkas2 p, #form-kelengkapan_berkas3 p, #form-kelengkapan_berkas4 p, #form-kelengkapan_berkas99 p, #form-kelengkapan_berkas20 p{
		color: red !important;
	    font-size: 13px !important;
	    margin-top: -12px;
	}
</style>
@if(isset($dokumen_tambahan) && $collection->dokumenUtamaTambahan()->exists())
<div class="form-group col-md-4">
	<label>{{$label}}</label>
	<p>format file : {{isset($type) ? $type : 'pdf'}}</p>
	<input type="file" class="form-control" name="{{$name}}" accept="{{isset($type) ? 'image/png,image/jpg,image/jpeg,application/pdf' : 'application/pdf'}} ">
</div>
@if($collection->dokumenUtamaTambahan->$name && $collection->dokumenUtamaTambahan->extension[$name] == "pdf")
<div class="form-group col-md-2" id="div-content-{{$name}}" style="margin-top: 55px;">
@elseif($collection->dokumenUtamaTambahan->$name && $collection->dokumenUtamaTambahan->extension[$name] != "pdf")
<div class="form-group col-md-2" id="div-content-{{$name}}" style="margin-top: -20px;">
@else
<div class="form-group col-md-2" id="div-content-{{$name}}">
@endif
	@if($collection->dokumenUtamaTambahan->$name)

	@if($collection->dokumenUtamaTambahan->extension[$name] == "pdf")
	<a href="{{\Helper::showImage($collection->dokumenUtamaTambahan->folder, $collection->dokumenUtamaTambahan->$name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>
	@else
	<a href="{{\Helper::showImage($collection->dokumenUtamaTambahan->folder, $collection->dokumenUtamaTambahan->$name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">
		<img src="{{\Helper::showImage($collection->dokumenUtamaTambahan->folder, $collection->dokumenUtamaTambahan->$name)}}" alt="" style="height: 150px;width: 150px;">
	</a>
	@endif
	
	@endif
</div>

@elseif(isset($is_developer))
<div class="form-group col-md-4">
	<label>{{$label}}</label>
	<p>format file : {{isset($type) ? $type : 'pdf'}}</p>
	<input type="file" class="form-control" name="{{$name}}" accept="{{isset($type) ? 'image/png,image/jpg,image/jpeg,application/pdf' : 'application/pdf'}} ">
</div>
@if($collection->developer->project && $collection->developer->project->extension[$name] == "pdf")
<div class="form-group col-md-2" id="div-content-{{$name}}" style="margin-top: 55px;">
@else
<div class="form-group col-md-2" id="div-content-{{$name}}">
@endif

	@if($collection->developer->project->extension[$name] == "pdf")
	<a href="{{\Helper::showImage($collection->developer->project->folder, $collection->developer->project->$name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>
	@endif	
</div>
@else

<div class="form-group col-md-4">
	<label>{{$label}}</label>
	<p>format file : {{isset($type) ? $type : 'pdf'}}</p>
	<input type="file" class="form-control" name="{{$name}}" accept="{{isset($type) ? 'image/png,image/jpg,image/jpeg,application/pdf' : 'application/pdf'}} ">
</div>
@if($collection->dokumenUtama->$name && $collection->dokumenUtama->extension[$name] == "pdf")
<div class="form-group col-md-2" id="div-content-{{$name}}" style="margin-top: 55px;">
@elseif($collection->dokumenUtama->$name && $collection->dokumenUtama->extension[$name] != "pdf")
<div class="form-group col-md-2" id="div-content-{{$name}}" style="margin-top: -20px;">
@else
<div class="form-group col-md-2" id="div-content-{{$name}}">
@endif
	@if($collection->dokumenUtama->$name)

	@if($collection->dokumenUtama->extension[$name] == "pdf")
	<a href="{{\Helper::showImage($collection->dokumenUtama->folder, $collection->dokumenUtama->$name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>
	@else
	<a href="{{\Helper::showImage($collection->dokumenUtama->folder, $collection->dokumenUtama->$name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">
		<img src="{{\Helper::showImage($collection->dokumenUtama->folder, $collection->dokumenUtama->$name)}}" alt="" style="height: 150px;width: 150px;">
	</a>
	@endif
	
	@endif
</div>
@endif