<?php
require_once "ctr.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_SESSION["user_id_AHM"]) && isset($_SESSION["email_AHM"]) && isset($_SESSION["password_AHM"])  ) {

    $user_idV1=htmlspecialchars($_SESSION["user_id_AHM"]);
    $emailV1=htmlspecialchars($_SESSION["email_AHM"]);
    $passwordV1=htmlspecialchars($_SESSION["password_AHM"]);

    $info = $pdo->prepare("SELECT * FROM user WHERE email=:email and password=:password and user_id=:user_id  and type='coach' LIMIT 1");
    $info->bindParam(':email', $emailV1);
    $info->bindParam(':password', $passwordV1);
    $info->bindParam(':user_id', $user_idV1);

    if ($info->execute()) {
        $resultinfo = $info->fetch();

        if ($resultinfo) {
           
                $login_email = $resultinfo["email"];
                $user_id = $resultinfo["user_id"];
                $coach_account=$pdo->prepare("SELECT coach_id FROM coach_account WHERE user_id=:user_id LIMIT 1 ");
                $coach_account->bindParam(':user_id',$user_id);
                $coach_account->execute();
                $result_coach=$coach_account->fetch();
                $coach_id=$result_coach["coach_id"];
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
