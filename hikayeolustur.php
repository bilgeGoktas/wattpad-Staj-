<?php
include "baglanti.php";

//echo "hikaye yaz.";

if(!isset($_SESSION['id'])){
	header("Location:giris.php?Hata=GirisYap");
	exit();
}
	$uye_id=$_SESSION['id'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<style type="text/css">
		body{width: 1000px; margin: auto;}
		p{margin-top: 20px; margin: auto; font-style: bolder; color: #000000;}
		
	</style>
</head>
<body bgcolor="#FF66FF">
	<div id="hikaye-olustur">
		<p>Lütfen hikaye detaylarını girin</p>
		<a href="anasayfa.php" style="margin-right: 7px; float: right; padding: 7px; color: #CC0099">İptal</a>
		
		<?php
			$sorguHikayeVarMi = mysqli_query($link,"SELECT * FROM hikayeler WHERE hikaye_sahip_id = '".$uye_id."'");
			$satir=mysqli_num_rows($sorguHikayeVarMi);
		?>
			<form name="hikaye" action="hikayekontrol.php?id=<?php echo $uye_id;?>" method="post" enctype="multipart/form-data">
				<tr>
					<td width="200">Başlık : </td></br>
					<td><input type="text" name="hikaye_adi"></td></br>
			    </tr>
			    <tr>
					<td></br>
					<textarea name="hikaye" style="width:700px; height:300px;" maxlenght="2000"></textarea></br>
					</td>
				</tr>
				<tr>
					<br></br>
					<td>Kategori Seçiniz : </td>
					<td>
						<select name="kategori" width="100">
							<option value="0">Bir Kategori Seçiniz</option>
							<option value="aksiyon">Aksiyon</option>
							<option value="aşk">Aşk</option>
							<option value="bilim kurgu">Bilim Kurgu</option>
							<option value="fantastik">Fantastik</option>
							<option value="kısa hikaye">Kısa Hikaye</option>
							<option value="kurgu">Kurgu</option>
							<option value="kurt adam">Kurt Adam</option>
							<option value="korku">Korku</option>
							<option value="macera">Macera</option>
							<option value="tarih">Tarih</option>
							<option value="vampir">Vampir</option>
							</select>
					</td>
				</tr>
				<tr>
					<br></br>
					<td>Telif Hakkı : </td>
					<td>
						<select name="telif" width="100">
							<option value="0">Telif Hakkı Seciniz</option>
							<option value="belirtilmemiş">Telif Hakkı Belirtilmemiş</option>
							<option value="hakkı saklı">Her Hakkı Saklıdır</option>
							<option value="kamu mali">Kamu Malı</option>
							</select>
					</td>
				</tr>
				<tr>
					<br></br>
					<td>Tamamlanmış mı : </td>
					<td>
						<select name="tamammi" width="100">
							<option value="0">Tamam mı belirleyiniz</option>
							<option value="hayir">Hayır</option>
							<option value="evet">Evet</option>
							</select>
					</td>
				</tr>
				<tr>
				</br></br>
					<td width="200">Hikayen için bir kapak resmi yükle :</td><br/><br/>
					<td><input type="file" name="kapakresim"/></td><br/> 
				</tr>
				<tr>
        			<td colspan="2" align="right">
          			<input type="submit" value="Kaydet">
        			</td>
      			</tr>
			</form>
			<?php
			if($satir==0){ 
				echo "Henüz bir hikayeniz bulunmamaktadır.";
			}
			while($hikaye_bilgi = mysqli_fetch_array($sorguHikayeVarMi)){
			?>
			<a href="hikaye.php?hikaye_id=<?php echo $hikaye_bilgi['hikaye_id'];?>" style="color=#CC0099; padding:7px">
			<?php
               	echo "<option value='".$hikaye_bilgi['hikaye_id']."'>".$hikaye_bilgi['hikaye_adi']." ".$hikaye_bilgi['hikaye_tur']."</option>";
            	$_SESSION['id']=$uye_id;
            ?>
            </a></br>
            <?php
			}
			?>
	</div>
</body>
</html>		