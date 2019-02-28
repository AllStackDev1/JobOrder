<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo TAGLINE?></title>
    <link href="<?php echo BASE_URL?>templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL?>templates/css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo TAGLINE?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">Account Login</h1>
          </div>
        </div>
      </div>
    </header>
    <?php displayMessage()?>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" action="index.php" method="post" class="well">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" required name="email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                  </div>
                  <button type="submit" class="btn btn-success btn-block"  name="do_login">Login</button>

                  <!-- <p><a style="margin-top:10" data-toggle="modal" data-target="#forgottenDetails"> Forgotten Email or Password?<a> <p> -->
              </form>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="forgottenDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Change Password</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="clientChangePassword.php">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control"  required name="p0">
            <input type="hidden" value="<?php echo $order->password?>" name="hidden">
          </div>
          <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" required name="p1">
          </div>
          <div class="form-group">
            <label>Confirm  New Password</label>
            <input type="password" class="form-control"  required name="p2">
          </div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="do_change">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="<?php echo BASE_URL?>templates/js/bootstrap.min.js"></script>

 <script type="text/javascript">
$(document).ready(function() {
    $(".alert").delay(4000).fadeOut();
  });

</script>
  </body>
</html>
