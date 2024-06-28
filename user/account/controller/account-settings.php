<?php 
require_once "security.php";
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

    if ($_POST["ero"] === 'profile_img') {
        $account = $pdo->prepare("SELECT picture FROM user_info WHERE user_id=:user_id LIMIT 1");
        $account->bindParam(':user_id', $user_id);
        $account->execute();
        $result = $account->fetch();
        if ($result["picture"] == NULL) {
            $path = "../assets/img/avatars/1.png";
        } else {
            $path = "../../../../fitness_img/user/" . $result["picture"];
        }

?>
        <form id="UpIm" method="POST" enctype="multipart/form-data">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="<?php echo $path; ?>" alt="user-avatar" class="d-block rounded mx-3 mb-3" style="object-fit:cover;"height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Select Image</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg ,image/jpg" name="photos" />
                    </label>
                    <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Upload</span>
                    </button>

                    <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 2 mb</p>
                </div>

            </div>
            </from>
<?php
    }
    if ($_POST["ero"] === 'img_u') {
        $errors = [];
        if (!empty($_FILES["photos"])) {
            if ($_FILES['photos']['error'] === UPLOAD_ERR_OK) {
                $filename = rand(111111, 999999) . uniqid() . ".png";
                $extension = pathinfo($_FILES['photos']['name'], PATHINFO_EXTENSION);

                $allowedTypes = array('jpg', 'png', 'jpeg');
                $maxSize = 2000000;

                if (in_array($extension, $allowedTypes)) {
                    if ($_FILES['photos']['size'] < $maxSize) {
                    } else {
                        $errors[] = 'File size exceeds the maximum limit: ' . $filename;
                    }
                } else {
                    $errors[] = 'Allowed files are jpg/png/jpeg';
                }
            } else {
                $errors[] = 'Error uploading file: ' . $_FILES['photos']['name'];
            }
        } else {
            $errors[] = "Empty image ";
        }

        if (empty($errors)) {

            if (move_uploaded_file($_FILES['photos']['tmp_name'], '../../../../fitness_img/user/' . $filename)) {

                $filepath = '../../../../fitness_img/user/' . $filename;

                $remove = $pdo->prepare("SELECT picture FROM user_info WHERE user_id=:user_id LIMIT 1");
                $remove->bindParam(':user_id', $user_id);
                $remove->execute();
                $result_rm = $remove->fetch();
                if ($result_rm) {
                    $img = $result_rm["picture"];

                    $folderPath = '../../../../fitness_img/user/';

                    $filePath = $folderPath . $img;

                    if ($img == NULL) {

                        $update = $pdo->prepare("UPDATE user_info SET picture=:photos WHERE user_id=:user_id");
                        $update->bindParam(':photos', $filename);
                        $update->bindParam(':user_id', $user_id);
                        if ($update->execute()) {
                            echo "Image Updated Successfully";
                        } else {
                            echo "Error try again";
                        }
                    } else {
                        if (file_exists($filePath)) {
                            if (unlink($filePath)) {
                                $update = $pdo->prepare("UPDATE user_info SET picture=:photos WHERE user_id=:user_id");
                                $update->bindParam(':photos', $filename);
                                $update->bindParam(':user_id', $user_id);
                                if ($update->execute()) {
                                    echo "Image Updated Successfully";
                                } else {
                                    echo "Error try again";
                                }
                            } else {
                                echo "Error deleting the image.";
                            }
                        }
                    }
                }
            } else {
                $errors[] = 'Error moving uploaded file to the destination.';
            }
        } else {
            foreach ($errors as $err) {
                echo $err . "\n";
            }
        }
    }
    if($_POST["ero"]==='update_account'){
        $requiredFields = ['firstName', 'phone', 'birthday', 'height', 'weight'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                jsonResponse('Error', ucwords(str_replace('_', ' ', $field)) . ' is required.');
            }
        }
    
        // Sanitize and retrieve form data
        $full_name = htmlspecialchars($_POST['firstName']);
        $phone = htmlspecialchars($_POST['phone']);
        $birthday = htmlspecialchars($_POST['birthday']);
        $height = htmlspecialchars($_POST['height']);
        $weight = htmlspecialchars($_POST['weight']);
    
        // Perform additional validation
        $errors = [];
    
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
    
        // If there are errors, return them as JSON response
        if (!empty($errors)) {
            foreach ($errors as $error) {
                jsonResponse('Error', $error);
            }
        }
    
        // If all validations pass, proceed with database update
        try {
            // Assuming $pdo is your PDO connection
            $updateQuery = "UPDATE user_info 
                            SET full_name = :full_name, birthday = :birthday, phone = :phone, weight = :weight, height = :height 
                            WHERE user_id = :user_id";
            $stmt = $pdo->prepare($updateQuery);
            $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
            $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
            $stmt->bindParam(':height', $height, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                jsonResponse('Success', 'User information updated successfully');
            } else {
                jsonResponse('Error', 'Failed to update user information');
            }
    
        } catch (PDOException $e) {
            jsonResponse('Error', 'Database error: ' . $e->getMessage());
        }
      
    }
    if ($_POST["ero"] === 'weight_track') {
        $errors = [];

        // Validate weight
        if (isset($_POST['weight']) && is_numeric($_POST['weight']) && $_POST['weight'] > 0) {
            $weight = $_POST['weight'];
        } else {
            $errors[] = "Invalid weight value.";
        }

        // Validate file upload
        if (!empty($_FILES["photos"])) {
            if ($_FILES['photos']['error'] === UPLOAD_ERR_OK) {
                $filename = rand(111111, 999999) . uniqid() . ".png";
                $extension = pathinfo($_FILES['photos']['name'], PATHINFO_EXTENSION);

                $allowedTypes = array('jpg', 'png', 'jpeg');
                $maxSize = 2000000;

                if (in_array($extension, $allowedTypes)) {
                    if ($_FILES['photos']['size'] < $maxSize) {
                        if (!move_uploaded_file($_FILES['photos']['tmp_name'], '../../../../fitness_img/user/' . $filename)) {
                            $errors[] = 'Error moving uploaded file to the destination.';
                        }
                    } else {
                        $errors[] = 'File size exceeds the maximum limit.';
                    }
                } else {
                    $errors[] = 'Allowed files are jpg/png/jpeg.';
                }
            } else {
                $errors[] = 'Error uploading file.';
            }
        } else {
            $errors[] = "No image uploaded.";
        }

        // Validate subscription
        if (isset($_POST['id_subscription']) && is_numeric($_POST['id_subscription'])) {
            $id_subscription = $_POST['id_subscription'];
        } else {
            $errors[] = "Invalid subscription ID.";
        }

        if (empty($errors)) {
            try {
             

                $subscriptionQuery = "SELECT COUNT(*) FROM subscription WHERE user_id = :user_id AND id_subscription = :id_subscription";
                $stmt = $pdo->prepare($subscriptionQuery);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
                $stmt->execute();
                $subscriptionExists = $stmt->fetchColumn();

                if ($subscriptionExists) {
                    // Insert data into weight_track table
                    $track_date = date('Y-m-d H:i:s'); // Current date and time
                    $query = "INSERT INTO weight_track (user_id, weight, img, track_date, id_subscription) 
                              VALUES (:user_id, :weight, :img, :track_date, :id_subscription)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
                    $stmt->bindParam(':img', $filename, PDO::PARAM_STR);
                    $stmt->bindParam(':track_date', $track_date, PDO::PARAM_STR);
                    $stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        jsonResponse('Success', 'Weight and image added successfully');
                    } else {
                        jsonResponse('Error', 'Failed to add weight and image');
                    }
                } else {
                    jsonResponse('Error', 'User is not part of this subscription');
                }
            } catch (PDOException $e) {
                jsonResponse('Error', 'Database error: ' . $e->getMessage());
            }
        } else {
            jsonResponse('Error', 'Validation failed', $errors);
        }
    }

}

?>