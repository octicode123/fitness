<?php
require_once 'pdo.php';
require_once '../../backend/check-help.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"], $_POST["password"])) {
        function check_subscription($cstId,$user_id){
            global $pdo;
            $subscription_check = "SELECT COUNT(*) FROM subscription WHERE temporary=:temp";
            $stmt = $pdo->prepare($subscription_check);
            $stmt->bindParam(':temp', $cstId);
            $stmt->execute();
            $subExists = $stmt->fetchColumn();

            if ($subExists) {
                $update_sub=$pdo->prepare("UPDATE subscription SET user_id=:user_id , temporary=NULL WHERE temporary=:temp");
                $update_sub->bindParam(':temp', $cstId);
                $update_sub->bindParam(':user_id', $user_id);

                $update_sub->execute();

            }
        }

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        try {
            $query = "SELECT * FROM user WHERE email = :email and type='user'";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    

                    $_SESSION['user_id_AHMx'] = $user['user_id'];
                    $_SESSION['email_AHMx'] = $user['email'];
                    $_SESSION['password_AHMx'] = $user['password'];
                    check_subscription($cstId,$user['user_id']);

                    header('location: index.php');

                } else {
                    $errors[] = "Invalid password";
                }
            } else {
                $errors[] = "User not found";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    } else {
        $errors[] = "Please provide email and password";
    }
}




?>
