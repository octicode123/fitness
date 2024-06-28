<?php require_once "./controller/security.php"; ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>My customers</title>

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
<?php
 $coach = $pdo->prepare("SELECT s.*,c.* FROM subscription as s 
 INNER JOIN coach_account as c ON s.coach_id=c.coach_id  
 WHERE s.user_id=:user_id");
           $coach->bindParam(':user_id', $user_id);
           $coach->execute();
           $result = $coach->fetchAll();

?>
        <div class="container-fluid flex-grow-1 container-p-y">
          <!-- Layout Demo -->
          <div class="card mb-4">
            <div class="card-header d-flex flex-wrap justify-content-between gap-3">
              <div class="card-title mb-0 me-1">
                <h5 class="mb-1">My coachs</h5>
                <p class="text-muted mb-0">Total <?php echo count($result); ?> coachs you have hired</p>
              </div>

            </div>
            <div class="card-body">
              <div class="row gy-4 mb-4">

                <?php
               
                if (count($result) == 0) {
                  echo "you don't have any coach now ";
                } else {
                  foreach ($result as $row) {
                ?>
                    <div class="col-sm-6 col-lg-4">
                      <div class="card p-2 h-100 shadow-none border">
                        <div class="rounded-2 text-center mb-3">
                          <a href="#"><img class="img-fluid" src="../../../fitness_img/coach/<?php echo $row["picture"]; ?>" alt="tutor image 1"></a>
                        </div>
                        <div class="card-body p-3 pt-2">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <?php
                            switch ($row["status"]) {
                              case 'pending':
                                echo "<span class=\"badge bg-label-warning me-1\">Pending</span>";
                                break;
                              case 'cancelled':
                                echo "<span class=\"badge bg-label-danger me-1\">Cancelled</span>";
                                break;
                              case 'accepted':
                                echo "<span class=\"badge bg-label-success me-1\">accepted</span>";
                                break;
                              case 'end':
                                echo "<span class=\"badge bg-label-danger me-1\">end of training</span>";
                                break;
                            }
                            ?> <h6 class="d-flex align-items-center justify-content-center gap-1 mb-0">
                              5 <span class="text-warning"><i class="bx bxs-star me-1"></i></span><span class="text-muted">(1.23k)</span>
                            </h6>
                          </div>
                          <a href="#" class="h5"><?php echo $row["full_name"]; ?></a>
                          <p class="mt-2"><?php echo $row["about_me"]; ?></p>
                          <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i><?php echo $row["sub_date"]; ?></p>

                          <div class="d-flex flex-column flex-md-row gap-2 text-nowrap pe-xl-3 pe-xxl-0">
                            <a class="app-academy-md-50 btn btn-label-secondary me-md-2 d-flex align-items-center" onclick="cancell()">
                              <i class="bx bx-sync align-middle me-2 "></i><span>Cancel</span>
                            </a>
                            <a class=" btn btn-label-primary d-flex align-items-center" href="coach-program.php?id=<?php echo $row["coach_id"]; ?>">
                              <span class="me-2">Continue</span><i class="bx bx-chevron-right lh-1 scaleX-n1-rtl"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php
                  }
                }
                ?>





              </div>

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
  function cancel() {
    alert("you can't cancel this");
  }
</script>