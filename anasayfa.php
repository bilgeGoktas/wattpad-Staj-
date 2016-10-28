<?php
include "baglanti.php";

$email=$_SESSION['email'];
$sifre=$_SESSION['sifre'];

$sorguUyeAdSoyad = mysqli_query($link, "SELECT * FROM uyeler WHERE email= '".$email."' and sifre= '".$sifre."'");
$uye_bilgi = mysqli_fetch_assoc($sorguUyeAdSoyad);
$uye_id = $uye_bilgi['id'];
$_SESSION['id']=$uye_id;
?>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css" />
</head>
<body bgcolor="#FF66FF">
	<div class="ana_div">
	<div id="profil-bilgileri" style="padding:105px">
		<a href="cikis.php" style="margin-right: 7px; float: right; color:#CC0099">Çıkış</a>
		<a href="kesfetgor.php?kategori_id=1" style="color:#FFFFFF; padding:7px">Kesfet</a>
		<a href="hikayeolustur.php" style="color:#FFFFFF; padding:7px">Hikaye Oluştur</a>
		<a href="profil.php" style="color:#FFFFFF; padding:7px">Profilim</a></br></br>
		<div class="anasf">
			<form>
				<p><font face="candice" size="5">
					<a href="kutuphane.php">Okumaya Devam Et...</a></br>
				</font></p>
			</form>

			<form>
				<p><font face="candice" size="4">
					<?php 
						$sorgukutuphane = mysqli_query($link,"SELECT hikaye_id FROM kutuphane WHERE uye_id = '".$uye_id."'");
						$id = array();
						if($sorgukutuphane == FALSE){
                				die(mysqli_error($link));
                				echo '<script>alert("hatalı!");history.back(-1);</script>';
                		}
						while($hikaye = mysqli_fetch_array($sorgukutuphane)){
							$id[]=$hikaye['hikaye_id'];
						}
						if(!is_null($hikaye)){
							$id = array_flip($id);
							$rastgele_id = array_rand($id, 1);
							$sql1 = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_id IN(".$rastgele_id.")");
							if($sql1 == FALSE){
                				die(mysqli_error($link));
                				echo '<script>alert("hatalı!");history.back(-1);</script>';
                			}
							$hikaye1=mysqli_fetch_array($sql1);
							?>
		<table>
			<tr>
				<td>
					<font color="#333300" style="font-style: bolder">
						<b><i>
						<a href="hikaye.php?hikaye_id=<?php echo $hikaye1['hikaye_id']?>" style='color=#CC0099; padding:7px'>
							<?php
                			echo "<option value='".$hikaye1['hikaye_id']."'>"."<img border=1 width=100 heigth=150 src=\'".$hikaye1['hikaye_kapak']."\'></a>"." Hikaye Adı :".ucfirst($hikaye1['hikaye_adi'])." - Hikaye Türü : ".ucwords($hikaye1['hikaye_tur'])."</option>";
                			?></a>
                		</i></b>
                	</font>
				</td>
			</tr>
		</table>
                			<?php
                		}else{
                			$sql2 = mysqli_query($link, "SELECT hikaye_id FROM hikayeler WHERE hikaye_sahip_id != '".$uye_id."'and hikaye_id NOT IN (SELECT hikaye_id FROM kutuphane WHERE uye_id = '".$uye_id."');");
                			$id2 = array();
                			if($sql2 == FALSE){
                				die(mysqli_error($link));
                				echo '<script>alert("hatalı!");history.back(-1);</script>';
                			}
                			while($hikaye2 = mysqli_fetch_array($sql2)){
                				$id2[]=$hikaye2["hikaye_id"];
                			}

                			$id2 = array_flip($id2);
                			$rastgele_id1= array_rand($id2, 1);
                			$sql3 = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_id IN(".$rastgele_id1.")");
							$hikaye3=mysqli_fetch_array($sql3);
                			?>
        <table>
			<tr>
				<td>
					<font color="#333300" style="font-style: bolder">
                			<b><i>
							<a href="hikaye.php?hikaye_id=<?php echo $hikaye3['hikaye_id']?>">
							<?php
                				echo "<option value='".$hikaye3['hikaye_id']."'>"."<img border=1 width=100 heigth=150 src=\'".$hikaye3['hikaye_kapak']."\'></a>"."  Hikaye Adı :".ucfirst($hikaye3['hikaye_adi'])." - Hikaye Türü : ".ucwords($hikaye3['hikaye_tur'])."</option>";
                			?></a>
                			</i></b>
                		</font>
				</td>
			</tr>
		</table>
                			<?php
                		}
                			?>
            			</a>
            	</font></p>
			</form>	
		</div>
		</div>
	</div>
	</div>
</body>
</html>	