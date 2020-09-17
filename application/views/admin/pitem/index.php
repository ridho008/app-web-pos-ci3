<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md">
        <div class="row">
          <div class="col-md-6">
            <button type="button" class="btn btn-outline-primary mb-2 tombolTambahPitem" data-toggle="modal" data-target="#formmodalPitem">Tambah Data Product Item</button>
            <?= $this->session->flashdata('pesan'); ?>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Semua Product Items</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Name Product</th>
                <th><i class="fas fa-cogs"></i></th>
              </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($pitem as $p) : ?>
                 <tr>
                   <td><?= $no++; ?></td>
                   <td><?= $p['barcode']; ?></td>
                   <td><?= $p['name_pitem']; ?></td>
                   <td>
                    <button type="button" class="btn btn-info tombolUbahCustomer" data-toggle="modal" data-target="#formmodalCustomer" data-id="<?= $p['id_pitem']; ?>"><i class="fas fa-user-edit"></i></button>
                     <a href="<?= base_url('customers/delete/') . $p['id_pitem']; ?>" onclick="return confirm('Yakin')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Customer?"><i class="fas fa-trash"></i></a>
                   </td>
                 </tr>
                <?php endforeach; ?>
                <?php if(empty($pitem)) : ?>
                  <div class="alert alert-danger" role="alert">Data Product Item Kosong</div>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </section>
  <!-- /.content -->

<!-- Modal Tambah User -->
<div class="modal fade" id="formmodalPitem">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Product Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('pitem/formPitem'); ?>" method="post">
          <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" name="barcode" id="barcode" class="form-control">
            <small class="text-danger muted"><?= form_error('barcode'); ?></small>
          </div>
          <div class="form-group">
            <label for="name">Name Product</label>
            <input type="text" name="name" id="name" class="form-control">
            <small class="text-danger muted"><?= form_error('name'); ?></small>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control">
            <small class="text-danger muted"><?= form_error('price'); ?></small>
          </div>
          <div class="form-group">
            <label for="categori">Categori</label>
            <select name="categori" id="categori" class="form-control">
            	<option value="">-- Choose Categori --</option>
            	<?php foreach($categories as $c) : ?>
            		<option value="<?= $c['id_categori']; ?>"><?= $c['name_cate']; ?></option>
            	<?php endforeach; ?>
            </select>
            <small class="text-danger muted"><?= form_error('categori'); ?></small>
          </div>
          <div class="form-group">
            <label for="unit">unit</label>
            <select name="unit" id="unit" class="form-control">
            	<option value="">-- Choose Unit --</option>
            	<?php foreach($units as $u) : ?>
            		<option value="<?= $u['id_unit']; ?>"><?= $u['name_unit']; ?></option>
            	<?php endforeach; ?>
            </select>
            <small class="text-danger muted"><?= form_error('unit'); ?></small>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



