<?php
include "baglanti.php";

if(!isset($_SESSION['id'])){
	header("Location:giris.php");
	exit();
}
if(!isset($_GET['hikaye_id'])){
	header("Location:profil.php");
	exit();
}
$uyeokuyucu_id=$_SESSION['id'];
$hikaye_id = $_GET['hikaye_id'];
?>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body bgcolor="#FF66FF">
	<div class="hik_div">
	<div id="hikaye" style="padding: 105px">
		
			<a href="profil.php" style="margin-right: 7px; float: right; color:#CC0099">İptal</a>
		<?php
			$sorguHikaye = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_id = '".$hikaye_id."'");
			$hikaye_bilgi = mysqli_fetch_array($sorguHikaye);
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
							echo ucfirst($hikaye_icerik);
						?>	
					<b><i></br></br>
				</div>
		</div>
		<div class="ekle">
		<form name="kitapekle" action="kutuphaneekle.php" method="post">
			<tr>
				<td><?php
					$_SESSION['hikaye_id']=$hikaye_id;
					$_SESSION['id'] = $uyeokuyucu_id;
				?><input type="submit" value="Kütüphaneye Ekle"></td>
			</tr>
		</form>
		<p style="margin: auto; float:left; color: #800080">Yorumlar</p></br></br>

		<?php
			$sorgu_yorum = mysqli_query($link,"SELECT * FROM yorumlar WHERE yorum_hikaye_id='".$hikaye_id."'");
			$yorum_satir = mysqli_num_rows($sorgu_yorum);
			if($yorum_satir!=0){
				while ($yorum_bilgi = mysqli_fetch_array($sorgu_yorum)) {
					$yorum_sahip_id = $yorum_bilgi['yorum_sahip_id'];
					$sorgu_yorum_yapan = mysqli_query($link,"SELECT adi,soyadi FROM uyeler WHERE id='".$yorum_sahip_id."'");
					$yapan_bilgi = mysqli_fetch_array($sorgu_yorum_yapan);
               		echo "<option value='".$yorum_bilgi['yorum_id']."'>".ucwords($yapan_bilgi['adi'])." ".ucfirst($yapan_bilgi['soyadi'])." > ".ucfirst($yorum_bilgi['yorum'])."</option>";
               	}
            }
               		?>
               		<form name="yorumekle" action="yorum.php?hikaye_id=<?php echo $hikaye_bilgi['hikaye_id']?>" method="post">
						<tr>
							<td></br>
							<textarea name="yorum" style="width:300px; height:50px;" maxlenght="800"></textarea></br>
							</td>
						</tr>
               			<tr><?php
               					$_GET['hikaye_id']=$hikaye_id;
               					$_SESSION['id']=$uyeokuyucu_id;
               			?>
						<td><input type="submit" value="Yorum Yap"></br></br></td>
						</tr>
					</form>
		</div>
	
	</div>
	</div>
</body>
</html>