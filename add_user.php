<?php

$page_title = 'Add User';
require_once('includes/load.php');
// Checking What level user has permission to view this page
page_require_level(1);
$groups = find_all('user_groups');

if (isset($_POST['add_user'])) {

  $req_fields = array('full-name', 'username', 'password', 'contact', 'gmail', 'level');
  validate_fields($req_fields);

  if (empty($errors)) {
    $name      = remove_junk($db->escape($_POST['full-name']));
    $username  = remove_junk($db->escape($_POST['username']));
    $password  = remove_junk($db->escape($_POST['password']));
    $contact   = remove_junk($db->escape($_POST['contact']));
    $gmail   = remove_junk($db->escape($_POST['gmail']));
    $user_level= (int)$db->escape($_POST['level']);

    // Validate contact field
    if (!is_numeric($contact) || strlen($contact) != 11) {
      $session->msg('d', 'Contact must be a numerical value with 11 digits.');
      redirect('add_user.php', false);
    }

    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
      $session->msg("d", "Name can only contain alphabetical characters.");
      redirect('add_user.php', false);
    }

    if (!preg_match('/^[a-zA-Z]+$/', $username)) {
      $session->msg("d", "Username can only contain alphabetical characters.");
      redirect('add_user.php', false);
    }
    
    $password  = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (";
    $query .= "name,username,password,contact,gmail, user_level,status";
    $query .= ") VALUES (";
    $query .= " '{$name}', '{$username}', '{$password}', '{$contact}','{$gmail}', '{$user_level}','1'";
    $query .= ")";
    if ($db->query($query)) {
      // Success
      $session->msg('s', "User account has been created! ");
      redirect('add_user.php', false);
    } else {
      // Failed
      $session->msg('d', ' Sorry failed to create account!');
      redirect('add_user.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_user.php', false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<?php echo display_msg($msg); ?>
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong>
        <span class="glyphicon glyphicon-user"></span>
        <span>Add New User</span>
      </strong>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <form id="userForm" method="post" action="add_user.php">
          <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="full-name" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <label for="contact">Contact <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="contact" placeholder="Enter Contact">
          </div>
          <div class="form-group">
            <label for="gmail">Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="gmail" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label for="level">User Role <span class="text-danger">*</span></label>
            <select class="form-control" name="level">
              <?php foreach ($groups as $group) : ?>
                <option value="<?php echo $group['group_level']; ?>"><?php echo ucwords($group['group_name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group clearfix">
            <button type="submit" name="add_user" class="btn btn-primary">
              <span class="glyphicon glyphicon-plus"></span> Add User
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  body {
    background-color: #add8e6;
  }

  .sidebar {
    background-color: #add8e6;
  }

  .text-danger {
    color: red;
  }
</style>

<script>
  document.getElementById('userForm').addEventListener('submit', function(event) {
    var form = event.target;
    var isValid = true;
    var requiredFields = form.querySelectorAll('[name="full-name"], [name="username"], [name="password"], [name="contact"], [name="gmail"], [name="level"]');
    
    requiredFields.forEach(function(field) {
      if (field.value.trim() === '') {
        isValid = false;
        field.nextElementSibling.textContent = 'This field is required';
      } else {
        field.nextElementSibling.textContent = '';
      }
    });

    if (!isValid) {
      event.preventDefault();
    }
  });
</script>

<?php include_once('layouts/footer.php'); ?>
