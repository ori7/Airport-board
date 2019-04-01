<?php
    require_once '../business-logic/country-business-logic.php';

    $bl = new BusinessLogicCountry;
    $alert = null;
    if (!empty($_POST['newCountry'])){

      $newCountry = new CountryModel([
        'country_name' => $_POST['newCountry']
      ]);

      $checkCountry = $bl->getOne($newCountry);

      if (!$checkCountry){
        $bl->set($newCountry);
        $alert = 'The country added successfully!';
      }
      else
        $alert = 'The country already registered!';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add country</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
</head>
<body>
  <header class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li><a href="../view/flights-view-show.php">Show flights</a></li>
              <li><a href="../view/pilot-view-show.php">Show pilots</a></li>
              <li><a href="../view/flights-view-add.php">Add flight</a></li>
              <li><a href="../view/pilot-view-add.php">Add pilot</a></li>
              <li><a href="../view/airport-view.php">Add airport</a></li>
            </ul>
        </div>
      </nav>
  </header>
  <main class="container">
    <br>
    <div class="container">
      <form class="form-horizontal col-sm-offset-1 col-sm-3" style="border:1px solid black" action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
        <h3>Add country</h3>
        <div class="form-group">
          <label for="inputCountry" class="col-sm-3 control-label">Country:</label>
          <div class="col-sm-10">
            <input class="form-control" id="inputCountry" placeholder="country" name="newCountry">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Add country</button>
          </div>
        </div>
      </form>
    </div>
    <br>
    <?php
          if ($alert != null) {?>
              <div class="alert alert-success text-center" role="alert"> <?php echo $alert ?></div>
    <?php } ?>
            </div>
  </main>
</body>
</html>
