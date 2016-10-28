<?php
  include "baglanti.php";
if(empty($_POST["adi"]) || empty($_POST["soyadi"]) || empty($_POST["dogum_tarihi"]) || empty($_POST["dogum_yeri"]) || empty($_POST["yasadigi_sehir"]) || 
  empty($_POST["email"]) || empty($_POST["sifre"]) || empty($_POST["tekrarsifre"])){

    echo '<script>alert("Form alanlarını doldurun!");history.back(-1);</script>';
}else{

      $adi=$_POST["adi"];
      $soyadi=$_POST["soyadi"];
      $dogum_tarihi=$_POST["dogum_tarihi"];
      $dogum_yeri=$_POST["dogum_yeri"];
      $yasadigi_sehir=$_POST["yasadigi_sehir"];
      $email=$_POST["email"];
      $sifre=md5($_POST["sifre"]);
      $tekrarsifre=$_POST["tekrarsifre"];

if($_FILES){
$resim_ismi = $_FILES['profilresim']['name'];
$resim_turu = $_FILES['profilresim']['type'];
$resim_boyut_orj = $_FILES['profilresim']['tmp_name'];
if($resim_kaynak ==""){
  echo '<script>alert("Bir resim seçmelisiniz!");history.back(-1);</script>';
}elseif (($resim_turu != "image/jpeg") && ($resim_turu != "image/png") && ($resim_turu != "image/gif")) {
  echo '<script>alert("Seçtiğiniz dosya türü jpeg, png ya da gif türünde olmalıdır!");history.back(-1);</script>';
}elseif ($resim_boyut_orj> 1024* 1024) {
  echo '<script>alert("Seçtiğiniz dosya boyutu 1 mb den küçük olmalıdır!");history.back(-1);</script>';
}else{
  $resim_hedef = "img/";
  $rasgele_isim = rand(1,10000);

  $resim_isim_yeni = $resim_hedef.$rasgele_isim.'-'.$resim_ismi.'';

  $resim_upload = move_uploaded_file($resim_kaynak, $resim_isim_yeni);

  function isValidEmail($email){

       return ( ! preg_match ( "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email ) ) ? FALSE : TRUE;

  }

if(isValidEmail($email)){

  if(($_REQUEST["sifre"]) != $tekrarsifre){
    echo '<script>alert("İlk girilen şifre ile ikinci girilen şifre uyumsuzdur!");history.back(-1);</script>';
  }
    $login=true;

    $query=mysqli_query($link,"insert into uyeler(adi,soyadi,email,sifre,dogum_tarihi,login,profil_resim,yasadigi_sehir,dogum_yeri) values ('".$adi."','".$soyadi."','".$email."','".$sifre."','".$dogum_tarihi."','".$login."','".$resim_isim_yeni."','".$yasadigi_sehir."','".$dogum_yeri."')");
    echo "Üyelik kaydınız yapılmıştır!";
    $_SESSION['email']=$email;
    $_SESSION['sifre']=$sifre;
    header("Location:anasayfa.php");

}else {

        echo '<script>alert("Eposta adresini doğru girin!");history.back(-1);</script>';

}
}
 
  ?>