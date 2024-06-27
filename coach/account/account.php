<?php require_once "./controller/security.php"; ?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Account settings - Account </title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/elements/ahm.jpg" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <?php include "header.php"; ?>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                  <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                </li>

              </ul>
              <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div id="picture"></div>
                <hr class="my-0" />
                <div class="card-body">
                  <?php
                  try {
                    $query = "SELECT * FROM coach_account WHERE user_id = :user_id";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->execute();
                    $account = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($account) {
                  ?>
                      <form id="update" method="POST" onsubmit="return false;">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Full Name</label>
                            <input class="form-control" type="text" id="firstName" name="full_name" value="<?php echo htmlspecialchars($account['full_name']); ?>" autofocus />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Phone No</label>
                            <input class="form-control" type="text" name="phone" id="lastName" value="<?php echo htmlspecialchars($account['phone']); ?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="language" class="form-label">Domain</label>
                            <select id="language" class="select2 form-select" name="domain">
                              <option value="Bodybuilding" <?php if ($account['domain'] === 'Bodybuilding') echo 'selected'; ?>>Bodybuilding</option>
                              <option value="Powerlifting" <?php if ($account['domain'] === 'Powerlifting') echo 'selected'; ?>>Powerlifting</option>
                              <option value="Cardio" <?php if ($account['domain'] === 'Cardio') echo 'selected'; ?>>Cardio</option>
                              <option value="Crossfit" <?php if ($account['domain'] === 'Crossfit') echo 'selected'; ?>>Crossfit</option>
                              <option value="Boxing" <?php if ($account['domain'] === 'Boxing') echo 'selected'; ?>>Boxing</option>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">City</label>
                            <input type="text" class="form-control" id="email" name="city" value="<?php echo htmlspecialchars($account['city']); ?>" placeholder="Enter your city" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($account['zipcode']); ?>" placeholder="Zip code" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($account['state']); ?>" placeholder="State" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($account['country']); ?>" placeholder="Country" />
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">About me</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="about_me" rows="3"><?php echo htmlspecialchars($account['about_me']); ?></textarea>
                          </div>
                          <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                          </div>
                        </div>
                      </form>
                  <?php


                    }
                  } catch (PDOException $e) {
                    echo 'Database error: ' . $e->getMessage();
                  }
                  ?>

                </div>
                <!-- /Account -->
              </div>

            </div>
          </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <?php include "footer.php"; ?>

        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->



  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/sweet.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/pages-account-settings-account.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
<script>
  profile_img()

  function profile_img() {
    var formData = new FormData();
    formData.append('ero', 'profile_img');

    fetch('controller/account-settings.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(message => {
        document.getElementById('picture').innerHTML = message;

        var UpIm = document.getElementById("UpIm");
        UpIm.addEventListener('submit', handleImageUpload);
      })
      .catch(error => {
        console.error('Error:', error);
        swal("Error", "An error occurred while processing your request", "error");
      });

    function handleImageUpload(event) {
      event.preventDefault();
      var formData = new FormData(UpIm);
      formData.append('ero', 'img_u');

      fetch('controller/account-settings.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(message => {
          swal(message);
          profile_img();
        })
        .catch(error => {
          console.error('Error:', error);
          swal("Error", "An error occurred while uploading the image", "error");
        });
    }
  }


var update = document.getElementById('update');
update.addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(update);
    formData.append('ero', 'update_account');

    fetch('controller/account-settings.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

    
        if (data.status === 'Success') {
            swal("Good Job", data.message, "success");
            
        } else if (data.status === 'Error') {
            swal("Opps!", data.message, "warning");
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

});
</script>