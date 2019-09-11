<?php include "head.php" ?>
<!-- <?php
	if (isset($_GET['action']) && $_GET['action']=="tambah_supplier") {
		include "tambah_supplier.php";
	}
	else if (isset($_GET['action']) && $_GET['action']=="edit_supplier") {
		include "edit_supplier.php";
	}
	else{
?> -->
<script type="text/javascript">
	document.title="Data Supplier";
	document.getElementById('supplier').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
			<div class="contenttop">
				<div class="left">
				<!-- <a href="?action=tambah_supplier" class="btnblue">Tambah Supplier</a> -->
				</div>
				<div class="both"></div>
			</div>
			<span class="label">Jumlah Supplier : <?= $root->show_jumlah_supplier() ?></span>
			<table class="datatable" id="datatable">
				<!-- style="width: 600px;" -->
				<thead>
				<tr>
					<th width="35px">#</th>
					<th>Nama Supplier</th>
					<th>Alamat</th>
					<th>No Telephone</th>
					<th>Tanggal Didaftarkan</th>
					<!-- <th width="60px">Aksi</th> -->
				</tr>
			</thead>
			<tbody>
					<?php
					$root->tampil_supplier();
					?>
</tbody>

			</table>
			</div>
		</div>
	</div>
</div>
<!-- <script type="text/javascript">
	function myconfirm(){
		confirm("Yakin Ingin Menghapus Supplier?");
		return false;
	}
</script> -->

<?php 
}
include "foot.php" ?>
