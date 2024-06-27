<?php
require_once "pdo.php"; 

if (isset($_POST["ero"])) {
    function jsonResponse($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    if ($_POST["ero"] === 'create_account') {



        if (isset($_POST["full_name"], $_POST["phone"], $_POST["domain"], $_POST["city"], $_POST["zip_code"], $_POST["state"], $_POST["country"], $_POST["login_email"], $_POST["login_password"], $_POST["terms"])) {
            $full_name = htmlspecialchars($_POST["full_name"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $domain = htmlspecialchars($_POST["domain"]);
            $city = htmlspecialchars($_POST["city"]);
            $zip_code = htmlspecialchars($_POST["zip_code"]);
            $state = htmlspecialchars($_POST["state"]);
            $country = htmlspecialchars($_POST["country"]);
            $about_me = isset($_POST["about_me"]) ? htmlspecialchars($_POST["about_me"]) : "";
            $login_email = htmlspecialchars($_POST["login_email"]);
            $login_password = htmlspecialchars($_POST["login_password"]);

            // Validate input lengths
            if (strlen($full_name) > 20) $errors[] = "Full name is too long";
            if (strlen($phone) < 10 || strlen($phone) > 13) $errors[] = "Phone number is invalid";
            if (strlen($city) > 20) $errors[] = "City is too long";
            if (strlen($zip_code) > 10) $errors[] = "Zip code is too long";
            if (strlen($state) > 20) $errors[] = "State is too long";
            if (strlen($country) > 20) $errors[] = "Country is too long";
            if (strlen($login_email) > 255) $errors[] = "Email is too long";
            if (strlen($login_password) < 8) $errors[] = "Password must be at least 8 characters long";

            if (empty($errors)) {
                try {
                    // Check if email already exists
                    $query = "SELECT COUNT(*) FROM user WHERE email = :email";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':email', $login_email);
                    $stmt->execute();
                    $email_count = $stmt->fetchColumn();

                    if ($email_count > 0) {
                        $errors[] = "This email is already used";
                        jsonResponse('Error', 'This email is already used');
                    } else {
                        $pdo->beginTransaction();

                        // Insert into user table
                        $query = "INSERT INTO user (email, password, type) VALUES (:email, :password, 'coach')";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':email', $login_email);
                        $stmt->bindParam(':password', password_hash($login_password, PASSWORD_DEFAULT));
                        $stmt->execute();
                        $user_id = $pdo->lastInsertId();

                        // Insert into coach_account table
                        $query = "INSERT INTO coach_account (user_id, full_name, about_me, phone, domain, city, state, zipcode, country) 
                                  VALUES (:user_id, :full_name, :about_me, :phone, :domain, :city, :state, :zipcode, :country)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':user_id', $user_id);
                        $stmt->bindParam(':full_name', $full_name);
                        $stmt->bindParam(':about_me', $about_me);
                        $stmt->bindParam(':phone', $phone);
                        $stmt->bindParam(':domain', $domain);
                        $stmt->bindParam(':city', $city);
                        $stmt->bindParam(':state', $state);
                        $stmt->bindParam(':zipcode', $zip_code);
                        $stmt->bindParam(':country', $country);

                        if ($stmt->execute()) {
                            $pdo->commit();
                            jsonResponse('Success', 'Coach account created successfully');
                        } else {
                            $pdo->rollBack();
                            jsonResponse('Error', 'Error creating coach account');
                        }
                    }
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    jsonResponse('Error', 'Error: ' . $e->getMessage());
                }
            } else {
                jsonResponse('Error', implode(', ', $errors));
            }
        } else {
            jsonResponse('Error', 'Please fill out all the fields and accept the terms.');
        }
    }
}
?>
