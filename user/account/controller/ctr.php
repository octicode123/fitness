<?php
require_once 'pdo.php';
$errors = [];
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"], $_POST["password"])) {

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
