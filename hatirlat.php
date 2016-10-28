<?php
include "baglanti.php";

$eposta = $_POST['eposta'];

$sifre= mysqli_query($link,"select sifre from uyeler where email='".$eposta."'");
 