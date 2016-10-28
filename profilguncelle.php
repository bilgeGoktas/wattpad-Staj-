<?php
include "baglanti.php";

$uye_id=$_SESSION['id'];
$sifre = $_SESSION['sifre'];
?>
<html>
<head>
  <meta charset="UTF-8">
  <style type="text/css">
    body{width: 1000px;margin: auto;}
  </style>
</head>
<body>
<form name="profilguncelle" action="pguncelekle.php" method="post">
    <table cellpadding="8" cellspacing="3" align="center">
      <a href="profil.php" style="margin-right: 7px; float: right; padding: 7px; color: #CC0099">İptal</a></br>
      <tr>
        <td width="100">Adınız:</td>
        <td><input type="text" name="adi"></td>
      </tr>
      <tr>
        <td width="100">Soyadınız:</td>
        <td><input type="text" name="soyadi"></td>
      </tr>
      <tr>
        <td width="100">Yaşadığınız Şehir:</td>
        <td><input type="text" name="yasadigi_sehir"></td>
      </tr>
      <tr>
        <td width="100">Email:</td>
        <td><input type="text" name="email"></td>
      </tr>
      <tr>
        <td colspan="2" align="right">
          <input type="submit" value="Güncelle">
          <?php
            $_SESSION['id']=$uye_id;
            $_SESSION['sifre']=$sifre;
          ?>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>