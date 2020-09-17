$(function() {
	// Ubah User
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


	// Ubah Supplier
	$('.tombolTambahSupplier').click(function() {
		$('.modal-title').html('Tambah Data Supplier');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_supplier').val('');
		$('#name').val('');
		$('#address').val('');
		$('#description').val('');
		$('#phone').val('');
	});

	$('.tombolUbahSupplier').click(function() {
		$('.modal-title').html('Ubah Data Supplier');
		$('.modal-footer button[type=submit]').html('Ubah');

		$('.modal-body form').attr('action', 'http://localhost/app-web-pos-ci3/suppliers/formUbahSupplier');

		const id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url: 'http://localhost/app-web-pos-ci3/suppliers/getUbahSupplier',
			data: {id: id},
			dataType: 'json',
			method: 'post',
			success: function(data) {
				// console.log(data);
				$('#id_supplier').val(data.id_supplier);
				$('#name').val(data.name_sup);
				$('#phone').val(data.phone);
				$('#address').val(data.address);
				$('#description').val(data.description);
			}

		});

	});


	// Ubah Customer
	$('.tombolTambahCustomer').click(function() {
		$('.modal-title').html('Tambah Data Customer');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_customer').val('');
		$('#name').val('');
		$('#address').val('');
		$('#description').val('');
		$('#phone').val('');
		$('#gender').val('');
	});

	$('.tombolUbahCustomer').click(function() {
		$('.modal-title').html('Ubah Data Customer');
		$('.modal-footer button[type=submit]').html('Ubah');

		$('.modal-body form').attr('action', 'http://localhost/app-web-pos-ci3/customers/formUbahCustomer');

		const id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url: 'http://localhost/app-web-pos-ci3/customers/getUbahCustomer',
			data: {id: id},
			dataType: 'json',
			method: 'post',
			success: function(data) {
				// console.log(data);
				$('#id_customer').val(data.id_customer);
				$('#name').val(data.name_cus);
				$('#phone').val(data.phone);
				$('#address').val(data.address);
				$('#gender').val(data.gender);
			}

		});

	});



});