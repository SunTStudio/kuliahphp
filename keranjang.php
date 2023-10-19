<?php 
session_start();
require 'template.php';
$template = new Template();

if (isset($_COOKIE['keranjang'])) {
	$_SESSION['keranjang'] = json_decode($_COOKIE['keranjang'], true);
	// var_dump(json_decode($_COOKIE['keranjang']));
}

 ?>

 <?= $template->tem_atas('KERANJANG BELANJA') ?>

 <table border="1">
 	<tr>
 		<th>Nama Produk</th>
 		<th>Jumlah Beli</th>
 		<th>Harga</th>
 		<th>Opsi</th>
 	</tr>
 	<?php foreach ($_SESSION['keranjang'] as $index => $row) { ?>
 	<tr>
 		<td><?= $row['nama_produk'] ?></td>
 		<td><?= $row['jumlah'] ?></td>
 		<td><?= ($row['harga_produk']*$row['jumlah']) ?></td>
 		<td><a href="<?= 'keranjang_proses.php?id_produk='.$row['id_produk'].'&aksi=hapus' ?>">hapus</a></td>
 	</tr>	
 	<?php } ?>

 </table>

 <?= $template->tem_bawah() ?>