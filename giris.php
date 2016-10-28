<?php
/*ob_start();
session_start();*/
include "baglanti.php";
 $email  = $_POST['email'];
  $sifre = md5($_POST['sifre']);
  

  if(isset($email) && isset($sifre)){
        $sorgu = mysqli_query($link,"select sifre from uyeler where email = '".$email."'");
        $satir=mysqli_num_rows($sorgu);
        $bilgi = mysqli_fetch_assoc($sorgu);

        if( $satir != 1 ){
          echo '<script>alert("Kullanıcı bulunamadı!");history.back(-1);</script>';
          exit;
        }else{
        $gelen_sifre = $bilgi["sifre"];
          if( $sifre != $gelen_sifre ){
            echo '<script>alert("Yanlış şifre girdiniz!");history.back(-1);</script>';
            exit;
          }else{
            $sorgu_id = mysqli_query($link,"select id from uyeler where email = '".$email."'");
            $bilgi_id = mysqli_fetch_assoc($sorgu_id);
            $_SESSION['uye_id']= $bilgi_id['id'];
            $_SESSION['sifre']=$sifre;
            $_SESSION['email']=$email;
            echo "Başarıyla giriş yaptınız! Şimdi profil sayfasına yönlendiriliyorsunuz.";
            header("Location:anasayfa.php");
          }
        }
  }else{
    echo "Eksik Alan Mevcut.";
  }   
?>