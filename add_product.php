<?php
$page_title = 'Add Product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
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
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'saleing-price');
  validate_fields($req_fields);
  if (empty($errors)) {
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
    $query .= " name,quantity,sale_price,categorie_id,id,media_id,date";
    $query .= ") VALUES (";
    $query .= " '{$p_name}', '{$p_qty}', '{$p_sale}', '{$p_cat}', '{$p_variant}','{$media_id}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";
    if ($db->query($query)) {
      //Get the name of the added product
      $added_product_name = $p_name;
      $session->msg('s', "Product '{$added_product_name}' has been added. ");
      redirect('add_product.php', false);
    } else {
      $session->msg('d', ' Sorry product: {added_product_name} failed to be added!');
      redirect('product.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<style>
  
  body{
    background-color: #aad8e6;
  }
  .sidebar {
    background-color: #aad8e6;
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
          <form method="post" action="add_product.php" class="clearfix">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-title" placeholder="Product Name">
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" name="product-categorie">
                    <option value="">Select Product Category</option>
                    <?php foreach ($all_categories as $cat) : ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control" name="product-variant">
                            <option value="">Select Product Variant</option>
                            <?php foreach ($all_variants as $var) : ?>
                                <option value="<?php echo (int)$var['id'] ?>">
                                    <?php echo $var['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
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
                    <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      ₱
                    </span>
                    <input type="number" class="form-control" name="saleing-price" placeholder="Price">
                    <span class="input-group-addon">.00</span>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary"style="background-color:blue;">
              <span class="glyphicon glyphicon-plus-sign"></span> Add Product
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>