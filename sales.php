<?php
$page_title = 'All sale';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

$sales = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>
<!-- Add jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
  body {
    background-color: #add8e6;
  }

  .btn-edit-sale {
    background-color: blue;
    border-color: none;
    color: white;
  }

  .btn-edit-sale:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: #fff;
  }

  .btn-delete-sale {
    background-color: blue;
    border-color: none;
    color: white;
  }

  .btn-delete-sale:hover {
    background-color: #c82333;
    border-color: #bd2130;
    color: #fff;
  }

  .panel-heading {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
  }

  .panel-heading strong {
    color: #fff;
  }

  .btn-group-vertical {
    display: flex;
    flex-direction: column;
    gap: 5px; /* Space between the buttons */
  }

  .sidebar {
    background-color:  #add8e6;
  }

  tfoot {
    position: fixed;
    bottom: 20px;
    right: 20px;
  }

  /* Add some margin to the table to prevent it from overlapping with the button */
  table {
    margin-bottom: 60px; /* Adjust this value according to your needs */
  }
</style>

<a id="top-of-page"></a>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div style="padding-top: 30px;">
          <strong>
            <span class="glyphicon glyphicon-th" style="color: black;"></span>
            <span style="color: black;">All Sales</span>
          </strong>
        </div>
        <div class="pull-right">
          <a href="add_sale.php" class="btn btn-primary"style="background-color:blue;">
            <span class="glyphicon glyphicon-plus-sign"></span> Add Sale
          </a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product name</th>
              <th class="text-center" style="width: 15%;">Quantity</th>
              <th class="text-center" style="width: 15%;">Total</th>
              <th class="text-center" style="width: 15%;">Date</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale) : ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($sale['name']); ?></td>
                <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
                <td class="text-center"><?php echo $sale['date']; ?></td>
                <td class="text-center">
                  <div class="btn-group btn-group-vertical">
                    <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-edit-sale btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>Edit 
                    </a>
                    <button type="button" class="btn btn-delete-sale btn-xs btn-delete-sale" data-toggle="modal" data-target="#deleteSaleModal" data-id="<?php echo (int)$sale['id']; ?>" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>Delete
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="9" class="text-center">
                <a href="#top-of-page" class="btn btn-info"style="background-color:blue;">
                  <span class="glyphicon glyphicon-arrow-up"></span> Back to Top
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
<div id="deleteSaleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this sale? This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a id="confirmDeleteSale" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.btn-delete-sale', function() {
    var saleId = $(this).data('id');
    $('#confirmDeleteSale').attr('href', 'delete_sale.php?id=' + saleId);
});
</script>

<?php include_once('layouts/footer.php'); ?>





