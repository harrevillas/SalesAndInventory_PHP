<?php
$page_title = 'Add User';
require_once('includes/load.php');
// Checking What level user has permission to view this page
page_require_level(1);
$groups = find_all('user_groups');
?>
<?php
if (isset($_POST['add_user'])) {

  $req_fields = array('full-name', 'username', 'password', 'level');
  validate_fields($req_fields);

  if (empty($errors)) {
    $name   = remove_junk($db->escape($_POST['full-name']));
    $username   = remove_junk($db->escape($_POST['username']));
    $password   = remove_junk($db->escape($_POST['password']));
    $user_level = (int)$db->escape($_POST['level']);
    $password = sha1($password);
    $query = "INSERT INTO users (";
    $query .= "name,username,password,user_level,status";
    $query .= ") VALUES (";
    $query .= " '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
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
        <form method="post" action="add_user.php">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="full-name" placeholder="Enter Full Name" oninput="allowLettersOnly(event)">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username" oninput="allowLettersOnly(event)">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <label for="level">User Role</label>
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
    font-family: Arial, sans-serif;
  }

  .sidebar{
    background-color: #add8e6;
  }

  .panel-heading {
    background-color: #007bff;
    color: white;
    padding: 15px;
    border-radius: 5px 5px 0 0;
  }

  .panel-heading strong {
    font-size: 20px;
  }

  .panel-body {
    padding: 20px;
  }

  .form-group label {
    font-weight: bold;
  }

  .form-control {
    border-radius: 5px;
    border-color: #ccc;
  }

  .btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: white;
    padding: 10px 20px;
    font-weight: bold;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }
</style>

<?php include_once('layouts/footer.php'); ?>

<script>
  function allowLettersOnly(event) {
    var inputValue = event.target.value;
    var lettersOnly = inputValue.replace(/[0-9]/g, '');
    event.target.value = lettersOnly;
  }
</script>
