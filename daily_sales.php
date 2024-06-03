<?php
  $page_title = 'Sale Report';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
  page_require_level(3);

  include_once('layouts/header.php');
?>

<style>
  body {
    background-color: #aad8e6;
  }

  .sidebar {
    background-color: #add8e6;
  }
</style>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading"></div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="sale_report_process.php">
          <div class="form-group">
            <label class="form-label">Date Range</label>
            <div class="input-group">
              <input type="text" class="datepicker form-control" name="start-date" placeholder="From">
              <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
              <input type="text" class="datepicker form-control" name="end-date" placeholder="To">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">
              <span class="glyphicon glyphicon-print"></span> Generate Report
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  $page_title = 'Monthly Sales';
  $year = date('Y');
  $sales = monthlySales($year);
?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Monthly Sales</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product name</th>
              <th class="text-center" style="width: 15%;">Quantity sold</th>
              <th class="text-center" style="width: 15%;">Total</th>
              <th class="text-center" style="width: 15%;">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale):?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
              <td class="text-center"><?php echo $sale['date']; ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
  $page_title = 'Daily Sales';
  $year = date('Y');
  $month = date('m');
  $sales = dailySales($year,$month);
?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Daily Sales</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product name</th>
              <th class="text-center" style="width: 15%;">Quantity sold</th>
              <th class="text-center" style="width: 15%;">Total</th>
              <th class="text-center" style="width: 15%;">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale):?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
              <td class="text-center"><?php echo $sale['date']; ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
