<?php include'register.php'; ?>
<html lang="en">
    <head>
        <title>
           AccuAccount/Register
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
        <br>
        <div class="container" align="center">
            <div class="panel panel-primary" style="width:400px;margin:0px auto">
			<img src="../../images/logo.png" style="margin-top: 0px !important; margin-left: -0px !important; width:130px;height:100px;">
              <div class="panel-heading">Register Account</div>
              <div class="panel-body">
                <form class="login-form" data-toggle="validator" role="form" action="" method="POST">
                  <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="firstName" class="control-label">First Name</label>
                    <input type="firstName" name="firstName" class="form-control" id="firstName" placeholder="First Name" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="lastName" class="control-label">Last Name</label>
                    <input type="lastName" name="lastName" class="form-control" id="lastName" placeholder="Last Name" required>
                    <div class="help-block with-errors"></div>
                  </div>


                  <div class="form-group">
                      <label for="Password" class="control-label">Password</label>
                      <input type="Password" name="Password" data-minlength="4" class="form-control" id="Password" data-error="must enter minimum of 4 characters" placeholder="Password" required>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="confirmPassword" class="control-label">Confirm Password</label>
                      <input type="password" name="confirmPassword" class="form-control" id=confirmPassword placeholder="Re-enter your password" required>
                      <div class="help-block with-errors"></div>
                    </div>

                  </div>
                  <div class="form-group">
					  <button class="btn btn-success" name="register" type="submit">
                          Register
                      </button>
					  <button onclick="window.location.href='login.php'" type="button" class="btn btn-outline btn-danger">Cancel</button>
            <?php echo $_SESSION['message'] ?>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </body>
</html>
