<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
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

    <title>User | Signup</title>

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
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class=" container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                 <img src="../assets/img/elements/ahm.jpg" style="border-radius: 10px;" width="100">
                  </span>
                  <span class="text-dark h3">AHM FITNESS</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-4 text-primary">Cridentials Login </h4>
              <form id="createAcc" class="mb-3"  method="POST">

               <div class="row mb-3">

                <div class="col-lg-6 col-12 col-md-6">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                  </div>
                </div>
                <div class="col-lg-6 col-12 col-md-6">
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
                  
               </div>
                
             

              

             
            </div>
          </div>


          <div class="card mt-3">
            <div class="card-body">
        
              <!-- /Logo -->
              <h4 class="mb-4 text-primary">Your informations</h4>

               <div class="row mb-3">
                <div class="col-lg-4 col-12 col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                      <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="full name" name="full_name" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                    </div>
                  </div>
                </div>

           
                <div class="col-lg-4 col-12 col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                      <input type="text" id="basic-icon-default-phone" name="phone" class="form-control phone-mask" placeholder="your phone number" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-12 col-md-6">
                  <div class="mb-3">
                    <label for="defaultSelect" class="form-label">birthday</label>
                    <input class="form-control" type="date" name="birthday" value="2021-06-18" id="html5-date-input">
                  </div>
                </div>
                <div class="col-lg-4 col-12 col-md-6">
                  <div class="mb-3">
                    <label for="email" class="form-label">height (in cm)</label>
                    <input type="text" class="form-control" id="email" name="height" placeholder="180" />
                  </div>
                </div>
                <div class="col-lg-4 col-12 col-md-6">
                  <div class="mb-3">
                    <label for="email" class="form-label">Weight (in kg)</label>
                    <input type="text" class="form-control" id="email" name="weight" placeholder="80" />
                  </div>
                </div>
              




               


                  <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary w-50" type="submit">Sign up</button>

                </div>
               </div>
                
              </form>


              

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="login.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    

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
  var createAcc = document.getElementById('createAcc');
createAcc.addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(createAcc);
    formData.append('ero', 'create_account');

    fetch('controller/create-account.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'Success') {
            swal("Good Job", data.message, "success");
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 2000);
        } else if (data.status === 'Error') {
            swal("Opps!", data.message, "warning");
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>