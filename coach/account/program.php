<?php
require_once "./controller/security.php";
?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Program</title>

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


                    <div class="card">
                        <h5 class="card-header">Program</h5>
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                Please add some exercises for sets and reps. They will be customized for each
                                customer.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <form id="programADD" method="POST"> 
                            <div class="row mb-3 mt-3">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-3">
                                        <label for="defaultSelect" class="form-label">Select your client *</label>
                                        <select id="defaultSelect" class="form-select" name="customer">
                                            <?php
                                            $customer = $pdo->prepare("SELECT s.*,u.* FROM subscription as s INNER JOIN user_info as u ON s.user_id=u.user_id WHERE s.coach_id=:coach_id ");
                                            $customer->bindParam(':coach_id', $coach_id);
                                            $customer->execute();
                                            $result_customer = $customer->fetchAll();
                                            if (count($result_customer) > 0) {

                                                foreach ($result_customer as $row) { ?>
                                                    <option value="<?php echo $row["user_id"]; ?>"><?php echo $row["full_name"]; ?></option>


                                            <?php

                                                }
                                            } else {
                                                echo "you don't have any customer now";
                                            }
                                            ?>
                                        </select>
                                    </div>



                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-3">
                                        <label for="defaultSelect" class="form-label">Day *</label>
                                        <select id="defaultSelect" class="form-select" name="day_of_week">
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>

                                        </select>
                                    </div>



                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Program Name *</label>
                                        <input type="text" class="form-control" id="email" name="title" value="push-pull-leg" placeholder="Program name" />
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Duration (approximately)*</label>


                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" name="duration" value="60" placeholder="30,60......" aria-label="Recipient's username" aria-describedby="basic-addon33">
                                            <span class="input-group-text" id="basic-addon33">Minute</span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <?php

                                ?>
                                <?php
                                $exercices = $pdo->prepare("SELECT * FROM exercises WHERE coach_id=:coach_id ");
                                $exercices->bindParam(':coach_id', $coach_id);
                                $exercices->execute();
                                $result_exercices = $exercices->fetchAll();
                                if (count($result_exercices) > 0) {

                                    foreach ($result_exercices as $row) { ?>

                                        <!--exercice-->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox" name="exercise_id[]" value="<?php echo $row["id_exercise"]; ?>" aria-label="Checkbox for following text input">
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo $row["title"]; ?>" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="exampleFormControlInput1" name="sets[]" placeholder="sets">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="exampleFormControlInput1" name="reps[]" placeholder="reps">
                                            </div>
                                        </div>
                                        <!--exercice end-->
                                <?php

                                    }
                                } else {
                                    echo "you don't have any customer now";
                                }
                                ?>

                                

                                <div class="text-end mt-3 mb-3">
                                    <button type="button" onclick="addMakeUp()" class="btn btn-primary">+ Add Meal</button>
                                </div>
                                <div id="food"></div>


                                <button class="btn btn-success">Submit</button>
                            </div>
                            </form>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            
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
    let dynamicElementCounter = 0;

    function addMakeUp() {

        const dynamicHTML = `
<div id="make${dynamicElementCounter}">
<div class="text-end mt-3 mb-3">
       <button type="button" onclick="addMeal('${dynamicElementCounter}')" class="btn btn-info">Add dish for meal ${dynamicElementCounter + 1}</button>
 </div>
<h3 class='text-danger'>Meal ${dynamicElementCounter + 1} </h3>
<div class="mb-3 row mt-3" id="meal${dynamicElementCounter}">





</div> 


<hr>
</div>
`;


        const dynamicContentContainer = document.getElementById('food');

        const newDiv = document.createElement('div');
        newDiv.innerHTML = dynamicHTML;
        dynamicContentContainer.appendChild(newDiv);
        dynamicElementCounter++;

    }

    let dynamicElementCounter1 = 0;

    function addMeal(id) {

        const dynamicHTML = `
        <div class="row mb-3" id="xxx${dynamicElementCounter1}">
            <div class="col-lg-4 col-md-4 col-12">
        <label for="html5-time-input" class="form-label">dish Name</label>
        <input class="form-control" type="text" name="meal_name${id}[]"  id="html5-time-input">
    </div>
    <div class="col-lg-3 col-md-4 col-12">
        <label for="html5-time-input" class="form-label">dish portion in g</label>
        <input class="form-control" type="number" name="meal_portion${id}[]"  id="html5-time-input">
    </div>
    <div class="col-lg-3 col-md-4 col-12">
        <label for="html5-time-input" class="form-label">Kcal per 100 g</label>
        <input class="form-control" type="number" name="meal_kcal${id}[]"  id="html5-time-input">
    </div>
    <div class="col-lg-2 col-md-2 col-12">
        <label for="html5-time-input" class="form-label"></label>

        <button type="button" onclick="removemakeup(${dynamicElementCounter1})" class="btn btn-danger form-control">Remove</button>
    </div>
     </div>

`;


        const dynamicContentContainer = document.getElementById('meal' + id);

        const newDiv = document.createElement('div');
        newDiv.innerHTML = dynamicHTML;
        dynamicContentContainer.appendChild(newDiv);
        dynamicElementCounter1++;

    }

    function removemakeup(xx) {

        document.getElementById("xxx" + xx).remove();

    }

    var programADD = document.getElementById('programADD');
    programADD.addEventListener('submit', function(e) {
      event.preventDefault();
      var formData = new FormData(programADD);
      formData.append('ero', 'add_program');

      fetch('controller/program.php', {
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
          swal("Error", "An error occurred ", "error");
        });
    });
</script>