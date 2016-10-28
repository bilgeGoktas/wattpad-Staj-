<?php
include "baglanti.php";

if(!isset($_SESSION['id'])){
	header("Location:giris.php?Hata=GirisYap");
}

if(!isset($_GET['kategori_id'])){
	header("Location : kesfetgor.php");
	exit();
}

$kategori_id = $_GET['kategori_id'];

?>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body bgcolor="#FF66FF">
	<div class="kes_div">
		<a href="anasayfa.php" style="margin-right: 70px; float: right; padding: 70px; color: #CC0099">İptal</a></br>
		<div class="sol_menu" style="padding:30px; float:left">
			<ul class="menu">
				<p>Kategoriler</p></br></br>
				<a href="kesfetgor.php?kategori_id=1">Aksiyon</a></br>
				<a href="kesfetgor.php?kategori_id=2">Aşk</a></br>
				<a href="kesfetgor.php?kategori_id=3">Bilim Kurgu</a></br>
				<a href="kesfetgor.php?kategori_id=4">Fantastik</a></br>
				<a href="kesfetgor.php?kategori_id=5">Kısa Hikaye</a></br>
				<a href="kesfetgor.php?kategori_id=6">Kurgu</a></br>
				<a href="kesfetgor.php?kategori_id=7">Kurt Adam</a></br>
				<a href="kesfetgor.php?kategori_id=8">Korku</a></br>
				<a href="kesfetgor.php?kategori_id=9">Macera</a></br>
				<a href="kesfetgor.php?kategori_id=10">Tarih</a></br>
				<a href="kesfetgor.php?kategori_id=11">Vampir</a>
			</ul>
		</div>
		<div class="baslik" style="padding:7px; float:left">
			<p>Kitaplar ve Yazarları</p></br>
		<?php
			$sorgu_kat = mysqli_query($link,"SELECT kategori_adi FROM kategori WHERE kategori_id='".$kategori_id."'");
			$kat_bilg = mysqli_fetch_array($sorgu_kat);
			$kategori_adi = $kat_bilg['kategori_adi'];
			$sorgu = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_tur='".$kategori_adi."'");
			while($hikaye_bilgi = mysqli_fetch_array($sorgu)){
		?>
		  	<ul class="oneri">
		  				<a href="hikaye.php?hikaye_id=<?php echo $hikaye_bilgi['hikaye_id']?>">
		  					<?php
		  						$hikaye_adi = $hikaye_bilgi['hikaye_adi'];
		  						$hikaye_sahip_id=$hikaye_bilgi['hikaye_sahip_id'];
		  							$yazar_sorgu = mysqli_query($link,"SELECT adi, soyadi FROM uyeler WHERE id='".$hikaye_sahip_id."'");
		  							$yazar_sorgu_bilgi = mysqli_fetch_array($yazar_sorgu);
		  							$yazar_adi = $yazar_sorgu_bilgi['adi'];
		  							$yazar_soyadi = $yazar_sorgu_bilgi['soyadi'];
		  						echo "Kitap Adı : ".ucwords($hikaye_adi)." - Yazar : ".ucwords($yazar_adi)."  ".ucfirst($yazar_soyadi);
		  					?></a></br>
		  	<?php
           	}
			?>
			</ul>
		</div>
	</div>
</body>
</html>