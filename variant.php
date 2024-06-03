<?php
$page_title = 'All categories';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$all_variant = find_all('variant');
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('variant-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['variant-name']));
   if(empty($errors)){
    $sql  = "INSERT INTO variant (name)";
    $sql .= " VALUES ('{$cat_name}')"; 
      if($db->query($sql)){
        $session->msg("s", "Successfully Added New Category");
        redirect('variant.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('variant.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('variant.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<!-- Add jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
.sidebar {
    background-color:  #add8e6;
  }
  
  body {
    background-color: #add8e6;
  }
  .btn-group-vertical .btn {
    background-color: blue;
    color: white;
    border: none;
    margin-bottom: 5px;
  }
  .btn-group-vertical .btn:hover {
    background-color: darkblue;
  }
</style>

<a id="top-of-page"></a>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-plus-sign"></span>
          <span>Add New Variant</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="variant.php">
          <div class="form-group">
            <input type="text" class="form-control" name="variant-name" placeholder="Variant Name">
          </div>
          <button type="submit" name="add_cat" class="btn btn-primary"style="background-color:blue;">
            <span class="glyphicon glyphicon-plus-sign"></span> Add Variant
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-align-justify"></span>
          <span>All Variant</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Variant</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_variant as $var): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk(ucfirst($var['name'])); ?></td>
                <td class="text-center">
                  <div class="btn-group btn-group-vertical">
                    <a href="edit_variant.php?id=<?php echo (int)$var['id']; ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit">
                      <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>
                    <a href="#" data-id="<?php echo (int)$var['id']; ?>" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                      <span class="glyphicon glyphicon-trash"></span> Delete
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="text-center">
                <a href="#top-of-page" class="btn btn-info"style="background-color:blue;">
                  <span class="glyphicon glyphicon-arrow-up"></span> Back to the Top
                </a>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this variant? All products data inside this variant will also be deleted. This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancel" data-toggle="tooltip" data-placement="top">
          <i class="bi bi-x-circle"></i> Cancel
        </button>
        <a id="confirmDelete" class="btn btn-danger" href="#" title="Delete" data-toggle="tooltip" data-placement="top">
          <i class="bi bi-trash"></i> Delete
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Custom CSS -->
<style>
  .modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
  }

  .modal-content {
    border-radius: 0.3rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  }

  .modal-header {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
  }

  .modal-header .close {
    margin-top: -10px;
  }

  .modal-title {
    margin: 0;
    line-height: 1.5;
  }

  .modal-body {
    padding: 15px;
  }

  .modal-footer {
    display: flex;
    justify-content: flex-end;
    padding: 15px;
    border-top: 1px solid #e9ecef;
  }

  .btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: #fff;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
  }

  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }

  .btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
  }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
  $(document).ready(function(){
    $('#deleteModal').on('show.bs.modal', function (e) {
      var button = $(e.relatedTarget); // Button that triggered the modal
      var variantId = button.data('id'); // Extract info from data-* attributes
      var deleteUrl = 'delete_variant.php?id=' + variantId; // Construct the URL

      var modal = $(this);
      modal.find('#confirmDelete').attr('href', deleteUrl); // Update the href attribute
    });
  });
</script>

<?php include_once('layouts/footer.php'); ?>
