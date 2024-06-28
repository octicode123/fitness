<?php
require_once "pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ero"])) {
    
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
        $requiredFields = ['email', 'password', 'full_name', 'phone', 'birthday', 'height', 'weight', 'terms'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                jsonResponse('Error', ucwords(str_replace('_', ' ', $field)) . ' is required.');
            }
        }

        // Sanitize and retrieve form data
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $full_name = htmlspecialchars($_POST['full_name']);
        $phone = htmlspecialchars($_POST['phone']);
        $birthday = htmlspecialchars($_POST['birthday']);
        $height = htmlspecialchars($_POST['height']);
        $weight = htmlspecialchars($_POST['weight']);
        $terms = $_POST['terms'];

        // Perform additional validation
        $errors = [];

        // Validate email (basic validation)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        // Password validation (example: at least 6 characters)
        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }

        // Phone number validation (basic validation)
        if (!preg_match('/^\+?\d{10,13}$/', $phone)) {
            $errors[] = 'Invalid phone number format';
        }

        // Date validation (example: must be in YYYY-MM-DD format)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
            $errors[] = 'Invalid birthday format. Use YYYY-MM-DD';
        }

        // Height and weight validation (must be numeric and positive)
        if (!is_numeric($height) || $height <= 0) {
            $errors[] = 'Height must be a positive number';
        }

        if (!is_numeric($weight) || $weight <= 0) {
            $errors[] = 'Weight must be a positive number';
        }

        // Terms agreement validation (must be checked)
        if (empty($terms)) {
            $errors[] = 'You must agree to the terms and conditions';
        }

        // Check if email already exists in the database
        try {
            $checkEmailQuery = "SELECT COUNT(*) AS count FROM user WHERE email = :email";
            $stmtCheck = $pdo->prepare($checkEmailQuery);
            $stmtCheck->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtCheck->execute();
            $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                $errors[] = 'Email address already exists';
            }
        } catch (PDOException $e) {
            $errors[] = 'Database error checking email: ' . $e->getMessage();
        }

        // If there are errors, return them as JSON response
        if (!empty($errors)) {
            foreach ($errors as $error) {
                jsonResponse('Error', $error);
            }
        }

        // If all validations pass, proceed with database insertion
        try {
            // Begin transaction
            $pdo->beginTransaction();

            // Insert into users table
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insertUserQuery = "INSERT INTO user (email, password,type) VALUES (:email, :password,'user')";
            $stmtUser = $pdo->prepare($insertUserQuery);
            $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtUser->bindParam(':password', $hashed_password, PDO::PARAM_STR);

            if ($stmtUser->execute()) {
                // Retrieve the last inserted user ID
                $user_id = $pdo->lastInsertId();

                // Insert into user_info table
                $insertQuery = "INSERT INTO user_info (user_id, full_name, birthday, phone, weight, height, registration_date) 
                                VALUES (:user_id, :full_name, :birthday, :phone, :weight, :height, NOW())";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
                $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
                $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
                $stmt->bindParam(':height', $height, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $pdo->commit();
                    jsonResponse('Success', 'Account created successfully');
                } else {
                    $pdo->rollBack();
                    jsonResponse('Error', 'Failed to create account');
                }
            } else {
                $pdo->rollBack();
                jsonResponse('Error', 'Failed to save user information');
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            jsonResponse('Error', 'Database error: ' . $e->getMessage());
        }
    }
}
?>
