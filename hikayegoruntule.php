<?php
include "baglanti.php";

if(!isset($_SESSION['id'])){
	header("Location:profil.php");
	exit();
}
	$uye_id=$_SESSION["id"];

    $sorgu = mysqli_query($link,"select * from hikayeler where hikaye_sahip_id= '".$uye_id."'");
?>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body bgcolor="#FF66FF">
	<div id="hikaye" style="padding: 105px">
		
			<a href="profil.php" style="margin-right: 7px; float: right; color:#CC0099">Profilim</a>

    	<div class="baslik" style="padding:30px; float:left">
			<p>YAZDIKLARIM</p></br>
			<?php
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