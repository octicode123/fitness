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

    <title>Exercices</title>

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
            

                           <div class="card">
                            <h5 class="card-header">Exercices</h5>
                            <div class="card-body">
                              <div class="alert alert-warning alert-dismissible" role="alert">
                                Please add some exercises for sets and reps. They will be customized for each customer.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              <form id="add_exercice" method="POST">
                              <div class="row mb-3 mt-3">
                                <div class="col-lg-4 col-md-4 col-12">
                                  <div class="mb-3">
                                    <label for="email" class="form-label">Title *</label>
                                    <input type="text" class="form-control" id="email" name="title" placeholder="exercice name" />
                                  </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                  <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">Target muscle *</label>
                                    <select id="defaultSelect" class="form-select" name="target_muscle">
                                      <option value="upper chest">Upper chest</option>
                                      <option value="lower chest">Lower chest</option>
                                      <option value="middle chest">Middle chest</option>
                                      <option value="biceps">Biceps</option>
                                      <option value="triceps">Triceps</option>
                                      <option value="anterior deltoid">Anterior deltoid (front shoulder)</option>
                                      <option value="lateral deltoid">Lateral deltoid (side shoulder)</option>
                                      <option value="posterior deltoid">Posterior deltoid (rear shoulder)</option>
                                      <option value="upper back">Upper back</option>
                                      <option value="lower back">Lower back</option>
                                      <option value="lats">Lats</option>
                                      <option value="traps">Traps</option>
                                      <option value="quadriceps">Quadriceps</option>
                                      <option value="hamstrings">Hamstrings</option>
                                      <option value="glutes">Glutes</option>
                                      <option value="calves">Calves</option>
                                      <option value="abdominals">Abdominals</option>
                                      <option value="obliques">Obliques</option>
                                      <option value="forearms">Forearms</option>
                                      <option value="adductors">Adductors</option>
                                      <option value="abductors">Abductors</option>
                                      <option value="Full Body">Full Body</option>

                                    </select>
                                  </div>   
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                  <div class="mb-3">
                                    <label for="email" class="form-label">Youtube Video</label>
                                    <input type="text" class="form-control" id="email" name="yt_video" placeholder="youtube video link" />
                                  </div>

                                </div>
                                <div class="col-12">
                                  
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Description and instructions *</label>
                                    <textarea id="basic-default-message" class="form-control" name="description"  style="height: 100px;"></textarea>
                                  </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                  

                                </div>
                                <button class="btn btn-success">Submit</button>
                              </div>
                              </form>
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
    <script src="../assets/js/sweet.js"></script>

    
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

    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<script>
  document.getElementById('add_exercice').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    formData.append('ero', 'add_exercice');


    fetch('./controller/program.php', {
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
