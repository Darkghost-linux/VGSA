<!DOCTYPE html>
<html>
	<head>
		<title>Money Changer Amanah</title>
		<!-- Hubungkan halaman web dengan file library CSS yang sudah tersedia -->
		<!-- sesuai INSTRUKSI KERJA 4. -->
		<link rel="stylesheet" href="../css/bootstrap.css">
		

	</head>
	
	<body>
	<div class="container border">
		<!-- Menampilkan judul halaman -->
		<h1>
		Money Changer Amanah
		<!-- Tampilkan logo sesuai INSTRUKSI KERJA 5. -->
		<img src="../Images/money-logo.png" style="width:60px;height:60px;">
		</h1>
		



		
		<!-- Form untuk memasukkan data pemesanan. -->
		<form action="index[1].php" method="post" id="formMoneyChanger">
			<div class="row">
				<!-- Masukan nama pemesan. Tipe data text. -->
				<div class="col-lg-2"><label for="nama">Nama Pemesan:</label></div>
				<div class="col-lg-2"><input type="text" id="nama" name="nama"></div>
			</div>
			<div class="row">
				<!-- Masukan NIK pemesan. Tipe data text. -->
			 	<!-- Modifikasi input supaya NIK yang dimasukkan harus tepat 16 karakter sesuai INSTRUKSI KERJA 6. -->

				<div class="col-lg-2"><label for="nik">NIK:</label></div>
				<div class="col-lg-2"><input type="text" id="nik" name="nik" min="16" max="16"></div> 
				<!--Type berubah menjadi text karena NIK bukan Number -->

			</div>
			<div class="row">
				<!-- Masukan pilihan valuta asing. -->
				<div class="col-lg-2"><label for="valas">Valuta asing:</label></div>
				<div class="col-lg-2">
					<select id="valas" name="valas">
					<option value="">- Pilih valas -</option>
					<?php 
							//  Buat sebuah array satu dimensi yang berisi beberapa valuta asing (valas) Intuksi Soal Nomor 1 
							$valas = array("US Dollar","Singapore Dollar","Pound Sterling","Japan Yen","South Korea Won","Chinese Yuan");

							//untuk mengurutkan array index ascending z-a Intuksi Soal Nomor 2 
							rsort($valas);


							// Tampilkan dropdown valas berdasarkan data pada array valas menggunakan perulangan
							// sesuai INSTRUKSI KERJA 3.
							foreach ($valas as $tampil_valas) {
							echo "<option value='".$tampil_valas."'>".$tampil_valas."</option>";
							}
					?>
					</select>
				</div>
			</div>
			<div class="row">
				<!-- Masukan jumlah valas. Tipe data number. -->
				<div class="col-lg-2"><label for="jumlah">Jumlah valas:</label></div>
				<div class="col-lg-2"><input type="number" id="jumlah" name="jumlah" maxlength="4"></div>
			</div>
			<div class="row">
				<!-- Tombol Submit -->
				<div class="col-lg-2"><button class="btn btn-primary" type="submit" form="formMoneyChanger" value="Hitung" name="Hitung">Hitung</button></div>
				<div class="col-lg-2"></div>		
			</div>
		</form>
	</div>
	
	<?php
		//	Kode berikut dieksekusi setelah tombol Hitung ditekan.
		if(isset($_POST['Hitung'])) {
			
			//array $dataKonversiValas
			$dataKonversiValas = array(
				'nama' => $_POST['nama'],
				'nik' => $_POST['nik'],
				'valas' => $_POST['valas'],
				'jumlah' => $_POST['jumlah']
			);

		$valas = $dataKonversiValas['valas'];

		//  Buat fungsi bernama total_rupiah untuk menghitung nilai rupiah hasil penukaran valas 
		//	sesuai INSTRUKSI KERJA 7.

		//@desc total_rupiah digunakan untuk menghitung nilai rupiah hasil penukaran valas 
		//@parm $valass berasal dari variable valas harga dengan nilai interger
		//@parm $jumlahh berasal dari varoable jumlah dengan nilai interger
      	function total_rupiah($valass, $jumlahh){
			$nilai = $valass * $jumlahh;
			return $nilai;
      	}

      	//Simpan jumlah valas yang sudah diinputkan pada form ke dalam variabel $jumlah sesuai INSTRUKSI KERJA 8
		 $jumlah = $dataKonversiValas['jumlah'];

		// Kontrol percabangan dalam kode untuk menyimpan nilai valas soal nomor 9
		if ($valas == "US Dollar") {
			$harga = 15000;
		} elseif ($valas == "Singapore Dollar") {
			$harga = 11000;
		} elseif ($valas == "Pound sterling") {
			$harga = 18500;
		} elseif ($valas == "Japan Yen") {
			$harga = 110;
		} elseif ($valas == "South Korea Won") {
			$harga = 11;
		} elseif ($valas == "Chinese Yuan") {
			$harga = 2200;
		}

		 //	Gunakan fungsi yang sudah dibuat dalam Instruksi Kerja 7 untuk menghitung nilai $totalRupiah sesuai INSTRUKSI KERJA 10.
		$totalRupiah = total_rupiah($harga, $jumlah);
			
		//	Simpan data pemesanan valas dari array $dataKonversiValas ke dalam file JSON/TXT/Excel/database sesuai INSTRUKSI KERJA 11.

		// Proses pemyimpanan ke dalam file JSON
		$file = 'data.json';

		// //mengkonversi array $input_json ke dalam format json
		$dataJson = json_encode($dataKonversiValas, JSON_PRETTY_PRINT);

		// // memasukan aeeay yg telah diubah menjadi format json
		file_put_contents($file, $dataJson);

		// // membuka dan membaca file json
		$dataJson = file_get_contents($file);

		// $input_json = json_decode($format_json, true);
		$dataKonversiValas = Json_decode($dataJson, true);



		//	Variabel $nilaiValas menyimpan nilai valas berdasarkan jenis valas yang dipilih.
		//	Gunakan pencabangan untuk menentukan nilai variabel $nilaiValas berdasarkan INSTRUKSI KERJA 9.


		//	Variabel $totalRupiah menyimpan nilai konversi valas ke dalam Rupiah.
		

		//	Tampilkan data pemesanan dan hasil perhitungan konversi valas.
			echo "
				<br/>
				<div class='container'>
					<div class='row'>
						<!-- Menampilkan nama pemesan. -->
						<div class='col-lg-2'>Nama pemesan:</div>
						<div class='col-lg-2'>".$dataKonversiValas['nama']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan NIK pemesan. -->
						<div class='col-lg-2'>NIK:</div>
						<div class='col-lg-2'>".$dataKonversiValas['nik']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan valas yang dikonversi. -->
						<div class='col-lg-2'>Valas:</div>
						<div class='col-lg-2'>".$dataKonversiValas['valas']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan jumlah valas. -->
						<div class='col-lg-2'>Jumlah valas:</div>
						<div class='col-lg-2'>".$dataKonversiValas['jumlah']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan hasil konversi. -->
						<div class='col-lg-2'>Total Rupiah:</div>
						<div class='col-lg-2'>Rp".number_format($totalRupiah, 0, ".", ".").",-</div>
					</div>
			</div>
			";
		}
	?>
	</body>
</html>