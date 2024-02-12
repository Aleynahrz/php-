<!-- Veri tabanı bağlantı kurma  işlemi-->

<?php

$host="localhost";
$user="root";
$parola="";
$db="aliss";

$baglanti=mysqli_connect($host,$user,$parola);
mysqli_select_db($baglanti,$db);
mysqli_set_charset($baglanti,"UTF8");

if(!$baglanti)
{
    die("Bağlantı  işlemi gerçekleştirilemedi!".mysqli_connect_error());
}
/*else{
    echo "Bağlantı başarılı";
}*/

?>