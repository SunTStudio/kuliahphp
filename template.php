 <?php
	require 'global_setting.php';

	class Template extends Global_setting
	{
		public function tem_atas($judul='form')
		{
			$setting = new Global_setting();

			return '
			<!DOCTYPE html>
			<html>
			<head>
				<title>'.$judul.'</title>
			</head>
			<body>
				'.$setting->get_menu().'
				<h1>'.$judul.'</h1>
				<hr/>
			';
		}

		public function tem_bawah()
		{
			return '
				<p>Copyright Web Programming II</p>
			</body>
			</html>
			';
		}
	}
?>