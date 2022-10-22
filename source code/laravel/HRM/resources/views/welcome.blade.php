<!DOCTYPE html>

<html lang="en">

<head>
  <title>Login - EasyManage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <link href= "{{asset('public/style.css')}}" rel= "stylesheet">;
  {{-- <link href= "{{('public/Data/db.php')}}" >; --}}
  {{-- <link href= "{{('public/function.php')}}">; --}}
    

</head>

<body>
  <div class="sidenav">
    <div class="login-main-text">
      <img class="logo" src="{{('public/./assets/img/logo.png')}}">
      <div class="company-brand">EasyManage<br></div>
      <div class="company-slogan">Human Resources Management</div>
      <br><br><br>
      <h5>Login is required to access.</h5>
    </div>
  </div>
  <div class="main">
    <div class="col-md-10 col-sm-12">
      <div class="login-form">
        <form action="{{URL::to('/admin')}}" method="post">
          {{csrf_field()}}
          <div class="container">
            <label for="uname"><b>User ID</b></label>
            <input type="text" placeholder="Enter Staff ID" name="userId" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label>
              <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <?php
            $message = Session::get('message');
            if($message){
              echo $message;
              Session::put('message',null);
            }
            ?>
            <br>
            <button type="submit" class="btn btn-dark">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>