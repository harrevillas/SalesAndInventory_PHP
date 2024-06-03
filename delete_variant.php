<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Find the category by ID
  $variant = find_by_id('variant',(int)$_GET['id']);
  if(!$variant){
    $session->msg("d","Missing Variant id.");
    redirect('variant.php');
  }
  $categoryName = $variant['name'];
?>
<?php
  $delete_id = delete_by_id('variant',(int)$variant['id']);
  if($delete_id){
      $session->msg("s","Variant '{$categoryName}' has been deleted.");
      redirect('variant.php');
  } else {
      $session->msg("d","Variant deletion failed.");
      redirect('variant.php');
  }
?>
