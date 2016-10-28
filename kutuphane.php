<?php
include "baglanti.php";

if(!isset($_SESSION['id'])){
	header("Location: profil.php");
	exit();
}
$uyeokuyucu_id=$_SESSION['id'];

?>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body bgcolor="#FF66FF">
	<div class="kut_div">
			<a href="profil.php" style="margin-right: 70px; float: right; padding: 70px; color:#CC0099">İptal</a>
		<ul class="bas" style="padding:30px">
		<p>Kütüphanene Hoş Geldin.</p>
		</ul>
		<div class="govde">
			<?php
			$sorgu_kutuphane_kitaplar = mysqli_query($link,"SELECT hikaye_id FROM kutuphane WHERE uye_id = '".$uyeokuyucu_id."'");
			while($kutuphane_bilgi = mysqli_fetch_array($sorgu_kutuphane_kitaplar)){
			?>
		
			<ul class="oneri">
		  					<a href="hikaye.php?hikaye_id=<?php echo $kutuphane_bilgi['hikaye_id']?>"></br>
		  					<?php
				$sorgu_hikaye = mysqli_query($link,"SELECT hikaye_adi, hikaye_tur, hikaye_sahip_id FROM hikayeler WHERE hikaye_id ='".$hikayeler_id=$kutuphane_bilgi['hikaye_id']."'");
				
				$hikaye_bilgi = mysqli_fetch_array($sorgu_hikaye);
				
				$hikaye_adi = $hikaye_bilgi['hikaye_adi'];
				$hikaye_tur = $hikaye_bilgi['hikaye_tur'];
				$hikaye_sahip_id = $hikaye_bilgi['hikaye_sahip_id'];
				
				$sorgu_kimin_hikaye = mysqli_query($link,"SELECT adi,soyadi FROM uyeler WHERE id='".$hikaye_sahip_id."'");
				
				$sorgu_kimin_bilgi = mysqli_fetch_array($sorgu_kimin_hikaye);
				
				$yazar_adi = $sorgu_kimin_bilgi['adi'];
				$yazar_soyadi = $sorgu_kimin_bilgi['soyadi'];
				echo "Kitap Adı : ".ucwords($hikaye_adi)." - Türü : ".ucwords($hikaye_tur)." - Yazar : ".ucwords($yazar_adi).ucfirst($yazar_soyadi);
							?></a></br>
		  						<?php
								}
								?>
			</ul>
		</div><!--govde bitiş-->
	</div>
</body>
</html>