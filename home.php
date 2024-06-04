<?php
$page_title = 'User Home Page';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {redirect('index.php', false);}

?>
<?php include_once('layouts/header.php'); ?>


<style>

.sidebar {
    background-color: #add8e6;
  }
  
  body {
    background-color: #add8e6;
  }
  .welcome-container {
    text-align: center;
    margin: 100px 0;
    font-size: 100px;
    color: #000;
    padding: 50px;
    border-radius: 20px;
    position: relative;
  }

  .welcome-container img {
    width: 850px;
    height: auto;
    border-radius: 20px;
    opacity: 0.2; /* Set a low opacity for the background logo */
    position: absolute;
    top: 95%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .welcome-text {
    position: relative;
    z-index: 1;
    font-weight: bold;
  }
</style>

<div class="welcome-container">
  <img src="libs/images/seles.png" alt="">
  <div class="welcome-text">
    WELCOME USER
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
