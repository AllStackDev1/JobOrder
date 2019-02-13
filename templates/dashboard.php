<link rel="stylesheet" type="text/css" href=" <?php echo BASE_URL?>templates/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href=" <?php echo BASE_URL?>templates/css/dataTables.bootstrap.min.css">
<?php include("includes/header.php");?>
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Perform Task
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                
                <?php if(getUserType() == ADMIN): ?>
                  <li><a type="button" data-toggle="modal" data-target="#addUser">Add User</a>
                  <li><a type="button" data-toggle="modal" data-target="#addUserType">Add UserType</a>
                <?php endif?>

                <?php if(getUserType() == RECEPTIONIST): ?>
                  <li><a type="button" data-toggle="modal" data-target="#addTask">Add Job</a>
                <?php endif?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php displayMessage();?>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-6">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h2>
                    <h4> <?php echo $numberOfUsers;?> Users</h4>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 
                    <h4> <?php echo $numberOfTasks;?> Printing Tasks</h4>
                  </div>
                </div>
              </div>
              </div>

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Activity Logs</h3>
                </div>
                <div class="panel-body">
                 <form  method="post" >
                    <table class="table table-bordered" id="documentTable">
                      <thead>
                        <tr>
                          <th>Client's Name</th>
                          <th>Job Description</th>
                          <th>Number of Job Copies</th>
                          <th>Submitted Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($tasks as $task):?>
                          <tr>
                              <td><?php echo $task->owner; ?></td>
                              <td><?php echo $task->description ?></td>
                              <td><?php echo $task->copies ?></td>
                              <td><?php echo dateFormat($task->submitted_date); ?></td>
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


    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add a New User</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="addUser.php">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="form-control" placeholder="Full Name" required name="name">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Email" required name="email">
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
            <label for="sel1">User Type:</label>
            <select class="form-control" name="usertype">
              <option value = "null">Select User Type</option>
              <?php foreach($userTypes as $userType):?>
                  <option value = "<?php echo $userType->name?>"><?php echo $userType->name?></option>
              <?php endforeach;?>   
            </select>
          </div>
          
           <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="addUser">Add Client</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Send Document(s)</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="addTask.php">
          <div class="form-group">
            <label>Document Owner</label>
            <input  class="form-control" placeholder="Document Owner" required name="owner" />
          </div>
          <div class="form-group">
            <label>Document Description</label>
            <textarea  class="form-control" placeholder="Document Description" required name="description" cols="40" rows="5"></textarea>
          </div>
          <div class="form-group">
            <label>Number of Copies</label>
            <input type="number" class="form-control" placeholder="Number of Copies" required name="copies">
          </div>
           <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="addTask">Save</button>
          </form>
           <ul class="list-group" id="fileList"></ul>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="addUserType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add UserType<i>(User Type can be Receptionist, etc.)</i></h4>
        </div>
        <div class="modal-body">
        <form method="post" action="addUserType.php">
          <div class="form-group">
            <label>User Type</label>
            <input type="text" class="form-control" required name="userType">
          </div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="addUserType">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>






  <div class="modal fade" id="addPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Change Password</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="adminChangePassword.php">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control"  required name="p0">
            <input type="hidden" value="<?php echo $admin->password?>" name="hidden">
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
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add Product</h4>
          <p><em>Please add product category if the category does not exist before adding the product</em></p>
        </div>
        <div class="modal-body">
        <form method="post" action="addProduct.php">
          <div class="form-group">
            <label>Label</label>
            <input type="text" class="form-control" placeholder="Product Label" required name="label">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" placeholder="Product Name" optional name="name">
          </div>
          <div class="form-group">
            <label>Prodcut Category</label>
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="category_id">
            <?php foreach ($categories as $key => $value):?>
              <option value="<?php echo $value->id?>">
                <?php echo $value->name?>
              </option>
            <?php endforeach;?>
            </select>
          </div>
         <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="do_AddProduct">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addCheckout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add a New Checkout</h4>
          <p><em>Please add client if the name of student does not exist </em></p>
        </div>
        <div class="modal-body">
        <form method="post" action="addCheckout.php">
          <div class="form-group">
            <label>Client Name</label>
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="client_id">
            <?php foreach ($Clients as $key => $value):?>
              <option value="<?php echo $value->id?>">
                <?php echo $value->first_name . " ".$value->middle_name . " " . $value->last_name?>
              </option>
            <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <label>Prodcut Name</label>
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="product_id">
            <?php foreach ($products as $key => $value):?>
              <option value="<?php echo $value->id?>">
                <?php echo $value->name;?>
              </option>
            <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <label>Qunatity</label>
            <input type="number" class="form-control" placeholder="Quantity" required name="quantity" maxlength="10">
          </div>
          <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="do_CheckOut">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addProductCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add Product Category</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="addCategory.php">
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" placeholder="Catgeory Name" optional name="name">
          </div>
         <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="do_AddCategory">Add Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
  include("includes/footer.php")
  ?>
 <script src=" <?php echo BASE_URL?>templates/js/bootstrap-select.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/jquery.dataTables.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/dataTables.bootstrap.min.js"></script>
 <script type="text/javascript">
$(document).ready(function() {
  $('#documentTable').dataTable( {
    "bSort": false
    });
  });

  // function validateAndUpload(input){
  //       //get the input and UL list
  //     let input = document.getElementById('filesToUpload');
  //     let list = document.getElementById('fileList');

  //     //empty list for now...
  //     while (list.hasChildNodes()) {
  //       list.removeChild(ul.firstChild);
  //     }

  //     //for every file...
  //     for (var x = 0; x < input.files.length; x++) {
  //       //add to list
  //       var li = document.createElement('li');
  //       li.innerHTML = 'File ' + (x + 1) + ':  ' + input.files[x].name;
  //       list.append(li);
  //   }
  // }

</script>
  </body>
</html>
