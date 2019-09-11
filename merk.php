<?php include "head.php" ?>
<?php
	if (isset($_GET['action']) && $_GET['action']=="edit_merk") {
		include "edit_merk.php";
	}
	else{
?>
<script type="text/javascript">
	document.title="List Merk";
	document.getElementById('merk').classList.add('active');
</script>
<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
			<div class="contenttop">
				<div class="left">
					<form action="handler.php?action=tambah_merk" method="post">
						<input required="" type="text" name="nama_merk" placeholder="Nama Merk..." style="margin-right: 10px;border-right: 1px solid #ccc;border-radius: 3px;">
						<button style="background: #41b3f9;color: #fff;border-radius: 3px;border-color: #41b3f9;border:1px solid #41b3f9">Tambahkan</button>
					</form>
				</div>
				<div class="both"></div>
			</div>
			<span class="label">Jumlah Merk : <?= $root->show_jumlah_merk() ?></span>
			<table class="datatable" style="width: 500px;">
				<thead>
				<tr>
					<th width="35px">NO</th>
					<th>Nama Merk</th>
					<th width="60px">Aksi</th>
				</tr>
			</thead>
			<tbody>
					<?php $root->tampil_merk() ?>
</tbody>

			</table>
			</div>
		</div>
	</div>
</div>

<?php 
}
include "foot.php" ?>
