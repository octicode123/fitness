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
        $account = $pdo->prepare("SELECT picture FROM coach_account WHERE user_id=:user_id LIMIT 1");
        $account->bindParam(':user_id', $user_id);
        $account->execute();
        $result = $account->fetch();
        if ($result["picture"] == NULL) {
            $path = "../assets/img/avatars/1.png";
        } else {
            $path = "../../../../fitness_img/coach/" . $result["picture"];
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
            if (move_uploaded_file($_FILES['photos']['tmp_name'], '../../../../fitness_img/coach/' . $filename)) {

                $filepath = '../../../../fitness_img/coach/' . $filename;

                $remove = $pdo->prepare("SELECT picture FROM coach_account WHERE user_id=:user_id LIMIT 1");
                $remove->bindParam(':user_id', $user_id);
                $remove->execute();
                $result_rm = $remove->fetch();
                if ($result_rm) {
                    $img = $result_rm["picture"];

                    $folderPath = '../../../../fitness_img/coach/';

                    $filePath = $folderPath . $img;

                    if ($img == NULL) {

                        $update = $pdo->prepare("UPDATE coach_account SET picture=:photos WHERE user_id=:user_id");
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
                                $update = $pdo->prepare("UPDATE coach_account SET picture=:photos WHERE user_id=:user_id");
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
            if (   isset($_POST['full_name']) && !empty($_POST['full_name'])
                && isset($_POST['phone']) && !empty($_POST['phone'])
                && isset($_POST['domain']) && !empty($_POST['domain'])
                && isset($_POST['city']) && !empty($_POST['city'])
                && isset($_POST['zip_code']) && !empty($_POST['zip_code'])
                && isset($_POST['state']) && !empty($_POST['state'])
                && isset($_POST['country']) && !empty($_POST['country'])
                && isset($_POST['about_me']) && !empty($_POST['about_me'])) {
    
                // Sanitize and validate input data
                $full_name = filter_var($_POST['full_name']);
                $phone = filter_var($_POST['phone']);
                $domain = filter_var($_POST['domain']);
                $city = filter_var($_POST['city']);
                $zip_code = filter_var($_POST['zip_code']);
                $state = filter_var($_POST['state']);
                $country = filter_var($_POST['country']);
                $about_me = filter_var($_POST['about_me']);
    
                // Prepare SQL statement to update coach_account
                $query = "UPDATE coach_account SET
                            full_name = :full_name,
                            phone = :phone,
                            domain = :domain,
                            city = :city,
                            zipcode = :zipcode,
                            state = :state,
                            country = :country,
                            about_me = :about_me
                          WHERE user_id = :user_id";
                
                $stmt = $pdo->prepare($query);
    
                // Bind parameters
                $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
                $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmt->bindParam(':domain', $domain, PDO::PARAM_STR);
                $stmt->bindParam(':city', $city, PDO::PARAM_STR);
                $stmt->bindParam(':zipcode', $zip_code, PDO::PARAM_STR);
                $stmt->bindParam(':state', $state, PDO::PARAM_STR);
                $stmt->bindParam(':country', $country, PDO::PARAM_STR);
                $stmt->bindParam(':about_me', $about_me, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
                if ($stmt->execute()) {
                    jsonResponse('Success', 'Coach account updated successfully');

                } else {
                    jsonResponse('Error', 'Error please try again');

                }
            } else {
                jsonResponse('Error', 'All the fields are required');

            }
      
    }

}

?>