<script type="text/javascript">
	document.title="Tambah User";
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
				<h3 class="jdl">Tambah Pengguna</h3>
				<form class="form-input" method="post" action="handler.php?action=tambah_user">
					<input type="text" name="username" placeholder="Username Login" required="required">
					<input autocomplete="off" type="password" name="password" placeholder="Password Login" required="required">
					<input type="text" name="nama" placeholder="Nama Lengkap" required="required">
					<label>Alamat :</label>
					<br>
					<textarea name="alamat" cols="56" rows="4" required="required"></textarea>
					<input type="text" onkeypress="return hanyaAngka(event)" name="notlp" placeholder="Nomor Telepon" required="required">
					<select style="width: 372px;cursor: pointer;" required="required" name="status">
						<option value="">Akses :</option>
						<?php $root->tampil_akses(); ?>
					</select>
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="users.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
