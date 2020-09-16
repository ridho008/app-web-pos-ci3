$(function() {
$('.tombolTambahUser').click(function() {
	$('.modal-title').html('Tambah Data User');
	$('.modal-footer button[type=submit]').html('Tambah');

	$('#id_user').val('');
	$('#username').val('');
	$('#name').val('');
	$('#password').val('');
	$('#address').val('');
	$('#level').val('');
	$('#inputHiddenFoto').val('');
	$('.imgTampil').attr('src', '');
});

$('.tombolUbahUser').click(function() {
	$('.modal-title').html('Ubah Data User');
	$('.modal-footer button[type=submit]').html('Ubah');

	$('.modal-body form').attr('action', 'http://localhost/app-web-pos-ci3/users/formUbah');

	const id = $(this).data('id');
	// console.log(id);
	$.ajax({
		url: 'http://localhost/app-web-pos-ci3/users/getUbahUser',
		data: {id: id},
		dataType: 'json',
		method: 'post',
		success: function(data) {
			console.log(data);
			$('#id_user').val(data.id_user);
			$('#username').val(data.username);
			$('#level').val(data.level);
			$('#password').val(data.password);
			$('#address').val(data.address);
			$('#name').val(data.name);
			$('#inputHiddenFoto').val(data.photo);
			$('.imgTampil').attr('src', 'http://localhost/app-web-pos-ci3/assets/img/user/' + data.photo);
		}

	});

});



});