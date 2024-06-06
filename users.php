<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(1);
//pull out all user form database
 $all_users = find_all_user();
 
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
  }
  .sidebar {
    background-color: #f5f5f5;
  }
  .panel {
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  .panel-heading {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 5px 5px 0 0;
  }
  .panel-heading strong {
    font-size: 16px;
  }
  .btn-info {
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    color: white;
  }
  .btn-info:hover {
    background-color: #0056b3;
  }
  .table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
  }
  .table-bordered {
    border: 1px solid #dee2e6;
    border-radius: 5px;
  }
  .table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
  }
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa;
  }
  .label-success {
    background-color: #28a745;
  }
  .label-danger {
    background-color: #dc3545;
  }
  .btn-group-vertical .btn {
    background-color: blue;
    color: white;
    border: none;
    margin-bottom: 5px;
    border-radius: 4px;
  }
  .btn-group-vertical .btn:hover {
    background-color: #0056b3;
  }

  body{
    background-color: #aad8e6;
  }

  .sidebar{
    background-color: #aad8e6;
  }
</style>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Users</span>
       </strong>
         <a href="add_user.php" class="btn btn-info pull-right">
         <span class="glyphicon glyphicon-plus"></span> Add New User
         </a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Name </th>
            <th>Username</th>
            <th class="text-center" style="width: 15%;">Contact</th>
            <th class="text-center" style="width: 15%;">Email</th>
            <th class="text-center" style="width: 15%;">User Role</th>
            <th class="text-center" style="width: 10%;">Status</th>
            <th style="width: 20%;">Last Login</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td><?php echo isset($a_user['contact']) ? remove_junk(ucwords($a_user['contact'])) : ''; ?></td>
           <td><?php echo isset($a_user['gmail']) ? remove_junk(ucwords($a_user['gmail'])) : ''; ?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group btn-group-vertical">
                <a href="verify_edituser.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs" data-toggle="tooltip" title="Edit">
                
                  <i class="glyphicon glyphicon-pencil"></i> Edit 
               </a>
               <!-- Confirmation Before Deletion-->
                <a href="verify_deleteuser.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs" data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure you want to delete this user?');">
                  <i class="glyphicon glyphicon-remove"></i> Delete
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
