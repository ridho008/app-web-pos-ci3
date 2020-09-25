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
      <div class="col-md-4">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <table>
            	<tr>
            		<div class="form-group">
	            		<td><label>Date</label></td>
	            		<td>
	            			<input type="date" id="date" value="<?= date('Y-m-d'); ?>" class="form-control">
	            		</td>
            		</div>
            	</tr>
            	<tr>
            		<div class="form-group">
	            		<td><label>Kasir</label></td>
	            		<td>
	            			<input type="text" id="kasir" value="<?= $user['name'] ?>" class="form-control">
	            		</td>
            		</div>
            	</tr>
            	<tr>
            		<div class="form-group">
	            		<td><label>Customer</label></td>
	            		<td>
	            			<select name="customer" id="customer" class="form-control">
	            			<option value="">-- Choose Customers --</option>
	            			<?php foreach($customers as $c) : ?>
	            				<option value="<?= $c['id_customer']; ?>"><?= $c['name_cus']; ?></option>
	            			<?php endforeach; ?>
	            			</select>
	            		</td>
            		</div>
            	</tr>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <div class="col-md-4">
      	<div class="card">
      		<div class="card-body">
      			<table>
      				<tr>
      					<td><label>Barcode</label></td>
      					<td>
      						<input type="hidden" id="pitem">
      						<input type="hidden" id="price">
      						<input type="hidden" id="stock">
      						<div class="input-group mb-3">
							  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
							  <div class="input-group-append">
							    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-item"><i class="fas fa-search"></i></button>
							  </div>
							</div>
      						<!-- <input type="text" id="barcode" class="form-control" autofocus="on"> -->
      						<!-- <span class="input-group-btn">
      							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-item"><i class="fas fa-search"></i></button>
      						</span> -->
      					</td>
      				</tr>
      				<tr>
      					<td><label for="quantity">Quantity</label></td>
      					<td><input type="number" id="quantity" value="1" min="1" class="form-control"></td>
      				<tr>
      					<td></td>
      					<td>
      						<button type="button" id="add-cart" class="btn btn-primary btn-sm float-left mt-2"><i class="fas fa-shopping-cart"></i> Add</button>
      					</td>
      				</tr>
      			</table>
      		</div>
      	</div>
      </div>
      <div class="col-md-4">
      	<div class="card">
      		<div class="card-body">
      			<div align="right">
      				<h4>Invoice <strong><span id="invoice"><?= $invoice; ?></span></strong></h4>
      				<h1><strong><span id="grand-total2">0</span></strong></h1>
      			</div>
      		</div>
      	</div>
      </div>
    </div>

    <div class="row">
    	<div class="col-md">
    		<div class="card">
    			<div class="card-body">
    				<div class="table-responsive">
    					<table class="table table-bordered table-striped">
    						<thead>
    							<tr>
    								<th>#</th>
    								<th>Barcode</th>
    								<th>Product Item</th>
    								<th>Price</th>
    								<th>Quantity</th>
    								<th>Discount Item</th>
    								<th>Total</th>
    								<th><i class="fas fa-cogs"></i></th>
    							</tr>
    						</thead>
    						<tbody>
    							<tr>
    								<td colspan="9">tidak ada item</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-3">
    		<div class="card">
    			<div class="card-body">
    				<table width="100%">
    					<tr>
    						<td><label>Sub Total</label></td>
    						<td>
    							<div class="form-group">
    								<input type="number" id="sub-total" value="" class="form-control" readonly>
    							</div>
    						</td>
    					</tr>
    					<tr>
    						<td><label>Discount</label></td>
    						<td>
    							<div class="form-group">
    								<input type="number" id="discount" value="0" min="0" class="form-control">
    							</div>
    						</td>
    					</tr>
    					<tr>
    						<td><label>Grand Total</label></td>
    						<td>
    							<div class="form-group">
    								<input type="number" id="grand-total" class="form-control" readonly>
    							</div>
    						</td>
    					</tr>
    				</table>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-3">
    		<div class="card">
    			<div class="card-body">
    				<table width="100%">
    					<tr>
    						<td><label>Cash</label></td>
    						<td>
    							<div class="form-group">
    								<input type="number" id="cash" value="0" min="0" class="form-control">
    							</div>
    						</td>
    					</tr>
    					<tr>
    						<td><label>Change</label></td>
    						<td>
    							<div class="form-group">
    								<input type="number" id="change" readonly class="form-control">
    							</div>
    						</td>
    					</tr>
    				</table>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-3">
    		<div class="card">
    			<div class="card-body">
    				<table width="100%">
    					<tr>
    						<td><label>Note</label></td>
    						<td>
    							<div>
    								<textarea name="note" id="note" class="form-control"></textarea>
    							</div>
    						</td>
    					</tr>
    				</table>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
    			<button id="cancel-payment" class="btn btn-warning btn-sm"><i class="fas fa-refresh-alt"></i> Cancel</button>
    			<button id="proses-payment" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i> Proses Payment</button>
    		</div>
    	</div>
    </div>
  </section>
  <!-- /.content -->


