<?php 

error_reporting(0);
class penjualan
{
	
	public $con;
	function __construct()
	{
		$this->con=new mysqli("localhost","root","","db_pos");
	}
	function __destruct()
	{
		$this->con->close();
	}
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
	function go_back(){
		?>
		<script type="text/javascript">
			window.history.back();
		</script>
		<?php
	}

	function login($username,$password){
		if (trim($username)=="") {
			$error[]="Username";
		}
		if (trim($password)=="") {
			$error[]="Password";
		}
		if (isset($error)) {
			echo "<div class='red'><i class='fa fa-warning'></i> Maaf sepertinya ".implode(' dan ', $error)." anda kosong.</div>";
		}else{
			$password=sha1($password);
			$query=$this->con->query("select * from user where username='$username' and password='$password'");

			if ($query->num_rows > 0) {
				echo "<div class='green'><i class='fa fa-check'></i> Login Berhasil, silahkan tunggu beberapa saat.</div>";
				$data=$query->fetch_assoc();
				session_start();
				$_SESSION['username']=$data['username'];
				$_SESSION['status']=$data['status'];
				$_SESSION['nama']=$data['nama'];
				$_SESSION['id']=$data['id'];
				if ($data['status']=='1') {
					$this->redirect("home.php");
				}else if ($data['status']=='2') {
					$this->redirect("transaksi.php");
				} else if($data['status']== '3') {
					$this->redirect("home.php");
				} else if($data['status']=='4') {
					$this->redirect("home.php");
				}

			}else{
				echo "<div class='red'><i class='fa fa-warning'></i> Maaf sepertinya username atau password anda salah.</div>";
			}
		}
	}
	function tambah_barang($kode_barang,$nama_barang,$stok,$harga_jual,$id_kategori,$id_merk,$id){
		$query=$this->con->query("select * from barang where nama_barang='$nama_barang'");
		if ($query->num_rows > 0) {
			$this->alert("Data barang sudah ada");
			$this->go_back();
		}
		else{
			$query2=$this->con->query("INSERT INTO barang SET kode_barang='$kode_barang', nama_barang='$nama_barang',id_kategori='$id_kategori', id_merk='$id_merk', id='$id', stok='$stok', harga_jual='$harga_jual'");
			if ($query2===TRUE) {
				$this->alert("Barang Berhasil Ditambahkan");
				$this->redirect("barang.php");
			}
			else{
				$this->alert("Barang Gagal Ditambahkan");
				$this->redirect("barang.php");
			}
		}
	}
	function tambah_user($username,$password,$nama,$alamat,$notlp,$status){
		$nama_kasir=str_replace(" ", "", $username);
		$query=$this->con->query("select * from  user where username='$username'");
		if ($query->num_rows > 0) {
			$this->alert("Username  untuk user sudah ada.");
			$this->go_back();
		}
		else{
			$password=sha1($password);
			$query2=$this->con->query("insert into user set username='$username',password='$password',nama='$nama',alamat='$alamat',notlp='$notlp',status='$status'");
			if ($query2 ===  TRUE) {
				$this->alert("Data User berhasil dismpan");
				$this->redirect("users.php");
			}
			else{
				$this->alert("User Gagal Ditambahkan");
				$this->redirect("users.php");
			}
		}
	}

	function tambah_kategori($nama_kategori){
		$query=$this->con->query("select * from kategori where nama_kategori='$nama_kategori'");
		if ($query->num_rows > 0) {
			$this->alert("Kategori Sudah Ada");
			$this->redirect("kategori.php");
		}else{
			$query2=$this->con->query("insert into kategori set nama_kategori='$nama_kategori'");
			if ($query2===TRUE) {
				$this->alert("kategori Berhasil Ditambahkan");
				$this->redirect("kategori.php");
			}
			else{
				$this->alert("kategori Gagal Ditambahkan");
				$this->redirect("kategori.php");
			}
		}
	}

	function tambah_merk($nama_merk){
		$query=$this->con->query("select * from merk where nama_merk='$nama_merk'");
		if ($query->num_rows > 0) {
			$this->alert("Merk Sudah Ada");
			$this->redirect("merk.php");
		}else{
			$query2=$this->con->query("insert into merk set nama_merk='$nama_merk'");
			if ($query2===TRUE) {
				$this->alert("Merk Berhasil Ditambahkan");
				$this->redirect("merk.php");
			}
			else{
				$this->alert("Merk Gagal Ditambahkan");
				$this->redirect("merk.php");
			}
		}
	}

	function tampil_barang($keyword, $status = null){
		if ($keyword=="null") {
			if($status == null){
				$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id)");
			} else {
				$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id) WHERE user.id = '".$_SESSION['id']."'");
			}
		}else{
			$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id) where nama_barang like '%$keyword%'");
		}
		if ($query->num_rows > 0) {
			$no=1;
			while ($data=$query->fetch_assoc()) {
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $data['kode_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['nama_kategori'] ?></td>
					<td><?= $data['nama_merk'] ?></td>
					<td><?= $data['nama'] ?></td>
					<td><?= $data['stok'] ?></td>
					<?php 
					if ($_SESSION['status']!=4) {
						# code...
						?>
						<td>Rp. <?= number_format($data['harga_jual']) ?></td>
					<?php } ?>
					<td><?= date("d-m-Y",strtotime($data['date_added'])) ?></td>

					<?php if($_SESSION['status'] == 1 ){ ?>
						<td>
							<a href="?action=edit_barang&id_barang=<?= $data['id_barang'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Edit</span><i class="fa fa-pencil"></i></a>
							<a href="handler.php?action=hapus_barang&id_barang=<?= $data['id_barang'] ?>" class="btn redtbl" onclick="return confirm('yakin ingin menghapus <?= $data['nama_barang']." (id : ".$data['id_barang'] ?>) ?')"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
						</td>
					<?php } ?>

				</tr>
				<?php
				$no++;
			}
		}else{
			echo "<td></td><td colspan='5'>Maaf, barang yang anda cari tidak ada!</td>";
		}
		
	}

	function tampil_barang_pelanggan($keyword){
			if ($keyword=="null") {
				$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id)");
			}else{
				$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id) where nama_barang like '%$keyword%'");
			}
		if ($query->num_rows > 0) {
			$no=1;
			while ($data=$query->fetch_assoc()) {
				?>
				<tr>
					<!-- <td><?= $no ?></td> -->
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['nama_kategori'] ?></td>
					<td><?= $data['nama_merk'] ?></td>
					<td>Rp. <?= number_format($data['harga_jual']) ?></td>
					<td align="center"><?= $data['stok'] ?></td>
				</tr>
				<?php
				$no++;
			}
		}else{
			echo "<td></td><td colspan='5'>Maaf, barang yang anda cari tidak ada!</td>";
		}
		
	}

	function tampil_permintaan_barang_filter($id_cat){
		$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id) where kategori.id_kategori='$id_cat'");
		if ($query->num_rows > 0) {

			$no=1;
			while ($data=$query->fetch_assoc()) {
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $data['kode_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['nama_kategori'] ?></td>
					<td><?= $data['nama_merk'] ?></td>
					<td><?= $data['nama'] ?></td>
					<td><?= $data['stok'] ?></td>
					<td><input type="text" name="jumlah_permintaan"></td>
				</tr>
				<?php
				$no++;
			}
		}else{
			echo "<td></td><td colspan='5'>Barang dengan kategori tersebut masih kosong</td>";
		}
	}

	function tampil_permintaan_barang($keyword){
		if ($keyword=="null") {
			$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id)");
		}else{
			$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id) where nama_barang like '%$keyword%'");
		}

		if ($query->num_rows > 0) {
			$no=1;
			while ($data=$query->fetch_assoc()) {
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $data['kode_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['nama_kategori'] ?></td>
					<td><?= $data['nama_merk'] ?></td>
					<td><?= $data['nama'] ?></td>
					<td><?= $data['stok'] ?></td>
					<td><input type="text" name="jumlah_permintaan[]" value="0"><input type="hidden" name="kode_barang[]" value="<?= $data['kode_barang'] ?>"></td>
				</tr>
				<?php
				$no++;
			}
		}else{
			echo "<td></td><td colspan='5'>Maaf, barang yang anda cari tidak ada!</td>";
		}
	}

	function tampil_barang_filter($id_cat){
		$query=$this->con->query("SELECT barang.id_barang,barang.kode_barang,barang.nama_barang,barang.stok,barang.harga_jual,barang.date_added,kategori.nama_kategori,merk.nama_merk,user.nama from (((barang INNER JOIN kategori on kategori.id_kategori=barang.id_kategori) INNER JOIN merk ON merk.id_merk=barang.id_merk) INNER JOIN user ON user.id=barang.id) where kategori.id_kategori='$id_cat'");
		if ($query->num_rows > 0) {

			$no=1;
			while ($data=$query->fetch_assoc()) {
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $data['kode_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['nama_kategori'] ?></td>
					<td><?= $data['nama_merk'] ?></td>
					<td><?= $data['nama'] ?></td>
					<td><?= $data['stok'] ?></td>
					<td>Rp. <?= number_format($data['harga_jual']) ?></td>
					<td><?= date("d-m-Y",strtotime($data['date_added'])) ?></td>
					<td>
						<a href="?action=edit_barang&id_barang=<?= $data['id_barang'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Edit</span><i class="fa fa-pencil"></i></a>
						<a href="handler.php?action=hapus_barang&id_barang=<?= $data['id_barang'] ?>" class="btn redtbl" onclick="return confirm('yakin ingin menghapus <?= $data['nama_barang']." (id : ".$data['id_barang'] ?>) ?')"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php
				$no++;
			}
		}else{
			echo "<td></td><td colspan='5'>Barang dengan kategori tersebut masih kosong</td>";
		}
	}

	function tambah_permintaan_barang($kat,$jml,$tgl,$ket,$permintaan_id){
		$data = [];
		for($i = 0; $i < count($kat); $i++ ){
			if($jml[$i] == "0" || $jml[$i] == ""){
				continue;
			}
			$data[] = array('kode_barang' => $kat[$i], 'jml' => $jml[$i]);
		}

		$query=$this->con->query("select * from permintaan where permintaan_tgl='$tgl'");
		if ($query->num_rows > 0) {
			$this->alert("Data Sudah Ada");
			$this->redirect("tambah_permintaan.php");
		}else
		{
			$query2=$this->con->query("insert into permintaan(permintaan_id, permintaan_tgl,permintaan_ket) values ('$permintaan_id', '$tgl', '$ket')");
			if($query2 === true){
				$jml_inserted = 0;
				for ($a = 0; $a < count($data); $a++) {
					$query3=$this->con->query("insert into detail_permintaan(permintaan_id,kode_barang,dp_jumlah) values ('".$permintaan_id."','".$data[$a]['kode_barang']."','".$data[$a]['jml']."')");
					if($query3 === true){
						$jml_inserted++;
					}
				}

				if ($jml_inserted != 0) {
					$this->alert("Permintaan Berhasil Ditambahkan");
					$this->redirect("tambah_permintaan.php");
				}
				else{
					$this->alert("Permintaan Gagal Ditambahkan");
					$this->redirect("tambah_permintaan.php");
				}
			}
		}
	}	

	function tampil_kategori(){
		$query=$this->con->query("select * from kategori order by id_kategori desc");
		$no=1;
		while ($data=$query->fetch_assoc()) {
			?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $data['nama_kategori'] ?></td>
				<td>
					<a href="?action=edit_kategori&id_kategori=<?= $data['id_kategori'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Edit</span><i class="fa fa-pencil"></i></a>
					<a href="handler.php?action=hapus_kategori&id_kategori=<?= $data['id_kategori'] ?>" class="btn redtbl" onclick="return confirm('yakin ingin menghapus kategori : <?= $data['nama_kategori'] ?> ?')"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php

			$no++;
		}
	}

	function tampil_merk(){
		$query=$this->con->query("select * from merk order by id_merk desc");
		$no=1;
		while ($data=$query->fetch_assoc()) {
			?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $data['nama_merk'] ?></td>
				<td>
					<a href="?action=edit_merk&id_merk=<?= $data['id_merk'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Edit</span><i class="fa fa-pencil"></i></a>
					<a href="handler.php?action=hapus_merk&id_merk=<?= $data['id_kategori'] ?>" class="btn redtbl" onclick="return confirm('yakin ingin menghapus merk : <?= $data['nama_merk'] ?> ?')"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php

			$no++;
		}
	}

	function tampil_merk2(){
		$query=$this->con->query("select * from merk order by id_merk desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option value="<?= $data['id_merk'] ?>"><?= $data['nama_merk'] ?></option>
			<?php
		}
	}

	function tampil_merk3($id_barang){
		$q=$this->con->query("select * from barang where id_barang='$id_barang'");
		$q2=$q->fetch_assoc();
		$id_merk=$q2['id_merk'];
		$query=$this->con->query("select * from merk order by id_merk desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option <?php if ($data['id_merk']==$id_merk) { echo "selected"; } ?> value="<?= $data['id_merk'] ?>"><?= $data['nama_merk'] ?></option>
			<?php
		}
	}

	function tampil_kategori2(){
		$query=$this->con->query("select * from kategori order by id_kategori desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
			<?php
		}
	}
	function tampil_kategori3($id_barang){
		$q=$this->con->query("select * from barang where id_barang='$id_barang'");
		$q2=$q->fetch_assoc();
		$id_cat=$q2['id_kategori'];
		$query=$this->con->query("select * from kategori order by id_kategori desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option <?php if ($data['id_kategori']==$id_cat) { echo "selected"; } ?> value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
			<?php
		}
	}
	function tampil_user(){
		$query=$this->con->query("SELECT user.id,user.username,user.nama,user.alamat,user.notlp,user.date_created,akses.level_akses from (user INNER JOIN akses on akses.status=user.status) where user.status!=1");
		$no=1;
		while ($data=$query->fetch_assoc()) {
			?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $data['username'] ?></td>
				<td><?= $data['nama'] ?></td>
				<td><?= $data['alamat'] ?></td>
				<td><?= $data['notlp'] ?></td>
				<td><?= $data['level_akses'] ?></td>
				<td><?= date("d-m-Y",strtotime($data['date_created'])) ?></td>
				<td>
					<a href="?action=edit_user&id=<?= $data['id'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Edit</span><i class="fa fa-pencil"></i></a>
					<a href="handler.php?action=hapus_user&id=<?= $data['id'] ?>" class="btn redtbl" onclick="return confirm('yakin ingin menghapus user : <?= $data['username'] ?> ?')"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php
			$no++;
		}
	}

	function tampil_akses(){
		$query=$this->con->query("select * from akses order by status desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option value="<?= $data['status'] ?>"><?= $data['level_akses'] ?></option>
			<?php
		}
	}

	function tampil_supplier(){
		$query=$this->con->query("select * from user where status='4'");
		$no=1;
		while ($data=$query->fetch_assoc()) {
			?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $data['nama'] ?></td>
				<td><?= $data['alamat'] ?></td>
				<td><?= $data['notlp'] ?></td>
				<td><?= date("d-m-Y",strtotime($data['date_created'])) ?></td>
				<td>
					<!-- <a href="?action=edit_supplier&id_sup=<?= $data['id_sup'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Edit</span><i class="fa fa-pencil"></i></a>
						<a href="handler.php?action=hapus_supplier&id_supp=<?= $data['id'] ?>" class="btn redtbl" onclick="return confirm('yakin ingin menghapus supplier : <?= $data['nama_sup'] ?> ?')"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a> -->
					</td>
				</tr>
				<?php
				$no++;
			}
	}
	function tampil_supplier2(){
		$query=$this->con->query("select * from user where status='4' order by id desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
			<?php
		}
	}

	function tampil_supplier3($id_barang){
		$q=$this->con->query("select * from barang where id_barang='$id_barang'");
		$q2=$q->fetch_assoc();
		$id=$q2['id'];
		$query=$this->con->query("select * from user where status='4' order by id desc");
		while ($data=$query->fetch_assoc()) {
			?>
			<option <?php if ($data['id']==$id) { echo "selected"; } ?> value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
			<?php
		}
	}
	function tampil_laporan(){
		$query=$this->con->query("select transaksi.id_transaksi,transaksi.tgl_transaksi,transaksi.no_invoice,transaksi.total_bayar,transaksi.nama_pembeli,user.username from transaksi inner join user on transaksi.kode_kasir=user.id order by transaksi.id_transaksi desc");
		$no=1;
		while ($f=$query->fetch_assoc()) {
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $f['no_invoice'] ?></td>
				<td><?= $f['username'] ?></td>
				<td><?= $f['nama_pembeli'] ?></td>
				<td><?= date("d-m-Y",strtotime($f['tgl_transaksi'])) ?></td>
				<td>Rp. <?= number_format($f['total_bayar']) ?></td>
				<td>
					<a href="?action=detail_transaksi&id_transaksi=<?= $f['id_transaksi'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Lihat</span><i class="fa fa-eye"></i></a>
					<a onclick="return confirm('yakin ingin menghapus <?= $f['no_invoice']." (id : ".$f['id_transaksi'] ?>) ?')" href="handler.php?action=delete_transaksi&id=<?= $f['id_transaksi'] ?>" class="btn redtbl"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php
		}
	}
	function filter_tampil_laporan($tanggal,$aksi){
		if ($aksi==1) {
			$split1=explode('-',$tanggal);
			$tanggal=$split1[2]."-".$split1[1]."-".$split1[0];
			$query=$this->con->query("select transaksi.id_transaksi,transaksi.tgl_transaksi,transaksi.no_invoice,transaksi.total_bayar,transaksi.nama_pembeli,user.username from transaksi inner join user on transaksi.kode_kasir=user.id where transaksi.tgl_transaksi like '%$tanggal%' order by transaksi.id_transaksi desc");
		}else{
			$split1=explode('-',$tanggal);
			$tanggal=$split1[1]."-".$split1[0];
			$query=$this->con->query("select transaksi.id_transaksi,transaksi.tgl_transaksi,transaksi.no_invoice,transaksi.total_bayar,transaksi.nama_pembeli,user.username from transaksi inner join user on transaksi.kode_kasir=user.id where transaksi.tgl_transaksi like '%$tanggal%' order by transaksi.id_transaksi desc");
		}

		$no=1;
		while ($f=$query->fetch_assoc()) {
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $f['no_invoice'] ?></td>
				<td><?= $f['username'] ?></td>
				<td><?= $f['nama_pembeli'] ?></td>
				<td><?= date("d-m-Y",strtotime($f['tgl_transaksi'])) ?></td>
				<td>Rp. <?= number_format($f['total_bayar']) ?></td>
				<td>
					<a href="?action=detail_transaksi&id_transaksi=<?= $f['id_transaksi'] ?>" class="btn bluetbl m-r-10"><span class="btn-edit-tooltip">Lihat</span><i class="fa fa-eye"></i></a>
					<a onclick="return confirm('yakin ingin menghapus <?= $f['no_invoice']." (id : ".$f['id_transaksi'] ?>) ?')" href="handler.php?action=delete_transaksi&id=<?= $f['id_transaksi'] ?>" class="btn redtbl"><span class="btn-hapus-tooltip">Hapus</span><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php
		}
	}
	function hitung_penjualan($tanggal,$aksi){
		if ($aksi==1) {
			$split1=explode('-',$tanggal);
			$tanggal=$split1[2]."-".$split1[1]."-".$split1[0];
			$query=$this->con->query("select transaksi.id_transaksi,transaksi.tgl_transaksi,transaksi.no_invoice,transaksi.total_bayar,transaksi.nama_pembeli,user.username from transaksi inner join user on transaksi.kode_kasir=user.id where transaksi.tgl_transaksi like '%$tanggal%' order by transaksi.id_transaksi desc");
			$getsump=$this->con->query("SELECT SUM(total_bayar) as total_penjualan FROM transaksi where tgl_transaksi like '%$tanggal%'");
			$getsump1=$getsump->fetch_assoc();
			
		}else{
			$split1=explode('-',$tanggal);
			$tanggal=$split1[1]."-".$split1[0];
			$query=$this->con->query("select transaksi.id_transaksi,transaksi.tgl_transaksi,transaksi.no_invoice,transaksi.total_bayar,transaksi.nama_pembeli,user.username from transaksi inner join user on transaksi.kode_kasir=user.id where transaksi.tgl_transaksi like '%$tanggal%' order by transaksi.id_transaksi desc");
			$getsump=$this->con->query("SELECT SUM(total_bayar) as total_penjualan FROM transaksi where tgl_transaksi like '%$tanggal%'");
			$getsump1=$getsump->fetch_assoc();
		}

			?>
			<tr>
				<td style="font-size: 23px;">Total Penjualan : </td>
				<td style="font-size: 23px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td style="font-size: 23px;"> 
					Rp. <?= number_format($getsump1['total_penjualan']) ?>
				</td>
			</tr>
			<?php
	}
	function show_jumlah_cat(){
		$query=$this->con->query("select * from kategori");
		echo $query->num_rows;
	}
	function show_jumlah_merk(){
		$query=$this->con->query("select * from merk");
		echo $query->num_rows;
	}
	function show_jumlah_barang(){
		$query=$this->con->query("select * from barang");
		echo $query->num_rows;
	}
	function show_jumlah_user(){
		$query=$this->con->query("select * from user");
		echo $query->num_rows;
	}
	function show_jumlah_supplier(){
		$query=$this->con->query("select * from user where status=4");
		echo $query->num_rows;
	}
	function show_jumlah_trans(){
		$query=$this->con->query("select * from transaksi where kode_kasir='$_SESSION[id]'");
		echo $query->num_rows;
	}
	function show_jumlah_trans2(){
		$query=$this->con->query("select * from transaksi");
		echo $query->num_rows;
	}

	function show_jumlah_permintaan(){
		$query=$this->con->query("select * from permintaan");
		echo $query->num_rows;
	}

	function hapus_kategori($id_kategori){
		$query=$this->con->query("delete from kategori where id_kategori='$id_kategori'");
		if ($query === TRUE) {
			$this->alert("Kategori id $id_kategori telah dihapus");
			$this->redirect("kategori.php");
		}
	}
	function hapus_merk($id_merk){
		$query=$this->con->query("delete from merk where id_merk='$id_merk'");
		if ($query === TRUE) {
			$this->alert("Merk id $id_merk telah dihapus");
			$this->redirect("merk.php");
		}
	}
	function hapus_barang($id_barang){
		$query=$this->con->query("delete from barang where id_barang='$id_barang'");
		if ($query === TRUE) {
			$this->alert("barang id $id_barang telah dihapus");
			$this->redirect("barang.php");
		}
	}
	function hapus_user($id_user){
		$query=$this->con->query("delete from user where id='$id_user'");
		if ($query === TRUE) {
			$this->alert("User id : $id_user berhasil dihapus");
			$this->redirect("users.php");
		}
	}
	function edit_kategori($id_kategori){
		$query=$this->con->query("select * from kategori where id_kategori='$id_kategori'");
		$data=$query->fetch_assoc();
		return $data;
	}
	function edit_merk($id_merk){
		$query=$this->con->query("select * from merk where id_merk='$id_merk'");
		$data=$query->fetch_assoc();
		return $data;
	}
	function edit_barang($id_barang){
		$query=$this->con->query("select * from barang where id_barang='$id_barang'");
		$data=$query->fetch_assoc();
		return $data;
	}

	function edit_supplier($id_sup){
		$query=$this->con->query("select * from supplier where id_sup='$id_sup'");
		$data=$query->fetch_assoc();
		return $data;
	}
	function edit_user($id){
		$query=$this->con->query("select * from user where id='$id'");
		$data=$query->fetch_assoc();
		return $data;
	}
	function edit_admin(){
		$query=$this->con->query("select * from user where id='1'");
		$data=$query->fetch_assoc();
		return $data;
	}
	function aksi_edit_kategori($id_kategori,$nama_kategori){
		$query=$this->con->query("update kategori set nama_kategori='$nama_kategori' where id_kategori='$id_kategori'");
		if ($query === TRUE) {
			$this->alert("Kategori berhasil di update");
			$this->redirect("kategori.php");
		}else{
			$this->alert("Kategori gagal di update");
			$this->redirect("kategori.php");

		}
	}

	function aksi_edit_permintaan($id,$status){
		$query=$this->con->query("update detail_permintaan set permintaan_status='$status' where dp_id='$id'");
		if ($query === TRUE) {
			$this->alert("Permintaan berhasil di update");
			// $this->redirect("detail_permintaan.php");
		}else{
			$this->alert("Permintaan gagal di update");
			// $this->redirect("detail_permintaan.php");

		}
	}

	function aksi_edit_merk($id_merk,$nama_merk){
		$query=$this->con->query("update merk set nama_merk='$nama_merk' where id_merk='$id_merk'");
		if ($query === TRUE) {
			$this->alert("Merk berhasil di update");
			$this->redirect("merk.php");
		}else{
			$this->alert("Merk gagal di update");
			$this->redirect("merk.php");

		}
	}
	function aksi_edit_barang($id_barang,$kode_barang,$nama_barang,$stok,$harga_jual,$id_kategori,$id_merk,$id){
		$query=$this->con->query("update barang set kode_barang='$kode_barang',nama_barang='$nama_barang',stok='$stok',harga_jual='$harga_jual',id_kategori='$id_kategori',id_merk='$id_merk',id='$id',date_added=date_added where id_barang='$id_barang'");
		if ($query === TRUE) {
			$this->alert("Barang berhasil di update");
			$this->redirect("barang.php");
		}
		else{
			$this->alert("Barang gagal di update");
			$this->redirect("barang.php");
		}
	}
	function aksi_edit_user($username,$password,$nama,$alamat,$notlp,$id){
		if (empty($password)) {
			$query=$this->con->query("update user set username='$username',nama='$nama',alamat='$alamat',notlp='$notlp',date_created=date_created where id='$id'");
		}else{
			$password=sha1($password);
			$query=$this->con->query("update user set username='$username',password='$password',nama='$nama',alamat='$alamat',notlp='notlp',date_created=date_created where id='$id'");
		}

		if ($query === TRUE) {
			$this->alert("User berhasil di update");
			$this->redirect("users.php");
		}else{
			$this->alert("User gagal di update");
			$this->redirect("user.php");
		}
	}

	function aksi_edit_admin($username,$password){
		if (empty($password)) {
			$query=$this->con->query("update user set username='$username',date_created=date_created where id='1'");
		}else{
			$password=sha1($password);
			$query=$this->con->query("update user set username='$username',password='$password',date_created=date_created where id='1'");
		}

		if ($query === TRUE) {
			$this->alert("admin berhasil di update, silahkan login kembali");
			session_start();
			session_destroy();
			$this->redirect("index.php");
		}else{
			$this->alert("admin gagal di update");
			$this->redirect("user.php");
		}
	}
	function tambah_tempo($id_barang,$jumlah,$trx){
		$q1=$this->con->query("select * from barang where id_barang='$id_barang'");
		$data=$q1->fetch_assoc();
		if ($data['stok'] < $jumlah) {
			$this->alert("stock tidak mencukupi");
			$this->redirect("transaksi.php?action=transaksi_baru");
		}
		else{
			$q=$this->con->query("select * from tempo where id_barang='$id_barang'");
			if ($q->num_rows > 0) {
				$ubah=$q->fetch_assoc();
				$jumbel=$ubah['jumlah_beli']+$jumlah;
				$total_harga=$jumbel*$data['harga_jual'];
				$dbquery=$this->con->query("update tempo set jumlah_beli='$jumbel',total_harga='$total_harga' where id_barang='$id_barang'");
				if ($dbquery === TRUE) {
					$this->con->query("update barang set stok=stok-$jumlah where id_barang='$id_barang'");
					$this->alert("Ditambahkan");
					$this->redirect("transaksi.php?action=transaksi_baru");

				}
			}else{
				$total_harga=$jumlah*$data['harga_jual'];
				$query1=$this->con->query("insert into tempo set id_barang='$id_barang',jumlah_beli='$jumlah',total_harga='$total_harga',trx='$trx'");
				if ($query1 === TRUE) {
					$this->con->query("update barang set stok=stok-$jumlah where id_barang='$id_barang'");
					$this->alert("Tersimpan");
					$this->redirect("transaksi.php?action=transaksi_baru");

				}
			}
		}
	}
	function hapus_tempo($id_tempo,$id_barang,$jumbel){
		$query=$this->con->query("delete from tempo where id_subtransaksi='$id_tempo'");
		if ($query===TRUE) {
			$query2=$this->con->query("update barang set stok=stok+$jumbel where id_barang='$id_barang'");
			$this->alert("Barang berhasil dicancel");
			$this->redirect("transaksi.php?action=transaksi_baru");

		}
	}
}

$root=new penjualan();
?>
