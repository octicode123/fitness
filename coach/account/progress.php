<?php
require_once "./controller/security.php";
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id_customer = htmlspecialchars($_GET["id"]);
  $customer = $pdo->prepare("SELECT s.*,u.* FROM subscription as s INNER JOIN user_info as u ON s.user_id=u.user_id WHERE s.coach_id=:coach_id and s.user_id=:user_id LIMIT 1 ");
  $customer->bindParam(':coach_id', $coach_id);
  $customer->bindParam(':user_id', $id_customer);

  $customer->execute();
  $result_customer = $customer->fetch();
  if ($result_customer) {
    if ($result_customer["picture"] == NULL) {
      $path = "../assets/img/avatars/1.png";
    } else {
      $path = "../../../../fitness_img/user/" . $result_customer["picture"];
    }
?>
    <!DOCTYPE html>


    <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title>Customer progress</title>

      <meta name="description" content="" />

      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

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

            <div class="container-fluid flex-grow-1 container-p-y">
              <!-- Layout Demo -->
              <div class="row">
                <div class="col-lg-7 col-md-7 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                          <img class="img-fluid rounded my-4" src="<?php echo $path; ?>" height="110" width="110" alt="User avatar">
                          <div class="user-info text-center">
                            <h4 class="mb-2"><?php echo $result_customer["full_name"]; ?></h4>
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
                      <div id="details_customer"></div>

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
                        <?php
                        $track = $pdo->prepare("SELECT * FROM weight_track WHERE id_subscription=:id_subscription and user_id=:user_id");
                        $track->bindParam(':id_subscription', $result_customer["id_subscription"]);
                        $track->bindParam(':user_id', $id_customer);
                        $track->execute();
                        $result_track = $track->fetchAll();
                        if (count($result_track) > 0) {
                          foreach ($result_track as $track) {
                        ?>
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <i class='bx bx-plus h3'></i>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <small class="text-muted d-block mb-1"><?php echo $track["track_date"]; ?></small>
                                  <h6 class="mb-0"><i class='bx bxs-show' onclick="img('<?php echo $track['img']; ?>')" data-bs-toggle="modal" data-bs-target="#modalCenter"></i> body picture</h6>
                                  <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="modalCenterTitle">picture</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <img id="modalImage" src="" alt="Image" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                  <h6 class="mb-0"><?php echo $track["weight"]; ?></h6>
                                  <span class="text-muted">KG</span>
                                </div>
                              </div>
                            </li>
                        <?php
                          }
                        } else {
                          echo "No added data by client";
                        }

                        ?>



                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header h3 text-primary">Program</div>
                <div class="card-body">
                  <div class="row">

                    <?php
                    $program = $pdo->prepare("SELECT * FROM training_program WHERE coach_id=:coach_id and user_id=:user_id");
                    $program->bindParam(':coach_id', $coach_id);
                    $program->bindParam(':user_id', $id_customer);
                    $program->execute();
                    $result_program = $program->fetchAll();
                    if (count($result_program) > 0) {

                      $classMap = [
                        'Monday' => 'bg-label-success',
                        'Tuesday' => 'bg-label-info',
                        'Wednesday' => 'bg-label-primary',
                        'Thursday' => 'bg-label-warning',
                        'Friday' => 'bg-label-danger',
                        'Saturday' => 'bg-label-secondary',
                        'Sunday' => 'bg-label-dark',
                      ];

                      $defaultClass = 'bg-label-secondary';

                      foreach ($result_program as $row) {
                        $dayOfWeek = ucfirst($row["day_of_week"]);

                        $class = isset($classMap[$dayOfWeek]) ? $classMap[$dayOfWeek] : $defaultClass;
                    ?>
                        <div class="col-lg-3 col-6 mb-3">
                          <div class="card">
                            <div class="body">
                              <div class="p-3" data-eid="in-progress-1" data-comments="12" data-badge-text="UX" data-badge="success" data-due-date="5 April" data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                  <div class="item-badges">
                                    <div class="badge rounded-pill <?php echo $class; ?>"><?php echo $dayOfWeek; ?></div>

                                  </div>
                                  <div class="dropdown kanban-tasks-item-dropdown"><i class="dropdown-toggle bx bx-dots-vertical-rounded" id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item" href="program-details.php?id=<?php echo $row["id_training"]; ?>" target="_blank">View Program</a></div>
                                  </div>
                                </div><span class="kanban-text"><?php echo $row["title"]; ?></span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                  <div class="d-flex"> <span class="d-flex align-items-center me-2"><i class='bx bx-food-menu'></i>
                                      <span class="attachments"></span></span>
                                    <span class="d-flex align-items-center"><i class='bx bx-run'></i> </span></span>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php
                      }
                    } else {
                      echo "<h3 class='text-danger text-center'>you didn't add any program fot this client</h3>";
                    }
                    ?>






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
      <script src="../assets/js/sweet.js"></script>

      <!-- Page JS -->

      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>

    </html>
    <script>
      var customer_id = '<?php echo $id_customer; ?>';
      customers(customer_id)

      function customers(customer_id) {
        var formData = new FormData();
        formData.append('ero', 'customer_details');
        formData.append('customer_id', customer_id);

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
            document.getElementById('details_customer').innerHTML = message;


          })
          .catch(error => {
            console.error('Error:', error);
            swal("Error", "An error occurred while processing your request", "error");
          });


      }

      function accept(id_subscription) {
        if (id_subscription != null) {
          swal({
              title: "Are you sure?",
              text: "Once accepted, you will not be able to cancell this order!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                var formData = new FormData();
                formData.append('ero', 'accept_subscription');
                formData.append('id_subscription', id_subscription);


                fetch('controller/customer.php', {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json())
                  .then(data => {
                    if (data.status === 'Success') {
                      swal("Good Job", data.message, "success");
                      customers(customer_id)

                    } else if (data.status === 'Error') {
                      swal("Opps!", data.message, "warning");
                    }
                  })
                  .catch(error => {
                    console.error('Error:', error);
                  });

              } else {
                swal("OK!");
              }
            });
        }

      }


      function deny(id_subscription) {
        if (id_subscription != null) {
          swal({
              title: "Are you sure?",
              text: "Once denied, you will not be able to accept this order!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                var formData = new FormData();
                formData.append('ero', 'deny_subscription');
                formData.append('id_subscription', id_subscription);


                fetch('controller/customer.php', {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json())
                  .then(data => {
                    if (data.status === 'Success') {
                      swal("Good Job", data.message, "success");
                      customers(customer_id)

                    } else if (data.status === 'Error') {
                      swal("Opps!", data.message, "warning");
                    }
                  })
                  .catch(error => {
                    console.error('Error:', error);
                  });

              } else {
                swal("OK!");
              }
            });
        }

      }

      function end_training(id_subscription) {
        if (id_subscription != null) {
          swal({
              title: "Are you sure?",
              text: "Once ended, you will not be able to change the status to this order!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                var formData = new FormData();
                formData.append('ero', 'end_subscription');
                formData.append('id_subscription', id_subscription);


                fetch('controller/customer.php', {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json())
                  .then(data => {
                    if (data.status === 'Success') {
                      swal("Good Job", data.message, "success");
                      customers(customer_id)

                    } else if (data.status === 'Error') {
                      swal("Opps!", data.message, "warning");
                    }
                  })
                  .catch(error => {
                    console.error('Error:', error);
                  });

              } else {
                swal("OK!");
              }
            });
        }

      }

      function img(imageUrl) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = "../../../fitness_img/user/" + imageUrl;
      }
    </script>
<?php
  } else {
    header('location: index.php');
  }
} else {
  header('location: index.php');
}
?>