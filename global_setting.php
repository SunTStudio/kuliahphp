 <?php
	class Global_setting
	{
		private $arr_menu = [
			[
				'nama' => 'List Barang',
				'link' => 'index.php'
			],
			[
				'nama' => 'Form Inputan Barang',
				'link' => 'form_barang.php'
			],
			[
				'nama' => 'Keranjang Belanja',
				'link' => 'keranjang.php'
			],
		];

		protected function get_menu()
		{
			$html_kode = '';

			foreach ($this->arr_menu as $key => $value) {
				$html_kode .= '<a href="'.$value['link'].'">'.$value['nama'].'</a>  ';
			}

			return $html_kode;
		}
	}
?>