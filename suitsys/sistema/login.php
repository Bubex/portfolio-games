<?
     include 'session.php';
     $page = 'Login';
?>
<!DOCTYPE html>
<html lang="en">

<? include '_head.php'; ?>

<body class="bg-gradient-warning">

     <div class="container">

          <!-- Outer Row -->
          <div class="row justify-content-center">

               <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                         <div class="card-body p-0">
                              <!-- Nested Row within Card Body -->
                              <div class="row justify-content-center">
                                   <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                                   <div class="col-lg-6">
                                        <div class="p-5">
                                             <div class="text-center">
                                                  <h1 class="h4 text-gray-900 mb-4"><?= APP_NAME ?></h1>
                                             </div>
                                             <form class="user" id="login-form">
                                                  <div class="form-group">
                                                       <input type="email" class="form-control form-control-user" name="login-email" aria-describedby="emailHelp" placeholder="Email" required>
                                                  </div>
                                                  <div class="form-group">
                                                       <input type="password" class="form-control form-control-user" name="login-pass" placeholder="Senha" required>
                                                  </div>
                                                  <div class="form-group">
                                                       <div class="custom-control custom-checkbox small">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                       </div>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                             </form>
                                             <hr>
                                             <div class="text-center">
                                                  <a class="small" href="forgot-password.html">Forgot Password?</a>
                                             </div>
                                             <div class="text-center">
                                                  <a class="small" href="register.html">Create an Account!</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>

          </div>

     </div>

     <? include '_footer.php'; ?>

     <script>
          $('#login-form').submit(function(e) {
               e.preventDefault();
               var email = $('[name=login-email').val();
               var password = $('[name=login-pass]').val();

               $.ajax({
                    type: 'POST',
                    url: 'requests.php',
                    data: {
                         action: 'login',
                         email: email,
                         password: password
                    },
                    beforeSend: function() {
                         let timerInterval
                         Swal.fire({
                              title: 'Autenticando...',
                              timer: 2000,
                              onBeforeOpen: () => {
                                   Swal.showLoading()
                              },
                              onClose: () => {
                                   clearInterval(timerInterval)
                              }
                         });
                    },
                    success: function(retorno) {
                         var ret = JSON.parse(retorno);

                         if (ret.code == 0) {
                              window.location = 'dashboard.php';
                         } else if (ret.code == 1) {
                              Swal.fire({ type: 'error', title: 'Senha incorreta.', text: 'Você possui mais '+ret.attempts+' tentativas...' });
                         } else {
                              Swal.fire({ type: 'error', text: ret.msg });
                         }
                    },
                    error: function() {

                    }
               });
          });
     </script>

</body>

</html>