function formatDate(date) {
	var d = new Date(date)
	month = d.getMonth()
	day = '' + d.getDate()
	year = d.getFullYear();
	switch(month) {
		case 0: month = "Januari"; break;
		case 1: month = "Februari"; break;
		case 2: month = "Maret"; break;
		case 3: month = "April"; break;
		case 4: month = "Mei"; break;
		case 5: month = "Juni"; break;
		case 6: month = "Juli"; break;
		case 7: month = "Agustus"; break;
		case 8: month = "September"; break;
		case 9: month = "Oktober"; break;
		case 10: month = "November"; break;
		case 11: month = "Desember"; break;
	}

	if (day.length < 2)
		day = '0' + day;

	return date === null ? '-' : [day,month, year].join(' ')
}

function loadButton(elem, is_send=true, text){
	if (is_send) {
		var html = '&nbsp;'
		html += '<div class="spinner-border text-white mr-2 align-self-center loader-sm" style="width: 1rem; height: 1rem;">'
		html += '</div>'
		$(elem).attr('disabled', true).text('Loading...').append(html)
		return
	}
	$(elem).attr('disabled', false).text(text)
	$('.spinner-border text-white mr-2 align-self-center loader-sm').remove()
}

function formatRp(angka, prefix){
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split = number_string.split(','),
	sisa = split[0].length % 3,
	rupiah = split[0].substr(0, sisa),
	ribuan = split[0].substr(sisa).match(/\d{3}/gi);
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function historyCRI(){
	$('body').on('click', '[id=btnHistory]', function() {
		$('#modalHistory').modal('show')
		let id = $(this).attr('data-id')
		$.ajax({
			type: 'get',
			url: `${window.location.origin}/api/status/history`,
			data: {
				collection_id: id
			},
			beforeSend: function() {
				$('div .timeline-line').html('<h6>Load data ...</h6>')
			},
			success: function(data) {
				console.log(data.data)
				cont = ''
				if (data.data.length > 0) {
					$.each(data.data, function(k, v) {
						cont += `<div class="item-timeline">
						<p class="t-time" style="font-size: 13px;">${v.created_at}</p>
						<div class="t-dot t-dot-${v.status.id == 2 || v.status.id == 6 || v.status.id == 12 || v.status.id == 14 ? 'danger' : v.status.id  > 9 ? 'success' : 'primary'  }">
						</div>
						<div class="t-text">
						<p>${v.status.nama}</p>
						<p class="t-meta-time" style="max-width: 200px;">${v.user.name}</p>
						</div>
						</div>`

					})
				}else{
					cont += '<h6>Belum ada history status.</h6>'
				}			
				$('div .timeline-line').html(cont)
			},
			error: function(data) {
				console.log(data.responseText)
				var data = data.responseJSON;
				if (data.status == "fail") {
					toastr["error"](data.messages);
				}
			}
		});
	})
}

function historyBRI(){
	$('body').on('click', '[id=btnHistory]', function() {
		$('#modalHistory').modal('show')
		let id = $(this).attr('data-id')
		$.ajax({
			type: 'get',
			url: `${window.location.origin}/api/status/history`,
			data: {
				collection_id: id
			},
			beforeSend: function() {
				$('div .timeline-line').html('<h6>Load data ...</h6>')
			},
			success: function(data) {

				cont = ''
				$.each(data.data, function(k, v) {
					if (v.status.id > 9) {
						cont += `<div class="item-timeline">
						<p class="t-time" style="font-size: 13px;">${v.created_at}</p>
						<div class="t-dot t-dot-${v.status.id == 12 ? 'warning' : v.status.id == 14 || v.status.id == 16 ? 'danger' : 'success'  }">
						</div>
						<div class="t-text">
						<p>${v.status.nama}</p>
						<p class="t-meta-time" style="max-width: 200px;">${v.user.name}</p>
						</div>
						</div>`
					}
				})
				$('div .timeline-line').html(cont)
			},
			error: function(data) {
				console.log(data.responseText)
				var data = data.responseJSON;
				if (data.status == "fail") {
					toastr["error"](data.messages);
				}
			}
		});
	})
}

$('body').on('click', '[id=btnHapusCollection]', function(e) {
	e.preventDefault()
	let _this = $(this)

	Swal.fire({
		title: 'Anda yakin ingin menghapus data ini ?',
		text: "Jika melakukan hapus data, semua data terkait akan hilang.",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya !'
	}).then((result) => {
		if (result.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
				}
			});
			console.log(result.value)

			$.ajax({
				type: 'post',
				url: $(this).attr("href"),
				beforeSend: function() {
					loadButton($(_this))
				},
				success: function(data) {
					console.log(data)
					if (data.status == "ok") {
						toastr["success"](data.messages);
					}
					setTimeout(function() {
						location.reload()
					}, 1500);
				},
				error: function(data) {
					var data = data.responseJSON;
					if (data.status == "fail") {
						toastr["error"](data.messages);
					}
				},
				complete: function() {
					loadButton($(_this), false, 'Hapus Data')
				}
			});
		}
	})
})

function getStatusFilterCRI(max=18, is_superadmin=false) {
	$.ajax({
		type: 'get',
		url: `${window.location.origin}/api/status`,
		data: {
			id: 0
		},
		beforeSend: function() {

		},
		success: function(data) {
			console.log(is_superadmin)
			let opt = '<option value="">Pilih Status</option>'
			$.each(data.data, function(k, v) {
				if (v.id <= max) {
					if (is_superadmin) {
						opt += `<option value=${v.id}>${v.nama}</option>`
					}else{
						if (v.id != 0) {
							opt += `<option value=${v.id}>${v.nama}</option>`
						}
					}			
				}
			})
			$('[name=filter_status]').html(opt)
		},
		error: function(data) {
			var data = data.responseJSON;
			if (data.status == "fail") {
				toastr["error"](data.messages);
			}
		}
	});
}