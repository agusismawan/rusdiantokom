<?php include "head.php" ?>
<?php
	$con=new mysqli("localhost","root","","db_pkl");
	function alert($text){
		?><script type="text/javascript">
			alert( "<?= $text ?>" );
		</script>
		<?php
	}

	function redirect($url){
		?>
		<script type="text/javascript">
			window.location.href="<?= $url ?>";
		</script>
		<?php
	}
	if (isset($_GET['action']) && $_GET['action']=="detail_permintaan") {
		include "detail_permintaan.php";
	}
	else if (isset($_GET['action']) && $_GET['action']=="diterima_detail_permintaan") {
		$id=$_GET['dp_id'];
		$permintaan_id=$_GET['permintaan_id'];
		
		$query=$con->query("update detail_permintaan set permintaan_status='diterima' where dp_id='$id'");
		if ($query === TRUE) {
			alert("Permintaan berhasil di update");
			redirect("list_permintaan.php?action=detail_permintaan&permintaan_id=$permintaan_id");
		}else{
			alert("Permintaan gagal di update");
			redirect("list_permintaan.php?action=detail_permintaan&permintaan_id=$permintaan_id");

		}
	}
	else if (isset($_GET['action']) && $_GET['action']=="ditolak_detail_permintaan") {
		$id=$_GET['dp_id'];
		$permintaan_id=$_GET['permintaan_id'];
		$query=$con->query("update detail_permintaan set permintaan_status='ditolak' where dp_id='$id'");
		if ($query === TRUE) {
			alert("Permintaan berhasil di update");
			redirect("list_permintaan.php?action=detail_permintaan&permintaan_id=$permintaan_id");
		}else{
			alert("Permintaan gagal di update");
			redirect("list_permintaan.php?action=detail_permintaan&permintaan_id=$permintaan_id");

		}
	}

	else{
?>
<script type="text/javascript">
	document.title="List Permintaan";
	document.getElementById('list_permintaan').classList.add('active');
</script>
<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
			<div class="contenttop">
				<div class="both"></div>
			</div>
			<span class="label">Jumlah Permintaan : <?= $root->show_jumlah_permintaan() ?></span>
			<table class="datatable" style="width: 600px;">
				<thead>
				<tr>
					<th width="35px">NO</th>
					<th>Tanggal Permintaan</th>
					<th>Kode Permintaan</th>
					<th>Keterangan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				$q=$root->con->query("select * from permintaan");
				if ($q->num_rows > 0) {
				while ($f=$q->fetch_assoc()) {
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= date("d-m-Y",strtotime($f['permintaan_tgl'])) ?></td>
						<td><?= $f['permintaan_id'] ?></td>
						<td><?= $f['permintaan_ket'] ?></td>
						<!-- <td><?= $f[''] ?></td> -->
						<td>
							<a href="?action=detail_permintaan&permintaan_id=<?= $f['permintaan_id'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Detail</span><i class="fa fa-eye"></i></a>
							<a onclick="return confirm('yakin ingin menghapus <?= $f['permintaan_id'] ?>')" href="handler.php?action=delete_permintaan_barang&id=<?= $f['permintaan_id'] ?>" class="btn redtbl"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php
				}
			}else{
				?>
				<td><?= $no++ ?></td>
				<td colspan="5">Belum Ada Permintaan</td>
				<?php
			}
				?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<?php 
}
include "foot.php" ?>
