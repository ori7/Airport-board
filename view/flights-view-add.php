<?php
    session_start();
    require_once '../business-logic/flights-business-logic.php';
    require_once '../business-logic/airport-business-logic.php';
    require_once '../business-logic/pilot-business-logic.php';

    $bl = new BusinessLogicFlights;

    $blAirport = new BusinessLogicAirport;
    $arrayOfAirport = $blAirport -> get();

    $blPilots = new BusinessLogicPilots;
    $arrayOfPilots = $blPilots -> get();
    
    $alert = null;
    if (!empty($_POST['flight_no']) && !empty($_POST['flight_datetime']) && !empty($_POST['flight_from']) && !empty($_POST['flight_to']) && !empty($_POST['flight_pilot_id'])){
      if ($_POST['flight_from'] != $_POST['flight_to']){

      $flight = new FlightModel([
            'flight_no' =>  $_POST['flight_no'],
            'flight_datetime' => $_POST['flight_datetime'],
            'flight_from' => $_POST['flight_from'],
            'flight_to' => $_POST['flight_to'],
            'flight_pilot_id' => $_POST['flight_pilot_id']
      ]);

      $bl->set($flight);

      $_SESSION['alert'] = 'The flight added successfully!';

      header("Location: flights-view-show.php");
      exit;
    }
      else 
      $alert = 'Mistake, the flight not added';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add flights</title>
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
                <li><a href="../view/pilot-view-add.php">Add pilot</a></li>
                <li><a href="../view/airport-view.php">Add airport</a></li>
                <li><a href="../view/country-view.php">Add country</a></li>
            </ul>
        </div>
      </nav>
  </header>
  <main class="container">
  <br>
    <div class="container">
      <form class="form-horizontal col-sm-offset-1 col-sm-3" style="border:1px solid black" action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
        <h3>Add flights</h3>
        <div class="form-group">
          <label for="input_flight_no" class="col-sm-4 control-label">Flight no:</label>
          <div class="col-sm-10">
            <input class="form-control" id="input_flight_no" placeholder="flight no" name="flight_no">
          </div>
        </div>
        <div class="form-group">
          <label for="input_flight_datetime" class="col-sm-6 control-label">Flight date-time:</label>
          <div class="col-sm-10">
            <input class="form-control" id="input_flight_datetime" type="datetime-local" placeholder="flight datetime" name="flight_datetime">
          </div>
        </div>
        <div class="form-group">
          <label for="input_flight_from" class="col-sm-5 control-label">Flight from:</label>
          <div class="col-sm-10">
            <select class="form-control" name="flight_from">
              <?php foreach ($arrayOfAirport as $airport) { ?>
              <option id="input_flight_from" value="<?php echo $airport->getAirportId() ?>"> <?php echo $airport->getAirportName() ?> </option>
              <?php } ?>
            </select> 
          </div>
        </div>
        <div class="form-group">
          <label for="input_flight_to" class="col-sm-4 control-label">Flight to:</label>
          <div class="col-sm-10">
            <select class="form-control" name="flight_to">
              <?php foreach ($arrayOfAirport as $airport) { ?>
              <option id="input_flight_to" value="<?php echo $airport->getAirportId() ?>"> <?php echo $airport->getAirportName() ?> </option>
              <?php } ?>
            </select> 
          </div>
        </div>
        <div class="form-group">
          <label for="input_flight_pilot_id" class="col-sm-4 control-label">Pilot id:</label>
          <div class="col-sm-10">
            <select class="form-control" name="flight_pilot_id">
              <?php foreach ($arrayOfPilots as $pilot) { ?>
              <option id="input_flight_pilot_id" value="<?php echo $pilot->getPilotId() ?>"> <?php echo $pilot->getPilotName() ?> </option>
              <?php } ?>
            </select> 
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" >Add flight</button>
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