<script type="text/javascript">
	document.title="Detail transaksi";
	document.getElementById('transaksi').classList.add('active');

	$('.disabled').click(function(e){
    	e.preventDefault();
	});

</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<?php
				if ($_SESSION['status']==1) {
				?>
				<h3 class="jdl">Detail Permintaan</h3>
				<?php }else{ ?>
				<h3 class="jdl">Detail Permintaan</h3>
				<?php } ?>
				<?php
				$getqheader=$root->con->query("select * from permintaan where permintaan_id='$_GET[permintaan_id]'");
				$getqheader=$getqheader->fetch_assoc();
				?>
				<table>
					<tr>
						<td><span class="label">Kode Permintaan</span></td><td><span class="label">: </span></td>
						<td><span class="label"><?= $getqheader['permintaan_id'] ?></span></td>
					</tr>
					<tr>
						<td><span class="label">Tanggal Permintaan</span></td><td><span class="label">: </span></td>
						<td><span class="label"><?= date("d-m-Y",strtotime($getqheader['permintaan_tgl'])) ?></span></td>
					</tr>
					<tr>
						<td><span class="label">Keterangan</span></td><td><span class="label">: </span></td>
						<td><span class="label"><?= $getqheader['permintaan_ket'] ?></span></td>
					</tr>
				</table>
				<table class="datatable" style="width: 100%;">
					<thead>
				<tr>
					<th width="35px">NO</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Stok Barang</th>
					<th>Permintaan</th>
					<th>Status</th>
					<?php 
					if ($_SESSION['status']==3) {
					 ?>
					 <th width="100px">Aksi</th>
					<?php } ?>
				</tr>
			</thead>
					<tbody>
				<?php
				$trx=date("d")."/AF/".$_SESSION['status']."/".date("y");
				$data=$root->con->query("select barang.kode_barang, barang.nama_barang, barang.stok, detail_permintaan.dp_id, detail_permintaan.dp_jumlah, detail_permintaan.permintaan_status from detail_permintaan inner join barang on barang.kode_barang=detail_permintaan.kode_barang where detail_permintaan.permintaan_id='$_GET[permintaan_id]'");
				$no=1;
				while ($f=$data->fetch_assoc()) {
					?><tr>
						<td><?= $no++ ?></td>
						<td><?= $f['kode_barang'] ?></td>
						<td><?= $f['nama_barang'] ?></td>
						<td><?= $f['stok'] ?></td>
						<td><?= $f['dp_jumlah'] ?></td>
						<td><?= $f['permintaan_status'] ?></td>
						<td>
							<?php
							if ($_SESSION['status'] == 3 ) {
								?>

								<?php
								if($f['permintaan_status'] == 'menunggu'){
									?>
									<a class="btnblue" href="?action=diterima_detail_permintaan&dp_id=<?= $f['dp_id'] ?>&permintaan_id=<?=$_GET['permintaan_id']?>"><i class="fa fa-check"></i></a>
									<a class="btnblue" style="background: #f33155" href="?action=ditolak_detail_permintaan&dp_id=<?= $f['dp_id'] ?>&permintaan_id=<?=$_GET['permintaan_id']?>""><i class="fa fa-times"></i></a>
									<?php
								}
								elseif($f['permintaan_status'] == 'ditolak'){
									?>
									<a class="btnblue" href="?action=diterima_detail_permintaan&dp_id=<?= $f['dp_id'] ?>&permintaan_id=<?=$_GET['permintaan_id']?>"><i class="fa fa-check"></i></a>
									<?php
								}else {
									?>
									<a class="btnblue" style="background: #f33155" href="?action=ditolak_detail_permintaan&dp_id=<?= $f['dp_id'] ?>&permintaan_id=<?=$_GET['permintaan_id']?>""><i class="fa fa-times"></i></a>
									<?php
								}
								  ?>
							<?php
							}
							?>
						</td>
						</tr>
					<?php
				}
				?>
			</tbody>
				</table>
				<br>
				<div class="left">
					<a href="list_permintaan.php" class="btnblue" style="background: #f33155"><i class="fa fa-mail-reply"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>
