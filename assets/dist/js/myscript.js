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


	// Ubah Categori
	$('.tombolTambahCategori').click(function() {
		$('.modal-title').html('Tambah Data Categori');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_categori').val('');
		$('#name').val('');
	});

	$('.tombolUbahCategori').click(function() {
		$('.modal-title').html('Ubah Data Categori');
		$('.modal-footer button[type=submit]').html('Ubah');

		$('.modal-body form').attr('action', 'http://localhost/app-web-pos-ci3/categories/formUbahCategori');

		const id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url: 'http://localhost/app-web-pos-ci3/categories/getUbahCategori',
			data: {id: id},
			dataType: 'json',
			method: 'post',
			success: function(data) {
				// console.log(data);
				$('#id_categori').val(data.id_categori);
				$('#name').val(data.name_cate);
			}

		});
	});


	// Ubah Unit
	$('.tombolTambahUnit').click(function() {
		$('.modal-title').html('Tambah Data Unit');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_unit').val('');
		$('#name').val('');
	});

	$('.tombolUbahUnit').click(function() {
		$('.modal-title').html('Ubah Data Unit');
		$('.modal-footer button[type=submit]').html('Ubah');

		$('.modal-body form').attr('action', 'http://localhost/app-web-pos-ci3/units/formUbahUnit');

		const id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url: 'http://localhost/app-web-pos-ci3/units/getUbahUnit',
			data: {id: id},
			dataType: 'json',
			method: 'post',
			success: function(data) {
				// console.log(data);
				$('#id_unit').val(data.id_unit);
				$('#name').val(data.name_unit);
			}

		});
	});


	// Ubah Product Item
	$('.tombolTambahPitem').click(function() {
		$('.modal-title').html('Tambah Data Product Item');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_pitem').val('');
		$('#name').val('');
		$('#price').val('');
		$('#categori').val('');
		$('#unit').val('');
	});

	$('.tombolUbahPitem').click(function() {
		$('.modal-title').html('Ubah Data Product Item');
		$('.modal-footer button[type=submit]').html('Ubah');

		$('.modal-body form').attr('action', 'http://localhost/app-web-pos-ci3/pitem/formUbahPitem');

		const id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url: 'http://localhost/app-web-pos-ci3/pitem/getUbahPitem',
			data: {id: id},
			dataType: 'json',
			method: 'post',
			success: function(data) {
				console.log(data);
				$('#id_pitem').val(data.id_pitem);
				$('#name').val(data.name_pitem);
				$('#barcode').val(data.barcode);
				$('#price').val(data.price);
				$('#categori').val(data.id_categori);
				$('#unit').val(data.id_unit);
				$('#inputUbahFoto').val(data.photo_product);
				$('#tampilFotoProduct').attr('src', 'http://localhost/app-web-pos-ci3/assets/img/product/' + data.photo_product);
			}

		});
	});


	// Generate Barcode
	$('.tombolGenerateBarcode').click(function() {

		const id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url: 'http://localhost/app-web-pos-ci3/pitem/getUbahPitem',
			data: {id: id},
			dataType: 'json',
			method: 'post',
			success: function(data) {
				// console.log(data);
				$('.modalGenerate').html();
			}

		});
	});


	$('.tombolUbahPitem').click(function() {
		if($('.tombolGenerateBarcode')) {
			$('.tombolGenerateBarcode').toggle();
		} else {
			$('.tombolGenerateBarcode').show();
		}
	})


	// Halaman Stock In
	  $('.selectStockIn').click(function() {
	    var id_pitem = $(this).data('id'); 
	    var barcode = $(this).data('barcode'); 
	    var name_pitem = $(this).data('name'); 
	    var name_unit = $(this).data('unit'); 
	    var stock = $(this).data('stock');

	    $('#id_pitem').val(id_pitem);
	    $('#barcode').val(barcode);
	    $('#name_pitem').val(name_pitem);
	    $('#name_unit').val(name_unit);
	    $('#stock').val(stock);
	    $('#modalStockIn').modal('hide');
	    $('#formmodalUnit').modal('hide');
	  });

	



});