<?php session_start(); ?>
<html lang="en">
    <head>
        <title>
           AccuAccounting Login
        </title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-1.12.4.js">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
        </script>

    </head>

    <body>
       <?php include'index.php'; ?>
        <br>
        <div class="container" align="center">
            <div class="panel panel-primary" style="width:400px;margin:0px auto">
			<img src="../../images/logo.png" style="margin-top: 0px !important; margin-left: -0px !important; width:130px;height:100px;">
              <div class="panel-heading">Account Login</div>
              <div class="panel-body">


                <form class="login-form" data-toggle="validator" role="form" action="" method="POST">

                  <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" name="username" class="form-control" id="inputEmail" placeholder="Email" required>
                    <div class="help-block with-errors"></div>
                  </div>


                  <div class="form-group">
                    <label for="inputPassword" class="control-label">Password</label>
                    <div class="form-group">
                      <input type="password" name="password"data-minlength="4" class="form-control" id="inputPassword" data-error="must enter minimum of 4 characters" placeholder="Password" required>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
					  <button class="btn btn-primary" name="login"type="submit">
                          Login
                      </button>
					  <button onclick="window.location.href='welcome.php'" type="button" class="btn btn-outline btn-danger">Cancel</button>
                  </div>
				  <div class="form-group">
				  <button onclick="window.location.href='registerUser.php'" type="button"  class="btn btn-outline btn-success">Register</button>
				  </div>

                   <?php if(@$_GET['err'] == 1){ ?>
        <div class ='alert alert-danger' style ="color: red; ">Username or password is incorrect</div>
       <?php } ?>
                </form>


              </div>
            </div>
        </div>
    </body>
</html>
