<?php
$page_title = 'Edit product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
date_default_timezone_set('Asia/Manila'); // Set the timezone

// Fetch all photos from the database
$all_photo = find_all('media');

// Sort the array of photos alphabetically by file name
usort($all_photo, function ($a, $b) {
  return strcmp($a['file_name'], $b['file_name']);
});

$product = find_by_id('products', (int)$_GET['id']);
$all_categories = find_all('categories');

if (!$product) {
  $session->msg("d", "Missing product id.");
  redirect('product.php');
}

if (isset($_POST['product'])) {
  $req_fields = array('product-code','product-title', 'product-categorie', 'product-quantity', 'saleing-price');
  validate_fields($req_fields);

  if (!preg_match('/^[0-9]+$/', $_POST['product-code'])) {
    $session->msg('d', 'Product code can only contain numerical values.');
    redirect('product.php', false);
  }
  // Validate product title format
  if (!preg_match('/^[a-zA-Z]+$/', $_POST['product-title'])) {
    $session->msg('d', 'Product title can only contain alphabetical characters.');
    redirect('product.php', false);
  }

  if (empty($errors)) {
    $p_code  = remove_junk($db->escape($_POST['product-code']));
    $p_name  = remove_junk($db->escape($_POST['product-title']));
    $p_cat   = (int)$_POST['product-categorie'];
    $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
    $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $query   = "UPDATE products SET";
    $query  .= " code ='{$p_code}', name ='{$p_name}', quantity ='{$p_qty}',";
    $query  .= " buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
    $query  .= " WHERE id ='{$product['id']}'";
    $result = $db->query($query);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Product updated ");
      redirect('product.php', false);
    } else {
      $session->msg('d', ' Sorry failed to updated!');
      redirect('edit_product.php?id=' . $product['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_product.php?id=' . $product['id'], false);
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
</div>

<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Edit Product</span>
      </strong>
    </div>
    <div class="panel-body">
      <div class="col-md-7">
        <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-th-large"></i>
              </span>
              <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>">
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-th-large"></i>
              </span>
              <input type="text" class="form-control" name="product-code" value="<?php echo remove_junk($product['code']); ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <select class="form-control" name="product-categorie">
                  <option value=""> Select a category</option>
                  <?php foreach ($all_categories as $cat) : ?>
                    <option value="<?php echo (int)$cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']) : echo "selected";
                                                                    endif; ?>>
                      <?php echo remove_junk($cat['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-control" name="product-photo">
                  <option value=""> No image</option>
                  <?php foreach ($all_photo as $photo) : ?>
                    <option value="<?php echo (int)$photo['id']; ?>" <?php if ($product['media_id'] === $photo['id']) : echo "selected";
                                                                    endif; ?>>
                      <?php echo $photo['file_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="qty">Quantity</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </span>
                    <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="qty">Price</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                    <i class="fas fa-money-bill-alt"></i>
                    <span style="font-size: 20px;">&#8369;</span>
                    </span>
                    <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']); ?>">
                    <span class="input-group-addon">.00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" name="product" class="btn btn-primary"style="background-color:blue;"><span class="glyphicon glyphicon-edit"></span>Update</button>
        </form>
      </div>
    </div>

  </div>
</div>
</div>

<?php include_once('layouts/footer.php'); ?>