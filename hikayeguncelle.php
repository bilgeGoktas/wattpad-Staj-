<?php
include "baglanti.php";
ini_set('display_errors', true);
$uye_id = $_SESSION['id'];
$hikaye_id = $_GET['hikaye_id'];
?>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body bgcolor="#FF66FF">
	<div class="hik_div">
	<div id="hikaye" style="padding: 105px">
		
			<a href="anasayfa.php" style="margin-right: 7px; float: right; color:#CC0099">İptal</a>
		<?php
		$sorguHikaye = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_id = '".$hikaye_id."'");
		$hikaye_bilgi = mysqli_fetch_array($sorguHikaye);
		$hikaye_sahip_id=$hikaye_bilgi['hikaye_sahip_id'];
		if($hikaye_sahip_id=$uye_id){
			?>
		<div class="hikayebaslik">
			<p><?php
		  		$hikaye_adi = $hikaye_bilgi['hikaye_adi'];
		  		echo ucwords($hikaye_adi);
		  	?></p>
		</div class="resim">
			<?php
				$resim = $hikaye_bilgi['hikaye_kapak'];
				echo "<img border=1 width=100 height=150 src=\"$resim\"></a></br>";
			
				$hikaye_sahip_id=$hikaye_bilgi['hikaye_sahip_id'];
				if($hikaye_sahip_id == $uyeokuyucu_id){
			?>
			<form action="guncelle.php?hikaye_id=<?php echo $hikaye_id?>" name="resim" method="post"> 
				<input type="submit" value="Yeni Kapak Resmi Güncelle" />
			</form>
					<?php
						}
					?>
				<div class="hik_genel">
		  			<b><i style="color: #CC0000">Yazar :  </i></b><?php
		  			$sorgu = mysqli_query($link,"SELECT adi, soyadi FROM uyeler WHERE id='".$hikaye_sahip_id."'");
		  			$sorgu_bilgi = mysqli_fetch_array($sorgu);
		  			$yazar = $sorgu_bilgi['adi'];
		  			$yazar_soyadi = $sorgu_bilgi['soyadi'];
		  			echo ucwords($yazar)." ".ucwords($yazar_soyadi);
		  		?></br>
		  			<b><i style="color: #CC0000">Tür :  </i></b><?php
		  			$tur = $hikaye_bilgi['hikaye_tur'];
		  			echo ucwords($tur);
		  		?></br></br></br>
				</div>
				<div class="icerik">
						<?php
							$hikaye_icerik = $hikaye_bilgi['hikaye_icerik'];
							echo ucfirst($hikaye_icerik);}
						?>	
					<b><i></br></br>
				</div>
		</div><!--resim div bitiş-->
		</div><!--hikayebas div bitiş-->
	</div><!--hikaye div bitiş-->
</div><!--hik div bitiş-->
</body>
</html>