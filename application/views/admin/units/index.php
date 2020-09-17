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
            <button type="button" class="btn btn-outline-primary mb-2 tombolTambahUnit" data-toggle="modal" data-target="#formmodalUnit">Tambah Data Unit</button>
            <?= $this->session->flashdata('pesan'); ?>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Semua Units</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Name Unit</th>
                <th><i class="fas fa-cogs"></i></th>
              </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($units as $u) : ?>
                 <tr>
                   <td><?= $no++; ?></td>
                   <td><?= $u['name_unit']; ?></td>
                   <td>
                    <button type="button" class="btn btn-info tombolUbahUnit" data-toggle="modal" data-target="#formmodalUnit" data-id="<?= $u['id_unit']; ?>"><i class="fas fa-edit"></i></button>
                     <a href="<?= base_url('units/delete/') . $u['id_unit']; ?>" onclick="return confirm('Yakin')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus User?"><i class="fas fa-trash"></i></a>
                   </td>
                 </tr>
                <?php endforeach; ?>
                <?php if(empty($units)) : ?>
                  <div class="alert alert-danger" role="alert">Data Units Kosong</div>
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

<!-- Modal Tambah Categori -->
<div class="modal fade" id="formmodalUnit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Unit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('units/formUnit'); ?>" method="post">
          <input type="text" name="id_unit" id="id_unit">
          <div class="form-group">
            <label for="name">Name Unit</label>
            <input type="text" name="name" id="name" class="form-control">
            <small class="text-danger muted"><?= form_error('name'); ?></small>
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



