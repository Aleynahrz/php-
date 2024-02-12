<?php
    session_start();
/*
    fopen("dosya_ismi","dosya_açma_methodu(a,a+,r+,r,w,w+)");
    fwrite(): dosya yazmamıza yarar.
    fclose():>dosyayı kapatmamıza yarar.
    fgets(): dosyayı satır satır okuma yapar
    filesize():dosyanın karakter sayısını okur.
    feof(): dosya sonuna gelindiğindetrue değerini döndürür.
    Unlink(): Dosyayaı kalıcı olarak siler.
    file():dosyayı okur geriye dizi döndürür.
    fread(): dosyayı tek seferde okur


    dosya açma metodları:

    a:Dosya yazma modunda yazılır.İmleç dosya sonundadır.Dosya ekleme yapılır dosya konumu yoksa oluşturulur.
    r: dosya okuma mofunda acılır.İmleç dosyanın başında yer alır.
    w:Dosya yazma modunda açılır.İmleç dosyanın başında yer alır.Dosya konumundaysa içindeki tüm veriler silinir.
    x:Dosya yazma modunda acılır.Dosya yoksa oluşturulur,varsa false  döner

    a+:Dosya yazma ve okuma modunda açılır.
    r+:Dosya okuma ve yazma modunda açılır.
    w+:Dosya yazma ve okuma modunda acılır.
    x+:Dosya okuma ve yazma modunda acılır.
*/ 

/*@$baslik=$_POST["baslik"];
@$kaydet=$_POST["kaydet"];
if(isset($kaydet)) {
	$openfile=fopen("duyurular.txt","a"); //dosyaya yazdırma işlemi oluşturduk.$openfile değişkeni ile
	$yaz=fwrite($openfile,$baslik);//fputs.elirtilen dosyaya karakter dizisini yazar ve başarı durumunda 0, hata durumunda EOF (End-of-File) değerini döndürür.
	fclose($openfile);// yazdırma işlemini durdur
}

@$kaydet=$_POST["kaydet"];
@$duyuru=$_POST["msjduyuru"];
if(isset($kaydet)) {
	$openfile=fopen("duyurular.txt","a+");
	$yaz=fwrite($openfile,$duyuru);
	fclose($openfile);
	echo"Kayıt Başarılı";
}*/
   

$txtdosyayolu = "C://xampp//htdocs//yeniii//duyurular.txt";

if (isset($_POST["kaydet"])) {
    $oku = fopen($txtdosyayolu, "a+");

    if ($oku) {
        $baslik = "Başlık: " . $_POST["baslik"];
        $metin = "Metin: " . $_POST["msjduyuru"];

        $yaz = fwrite($oku, $baslik . "\n" . $metin . "\n\n"); 
        fclose($oku);

        if ($yaz !== false) {
            $msj = "Başarıyla dosyaya eklendi.";
            setcookie("error",$msj,time()+10,"/");
        } else {
          $msj = "Dosyaya yazma hatası.";
          setcookie("error",$msj,time()+10,"/");
        }
    } else {
      $msj =  "Dosya açma hatası.";
      setcookie("error",$msj,time()+10,"/");
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Duyuru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/duyuru.css">
    <style>
      .dygor{
      text-decoration: none;
      margin-left: 80px;
     margin-top: 150px;
      color: orangered;
      }
    </style>
    
  </head>
  <body>

     
    <header class="header">
        <div class="container-fluid">
    <a href="giris.php">Üye Giriş</a>
    <a href="kayit.php">Kayit Ol</a>
    <a href="duyurular.php">Duyurular</a>
            <?php
             echo @$_SESSION['eposta'];
            ?>

    </div>
</header>
            <nav class="nav-bar">
                <div class="container-fluid">
                    <a href="email.php">iletişim</a>
                    <a href="#"> Web Projeleri </a>
                    <a href="#">Hakkında</a>
                    <a href="#"></a>
                    <a href="index.php">Anasayfa</a>
                </div>
            </nav>

            <section>
              <div class="container">
                <h2>Duyurular</h2>
                <hr>
              </div>
              <div class="card">
                <form action="duyuru.php" method="post">
                  <p>Duyuru Başlığı</p>
                <input type="text" name="baslik"><br>
                <p>Duyuru</p>
                <textarea name="msjduyuru" id="" cols="50" rows="8"></textarea>
                <button type="menu" class="btn" name="kaydet" >Kaydet</button> 
                
                <a href="duyurular.php" class="dygor">Duyuruları görmek için</a>
                <?php
                  if(isset($_COOKIE["error"])){
                    echo $_COOKIE["error"];
                  }
                ?>
               
                </form>
              </div> 
            </section>

     
           

         

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  </body>
</html>