 <?php
	$default_deskripsi = isset($_GET['deskripsi'])?$_GET['deskripsi']:'';
	
	// if (isset($_GET['deskripsi'])) {
	// 	$default_deskripsi = $_GET['deskripsi'];
	// } else {
	// 	$default_deskripsi = '';
	// }

	require 'template.php';

	$template = new Template();
?>

<?= $template->tem_atas('Form Input Barang') ?>

	<form action="keranjang_proses.php" method="GET">
		<table>
			<tr>
				<td>Kode Produk</td>
				<td>:</td>
				<td>
					<input type="text" name="id_produk" value="">
				</td>
			</tr>
			<tr>
				<td>Nama Produk</td>
				<td>:</td>
				<td>
					<input type="text" name="nama_produk" value="Produk A">
				</td>

			</tr>
			<tr>
				<td>Deskripsi Produk</td>
				<td>:</td>
				<td>
					<textarea name="deskripsi"><?= $default_deskripsi ?></textarea>
				</td>
				
			</tr>
			<tr>
				<td>Stok Produk</td>
				<td>:</td>
				<td>
					<input type="number" name="stok_produk" min="0">
				</td>
				
			</tr>
			<tr>
				<td>Harga Produk</td>
				<td>:</td>
				<td>
					<input type="number" name="harga_jual" min="0">
				</td>
				
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="submit" value="Simpan Data">
				</td>
			</tr>
		</table>
	</form>

	<?= $template->tem_bawah() ?>