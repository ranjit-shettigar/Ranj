<h1>Select the Date Range</h1>
<hr>
<?php display_message(); ?>
<form action="index.php?view_reports" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Select From Date:</label>
    <input type="date" name="fromdate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Select To Date:</label>
    <input type="date" name="todate" class="form-control" id="exampleInputPassword1" required>
  </div>

  <input name="submit" type="submit" class="btn btn-primary" value="Generate Report">
</form>