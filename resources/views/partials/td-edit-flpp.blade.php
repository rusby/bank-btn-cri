<td>
	@if (count(explode('.', $collection->dokumenUtama->$fix) ) > 1)
	@if (explode('.', $collection->dokumenUtama->$fix) [1] == 'pdf')
	<a href="{{ \Helper::showImage($collection->dokumenUtama->folder, $collection->dokumenUtama->$fix ?? 'default.jpg') }}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>
	@else
	<a href="{{ \Helper::showImage($collection->dokumenUtama->folder, $collection->dokumenUtama->$fix) }}" target="_blank"> <img class="img-thumbnail" src="{{ \Helper::showImage($collection->dokumenUtama->folder, $collection->dokumenUtama->$fix) }}" alt="" style="max-width: 150px;">
	</a>
	@endif
	@else
	-
	@endif
</td>
