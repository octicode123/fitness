<?php require_once "./controller/security.php";
if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["id_subscription"])){
  $coach_id=htmlspecialchars($_GET["id"]);
  $id_subscription=htmlspecialchars($_GET["id_subscription"]);

?>
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

        <div class="container-fluid flex-grow-1 container-p-y">
          <!-- Layout Demo -->
         
     
                  <div class="row">

                    <?php
                    $program = $pdo->prepare("SELECT * FROM training_program WHERE coach_id=:coach_id and user_id=:user_id");
                    $program->bindParam(':coach_id', $coach_id);
                    $program->bindParam(':user_id', $user_id);
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
                        <div class="col-lg-3 col-12 mb-3">
                          <div class="card">
                            <div class="body">
                              <div class="p-3" data-eid="in-progress-1" data-comments="12" data-badge-text="UX" data-badge="success" data-due-date="5 April" data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                  <div class="item-badges">
                                    <div class="badge rounded-pill <?php echo $class; ?>"><?php echo $dayOfWeek; ?></div>

                                  </div>
                                  <div class="dropdown kanban-tasks-item-dropdown"><i class="dropdown-toggle bx bx-dots-vertical-rounded" id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item" href="program.php?id=<?php echo $row["id_training"]; ?>" target="_blank">View Program</a></div>
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
                      echo "<h3 class='text-danger text-center'>you don't have any program yet</h3>";
                    }
                    ?>






                  
              </div>
              <div class="card">
                <div class="card-header h3"> Weight track

                </div>
                <div class="card-body">

            <form id="add_weight" method="POST" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-lg-4 col-12">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Weight</label>
                        <input type="text" class="form-control" name="weight" id="exampleFormControlInput1" >
                      </div>
                    </div>
                    <div class="col-lg-8 col-12">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" id="upload"  accept="image/png, image/jpeg ,image/jpg" name="photos">
                    </div>
                      </div>
                      <input type="hidden" name="id_subscription" value="<?php echo $id_subscription; ?>"  >

                      <div class="text-center">
                      <button class="btn btn-success w-50 text-center" type="submit">Add Weight</button>

                      </div>
                  </div>
                  </form>

                </div>
              </div>

              <div class="card mt-3">
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
                        $track->bindParam(':id_subscription', $id_subscription);
                        $track->bindParam(':user_id', $user_id);
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
  <script src="../assets/js/sweet.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
<script>
        var add_weight = document.getElementById("add_weight");
        add_weight.addEventListener('submit', handleImageUpload);



        function handleImageUpload(event) {
    event.preventDefault();

    var formData = new FormData(add_weight);
    formData.append('ero', 'weight_track');

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
      })
      .catch(error => {
        console.error('Error:', error);
        swal("Error", "An error occurred while uploading the image", "error");
      });
  }
  function img(imageUrl) {
        var modalImage = document.getElementById('modalImage');
        modalImage.src = "../../../fitness_img/user/" + imageUrl;
      }
</script>
<?php
}else{
  header('location :index.php');
}
?>

