<?php 

$txtdosyayolu = "C:\\xampp\\htdocs\\yeniii\\duyurular.txt";

if (file_exists($txtdosyayolu)) //file_exists: belirtilen dosya yolunun var olup olmadığına bakar.
{
    $oku = fopen($txtdosyayolu, "r");

    if ($oku) {
        echo fread($oku, filesize($txtdosyayolu));
        fclose($oku);
    } else {
        echo "Dosya açma hatası";
    }
} else {
    echo "Dosya bulunamadı";
}



?>