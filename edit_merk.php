<script type="text/javascript">
	document.title="Edit List Merk";
	document.getElementById('merk').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Edit Merk</h3>
				<?php $f=$root->edit_merk($_GET['id_merk']) ?>
				<form class="form-input" method="post" action="handler.php?action=edit_merk">
					<input type="text" placeholder="ID Merk" disabled="disabled" value="ID merk : <?= $f['id_merk'] ?>">
					<input type="text" name="nama_merk" placeholder="Nama Barang" required="required" value="<?= $f['nama_merk'] ?>">
					<input type="hidden" name="id_merk" value="<?= $f['id_merk'] ?>">
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Update</button>
					<a href="merk.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
