 <?php
      include("bagla.php");
    $username_err="";
    $ad_err="";
    $soyad_err="";
    $email_err="";// email doğrulama için boş veri atandı
    $sifre_err="";// şifre doğrulama için boş veri atandı
  //kaydet butanuna basıldığında tabloya veri ekleme ve hata mesajları bildirimi alma.
  if(isset($_POST["kaydet"]))
  {

    if(strlen($_POST["ad"]<1))
    {
    $ad_err="Ad kısmı  boş geçilemez.";
    }
    else if (!preg_match('/^[a-zA-ZÇçĞğİıÖöŞşÜü\s]+$/', $_POST["ad"])) {
      $ad_err = "Ad kısmında sadece harf ve boşluk kullanabilirsiniz.";
    }
    else{
      $ad=$_POST["ad"];
    }   
    if(strlen($_POST["soyad"]) < 1)
     {
      $soyad_err = "Soyad kısmı alanı boş geçilemez.";
    } else if (!preg_match('/^[a-zA-ZÇçĞğİıÖöŞşÜü\s]+$/', $_POST["soyad"])) {
        $soyad_err = "Soyad kısmında sadece harf ve boşluk kullanabilirsiniz.";
    } else {
        $soyad = $_POST["soyad"];
    }
  

    /*if(strlen($_POST["soyad"]<1))
    {
      $soyad_err="Soyad kısmı alanı boş geçilemez.";
    }
    else if (!preg_match('/^[a-zA-ZÇçĞğİıÖöŞşÜü\s]+$/', $_POST["soyad"])) {
      $soyad_err = "Soyad kısmında sadece harf ve boşluk kullanabilirsiniz.";
    }
    else{
      $soyad=$_POST["soyad"];
    }*/

    //kullanıcıadı doğrulama
    if(empty($_POST["kullanici_adi"]))
    {
      $username_err="Kullanıcı ad alanı boş geçilemez.";
    }
    else if (strlen($_POST["sifre"]<8))
    {
            $sifre_err="Şifre en az 8 karakterden oluşmalıdır.";
    }
    else{
      $kullanici=$_POST["kullanici_adi"];
    }       

            // email doğrulama
    if(empty($_POST["email"]))
      {
        $email_err="Email alanı boş geçilemez.";
      }
    else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Geçerli bir email format değil!!";
      }
    else
      {
         $email=$_POST["email"];
      }
          
      // kullanıcıadı doğrulama
    if(empty($_POST["kullanici_adi"]))
      {
        $username_err="Kullanıcı ad alanı boş geçilemez.";
      }
    else if (strlen($_POST["sifre"]<8))
      {
         $sifre_err="Şifre en az 8 karakterden oluşmalıdır.";
      }
    else
      {
        $username=$_POST["kullanici_adi"];
      } 

  //şifre doğrulama
    if(strlen($_POST["sifre"]<8))
      {
         $sifre_err="Şifre en az 8 karakterden oluşmalıdır.";
      }
        else if (preg_match('/^[a-z\d_]{5,20}$/i',$_POST["sifre"] ))
      {
         $sifre_err="Şifreniz küçük,büyük harf ve karakterlerden oluşmalıdır.";
      } 
    else
      {
         $sifre=$_POST["sifre"];

      }

   // $ad=$_POST["ad"];
    //$soyad=$_POST["soyad"];
    $tel=$_POST["telefon"];


    //$email=$_POST["email"];
    //$sifre=password_hash($_POST["sifre"],PASSWORD_DEFAULT);// şifreyi veri tabanına criptolayıp kaydediyor.

          if(isset($ad)&&isset($soyad)&&isset($tel)&&isset($email)&&isset($sifre))
          {
    // tabloya veri kayıt işlemi
          $ekle="INSERT INTO aliye (ad, soyad,telefon,kullanici_adi,email,sifre) VALUES('$ad', '$soyad', '$tel', '$kullanici','$email', '$sifre' )";
          $eklecalistir=mysqli_query($baglanti,$ekle);

          // kayıt işlemi yaparken uyarı verdiediğimiz kısım
          if($eklecalistir)
          {
            //echo 'Kayıt işlemi başarılı';
            $msj = "Kayıt Başarılı";
            setcookie('error' , $msj , time() + 5 , "/");// Coockie oluşturuldu butana basıldığında ekranda duracağı zamana kadar
           header("Location:giris.php");//Coockie'nin verileciği sayfaya yönlendirir.
          }
          else
          {
            echo 'kayıt işleminiz başarısız!!!';
          }

          mysqli_close($baglanti);
        }
  }

?> 

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Üye Kayıt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/kayit.css">
  </head>
  <body>

  <header class="header">
              <div class="container-fluid">   
                <a href="duyuru.php">Duyurular</a>
                <a href="giris.php">Üye Giriş</a>
                <a href="kayit.php">Kayit Ol</a>
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
            <div class="card">
            <h2>Üye Kayıt</h2>
              <form action="kayit.php" method="post">
              <div class="row">
                <div class="col-6">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ad</label>
                <input type="text" class="form-control
                <?php
                  if(!empty($ad_err))
                  {
                    echo "is-invalid";
                  }
                ?>"
                id="exampleInputPassword1"   name="ad">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                      echo $ad_err;
                    ?>
                </div>
              </div>
                </div>
                <div class="col-6">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Soyad</label>
                <input type="text" class="form-control
                <?php
                  if(!empty( $soyad_err))
                  {
                    echo "is-invalid";
                  }
                ?>"
                id="exampleInputPassword1"   name="soyad">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                      echo  $soyad_err;
                    ?>
                </div>
              </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control  
                  <!-- burda ki kodda verieln yanlışgirilmise altta uyarı veriyor.  -->
                <?php
                  if(!empty($username_err))
                  {
                    echo "is-invalid";
                  }
                ?>
                
                " id="exampleInputEmail1"   name="kullanici_adi">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                      echo $username_err;
                    ?>
                </div>
              </div>
            
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Telefon</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="telefon">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email adres</label>
                <input type="text" class="form-control 
                  
                <?php
                  if(!empty($email_err))
                  {
                    echo "is-invalid";
                  }
                ?>
                
                " id="exampleInputEmail1"   name="email">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                      echo $email_err;
                    ?>
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Şifre</label>
                <input type="password" class="form-control 
                <?php
                  if(!empty($sifre_err))
                  {
                    echo "is-invalid";
                  }
                ?>
                " id="exampleInputPassword1"   name="sifre">
                <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                      echo $sifre_err;
                    ?>
                </div>
              </div>
  
              <button type="submit" class="btn btn-secondary" name="kaydet">Kaydet</button>
          
            </form>
            </div>
        </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
