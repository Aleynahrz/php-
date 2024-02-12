<?php 

session_start();


header("Content-type: text/html; charset = utf8");

foreach($_SESSION["id_array"] as $id)
{

    echo $_SESSION["array"][$id]["kadi"] . ($_SESSION["userid"] != $id ? '<a href="change.php?id=' . $id . '">[Bu hesaba geç] </a>' : '') . '<br/>';

}

if($id = @$_GET["id"])
{
    $_SESSION["userid"] = $id;
    header("Location:profile.php");
}


?>