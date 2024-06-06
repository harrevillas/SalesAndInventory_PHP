<?php
$page_title = 'Edit category';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(1);
?>
<?php
// Display all categories.
$categorie = find_by_id('categories', (int)$_GET['id']);
if (!$categorie) {
  $session->msg("d", "Missing category id.");
  redirect('categorie.php');
}
?>

<?php
function is_alphabetic($str) {
  return preg_match('/^[a-zA-Z]+$/', $str);
}

if (isset($_POST['edit_cat'])) {
  $req_field = array('categorie-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  if (!is_alphabetic($cat_name)) {
    $session->msg("d", "Category Name can only contain alphabetical characters.");
    redirect('categorie.php', false);
  }
  if (empty($errors)) {
    $sql = "UPDATE categories SET name='{$cat_name}'";
    $sql .= " WHERE id='{$categorie['id']}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg("s", "Successfully updated Category");
      redirect('categorie.php', false);
    } else {
      $session->msg("d", "Sorry! Failed to Update");
      redirect('categorie.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<!-- Add jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
  .sidebar {
    background-color: #add8e6;
  }
  
  body {
    background-color: #add8e6;
  }

  .text-danger {
    color: red;
  }

  .error {
    color: red;
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
          <span>Editing <?php echo remove_junk(ucfirst($categorie['name'])); ?></span>
        </strong>
      </div>
      <div class="panel-body">
        <form id="editCategoryForm" method="post" action="edit_categorie.php?id=<?php echo (int)$categorie['id']; ?>">
          <div class="form-group">
            <label for="categorie-name" class="control-label">Category Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="categorie-name" value="<?php echo remove_junk(ucfirst($categorie['name'])); ?>">
            <span class="error"></span>
          </div>
          <button type="submit" name="edit_cat" class="btn btn-primary" style="background-color: blue;">
            <span class="glyphicon glyphicon-edit"></span> Update category
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#editCategoryForm').on('submit', function(event) {
    var isValid = true;
    var catName = $('[name="categorie-name"]');
    var errorSpan = catName.next('.error');
    if (!catName.val()) {
      isValid = false;
      errorSpan.text('This field is required.');
    } else {
      errorSpan.text('');
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
</script>

<?php include_once('layouts/footer.php'); ?>
