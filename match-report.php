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
    
    <?php
      require_once 'login.php';
      $conn = new mysqli($hn, $un, $pw, $db);
      if ($conn->connect_error) die($conn->connect_error);

      $query  = "SELECT * FROM results_archive WHERE ID='" . $_GET['id'] . "'";
      $result = $conn->query($query);
      if (!$result) die($conn->error);
      $details=$result->fetch_assoc();

    if ($details['HA'] == 'H')
      {
        print "<h1>Consett " . $details['ConsettScore'] . " " . $details['Opponents'] . " " . $details['OppScore'] . "</h1>";
      } else {
        print "<h1>" . $details['Opponents'] . " " . $details['OppScore'] . " Consett " . $details['ConsettScore'] . "</h1>";
      }
    print "<h3>" . $details['Competition'] . "<br />" . $details['Venue'] . ", " . $details['TextDate'] . "</h3>";
    ?>

    <p><strong>Scorers:</strong>&nbsp;
        <?php
            $scorers = array($details['Scorer1'], $details['Scorer2'], $details['Scorer3'], $details['Scorer4'], $details['Scorer5'], $details['Scorer6'], $details['Scorer7'], $details['Scorer8']);
            if ($scorers[0] == '') {
                print "none";
            } else {
                for($x = 0; $scorers[$x] != ''; $x++) {
                    if ($x != 0){print ", ";}
                    print $scorers[$x];
                }
            }
        ?>
    </p>
    <p><strong>Team:</strong>&nbsp;
        <?php
            print $details['No1'] . ", " . $details['No2'] . ", " . $details['No3'] . ", " . $details['No4'] . ", " . $details['No5'] . ", " . $details['No6'] . ", " . $details['No7'] . ", " . $details['No8'] . ", " . $details['No9'] . ", " . $details['No10'] . ", " . $details['No11'] . ".";
            print " Subs: ";
            $subs = array($details['Sub1'], $details['Sub2'], $details['Sub3']); 
            if ($subs[0] == '') {
                print "none";
            } else {
                for($x = 0; $subs[$x] != ''; $x++) {
                    if ($x != 0){print ", ";}
                    print $subs[$x];
                }
            }
        ?>
    </p>
    <?php
      if ($details['Report'] != '') {
        print "<h4>Match report</h4>";
        print "<p>" . $details['Report'] . "</p>";
        }
      $result->close();
      $conn->close();
    ?>

</div>
    
</body>
</html>