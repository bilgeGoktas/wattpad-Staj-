<?php
include "baglanti.php";

if(empty($_SESSION['uye_id'])){
	header("Location:index.php?Hata=GirisYap");
	exit();
}

$uye_id = $_SESSION['uye_id'];
//title da üye adını görüntülemek için
$sorguUyeAdSoyad = mysqli_query($link, "SELECT * FROM uyeler WHERE id= '".$uye_id."'");
$uye_bilgi = mysqli_fetch_assoc($sorguUyeAdSoyad);

$adi=$uye_bilgi["adi"];
$soyadi=$uye_bilgi["soyadi"];

$uye_id=$uye_bilgi['id'];
$_SESSION['id']=$uye_id;

?>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body bgcolor="#FF66FF">

	<div id="profil-bilgileri" style="padding:105px">
		<a href="cikis.php" style="margin-right: 7px; float: right; color:#CC0099">Çıkış</a>
		<a href="kesfetgor.php?kategori_id=1" style="color:#FFFFFF; padding:7px">Kesfet</a>
		<a href="hikayeolustur.php" style="color:#FFFFFF; padding:7px">Hikaye Oluştur</a>
		<a href="hikayegoruntule.php" style="color:#FFFFFF; padding:7px">Yazdıklarım</a>
		<a href="kutuphane.php" style="color:#FFFFFF; padding:7px">Kütüphane</a>
		<a href="anasayfa.php" style="color:#FFFFFF; padding:7px">Anasayfa</a></br></br>

		<div class="profilbaslik">
			<p><?php
				echo ucwords($adi)." ".ucwords($soyadi)." Profili";
			?></p>
		</div>

		<div class="resim">
			<?php
				$sorgu_resim = mysqli_query($link,"select profil_resim from uyeler where id = '".$uye_id."'");
				$resim_bilgi = mysqli_fetch_array($sorgu_resim);
				$resim = $resim_bilgi['profil_resim'];
				echo "<img border=1 width=100 height=150 src=\"$resim\"></a>";
			?>
		<form action="yukle.php" name="resim" method="post" enctype="multipart/form-data">
			<input type="file" name="profilresim"/><br/> 
			<input type="submit" value="Profil Resmi Yükle" />
		</form>
		<form>
			<legend style="margin-left: 20px; padding:10px; color:#660099">Profil Bilgileri</legend>
			<div class="bilgi">
				<label style="color:#660099">Adı Soyadı: </label>
				<label>
					<?php 
						$adi= $uye_bilgi['adi'];
						$soyadi= $uye_bilgi['soyadi'];
						echo ucwords($adi)." ".ucfirst($soyadi)."</br>"; 
					?>
				</label>
				<label style="color:#660099">Doğum Tarihi : </label>
				<label>
					<?php 
						$dogum_tarihi= $uye_bilgi['dogum_tarihi'];
						echo $dogum_tarihi."</br>"; 
					?>
				</label>
				<label style="color:#660099">Doğum Yeri : </label>
				<label>
					<?php 
						$dogum_yeri= $uye_bilgi['dogum_yeri'];
						echo ucfirst($dogum_yeri)."</br>"; 
					?>
				</label>
				<label style="color:#660099">Yaşadığı Şehir : </label>
				<label>
					<?php 
						$yasadigi_sehir= $uye_bilgi['yasadigi_sehir'];
						echo ucwords($yasadigi_sehir)."</br>"; 
					?>
				</label>
				<label style="color:#660099">e-mail : </label>
				<label>
					<?php 
						$email= $uye_bilgi['email'];
						echo $email."</br>"; 
					?>
				</label></br></br>
			</div>
		</form>
		<form name="profilgüncelleme" action="profilguncelle.php" method="post">
			<td>
				<input type="submit" value="Profil Bilgilerini Güncelle"/>
				<?php
					$_SESSION['id']= $uye_id;
					//$_SESSION['sifre']=$sifre;
				?>
			</td>
		</form>
      	<form>
      		<div>
				<label>
					<?php 
						$sorguHikayeVarMi = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_sahip_id = '".$uye_id."'");//buraya beğendiği hikayeler ayrıyetten eklenmeli
						while($hikaye_bilgi = mysqli_fetch_array($sorguHikayeVarMi)){
						?>
						<a href="hikaye.php?hikaye_id=<?php echo $hikaye_bilgi['hikaye_id']?>" style='color=#CC0099; padding:7px'>
							<?php
                			echo "<option value='".$hikaye_bilgi['hikaye_id']."'>Hikaye Adı :".ucfirst($hikaye_bilgi['hikaye_adi'])." - Hikaye Türü : ".ucwords($hikaye_bilgi['hikaye_tur'])."</option>";
                			?>
            			</a>
            			<?php
            		}
					?>
				</label>
			</div>
		</form>
	</div>
	</div>
</body>
</html>