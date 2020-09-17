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
            <button type="button" class="btn btn-outline-primary mb-2 tombolTambahSupplier" data-toggle="modal" data-target="#formmodalSupplier">Tambah Data Supplier</button>
            <?= $this->session->flashdata('pesan'); ?>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Semua Suppliers</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Name Supplier</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Description</th>
                <th><i class="fas fa-cogs"></i></th>
              </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($suppliers as $s) : ?>
                 <tr>
                   <td><?= $no++; ?></td>
                   <td><?= $s['name_sup']; ?></td>
                   <td><?= $s['phone']; ?></td>
                   <td><?= $s['address']; ?></td>
                   <td><?= $s['description']; ?></td>
                   <td>
                    <button type="button" class="btn btn-info tombolUbahSupplier" data-toggle="modal" data-target="#formmodalSupplier" data-id="<?= $s['id_supplier']; ?>"><i class="fas fa-user-edit"></i></button>
                     <a href="<?= base_url('suppliers/delete/') . $s['id_supplier']; ?>" onclick="return confirm('Yakin')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus User?"><i class="fas fa-trash"></i></a>
                   </td>
                 </tr>
                <?php endforeach; ?>
                <?php if(empty($suppliers)) : ?>
                  <div class="alert alert-danger" role="alert">Data User Kosong</div>
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
<div class="modal fade" id="formmodalSupplier">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Supplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('suppliers/formSupplier'); ?>" method="post">
          <input type="hidden" name="id_supplier" id="id_supplier">
          <div class="form-group">
            <label for="name">Nama Supplier</label>
            <input type="text" name="name" id="name" class="form-control">
            <small class="text-danger muted"><?= form_error('name'); ?></small>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control">
            <small class="text-danger muted"><?= form_error('phone'); ?></small>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control"></textarea>
            <small class="text-danger muted"><?= form_error('address'); ?></small>
          </div>
          <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            <small class="text-danger muted"><?= form_error('description'); ?></small>
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



