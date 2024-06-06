<?php
$page_title = 'Edit User';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>

<?php
$e_user = find_by_id('users', (int)$_GET['id']);
$groups = find_all('user_groups');
if (!$e_user) {
  $session->msg("d", "Missing user id.");
  redirect('users.php');
}
?>

<?php
// Update User basic info
if (isset($_POST['update'])) {
  $req_fields = array('name', 'username', 'contact', 'gmail', 'level');
  validate_fields($req_fields);
  if (empty($errors)) {
    $id = (int)$e_user['id'];
    $name = remove_junk($db->escape($_POST['name']));
    $username = remove_junk($db->escape($_POST['username']));
    $contact = remove_junk($db->escape($_POST['contact']));
    $gmail = remove_junk($db->escape($_POST['gmail']));
    $level = (int)$db->escape($_POST['level']);
    $status = remove_junk($db->escape($_POST['status']));
    
    // Validate contact field
    if (!is_numeric($contact) || strlen($contact) != 11) {
      $session->msg('d', 'Contact must be a numerical value with 11 digits.');
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    }

    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
      $session->msg("d", "Name can only contain alphabetical characters.");
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    }

    if (!preg_match('/^[a-zA-Z]+$/', $username)) {
      $session->msg("d", "Username can only contain alphabetical characters.");
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    }

    $sql = "UPDATE users SET name ='{$name}', username ='{$username}', contact = '{$contact}', gmail = '{$gmail}', user_level='{$level}', status='{$status}' WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);

    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Account Updated ");
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    } else {
      $session->msg('d', ' Sorry failed to update!');
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id=' . (int)$e_user['id'], false);
  }
}
?>

<?php
// Update user password
if (isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if (empty($errors)) {
    $id = (int)$e_user['id'];
    $password = remove_junk($db->escape($_POST['password']));
    $h_pass = sha1($password);
    $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "User password has been updated ");
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    } else {
      $session->msg('d', ' Sorry failed to update user password!');
      redirect('edit_user.php?id=' . (int)$e_user['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id=' . (int)$e_user['id'], false);
  }
}
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
    <!-- Update Account form -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Update <?php echo remove_junk(ucwords($e_user['name'])); ?> Account
        </strong>
      </div>
      <div class="panel-body">
        <form id="userForm" method="post" action="edit_user.php?id=<?php echo (int)$e_user['id']; ?>" class="clearfix">
          <div class="form-group">
            <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
            <span class="error"></span>
          </div>
          <div class="form-group">
            <label for="username" class="control-label">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
            <span class="error"></span>
          </div>
          <div class="form-group">
            <label for="contact" class="control-label">Contact <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="contact" value="<?php echo remove_junk(ucwords($e_user['contact'])); ?>">
            <span class="error"></span>
          </div>
          <div class="form-group">
            <label for="gmail" class="control-label">Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="gmail" value="<?php echo remove_junk(ucwords($e_user['gmail'])); ?>">
            <span class="error"></span>
          </div>
          <div class="form-group">
            <label for="level">User Role <span class="text-danger">*</span></label>
            <select class="form-control" name="level">
              <?php foreach ($groups as $group) : ?>
                <option <?php if ($group['group_level'] === $e_user['user_level']) echo 'selected="selected"'; ?> value="<?php echo $group['group_level']; ?>"><?php echo ucwords($group['group_name']); ?></option>
              <?php endforeach; ?>
            </select>
            <span class="error"></span>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option <?php if ($e_user['status'] === '1') echo 'selected="selected"'; ?> value="1">Active</option>
              <option <?php if ($e_user['status'] === '0') echo 'selected="selected"'; ?> value="0">Deactive</option>
            </select>
          </div>
          <div class="form-group clearfix">
            <button type="submit" name="update" class="btn btn-info" style="background-color:blue;"><span class="glyphicon glyphicon-edit"></span> Update</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Change password form -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Change <?php echo remove_junk(ucwords($e_user['name'])); ?> password
        </strong>
      </div>
      <div class="panel-body">
        <form id="passwordForm" action="edit_user.php?id=<?php echo (int)$e_user['id']; ?>" method="post" class="clearfix">
          <div class="form-group">
            <label for="password" class="control-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" placeholder="Type user new password">
            <span class="error"></span>
          </div>
          <div class="form-group clearfix">
            <button type="submit" name="update-pass" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-refresh"></span> Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  body {
    background-color: #aad8e6;
  }

  .sidebar {
    background-color: #aad8e6;
  }

  .text-danger {
    color: red;
  }

  .error {
    color: red;
  }
</style>

<script>
  document.getElementById('userForm').addEventListener('submit', function(event) {
    var form = event.target;
    var isValid = true;
    var requiredFields = form.querySelectorAll('[name="name"], [name="username"], [name="contact"], [name="gmail"], [name="level"]');
    
    requiredFields.forEach(function(field) {
      var errorSpan = field.nextElementSibling;
      if (!field.value) {
        isValid = false;
        errorSpan.textContent = "This field is required.";
      } else {
        errorSpan.textContent = "";
      }
    });

    if (!isValid) {
      event.preventDefault();
    }
  });

  document.getElementById('passwordForm').addEventListener('submit', function(event) {
    var form = event.target;
    var isValid = true;
    var passwordField = form.querySelector('[name="password"]');
    var errorSpan = passwordField.nextElementSibling;

    if (!passwordField.value) {
      isValid = false;
      errorSpan.textContent = "This field is required.";
    } else {
      errorSpan.textContent = "";
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
</script>

<?php include_once('layouts/footer.php'); ?>
