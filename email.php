<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer.php';
  require 'SMTP.php';

    $email_err="";// email doğrulama için boş veri atandı
   
  //kaydet butanuna basıldığında tabloya veri ekleme ve hata mesajları bildirimi alma.
  if(isset($_POST["gonder"]))
  { 
    $email=new PHPMailer();// phpmailer kütüphanesinin fonksiyonunu çağırdı
    //$email->SMTPDebug = 2; hata ayıklayıcı
    $email->IsSMTP();// IsMTP protokulunu kullanıcağını söyledik.
    $email->SMTPAuth=true;// kimlik doğrulama işlemleri için kullanılır.
    $email->SMTPSecure="tls";//(ssl)SMTP güvenliğini sağlamak için
    $email->Port=587;
    $email->Host="smtp.gmail.com";//gmailin sağladığı host
    $email->Username="aleyna.hrz05@gmail.com";
    $email->Password="npoi vrib flgr ptlf";
    $email->AddAddress($_POST['email'], "ad");
    $email->CharSet = 'UTF-8';
    $email->Subject=$_POST['konu'];
    $email->Body=$_POST['mesaj'];
    if($email->Send())
      {
        ?>
        
        <script> alert("Mail Gönderildi");</script>

        <?php
      }
    else
      {
        ?>
        
        <script> alert("Mail Gönderilemedi");</script>

        <?php
      } 
  
        

            // email doğrulama
          if(empty($_POST["email"]))
          {
            $email_err="Email alanı boş geçilemez.";
          }
          else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
             $email_err = "Geçerli bir email format değil!!";
          }
          else{
            $email=$_POST["email"];
          } 

  


    $ad=$_POST["ad"];
    $soyad=$_POST["soyad"];


    //$email=$_POST["email"];
    //$sifre=password_hash($_POST["sifre"],PASSWORD_DEFAULT);// şifreyi veri tabanına criptolayıp kaydediyor.

          if(isset($ad)&&isset($soyad)&&isset($tel)&&isset($email)&&isset($sifre))
          {
    // tabloya veri kayıt işlemi
          $ekle="INSERT INTO aliye (ad, soyad,telefon,kullanici_adi,email,sifre) VALUES('$ad', '$soyad', '$tel', '$kullanici','$email', '$sifre' )";
          $eklecalistir=mysqli_query($baglanti,$ekle);

          if($eklecalistir)
          {
            echo 'Kayıt işlemi başarılı';
            $msj = "Kayıt Başarılı";
            setcookie('error' , $msj , time() + 5 , "/");
            header("Location:error.php");
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
    <title>E-Mail Gönderme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="css/email.css">
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
            <div class="card-body">
            <h2>E-Mail İletişim</h2>
              <form action="email.php" method="post">
              <div class="row">
                <div class="col-6">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ad</label>
                <input type="text" class="form-control" id="exampleInputPassword1"   name="ad">
              </div>
                </div>
                <div class="col-6">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="exampleInputPassword1"   name="soyad">
              </div>
                </div>
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
                <label for="exampleInputPassword1" class="form-label">Konu</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="konu">
              </div>
              <label for="exampleInputPassword1" class="form-label ">Mesajınız</label>
              <hr>
              <textarea name="mesaj" id="" cols="53" rows="5" class="mesaj" ></textarea>
             


        
              <button type="submit" class="btn btn-secondary" name="gonder">Gönder</button>
              <?php
if (isset($_COOKIE["mailmsj"])) {
    header("Refresh:5; URL:email.php");
    echo $_COOKIE["mailmsj"];
    exit; }
?>
            </form>
            </div>
          </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


