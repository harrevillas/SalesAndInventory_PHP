<?php
  $page_title = 'Edit categorie';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $variant = find_by_id('variant',(int)$_GET['id']);
  if(!$variant){
    $session->msg("d","Missing variant id.");
    redirect('variant.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('variant-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['variant-name']));
  if(empty($errors)){
        $sql = "UPDATE variant SET name='{$cat_name}'";
       $sql .= " WHERE id='{$variant['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Variant");
       redirect('variant.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('variant.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('variant.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>
<style>
  .sidebar {
    background-color:  #add8e6;
  }
  
  body {
    background-color: #add8e6;
  }
  </style>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($variant['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_variant.php?id=<?php echo (int)$variant['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="variant-name" value="<?php echo remove_junk(ucfirst($variant['name']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary"style="background-color:blue;">Update Variant</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
