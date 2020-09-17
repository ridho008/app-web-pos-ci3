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
            <button type="button" class="btn btn-outline-primary mb-2 tombolTambahCustomer" data-toggle="modal" data-target="#formmodalCustomer">Tambah Data Customer</button>
            <?= $this->session->flashdata('pesan'); ?>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Semua Customers</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Name Customer</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Address</th>
                <th><i class="fas fa-cogs"></i></th>
              </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($customers as $c) : ?>
                 <tr>
                   <td><?= $no++; ?></td>
                   <td><?= $c['name_cus']; ?></td>
                   <td><?= $c['gender'] == 'L' ? 'Pria' : 'Perempuan'; ?></td>
                   <td><?= $c['phone']; ?></td>
                   <td><?= $c['address']; ?></td>
                   <td>
                    <button type="button" class="btn btn-info tombolUbahCustomer" data-toggle="modal" data-target="#formmodalCustomer" data-id="<?= $c['id_customer']; ?>"><i class="fas fa-user-edit"></i></button>
                     <a href="<?= base_url('customers/delete/') . $c['id_customer']; ?>" onclick="return confirm('Yakin')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Customer?"><i class="fas fa-trash"></i></a>
                   </td>
                 </tr>
                <?php endforeach; ?>
                <?php if(empty($customers)) : ?>
                  <div class="alert alert-danger" role="alert">Data Customers Kosong</div>
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
<div class="modal fade" id="formmodalCustomer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('customers/formCustomer'); ?>" method="post">
          <input type="text" name="id_customer" id="id_customer">
          <div class="form-group">
            <label for="name">Nama Customer</label>
            <input type="text" name="name" id="name" class="form-control">
            <small class="text-danger muted"><?= form_error('name'); ?></small>
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control">
              <option value="">-- Pilih Gender --</option>
              <option value="L">Pria</option>
              <option value="P">Perempuan</option>
            </select>
            <small class="text-danger muted"><?= form_error('gender'); ?></small>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control">
            <small class="text-danger muted"><?= form_error('phone'); ?></small>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control"></textarea>
            <small class="text-danger muted"><?= form_error('address'); ?></small>
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



