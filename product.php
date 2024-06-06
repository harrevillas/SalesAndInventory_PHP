<?php
$page_title = 'All Product';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);
$products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>

<!-- Style for low stock alert -->
<style>
  body {
    background-color: #add8e6;
  }
  .low-stock-alert {
    background: #dc3545; /* Dark red background */
   
  }

  .modal-content img {
    width: 100%;
    height: auto;
    max-width: 600px;
  }

  .product-image.zoomed {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    z-index: 9999;
  }

  .img-avatar {
    cursor: pointer;
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
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-left" style="padding-top: 7px;">
          <strong>
            <span class="glyphicon glyphicon-list-alt"></span>
            <span>Products Inventory</span>
          </strong>
        </div>
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary"style="background-color:blue;">
            <span class="glyphicon glyphicon-plus-sign"></span> Add New
          </a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product Code</th>
              <th> Photo</th>
              <th> Product Title </th>
              <th class="text-center" style="width: 10%;"> Categories </th>
              <th class="text-center" style="width: 10%;"> In-Stock </th>
              <th class="text-center" style="width: 10%;"> Price </th>
              <th class="text-center" style="width: 10%;"> Product Added </th>
              <th class="text-center" style="width: 100px;"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) : ?>
              <!-- Check if product quantity is low and apply alert class -->
              <tr <?php echo ($product['quantity'] <= 10) ? 'class="low-stock-alert"' : ''; ?>>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td> <?php echo remove_junk($product['code']); ?></td>
                <td>
                  <?php if ($product['media_id'] === '0') : ?>
                    <img class="img-avatar img-circle product-image" src="uploads/products/no_image.png" alt="" title="View Image" data-toggle="tooltip">
                  <?php else : ?>
                    <img class="img-avatar img-circle product-image" src="uploads/products/<?php echo $product['image']; ?>" alt="" title="View Image" data-toggle="tooltip">
                  <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center">
                  <?php echo remove_junk($product['quantity']); ?>
                  <!-- Display warning icon if quantity is low -->
                  <?php if ($product['quantity'] <= 10) : ?>
                    <span class="glyphicon glyphicon-alert" title="Low Stock"></span>
                  <?php endif; ?> 
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group btn-group-vertical">
                    <a href="verify_editproduct.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>
                    <!-- this button will trigger modal for deletion-->
                    <a href="verify_deleteproduct.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span> Delete
                    </a>
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

<!-- Modal for image -->
<div id="imageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" title="Close" data-toggle="tooltip">
          <span class="glyphicon glyphicon-remove"></span> Close
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Deletion confirmation modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this product?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" title="Cancel" data-toggle="tooltip" data-placement="top"><i class="fas fa-times-circle"></i>Cancel</button>
        <a id="confirmDelete" class="btn btn-danger" href="#" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash-alt"></i>Delete</a>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php include_once('layouts/footer.php'); ?>

<script>
 // $(document).ready(function() {
  // Loop through each product with low stock
 // $('.low-stock-alert').each(function() {
      // Get the product name and stock quantity
    //  var $product = $(this).find('td:nth-child(4)').text(); // Product Title
    //  var quantity = $(this).find('td:nth-child(5)').text(); // Stock Quantity

      // Display an alert for each product
   //   alert('Low stock alert!\n\nProduct: ' + $product + '\nStock Quantity:'+quantity);
 // });
//}); 

  // Initialize tooltips for all elements
  $('[data-toggle="tooltip"]').tooltip();

  // Event listener for delete modal
  $('#deleteModal').on('show.bs.modal', function(e) {
    var productId = $(e.relatedTarget).data('id');
    $('#confirmDelete').attr('href', 'delete_product.php?id=' + productId);
  });

  // Add a click event listener to the product image
  $('.product-image').click(function() {
    var imageUrl = $(this).attr('src');

    // Show a modal with the image
    $('#imageModal').find('.modal-body').html('<img src="' + imageUrl + '" class="img-responsive">');
    $('#imageModal').modal('show');
  });

  // Add a click event listener to close the modal or zoomed-in image
  $('#imageModal').on('hidden.bs.modal', function() {
    // Remove the image when the modal is closed
    $(this).find('.modal-body').html('');
  });
</script>
