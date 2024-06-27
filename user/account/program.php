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
          <h5 class="mb-1">Push day</h5>
          <p class="mb-1">Coach. <span class="fw-medium"> Amine Ait Bella </span></p>
        </div>
        <div class="d-flex align-items-center">
          <span class="badge bg-label-danger">Monday</span>
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
              <p class="text-nowrap"><i class='bx bx-run me-2' ></i>Exercices: 38,815</p>
              <p class="text-nowrap"><i class='bx bx-target-lock me-2' ></i>Targeted muscle: chest</p>
            </div>
            
          </div>
          
         
        </div>
      </div>
    </div>
    <div class="col-lg-6">
        <h5>Exercices</h5>
      <div class="accordion stick-top accordion-bordered course-content-fixed" id="courseContent">
        <div class="accordion-item shadow-none border border-bottom-0 mb-0">
          <div class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button bg-lighter rounded-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chapterOne" aria-expanded="false" aria-controls="chapterOne">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Incline chest</span>
                <span class="fw-normal">5 reps | 12 sets</span>
              </span>
            </button>
          </div>
          <div id="chapterOne" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <label for="defaultCheck1" class="form-check-label ">
                  <span class="mb-0 h6">Description :testtestestt</span>
                  <span class="text-muted d-block">target Muscle : Chest</span>
                  <span class="text-muted d-block">Youtube video: Chest</span>

                </label>
              </div>
             

              
            </div>
          </div>
        </div>
        <div class="accordion-item shadow-none border border-bottom-0 mb-0">
          <div class="accordion-header" id="headingTwo">
            <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterTwo" aria-expanded="false" aria-controls="chapterTwo">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Web Design for Web Developers</span>
                <span class="fw-normal">1 / 4 | 4.4 min</span>
              </span>
            </button>
          </div>
          <div id="chapterTwo" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck1" checked="">
                <label for="defCheck1" class="form-check-label ms-3">
                  <span class="mb-0 h6">1. How to use Pages in Figma</span>
                  <span class="text-muted d-block">8:31 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck2">
                <label for="defCheck2" class="form-check-label ms-3">
                  <span class="mb-0 h6">2. What is Lo Fi Wireframe</span>
                  <span class="text-muted d-block">2 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck3">
                <label for="defCheck3" class="form-check-label ms-3">
                  <span class="mb-0 h6">3. How to use color in Figma</span>
                  <span class="text-muted d-block">5.9 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="checkbox" id="defCheck4">
                <label for="defCheck4" class="form-check-label ms-3">
                  <span class="mb-0 h6">4. Frames vs Groups in Figma</span>
                  <span class="text-muted d-block">3.6 min</span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item shadow-none border border-bottom-0 mb-0">
          <div class="accordion-header" id="headingThree">
            <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterThree" aria-expanded="false" aria-controls="chapterThree">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Build Beautiful Websites!</span>
                <span class="fw-normal">0 / 6 | 4.4 min</span>
              </span>
            </button>
          </div>
          <div id="chapterThree" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-01">
                <label for="defCheck-01" class="form-check-label ms-3">
                  <span class="mb-0 h6">1. Section &amp; Div Block</span>
                  <span class="text-muted d-block">8:31 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-02">
                <label for="defCheck-02" class="form-check-label ms-3">
                  <span class="mb-0 h6">2. Read-Only Version of Chat App</span>
                  <span class="text-muted d-block">8 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-03">
                <label for="defCheck-03" class="form-check-label ms-3">
                  <span class="mb-0 h6">3. Webflow Autosave</span>
                  <span class="text-muted d-block">2.9 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-04">
                <label for="defCheck-04" class="form-check-label ms-3">
                  <span class="mb-0 h6">4. Canvas Settings</span>
                  <span class="text-muted d-block">7.6 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-05">
                <label for="defCheck-05" class="form-check-label ms-3">
                  <span class="mb-0 h6">5. HTML Tags</span>
                  <span class="text-muted d-block">10 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="checkbox" id="defCheck-06">
                <label for="defCheck-06" class="form-check-label ms-3">
                  <span class="mb-0 h6">6. Footer (Chat App)</span>
                  <span class="text-muted d-block">9.10 min</span>
                </label>
              </div>

            </div>
          </div>
        </div>
        <div class="accordion-item shadow-none border mb-0">
          <div class="accordion-header" id="headingFour">
            <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterFour" aria-expanded="false" aria-controls="chapterFour">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Final Project</span>
                <span class="fw-normal">2 / 3 | 4.4 min</span>
              </span>
            </button>
          </div>
          <div id="chapterFour" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-101" checked="">
                <label for="defCheck-101" class="form-check-label ms-3">
                  <span class="mb-0 h6">1. Responsive Blog Site</span>
                  <span class="text-muted d-block">10:0 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-102" checked="">
                <label for="defCheck-102" class="form-check-label ms-3">
                  <span class="mb-0 h6">2. Responsive Portfolio</span>
                  <span class="text-muted d-block">13:00 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-103">
                <label for="defCheck-103" class="form-check-label ms-3">
                  <span class="mb-0 h6">3. Responsive eCommerce Website</span>
                  <span class="text-muted d-block">15 min</span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>














    <div class="col-lg-12">
        <h4>Nutrition</h4>
      <div class="accordion stick-top accordion-bordered course-content-fixed" id="courseContent">
        <div class="accordion-item shadow-none border border-bottom-0 mb-0">
          <div class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button bg-lighter rounded-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chapter1" aria-expanded="false" aria-controls="chapter1">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Meal 1</span>
                <span class="fw-normal">5 compenents | 400 kcal</span>
              </span>
            </button>
          </div>
          <div id="chapter1" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <label for="defaultCheck1" class="form-check-label ms-3">
                  <span class="mb-0 h6">Oats</span>
                  <span class="text-muted d-block">Portion : 100 g</span>
                  <span class="text-muted d-block">kcal per 100 g : 375 kcal</span>

                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <label for="defaultCheck1" class="form-check-label ms-3">
                  <span class="mb-0 h6">Oats</span>
                  <span class="text-muted d-block">Portion : 100 g</span>
                  <span class="text-muted d-block">kcal per 100 g : 375 kcal</span>

                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item shadow-none border border-bottom-0 mb-0">
          <div class="accordion-header" id="headingTwo">
            <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterTwo" aria-expanded="false" aria-controls="chapterTwo">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Web Design for Web Developers</span>
                <span class="fw-normal">1 / 4 | 4.4 min</span>
              </span>
            </button>
          </div>
          <div id="chapterTwo" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck1" checked="">
                <label for="defCheck1" class="form-check-label ms-3">
                  <span class="mb-0 h6">1. How to use Pages in Figma</span>
                  <span class="text-muted d-block">8:31 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck2">
                <label for="defCheck2" class="form-check-label ms-3">
                  <span class="mb-0 h6">2. What is Lo Fi Wireframe</span>
                  <span class="text-muted d-block">2 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck3">
                <label for="defCheck3" class="form-check-label ms-3">
                  <span class="mb-0 h6">3. How to use color in Figma</span>
                  <span class="text-muted d-block">5.9 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="checkbox" id="defCheck4">
                <label for="defCheck4" class="form-check-label ms-3">
                  <span class="mb-0 h6">4. Frames vs Groups in Figma</span>
                  <span class="text-muted d-block">3.6 min</span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item shadow-none border border-bottom-0 mb-0">
          <div class="accordion-header" id="headingThree">
            <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterThree" aria-expanded="false" aria-controls="chapterThree">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Build Beautiful Websites!</span>
                <span class="fw-normal">0 / 6 | 4.4 min</span>
              </span>
            </button>
          </div>
          <div id="chapterThree" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-01">
                <label for="defCheck-01" class="form-check-label ms-3">
                  <span class="mb-0 h6">1. Section &amp; Div Block</span>
                  <span class="text-muted d-block">8:31 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-02">
                <label for="defCheck-02" class="form-check-label ms-3">
                  <span class="mb-0 h6">2. Read-Only Version of Chat App</span>
                  <span class="text-muted d-block">8 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-03">
                <label for="defCheck-03" class="form-check-label ms-3">
                  <span class="mb-0 h6">3. Webflow Autosave</span>
                  <span class="text-muted d-block">2.9 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-04">
                <label for="defCheck-04" class="form-check-label ms-3">
                  <span class="mb-0 h6">4. Canvas Settings</span>
                  <span class="text-muted d-block">7.6 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-05">
                <label for="defCheck-05" class="form-check-label ms-3">
                  <span class="mb-0 h6">5. HTML Tags</span>
                  <span class="text-muted d-block">10 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="checkbox" id="defCheck-06">
                <label for="defCheck-06" class="form-check-label ms-3">
                  <span class="mb-0 h6">6. Footer (Chat App)</span>
                  <span class="text-muted d-block">9.10 min</span>
                </label>
              </div>

            </div>
          </div>
        </div>
        <div class="accordion-item shadow-none border mb-0">
          <div class="accordion-header" id="headingFour">
            <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterFour" aria-expanded="false" aria-controls="chapterFour">
              <span class="d-flex flex-column">
                <span class="h5 mb-1">Final Project</span>
                <span class="fw-normal">2 / 3 | 4.4 min</span>
              </span>
            </button>
          </div>
          <div id="chapterFour" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-3 border-top">
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-101" checked="">
                <label for="defCheck-101" class="form-check-label ms-3">
                  <span class="mb-0 h6">1. Responsive Blog Site</span>
                  <span class="text-muted d-block">10:0 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-102" checked="">
                <label for="defCheck-102" class="form-check-label ms-3">
                  <span class="mb-0 h6">2. Responsive Portfolio</span>
                  <span class="text-muted d-block">13:00 min</span>
                </label>
              </div>
              <div class="form-check d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="defCheck-103">
                <label for="defCheck-103" class="form-check-label ms-3">
                  <span class="mb-0 h6">3. Responsive eCommerce Website</span>
                  <span class="text-muted d-block">15 min</span>
                </label>
              </div>
            </div>
          </div>
        </div>
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
</script>