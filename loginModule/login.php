<?php
  
session_start();

include 'Account.php';
include '../routes/Routes.php';
include '../dbModule/DB.php';


$DB = new DB( );
if ( isset( $_POST['signInButton'] ) ) {
  Account::logIn( $_POST['username'], $_POST['password'], $DB );

  if ( Account::isLogIn() ) {
    if ( Account::role() == 'Admin' ) {
      Routes::toAdminPage();

    }
    elseif ( Account::role() == 'Manager' ) {
      Routes::toManagerPage();

    }
  }
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/signIn.css">
</head>
  <body class="text-center">
    <div class="container col-md-2" style="padding-top: 10%; ">
    <form class="form-signin" action="" method="POST"  _lpchecked="1">
          <h1 class="h3 mb-3 font-weight-normal">Demersuri</h1>

          <label for="inputEmail" class="sr-only">Email address</label>
          <input name="username" id="inputEmail" class="form-control" placeholder="Email address" autofocus="" style="cursor: auto;" autocomplete="off" type="email">

          <label for="inputPassword" class="sr-only">Password</label>
          <input name="password" id="inputPassword" class="form-control" placeholder="Password" required="" style="cursor: auto;" autocomplete="off" type="password">

          <div class="checkbox mb-3">
            <label>
              <input name="rememberUser" value="remember-me" type="checkbox"> Remember me
            </label>
          </div>
          <input name="signInButton" class="btn btn-lg btn-secondary btn-block" value="Sign in" type="submit">
          <p class="mt-5 mb-3 text-muted">© <?=date("Y");?></p>
        </form>
    </div>
  </body>
</html>
<!-- 
<script>
  setInterval( ()=>{
    location.reload();
  }, 2000 );
  
</script> -->