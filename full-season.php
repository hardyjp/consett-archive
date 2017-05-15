<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consett AFC archive site</title>
    <meta name="description" content="A complete archive of Consett's results and league tables since 1919 AFC of site.">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="consett-archive.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    
<div class="container">
    <h1>
    <?php echo $_GET['season']; ?>
    </h1>
    
<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query  = "SELECT Date, Opponents, Competition, HA, Score, ID, ReportURL FROM results_archive WHERE Season='" . $_GET['season'] . "' ORDER BY ID";
  $result = $conn->query($query);
  if (!$result) die($conn->error);

  $rows = $result->num_rows;
?>
    <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Opponents</th>
        <th>Competition</th>
        <th></th>
        <th>Score</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php    
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);
    $reportUrl = "match-report.php?id=" . $row['ID'];
    if ($row['ReportURL'] != ""){
        $reportUrl = $row['ReportURL'];
    }
    print "<tr>
        <td>" . $row['Date'] . "</td><td>" . $row['Opponents'] . "</td><td>" . $row['Competition'] . "</td><td>" . $row['HA'] . "</td><td>" . $row['Score'] . "</td><td><a href='" . $reportUrl . "'>Details</a></td>
        </tr>";
  }

  $result->close();
  $conn->close();
?>
    </tbody>
  </table>

</div>
    
</body>
</html>