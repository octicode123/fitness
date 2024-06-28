<?php
require_once "./controller/security.php";
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id_training = htmlspecialchars($_GET["id"]);

  $program=$pdo->prepare("SELECT * FROM training_program WHERE id_training=:id_training and user_id=:user_id LIMIT 1");
  $program->bindParam(':user_id',$user_id);
  $program->bindParam(':id_training',$id_training);
  $program->execute();
  $result=$program->fetch();
  if($result){
    $exercices=$pdo->prepare("SELECT tr.*,e.* FROM exercice_training_program as tr 
INNER JOIN exercises AS e ON tr.id_exercice=e.id_exercise
 WHERE tr.id_training=:id_training");
 $exercices->bindParam(':id_training',$id_training);
 $exercices->execute();
 $result_exercices=$exercices->fetchAll();
    ?>

  
    <!DOCTYPE html>


    <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
        data-template="vertical-menu-template-free">
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    
        <title>Program</title>
    
        <meta name="description" content="" />
    
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="../assets/img/elements/ahm.jpg" />
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />
    
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
                            <div class="card g-3 mt-5">
      <div class="card-body row g-3">
        <div class="col-lg-6">
          <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
            <div class="me-1">
              <h5 class="mb-1"><?php echo strtoupper($result["title"]); ?></h5>
              <p class="mb-1">Coaching Program <span class="fw-medium"></span></p>
            </div>
            <div class="d-flex align-items-center">
              <span class="badge bg-label-danger"><?php echo strtoupper($result["day_of_week"]); ?></span>
              <i class="bx bx-share-alt bx-sm mx-4"></i>
              <i class="bx bx-bookmarks bx-sm"></i>
            </div>
          </div>
          <div class="card academy-content shadow-none border">
            <div class="p-2">
             
            </div>
            <div class="card-body">
              
              <h5>By the numbers</h5>
              <div class="d-flex flex-wrap">
                <div class="me-5">
                  <p class="text-nowrap"><i class="bx bx-check-double bx-sm me-2"></i>Skill level: All Levels</p>
                  <p class="text-nowrap"><i class='bx bx-run me-2' ></i>Exercices: <?php echo count($result_exercices); ?></p>
                  <p class="text-nowrap"><i class='bx bx-target-lock me-2' ></i>Targeted muscle: chest</p>
                </div>
                
              </div>
              
             
            </div>
          </div>
        </div>
        <div class="col-lg-6">
            <h5>Exercices</h5>
          <div class="accordion stick-top accordion-bordered course-content-fixed" id="courseContent">
<?php

 if(count($result_exercices)>0){
  $i=0;
  foreach($result_exercices as $row){


?>
    <div class="accordion-item shadow-none border border-bottom-0 mb-0">
              <div class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button bg-lighter rounded-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chapterOne<?php echo $i; ?>" aria-expanded="false" aria-controls="chapterOne1<?php echo $i; ?>">
                  <span class="d-flex flex-column">
                    <span class="h5 mb-1"><?php echo $row["title"]; ?></span>
                    <span class="fw-normal"><?php echo $row["reps"]; ?> reps | <?php echo $row["sets"]; ?> sets</span>
                  </span>
                </button>
              </div>
              <div id="chapterOne<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
                <div class="accordion-body py-3 border-top">
                  <div class="form-check d-flex align-items-center mb-3">
                    <label for="defaultCheck1" class="form-check-label ">
                      <span class="mb-0 h6">Description :<?php echo $row["description"]; ?></span>
                      <span class="text-muted d-block">Target Muscle : <?php echo strtoupper($row["target_muscle"]); ?></span>
                      <span class="text-muted d-block">Youtube video: <a href="<?php echo $row["yt_video"]; ?>" target="_blank"><?php echo $row["yt_video"]; ?></a></span>
    
                    </label>
                  </div>
                 
    
                  
                </div>
              </div>
            </div>
<?php
$i++;
  }
 }else{
  echo "no exercices";
 }
?>
        
            
           
          </div>
        </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        <div class="col-lg-12">
            <h4>Nutrition</h4>
          <div class="accordion stick-top accordion-bordered course-content-fixed" id="courseContent">

          <?php
$nutrition=$pdo->prepare("SELECT nu.*,f.* FROM nutrition_training_program as nu
INNER JOIN nutrition AS f ON nu.id_nutrition=f.id_nutrition
 WHERE nu.id_training=:id_training");
 $nutrition->bindParam(':id_training',$id_training);
 $nutrition->execute();
 $result_nutrition=$nutrition->fetchAll();
 if(count($result_nutrition)>0){
  $i=0;
  foreach($result_nutrition as $row){
    $food=$pdo->prepare("SELECT *  FROM nutrition_food WHERE id_nutrition=:id_nutrition");
    $food->bindParam(':id_nutrition',$row["id_nutrition"]);
    $food->execute();
    $food_result=$food->fetchAll();
    if(count($food_result)>0){
      $kcal=0;
      foreach($food_result as $fd){
$kcal+=($fd["weight"]*$fd["kcal"])/100;
      }}
    

?>
 <div class="accordion-item shadow-none border border-bottom-0 mb-0">
              <div class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button bg-lighter rounded-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chapter1<?php echo $i; ?>" aria-expanded="false" aria-controls="chapter1<?php echo $i; ?>">
                  <span class="d-flex flex-column">
                    <span class="h5 mb-1">Meal 1</span>
                    <span class="fw-normal"><?php echo count($food_result); ?> compenents | <?php echo $kcal; ?> kcal</span>
                  </span>
                </button>
              </div>
              <div id="chapter1<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
                <div class="accordion-body py-3 border-top">
                  <?php 
                   
                   if(count($food_result)>0){
                    foreach($food_result as $fd){

                   
                    ?>
               
               <div class="form-check d-flex align-items-center mb-3">
                    <label for="defaultCheck1" class="form-check-label ms-3">
                      <span class="mb-0 h6"><?php echo $fd["food_name"]; ?></span>
                      <span class="text-muted d-block">Portion : <?php echo $fd["weight"]; ?> g</span>
                      <span class="text-muted d-block">kcal per 100 g : <?php echo $fd["kcal"]; ?> kcal</span>
    
                    </label>
                  </div>
               <?php
                }
                   }else{
                     echo "There is no food for this meal";
                   }
                  ?>
                  
                  
                
                </div>
              </div>
            </div>
<?php
$i++;
  }}else{
  }


?>
           
       
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
            <input class="form-control" type="text" name="meal_name"  id="html5-time-input">
        </div>
        <div class="col-lg-3 col-md-4 col-12">
            <label for="html5-time-input" class="form-label">dish portion in g</label>
            <input class="form-control" type="number" name="meal_portion"  id="html5-time-input">
        </div>
        <div class="col-lg-3 col-md-4 col-12">
            <label for="html5-time-input" class="form-label">Kcal per 100 g</label>
            <input class="form-control" type="number" name="meal_kcal"  id="html5-time-input">
        </div>
        <div class="col-lg-2 col-md-2 col-12">
            <label for="html5-time-input" class="form-label"></label>
    
            <button type="button" onclick="removemakeup(${dynamicElementCounter1})" class="btn btn-danger form-control">Remove</button>
        </div>
         </div>
    
    `;
    
    
            const dynamicContentContainer = document.getElementById('meal'+id);
    
            const newDiv = document.createElement('div');
            newDiv.innerHTML = dynamicHTML;
            dynamicContentContainer.appendChild(newDiv);
            dynamicElementCounter1++;
    
        }
    
        function removemakeup(xx) {
    
    document.getElementById("xxx" + xx).remove();
    
    }
    </script><?php

  }else{
    header('location: index.php');

  }



}else{
  header('location: index.php');

}
  ?>

