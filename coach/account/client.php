<?php
require_once "./controller/security.php";
?>
<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>My customers</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/elements/ahm.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

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

            <div class="container-fluid flex-grow-1 container-p-y">
              <!-- Layout Demo -->
                           <!-- Basic Bootstrap Table -->
                           <div class="card">
                            <h5 class="card-header">Customers</h5>
                            <div class="table-responsive text-nowrap">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Client</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody class="table-border-bottom-0" id="data">
                                
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!--/ Basic Bootstrap Table -->
              <!--/ Layout Demo -->
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

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<script>
  customers()
    function customers() {
    var formData = new FormData();
    formData.append('ero', 'customer');

    fetch('./controller/customer.php', {
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
        document.getElementById('data').innerHTML = message;

      
      })
      .catch(error => {
        console.error('Error:', error);
        swal("Error", "An error occurred while processing your request", "error");
      });

   
  }

</script>