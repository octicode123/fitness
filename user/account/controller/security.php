<?php
require_once "ctr.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_SESSION["user_id_AHMx"]) && isset($_SESSION["email_AHMx"]) && isset($_SESSION["password_AHMx"])  ) {

    $user_idV1=htmlspecialchars($_SESSION["user_id_AHMx"]);
    $emailV1=htmlspecialchars($_SESSION["email_AHMx"]);
    $passwordV1=htmlspecialchars($_SESSION["password_AHMx"]);

    $info = $pdo->prepare("SELECT * FROM user WHERE email=:email and password=:password and user_id=:user_id  and type='user' LIMIT 1");
    $info->bindParam(':email', $emailV1);
    $info->bindParam(':password', $passwordV1);
    $info->bindParam(':user_id', $user_idV1);

    if ($info->execute()) {
        $resultinfo = $info->fetch();

        if ($resultinfo) {
           
                $login_email = $resultinfo["email"];
                $user_id = $resultinfo["user_id"];
               
        } else {
            header('Location: logout.php');
        }
    } else {
        header('Location: logout.php');
    }
} else {
    header('Location: logout.php');
}
?>
