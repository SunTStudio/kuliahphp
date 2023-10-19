 <?php

	session_start();
	require 'template.php';

	$template = new Template();

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

	
	



?>

<?= $template->tem_atas('List Barang') ?>

	<table border="1">
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Stok</th>
			<th>Harga</th>
			<th>Deskripsi</th>
			<th>OPSI</th>
		</tr>

		<?php //for ($i = 0; $i < count($arr_produk); $i++ ) { ?>

		<?php foreach ($katalok as $index => $nilai) { ?>
		<tr>
			<td><?= ($index + 1) ?></td>
			<td><?= $nilai['kode'] ?></td>
			<td><?= $nilai['nama'] ?></td>
			<td><?= $nilai['stok'] ?></td>
			<td>Rp <?= $nilai['harga'] ?></td>
			<td><?= $nilai['deskripsi'] ?></td>
			<td>
				 <a href="<?= 'keranjang_proses.php?id_produk='.$nilai['kode'].'&nama_produk='.$nilai['nama'].'&harga_produk='.$nilai['harga'].'&aksi=tambahKeranjang' ?>">
				Tambahkan ke Keranjang</a>  <b>||</b>  <a href="<?= 'keranjang_proses.php?id_produk='.$nilai['kode'].'&aksi=hapusKatalok' ?>">Hapus</a> 
			</td>

		</tr>

		<?php } ?>

	</table>

<?= $template->tem_bawah() ?>