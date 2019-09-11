<script type="text/javascript">
	document.title="Edit User";
	document.getElementById('users').classList.add('active');
	function hanyaAngka(evt) {
  		var charCode = (evt.which) ? evt.which : event.keyCode
  		if (charCode > 31 && (charCode < 48 || charCode > 57))

    	return false;
  		return true;
	}
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Edit User</h3>
				<form class="form-input" method="post" action="handler.php?action=edit_user">
					<?php $f=$root->edit_user($_GET['id']) ?>
					<input type="hidden" name="id" value="<?= $f['id'] ?>">
					<input type="text" name="username" placeholder="Username User Login" required="required" value="<?= $f['username'] ?>">
					<input type="text" name="nama" placeholder="Nama Lengkap" required="required" value="<?= $f['nama'] ?>">
					<textarea name="alamat" cols="53" rows="4" required="required" value="<?= $f['alamat'] ?>"></textarea>
					<input type="text" onkeypress="return hanyaAngka(event)" name="notlp" placeholder="Nomor Telepon" required="required" value="<?= $f['notlp'] ?>" >
					<input autocomplete="off" type="password" name="password" placeholder="Password Baru">
					<label>* Password tidak bisa ditampikan karena terenkripsi</label><br>
					<label>* Kosongkan form password jika tidak ingin merubah password</label><br><br>
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="users.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
