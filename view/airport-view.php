<?php
    require_once '../business-logic/airport-business-logic.php';
    require_once '../business-logic/country-business-logic.php';

    $bl = new BusinessLogicAirport;
    
    $blCountry = new BusinessLogicCountry;
    $arrayOfCountry = $blCountry -> get();

    $alert = null;
    if (!empty($_POST['airportCountry']) && !empty($_POST['newAirport'])){

      $newAirport = new AirportModel([
        'airport_name' => $_POST['newAirport'],
        'airport_country_id' => $_POST['airportCountry']
        ]);
      
      $checkAirport = $bl->getOneByName($newAirport);

      if (!$checkAirport){
        $bl->set($newAirport);
        $alert = 'The airport added successfully!';
      }
      else
        $alert = 'The airport already registered!';
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add airport</title>
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
              <li><a href="../view/country-view.php">Add country</a></li>
            </ul>
        </div>
      </nav>
  </header>
<br>
<main class="container">
  <div class="container">
    <form class="form-horizontal col-sm-offset-1 col-sm-3" style="border:1px solid black" action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
      <h3>Add airport</h3>
      <div class="form-group">
        <label for="inputCountry" class="col-sm-3 control-label">Country:</label>
            <div class="col-sm-10">
              <select class="form-control" name="airportCountry">
                <?php foreach ($arrayOfCountry as $country) { ?>
              <option id="inputCountry" value=" <?php echo $country->getCountryId() ?>"> <?php echo $country->getCountryName() ?> </option>
            <?php } ?>
              </select> 
          </div>
      </div>
      <div class="form-group">
        <label for="inputairport" class="col-sm-3 control-label">Airport:</label>
        <div class="col-sm-10">
          <input class="form-control" id="inputairport" placeholder="airport" name="newAirport">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2">
          <button type="submit" class="btn btn-primary">Add airport</button>
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
