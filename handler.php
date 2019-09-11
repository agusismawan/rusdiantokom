<?php
include "root.php";

if (isset($_GET['action'])) {
	$action=$_GET['action'];
	if ($action=="login") {
		$root->login($_POST['username'],$_POST['pass']);
	}
	if ($action=="logout") {
		session_start();
		session_destroy();
		$root->redirect("home.php");
	}
	if ($action=="terima_permintaan") {
		$status='diterima';
		$root->redirect("index.php");
		// $root->aksi_edit_permintaan($_GET['id'],$status);
	}

	if ($action=="tolak_permintaan") {
		$status='ditolak';
		$root->aksi_edit_permintaan($_GET['id'],$status);
	}

	if ($action=="tambah_barang") {
		$root->tambah_barang($_POST['kode_barang'],$_POST['nama_barang'],$_POST['stok'],$_POST['harga_jual'],$_POST['kategori'],$_POST['merk'],$_POST['user']);
	}
	if ($action=="tambah_kategori") {
		$root->tambah_kategori($_POST['nama_kategori']);
	}
	if ($action=="hapus_kategori") {
		$root->hapus_kategori($_GET['id_kategori']);
	}
	if ($action=="edit_kategori") {
		$root->aksi_edit_kategori($_POST['id_kategori'],$_POST['nama_kategori']);
	}
	if ($action=="tambah_merk") {
		$root->tambah_merk($_POST['nama_merk']);
	}
	if ($action=="hapus_merk") {
		$root->hapus_merk($_GET['id_merk']);
	}
	if ($action=="edit_merk") {
		$root->aksi_edit_merk($_POST['id_merk'],$_POST['nama_merk']);
	}
	if ($action=="hapus_barang") {
		$root->hapus_barang($_GET['id_barang']);
	}
	if ($action=="tambah_permintaan_barang") {
		$root->tambah_permintaan_barang($_POST['kode_barang'],$_POST['jumlah_permintaan'], $_POST['tgl_permintaan'], $_POST['ket_permintaan'],$_POST['kode_permintaan']);
	}
	if ($action=="edit_barang") {
		$root->aksi_edit_barang($_POST['id_barang'],$_POST['kode_barang'],$_POST['nama_barang'],$_POST['stok'],$_POST['harga_jual'],$_POST['kategori'],$_POST['merk'],$_POST['user']);
	}
	if ($action=="tambah_supplier") {
		$root->tambah_supplier($_POST['nama_sup'],$_POST['alamat'],$_POST['notlp']);
	}
	if ($action=="edit_supplier") {
		$root->aksi_edit_supplier($_POST['nama_sup'],$_POST['alamat'],$_POST['notlp'],$_POST['id_sup']);
	}	
	if ($action=="tambah_user") {
		$root->tambah_user($_POST['username'],$_POST['password'],$_POST['nama'],$_POST['alamat'],$_POST['notlp'],$_POST['status']);
	}
	if ($action=="hapus_user") {
		$root->hapus_user($_GET['id']);
	}
	if ($action=="edit_user") {
		$root->aksi_edit_user($_POST['username'],$_POST['password'],$_POST['nama'],$_POST['alamat'],$_POST['notlp'],$_POST['id']);
	}
	if ($action=="edit_admin") {
		$root->aksi_edit_admin($_POST['username'],$_POST['password']);
	}
	if ($action=="reset_admin") {
		$pass=sha1("admin");
		$q=$root->con->query("update user set username='admin',password='$pass',date_created=date_created where id='1'");
		if ($q === TRUE) {
			$root->alert("admin berhasil direset, username & password = 'admin'");
			session_start();
			session_destroy();
			$root->redirect("index.php");
		}
	}
	if ($action=="tambah_tempo") {
		$root->tambah_tempo($_POST['id_barang'],$_POST['jumlah'],$_POST['trx']);
	}
	if ($action=="hapus_tempo") {
		$root->hapus_tempo($_GET['id_tempo'],$_GET['id_barang'],$_GET['jumbel']);
	}
	if ($action=="selesai_transaksi") {
		session_start();
		$trx=date("d")."/RK/".$_SESSION['id']."/".date("y/h/i/s");

			$query=$root->con->query("insert into transaksi set kode_kasir='$_SESSION[id]',total_bayar='$_POST[total_bayar]',no_invoice='$trx',nama_pembeli='$_POST[nama_pembeli]'");

		$trx2=date("d")."/RK/".$_SESSION['id']."/".date("y");
		$get1=$root->con->query("select *  from transaksi where no_invoice='$trx'");
		$datatrx=$get1->fetch_assoc();
		$id_transaksi2=$datatrx['id_transaksi'];

		$query2=$root->con->query("select * from tempo where trx='$trx2'");
		while ($f=$query2->fetch_assoc()) {
			$root->con->query("insert into sub_transaksi set id_barang='$f[id_barang]',id_transaksi='$id_transaksi2',jumlah_beli='$f[jumlah_beli]',total_harga='$f[total_harga]',no_invoice='$trx'");
		}
		$root->con->query("delete from tempo where trx='$trx2'");
		$root->alert("Transaksi berhasil");
		$root->redirect("transaksi.php");


	}
	if ($action=="delete_transaksi") {
		$q1=$root->con->query("delete from transaksi where id_transaksi='$_GET[id]'");
		$q2=$root->con->query("delete from sub_transaksi where id_transaksi='$_GET[id]'");
		if ($q1===TRUE && $q2 === TRUE) {
			$root->alert("Transaksi No $_GET[id] Berhasil Dihapus");
			$root->redirect("laporan.php");
		}
	}
	if ($action=="delete_permintaan_barang") {
		$q3=$root->con->query("delete from permintaan where permintaan_id='$_GET[id]'");
		$q4=$root->con->query("delete from detail_permintaan where permintaan_id='$_GET[id]'");
		if ($q3===TRUE && $q4 === TRUE) {
			$root->alert("Kode Permintaan $_GET[id] Berhasil Dihapus");
			$root->redirect("list_permintaan.php");
		}
	}


}else{
	echo "no direct script are allowed";
}
?>
