
<?php

    session_start();
  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile.css">
    <style>
    h3{
      text-align: center;
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      font-size: 40px;
      margin-top: 50px;
    }
   
    </style>
  </head>
  <body>

        <header class="header">
                <div class="container-fluid">
                       
                   <a href="duyuru.php">Duyurular</a>
                     <a href="cikis.php">Çıkış Yap</a>
                     <a href="change.php">Hesap Değiştir</a>
                     <a href="giris.php">Hesap Ekle</a>
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
  <?php
    @$id = $_SESSION["userid"]; // tekrar tekrar $_SESSION oluşturmamak için $id değişkeni oluşturuyorum.
    //print_r($_SESSION["array"]); //print_r kullanarak array session'ındaki verileri ekrana yazdır
    if(isset($id))// $id var mı varsa if'i çalıştır
    {
        echo "<h3 >".$_SESSION["array"][$id]["kadi"]." HOŞ GELDİNİZ</h3 >"; // array session'ındaki aktif kullanıcı ($id) deki kadiyi ekrana yazdırıyor.
        echo "<h3>".$_SESSION["array"][$id]["email"]."</h3>";
       //echo "<a href='cikis.php' style='color:orenge; bacground-color:pink;
        //border:1px solid orenge ;padding:5px 5px'>Çıkış Yap </a>";
       /* ?>
            <a href="giris.php">Başka Bir Hesap Ekle</a>
            /
            <a href="change.php">Hesap Değiştir</a>
        <?php -------> bu kod profile sayfasının iç kısmına  a href ile link oluşturma yapıyor navbar kısmına ekleme yaptığımdan dolayı burası devre sışı şuanlık */
     
      
    }
    else
    {
        echo "Bu sayfayı görüntüleme yetkiniz yoktur."; 
    }
              

   
  ?> 
  




             
          
          

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  </body>
</html>