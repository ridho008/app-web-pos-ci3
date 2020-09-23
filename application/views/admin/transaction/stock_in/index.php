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
            <button type="button" class="btn btn-outline-primary mb-2 tombolTambahStockIn" data-toggle="modal" data-target="#formmodalUnit">Tambah Stock Barang Masuk</button>
            <?= $this->session->flashdata('pesan'); ?>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Barang Masuk / Pembelian</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Product Item</th>
                <th>Quantity</th>
                <th>Date</th>
                <th><i class="fas fa-cogs"></i></th>
              </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($t_stock_in as $tsi) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $tsi['barcode']; ?></td>
                    <td><?= $tsi['name_pitem']; ?></td>
                    <td><?= $tsi['quantity']; ?></td>
                    <td><?= date('d-m-Y', strtotime($tsi['date'])); ?></td>
                    <td>
                      <button type="button" data-id="<?= $tsi['id_stock']; ?>" class="btn btn-outline-primary tombolDetailStockIn" data-toggle="modal" data-target="#modalDetailStockIn"><i class="fas fa-eye"></i></button>
                      <a href="<?= base_url('stock/in/del/') . $tsi['id_stock'] . '/' . $tsi['id_pitem']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </section>
  <!-- /.content -->

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
        <form action="<?= base_url('stock/process'); ?>" method="post">
          <input type="text" name="id_pitem" id="id_pitem">
          <small class="text-danger muted"><?= form_error('id_pitem'); ?></small>
          <div class="form-group">
            <label for="name">Date</label>
            <input type="date" name="date" value="<?= date('Y-m-d'); ?>" id="date" class="form-control">
            <small class="text-danger muted"><?= form_error('date'); ?></small>
          </div>
          <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" name="barcode" id="barcode" class="form-control">
            <span class="input-group-btn">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalStockIn"><i class="fas fa-search"></i></button>
            </span>
            <small class="text-danger muted"><?= form_error('barcode'); ?></small>
          </div>
          <div class="form-group">
            <label for="name_pitem">Name Product Item</label>
            <input type="text" class="form-control" readonly name="name_pitem" id="name_pitem">
            <small class="text-danger muted"><?= form_error('name_pitem'); ?></small>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label for="name_unit">Name Unit</label>
                <input type="text" class="form-control" readonly name="name_unit" id="name_unit">
                <small class="text-danger muted"><?= form_error('name_unit'); ?></small>
              </div>
              <div class="col-md-4">
                <label for="stock">Initial Stock</label>
                <input type="text" class="form-control" readonly name="stock" id="stock">
                <small class="text-danger muted"><?= form_error('stock'); ?></small>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="detail">Detail</label>
            <input type="text" class="form-control" placeholder="Kulakan / Tambahan / etc" name="detail" id="detail">
            <small class="text-danger muted"><?= form_error('detail'); ?></small>
          </div>
          <div class="form-group">
            <label for="supplier">Supplier</label>
            <select class="form-control" name="supplier" id="supplier">
              <option value="">-- Choose Supplier --</option>
              <?php foreach($suppliers as $s) : ?>
                <option value="<?= $s['id_supplier']; ?>"><?= $s['name_sup']; ?></option>
              <?php endforeach; ?>
            </select>
            <small class="text-danger muted"><?= form_error('supplier'); ?></small>
          </div>
          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" placeholder="Kulakan / Tambahan / etc" name="quantity" id="quantity">
            <small class="text-danger muted"><?= form_error('quantity'); ?></small>
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


<div class="modal fade" id="modalStockIn">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Product Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th>Barcode</th>
              <th>Name</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Stock</th>
              <th><i class="fas fa-cogs"></i></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($item as $t) : ?>
              <tr>
                <td><?= $t['barcode']; ?></td>
                <td><?= $t['name_pitem']; ?></td>
                <td><?= $t['name_unit']; ?></td>
                <td><?= number_format($t['price'], 0, ',', '.'); ?></td>
                <td><?= $t['stock']; ?></td>
                <td>
                  <button id="selectStockIn" data-id="<?= $t['id_pitem']; ?>" data-barcode="<?= $t['barcode']; ?>" data-name="<?= $t['name_pitem']; ?>" data-unit="<?= $t['name_unit']; ?>" data-stock="<?= $t['stock']; ?>" class="btn btn-primary selectStockIn"><i class="fas fa-check"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Detail -->
<div class="modal fade" id="modalDetailStockIn">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Product Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tr>
              <th>Barcode</th>
              <td class="barcode"></td>
            </tr>
            <tr>
              <th>Item Name</th>
              <td class="item"></td>
            </tr>
            <tr>
              <th>Detail</th>
              <td class="detail"></td>
            </tr>
            <tr>
              <th>Supplier</th>
              <td class="supplier"></td>
            </tr>
            <tr>
              <th>Quantity</th>
              <td class="quantity"></td>
            </tr>
            <tr>
              <th>Date</th>
              <td class="date"></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->