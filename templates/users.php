<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo TAGLINE?></title>
    <link href="<?php echo BASE_URL?>templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL?>templates/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=" <?php echo BASE_URL?>templates/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href=" <?php echo BASE_URL?>templates/css/dataTables.bootstrap.min.css">
  </head>
  <body id="body">
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo BASE_URL?>dashboard.php"><?php echo TAGLINE?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
         
          <ul class="nav navbar-nav navbar-right">
           <?php if($isLoggedIn): ?>
            <li><a href="#">Welcome, <?php echo  $_SESSION['name'];?></a></li>
            <li><a href="logoutUser.php">Logout</a></li>
           <!-- <li><a type="button" data-toggle="modal" data-target="#updatePass">Change Password</a> -->
          <?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</h1>
          </div>
        </div>
      </div>
    </header>
    <?php displayMessage();?>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Users</h3>
                </div>
                <div class="panel-body">
                 <form  method="post" >
                    <table class="table table-bordered" id="documentTable">
                      <thead>
                       <tr>
                          <th>User Name</th>
                          <th>Department</th>
                          <th>User Type</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($users as $user):?>
                          <tr>
                              <td><?php echo $user->name; ?></td>
                              <td>
                                <?php echo $user->department ?>
                              </td>
                              <td>
                                <?php echo $user->userType ?> 
                              </td>
                              <td>
                                <button 
                                    type="button" 
                                    class="btn btn-primary updateUser"
                                    data-id ="<?php echo $user->id?>"
                                    data-email = "<?php echo $user->email?>"
                                    data-name = "<?php echo $user->name?>"
                                    data-password= "<?php echo $user->password?>"
                                    data-deparment= "<?php echo $user->department?>"
                                    data-type= "<?php echo $user->userType?>"
                                    data-toggle="modal" data-target="#updateUser"
                                >Edit</button>
                                <button 
                                    type="button" 
                                    class="btn btn-danger deleteUser"
                                    data-id ="<?php echo $user->id?>"
                                    data-toggle="modal" data-target="#deleteUser"
                                >Delete</button>   
                              </td>
                          </tr>
                        <?php endforeach;?>                         
                      </tbody>
                    </table>
                </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>


    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Deleting</i></h4>
        </div>
        <div class="modal-body">
        <form method="post" action="deleteUser.php">
          <div class="form-group">
            <label>Are you sure you want to delete this</label>
            <input type="hidden" class="form-control" required name="id" id="id" >
          </div>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger" name="deleteUser">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Editing User</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="updateUser.php">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" placeholder="Full Name" required name="name" id="name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Email" required name="email"  id="email">
            </div>
            <div class="form-group">
                <label>PassWord</label>
                <input type="password" class="form-control" placeholder="Password" required name="password">
            </div>
            <div class="form-group">
                <label>Confirm PassWord</label>
                <input type="password" class="form-control" placeholder="Confirm Password " required name="confirm_password">
            </div>
            <div class="form-group">
                <label for="sel1">Department</label>
                <select class="form-control" name="department"  id="department">
                <option value = "">Select Department</option>
                <?php foreach($departments as $department):?>
                    <option value = "<?php echo $department->name?>"><?php echo $department->name?></option>
                <?php endforeach;?>   
                </select>
            </div>
            <div class="form-group">
                <label for="sel1">User Type</label>
                <select class="form-control" name="userType"  id="userType">
                    <option value = "">User Type</option>
                    <option value = "<?php echo ADMIN?>"><?php echo ADMIN?></option>
                    <option value = "<?php echo RECEPTIONIST?>"><?php echo RECEPTIONIST?></option>
                </select>
            </div>      
            <input type="hidden" class="form-control" name="userId" id="userId"/>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
            <button type="submit" class="btn btn-primary" name="updateUser">Edit User</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo BASE_URL?>templates/js/jquery.min.js"></script>
  <script src="<?php echo BASE_URL?>templates/js/bootstrap.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/bootstrap-select.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/jquery.dataTables.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/dataTables.bootstrap.min.js"></script>


  <script>
  $(document).ready(function() {
  $('#documentTable').dataTable( {
    "bSort": false,
    destroy: true,
    });

    $(".alert").delay(4000).fadeOut();
    
    $('.updateUser').click(function () {
        $('#userId').val($(this).data("id"));
        $('#name').val($(this).data("name"));
        $('#email').val($(this).data("email"));
        $('#deparment').val($(this).data("deparment")).prop('selected', true)
        $('#userType').val($(this).data("type")).prop('selected', true)
    });

    $('.deleteUser').click(function () {
      $('#id').val($(this).data("id"));
    });
  });
  </script>
  </body>
</html>
