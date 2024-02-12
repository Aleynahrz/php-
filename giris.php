 <?php
      include("bagla.php");
    
    $email_err="";// email doğrulama için boş veri atandı
    $sifre_err="";// şifre doğrulama için boş veri atandı
  //kaydet butanuna basıldığında tabloya veri ekleme ve hata mesajları bildirimi alma.
  if(isset($_POST["giris"]))
   {
              
     // kullanıcıadı doğrulama
          if(empty($_POST["kullanici_adi"]))
          {
            $username_err="Kullanıcı ad alanı boş geçilemez.";
          }
          else if (strlen($_POST["sifre"]<8))
          {
            $sifre_err="Şifre en az 8 karakterden oluşmalıdır.";
          }
          else{
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
            $sifre=password_hash($_POST["sifre"],PASSWORD_DEFAULT);
          }
         
    //$email=$_POST["email"];
    //$sifre=password_hash($_POST["sifre"],PASSWORD_DEFAULT);// şifreyi veri tabanına criptolayıp kaydediyor.

          $username = $_POST["kullanici_adi"];
          $sifre = $_POST["sifre"];
          if(isset($username)&&isset($sifre))
          {

            $secim="SELECT * FROM aliye WHERE kullanici_adi='$username'";
            $calistir=mysqli_query($baglanti,$secim);
            $kayitsayisi=mysqli_num_rows($calistir);// e mail eşsiz olarak seçildiğinden ya sıfır değerini yada bir değerini veriri.

            if($kayitsayisi>0)
            {
                $ilgilikayit=mysqli_fetch_assoc($calistir);//sorgu sonucundaki her satırı bir assoziatif dizi olarak döndürerek bu verilerin üzerinde işlem yapmamızı sağlar.
                $haslisifre=$ilgilikayit["sifre"];

                // girilen şifre ile kayıtlı olan şifre aynımı diye bakar.
                if ($sifre == $haslisifre) {
                    session_start();// üye girişi işlemini yapmamızı sağlayan session' başlatır.
                    $sql="SELECT * FROM aliye WHERE kullanici_adi='$username'";// kayıt tablosundan  kullanici_adi id li username değişkenine sağıp veriyi gösterir.
                    $reuslt=mysqli_query($baglanti,$sql);// sgl değişkeninde ki sorguyu veri tabanında baktıran reuselt değişkeni
                    $row = mysqli_fetch_array($reuslt); //sordunun sırası ile ile dönmesini sağlayan değerleri gösteren değişken
                    $_SESSION["id_array"] = $_SESSION["id_array"] ?? array();
                    if(in_array($row["id"],$_SESSION["id_array"]))
                    {
                       ?> <script>alert("Zaten bu hesaba giriş yapmışsınız");</script> <?php
                        header('Refresh:3 ; URL=giris.php');
                    }
                    else
                    {
                    $array = array(
                      "id" => $row["id"], //veritabanındaki id kolonunu idye atıyor
                      "ad" => $row["ad"],
                      "soyad" => $row["soyad"],
                      "kadi" => $row["kullanici_adi"],
                      "tel" => $row["telefon"],
                      "email" => $row["email"]
                    );

                    // tüm session bilgilerinin  tutulacağı session dizisi
                    $_SESSION["array"][$row["id"]] = $array;//

                    // tüm üye idlerinin tutulacağı session dizisi
                    $_SESSION["id_array"][] = $row["id"];

                    // o anki açık oturum üye id'si

                    $_SESSION["userid"] = $row["id"];

                      /*$covalues=" Kullanıcı adı: " .$username . "/" . " Şifre: " .$sifre. "'bilginizi tutan  COOCKİE oluşturuldu" ;//giriş yapıldığında açılan profil sayfasında bilgileri tutan coocie oluşturdum.
                      $cotime=time()+30;
                      setcookie("kullanici_bilgileri",$covalues,$cotime); ---> istenilen coockie bu şekilde değil onuyapıcam
                      */
                      header("Location:profile.php");
                }}
                else {
                  echo "Hatalı şifre girdiniz!!";
                }

            }
            else{
                echo 'Kullanıcı adı yanlış.';

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
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/giris.css">
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
            <h2>Üye Giriş</h2>
              <form action="giris.php" method="post"> 
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control 
                  
                <?php
                  if(!empty($username_err))
                  {
                    echo "is-invalid";
                  }
                ?>
                
                " id="exampleInputEmail1" required name="kullanici_adi">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php
                      echo $username_err;
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
                " id="exampleInputPassword1" required name="sifre">
                <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                      echo $sifre_err;
                    ?>
                </div>
              </div>
              <div class="remember-forgot">
               <label ><input type="checkbox" name="hatirla">Hatırla beni!</label>
               <?php
              /* $hatirla=$_POST["hatirla"];
               if(isset($hatirla))
               {
                $mycoockie=setcookie('kullanici_adi',$username, time()+(60*10));
                $mycoockie1=setcookie('sifre',$sifre,(60*10));
                if(($mycoockie === true )&& ($mycoockie1 === true ))
                {
                  $kukimesaj='<div class="alert alert-success" role="alert">
                   Başarılı bir şekilde cookie oluşturuldu.
                </div>';

                }
                else
                {
                  $kukimesaj='<div class="alert alert-danger" role="alert">
                  Cookie oluşrken hata oluştu!!!!!
               </div>';*
                }

               }---> beni hatırla kısmın coockie oluşturmaya çalıştırdım fakat olmadı geliştirilmeli.*/
               
               ?>
               <a href="#">Şifremi Unuttum?</a> 
               </div>
  
              <button type="submit" class="btn btn-secondary" name="giris">Giriş Yap</button>
              <div class="register-link">              
             
                <p>Hesabım Yok!! <a href="kayit.php">Kayıt Ol</a></p>

                <?php

                
                      /*$msjcoo = "Giriş Başarılı! Hoşgeldiniz: " .$ilgilikayit["kullanici_adi"];
                      setcookie("error" , $msjcoo, time()+ 5 , "/");
                      header("Refresh:1");---> koki oluşturulmaya çalışıldı ama olmadı tekrar dene.*/
                  if(@$_COOKIE["error"])// kayıt.php'de oluşturduğum error coockie sini girş.php'nın formun buton altında çağırdım. 
                  {
                    echo $_COOKIE["error"];
                  }
          
                
                ?>
            </div>
            </form>
            </div>
        </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
