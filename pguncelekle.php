<?php
  include "baglanti.php";
  $adi=$_POST["adi"];
  $soyadi=$_POST["soyadi"];
  $yasadigi_sehir=$_POST["yasadigi_sehir"];
  $email=$_POST["email"];
  $sifre = $_SESSION['sifre'];
  $id = $_SESSION['id'];

  //echo "adi :".$adi." soyadi : ".$soyadi."yasadigi_sehir : ".$yasadigi_sehir." email :  ".$email." sifre : ".$sifre." id : ".$id;

  	$query = mysqli_query($link,"update uyeler set adi = '".$adi."' where id= '".$id."'");
    $query1 = mysqli_query($link,"update uyeler set soyadi = '".$soyadi."' where id= '".$id."'");
    $query2 = mysqli_query($link,"update uyeler set email = '".$email."' where id= '".$id."'");
    $query3 = mysqli_query($link,"update uyeler set yasadigi_sehir = '".$yasadigi_sehir."' where id= '".$id."'");
    echo "Profil bilgileriniz güncellenmiştir!";
    $_SESSION['email']=$email;
    $_SESSION['sifre']=$sifre;
    header("Location:profil.php");

    /*, soyadi = '".$soyadi."', 
      email = '".$email."', yasadigi_sehir = '".$yasadigi_sehir"'*/ 
  ?>