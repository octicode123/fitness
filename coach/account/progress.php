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

    <title>Customer progress</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

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
               <div class="row">
                <div class="col-lg-7 col-md-7 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                          <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                              <img class="img-fluid rounded my-4" src="../assets/img/avatars/1.png" height="110" width="110" alt="User avatar">
                              <div class="user-info text-center">
                                <h4 class="mb-2">Violet Mendoza</h4>
                                <span class="badge bg-label-secondary">User</span>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                              <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
                              <div>
                                <h5 class="mb-0">1.23k</h5>
                                <span>Tasks Done</span>
                              </div>
                            </div>
                            <div class="d-flex align-items-start mt-3 gap-3">
                              <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
                              <div>
                                <h5 class="mb-0">568</h5>
                                <span>Projects Done</span>
                              </div>
                            </div>
                          </div>
                          <h5 class="pb-2 border-bottom mb-4">Details</h5>
                          <div class="info-container">
                            <ul class="list-unstyled">
                              <li class="mb-3">
                                <span class="fw-medium me-2">Full Name:</span>
                                <span>violet.dev</span>
                              </li>
                              <li class="mb-3">
                                <span class="fw-medium me-2">Email:</span>
                                <span>vafgot@vultukir.org</span>
                              </li>
                              <li class="mb-3">
                                <span class="fw-medium me-2">Status:</span>
                                <span class="badge bg-label-success">Active</span>
                              </li>
                              <li class="mb-3">
                                <span class="fw-medium me-2">Begin date:</span>
                                <span>26-07-2024</span>
                              </li>
                              
                            </ul>
                            <div class="d-flex justify-content-center pt-3">
                              <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                              <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="card ">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <h5 class="card-title m-0 me-2">Weight History</h5>
                          <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                              <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                              <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                              <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <i class='bx bx-plus h3'></i>
                                                          </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <small class="text-muted d-block mb-1">27-06-2024</small>
                                  <h6 class="mb-0"><i class='bx bxs-show'></i> body picture</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                  <h6 class="mb-0">82.6</h6>
                                  <span class="text-muted">KG</span>
                                </div>
                              </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <i class='bx bx-minus h3' ></i>                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">05-07-2024</small>
                                    <h6 class="mb-0"><i class='bx bxs-show'></i> body picture</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                  <h6 class="mb-0">80</h6>
                                  <span class="text-muted">KG</span>
                                </div>
                              </div>
                            </li>
                          
                         
                          </ul>
                        </div>
                      </div>
                </div>
               </div>
          



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
