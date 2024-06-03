<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    ul {
      padding-left: 0;
    }
    ul li {
      list-style: none;
    }
    ul li a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: grey;
      font-weight: bold;
    }
    ul li a i {
      margin-right: 10px;
    }
    .peso-sign {
      margin-right: 10px;
      font-weight: normal;
    }
  </style>
</head>
<body>
  <ul>
    <li>
      <a href="admin.php">
        <i class="glyphicon glyphicon-home"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="users.php">
        <i class="glyphicon glyphicon-user"></i>
        <span>Users</span>
      </a>
    </li>
    <li>
      <a href="categorie.php">
        <i class="glyphicon glyphicon-list-alt"></i>
        <span>Categories</span>
      </a>
    </li>
    <li>
      <a href="variant.php">
        <i class="glyphicon glyphicon-star"></i>
        <span>Variant</span>
      </a>
    </li>
    <li>
      <a href="product.php">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Manage Products</span>
      </a>
    </li> 
    <li>
      <a href="add_product.php">
        <i class="glyphicon glyphicon-shopping-cart"></i>
        <span>Add Products</span>
      </a>
    </li>
    <li>
      <a href="media.php">
        <i class="glyphicon glyphicon-picture"></i>
        <span>Media Files</span>
      </a>
    </li>
    <li>
      <a href="sales.php">
        <i class="peso-sign">&#8369;</i>
        <span>Manage Sales</span>
      </a>
    </li>
    <li>
      <a href="add_sale.php">
        <i class="glyphicon glyphicon-credit-card"></i>
        <span>Add Sales</span>
      </a>
    </li>
    <li>
      <a href="daily_sales.php">
        <i class="glyphicon glyphicon-calendar"></i>
        <span>Sales</span>
      </a>
    </li>
  </ul>
</body>
</html>
