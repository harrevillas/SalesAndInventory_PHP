<?php
$page_title = 'Add Product';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);
date_default_timezone_set('Asia/Manila');
$all_categories = find_all('categories');
$all_variants = find_all('variant');
$all_photo = find_all('media');

// Sort the array of photos alphabetically by file name
usort($all_photo, function ($a, $b) {
  return strcmp($a['file_name'], $b['file_name']);
});
?>
<?php
if (isset($_POST['add_product'])) {
  $req_fields = array('product-code', 'product-title', 'product-categorie', 'product-quantity', 'saleing-price');
  validate_fields($req_fields);

  if (!preg_match('/^[0-9]+$/', $_POST['product-code'])) {
    $session->msg('d', 'Product code can only contain numerical values.');
    redirect('add_product.php', false);
  }
  // Validate product title format
  if (!preg_match('/^[a-zA-Z]+$/', $_POST['product-title'])) {
    $session->msg('d', 'Product title can only contain alphabetical characters.');
    redirect('add_product.php', false);
  }

  if (empty($errors)) {
    $p_code  = remove_junk($db->escape($_POST['product-code']));
    $p_name  = remove_junk($db->escape($_POST['product-title']));
    $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
    $p_variant = remove_junk($db->escape($_POST['product-variant']));
    $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
    $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $date    = make_date();
    $query  = "INSERT INTO products (";
    $query .= " code,name, quantity,sale_price,categorie_id,id,media_id,date";
    $query .= ") VALUES (";
    $query .= " '{$p_code}','{$p_name}', '{$p_qty}', '{$p_sale}', '{$p_cat}', '{$p_variant}','{$media_id}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";
    if ($db->query($query)) {
      // Get the name of the added product
      $added_product_name = $p_name;
      $session->msg('s', "Product '{$added_product_name}' has been added. ");
      redirect('add_product.php', false);
    } else {
      $session->msg('d', 'Sorry product: {added_product_name} failed to be added!');
      redirect('product.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<!-- Add jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Product</span>
        </strong>
      </div>

      <div class="panel-body">
        <div class="col-md-12">
          <form id="addProductForm" method="post" action="add_product.php" class="clearfix">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-title" placeholder="Product Name *">
                <span class="error"></span>
              </div>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-code" placeholder="Product Code *">
                <span class="error"></span>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" name="product-categorie">
                    <option value="">Select Product Category *</option>
                    <?php foreach ($all_categories as $cat) : ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="error"></span>
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="product-photo">
                    <option value="">Select Product Photo</option>
                    <?php foreach ($all_photo as $photo) : ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </span>
                    <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity *">
                    <span class="error"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      ₱
                    </span>
                    <input type="number" class="form-control" name="saleing-price" placeholder="Price *">
                    <span class="error"></span>
                    <span class="input-group-addon">.00</span>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary" style="background-color: blue;">
              <span class="glyphicon glyphicon-plus-sign"></span> Add Product
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#addProductForm').on('submit', function(event) {
    var isValid = true;

    // Check required fields
    var requiredFields = ['product-title', 'product-code', 'product-categorie', 'product-quantity', 'saleing-price'];
    requiredFields.forEach(function(fieldName) {
      var field = $('[name="' + fieldName + '"]');
      var errorSpan = field.next('.error');
      if (!field.val()) {
        isValid = false;
        errorSpan.text('This field is required.');
      } else {
        errorSpan.text('');
      }
    });

    if (!isValid) {
      event.preventDefault();
    }
  });
</script>

<?php include_once('layouts/footer.php'); ?>
