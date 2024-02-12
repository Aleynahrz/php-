<?php 
session_start();

if (isset($_SESSION["userid"])) {
    // Aktif kullanıcının verilerini oturum dizisinden kaldır
    unset($_SESSION["array"][$_SESSION["userid"]]);

    // Aktif kullanıcının kimliğini id_array oturumundan kaldır
    $key = array_search($_SESSION["userid"], $_SESSION["id_array"]);
    if ($key !== false) {
        unset($_SESSION["id_array"][$key]);
    }

    // Yeni aktif kullanıcının kimliğini belirle
    $newUserId = 0; // Varsayılan olarak sıfır ya da başka bir değer
    if (!empty($_SESSION["id_array"])) {
        // Eğer id_array dizisi boş değilse, yeni aktif kullanıcının kimliğini belirle
        $newUserId = reset($_SESSION["id_array"]);
    }

    // Yeni aktif kullanıcının kimliğini oturum içinde güncelle
    $_SESSION["userid"] = $newUserId;
    if(count($_SESSION["id_array"]) == 0)
    {
        session_destroy();
    }
}

header("location:profile.php");
?>