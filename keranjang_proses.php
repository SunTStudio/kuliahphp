<?php


class Keranjang_proses
{
	function __construct(){
		session_start();

		if (isset($_COOKIE['keranjang'])) {
			$_SESSION['keranjang'] = json_decode($_COOKIE['keranjang'],true);
		}
	}

	public function tambah_katalok()
	{
		$koneksi_database = mysqli_connect("localhost","root","");

		if(!$koneksi_database){
			die('Tidak bisa konek dengan Server : ' .mysqli_error());
		}

		mysqli_select_db($koneksi_database,"datatoko");

		$query_ambil_db = mysqli_query($koneksi_database,"SELECT * FROM katalok");
		// Mengambil semua hasil query ke dalam array
		$katalok = array();
		while ($row = mysqli_fetch_assoc($query_ambil_db)) {
		    $katalok[] = $row;
		}	

			if ($_GET != null) {

				$barang_baru = [
					'kode' => $_GET['id_produk'],
					'nama' => $_GET['nama_produk'],
					'stok' => $_GET['stok_produk'],
					'harga' => $_GET['harga_jual'],
					'deskripsi' => $_GET['deskripsi'],
				];

			$sama = true;
			foreach ($katalok as $index => $nilai) {
				if ($nilai['kode'] == $barang_baru['kode']) {
					$sama = false;
				}
			}

			if ($sama == true && $barang_baru['kode'] !== null) {
				mysqli_query($koneksi_database,"INSERT INTO katalok (kode,nama,stok,harga,deskripsi) VALUES ('".$barang_baru['kode']."','".$barang_baru['nama']."','".$barang_baru['stok']."','".$barang_baru['harga']."','".$barang_baru['deskripsi']."')");

				}
			}
			header('Location: http://localhost/kuliah/praktek2/index.php ');
			exit();
			
	}



	public function tambah_keranjang(){
		if (!isset($_SESSION['keranjang'])) {
			$_SESSION['keranjang'] = array();
		}else{
			$index_produk = array_search($_GET['id_produk'], array_column($_SESSION['keranjang'], 'id_produk'));
		}

		if (count($_SESSION['keranjang']) == 0 || $index_produk === false) {
			$keranjang_baru = [
				'id_produk' => $_GET['id_produk'],
				'nama_produk' => $_GET['nama_produk'],
				'harga_produk' => $_GET['harga_produk'],
				'jumlah' => 1,
			];

			$_SESSION['keranjang'][]= $keranjang_baru;
		}else{
			$_SESSION['keranjang'][$index_produk]['jumlah']++;
		}

		setcookie("keranjang", json_encode($_SESSION['keranjang']), strtotime('+7 days'),'/');

		header('Location: http://localhost/kuliah/praktek2/keranjang.php ');
		exit();

	}

	public function hapus_keranjang($id_produk)
	{
		$index_produk = array_search($_GET['id_produk'], array_column($_SESSION['keranjang'], 'id_produk'));

		if ($index_produk !== false) {
			array_splice($_SESSION['keranjang'], $index_produk,1);
		}
		setcookie("keranjang", json_encode($_SESSION['keranjang']), strtotime('+7 days'),'/');

		header('Location: http://localhost/kuliah/praktek2/keranjang.php ');
		exit();
	}

	public function hapus_katalok($id_produk)
	{
		$koneksi_database = mysqli_connect("localhost","root","");
		mysqli_select_db($koneksi_database,"datatoko");
		$isi_katalok = mysqli_query($koneksi_database,"SELECT * FROM katalok");
		$katalok = array();
		while ($isi = mysqli_fetch_assoc($isi_katalok)) {
			    $katalok[] = $isi;
			}
		$index_produk = array_search($_GET['id_produk'], array_column($katalok, 'kode'));

			// array_splice($_SESSION['keranjang'], $index_produk,1);
			mysqli_query($koneksi_database,"DELETE FROM `katalok` WHERE `katalok`.`kode` = '".$katalok[$index_produk]['kode']."' ");


		header('Location: http://localhost/kuliah/praktek2/index.php ');
		exit();
	}
}


?>

<?php 

$proses_k = new Keranjang_proses();

if ($_GET['aksi'] == 'hapus') {
	$proses_k->hapus_keranjang($_GET['id_produk']);
}else if($_GET['aksi'] == 'hapusKatalok'){
	$proses_k->hapus_katalok($_GET['id_produk']);
}
else if($_GET['aksi'] == 'tambahKeranjang'){
	$proses_k->tambah_keranjang();
}else{
	$proses_k->tambah_katalok();
}

 ?>




