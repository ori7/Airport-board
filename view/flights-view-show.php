<?php
    session_start();
    require_once '../business-logic/flights-business-logic.php';
    require_once '../business-logic/airport-business-logic.php';
    require_once '../business-logic/Pilot-business-logic.php';

    $bl = new BusinessLogicFlights;

    if (isset($_POST['delite'])){
        $bl->deliteId($_POST['delite']);
    }

    if (isset($_POST['updateNow'])){

        $updateFlight = new FlightModel([
            'flight_no' =>  $_POST['flight_no'],
            'flight_datetime' => $_POST['flight_datetime'],
            'flight_from' => $_POST['flight_from'],
            'flight_to' => $_POST['flight_to'],
            'flight_pilot_id' => $_POST['flight_pilot_id']
      ]);
        $bl->updateId($updateFlight,$_POST['updateNow']);
    } 

    $arrayOfFlights = $bl->get();

    if (isset($_POST['filter'])){
    
        if ($_POST['from_date'] != null && $_POST['to_date'] != null){
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $arrayOfFlights = $bl->getByDate($from_date,$to_date);
        }
        if (is_numeric($_POST['filter_flight_from'])){
            $temporaryArrayOfFlights = $arrayOfFlights;
            $arrayOfFlights =[];
                foreach ($temporaryArrayOfFlights as $flight){
                    if ($flight->getFlightFrom() == $_POST['filter_flight_from'])
                    array_push($arrayOfFlights,$flight);
                }
        }
        if (is_numeric($_POST['filter_flight_to'])){
            $temporaryArrayOfFlights = $arrayOfFlights;
            $arrayOfFlights =[];
                foreach ($temporaryArrayOfFlights as $flight){
                    if ($flight->getFlightTo() == $_POST['filter_flight_to'])
                    array_push($arrayOfFlights,$flight);
                }
        }
        if (is_numeric($_POST['filter_flight_pilot_id'])){
            $temporaryArrayOfFlights = $arrayOfFlights;
            $arrayOfFlights =[];
                foreach ($temporaryArrayOfFlights as $flight){
                    if ($flight->getFlightPilotId() == $_POST['filter_flight_pilot_id'])
                    array_push($arrayOfFlights,$flight);
                }
        }
    }
    $arrayOfAllFlights = $bl->get();

    $bla = new BusinessLogicAirport;
    $arrayOfAirport = $bla->get();
    $blp = new BusinessLogicPilots;
    $arrayOfPilots = $blp->get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show flights</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
</head>
<body>
    <header class="container">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="../view/pilot-view-show.php">Show pilots</a></li>
                <li><a href="../view/flights-view-add.php">Add flight</a></li>
                <li><a href="../view/pilot-view-add.php">Add pilot</a></li>
                <li><a href="../view/airport-view.php">Add airport</a></li>
                <li><a href="../view/country-view.php">Add country</a></li>
            </ul>
        </div>
        </nav>
    </header>     
    <main class="container">
        <?php
            if (isset($_SESSION['alert'])){ ?> 
                <div class="alert alert-success text-center" role="alert"> <?php echo $_SESSION['alert'] ?></div>
        <?php } ?>

        <form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
            <table class="table table-hover">
                    <tr>
                        <td><strong>Flight id</strong></td>
                        <td><strong>Flight no</strong></td>
                        <td><strong>Flight datetime</strong></td>
                        <td><strong>Flight from</strong></td>
                        <td><strong>Flight to</strong></td>
                        <td><strong>Flight pilot</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>from date<input class="form-control" type="date" name="from_date" 
                            value="<?php if (isset($_POST['filter'])) 
                                            echo $_POST['from_date'] ?>">
                            to date<input class="form-control" type="date" name="to_date"
                            value="<?php if (isset($_POST['filter'])) 
                                            echo $_POST['to_date'] ?>">
                        </td>
                        <td>
                            <select class="form-control" name="filter_flight_from">
                                <option>all flights</option>
                                <?php foreach ($arrayOfAirport as $airport) { 
                                        foreach ($arrayOfAllFlights as $flight){
                                            if ($airport->getAirportId() == $flight->getFlightFrom()){ ?>
                                                <option value=" <?php echo $airport->getAirportId() ?>"
                                                    <?php if (isset($_POST['filter']))
                                                               if ($airport->getAirportId() == $_POST['filter_flight_from']) 
                                                                    echo 'selected' ?> >
                                                    <?php echo $airport->getAirportName() ?> 
                                                </option>
                                <?php   break;  }   }   }?>
                            </select> 
                        </td>              
                        <td>               
                            <select class="form-control" name="filter_flight_to">
                                <option>all flights</option>
                                <?php foreach ($arrayOfAirport as $airport) { 
                                        foreach ($arrayOfAllFlights as $flight){
                                            if ($airport->getAirportId() == $flight->getFlightTo()){ ?>
                                                <option value=" <?php echo $airport->getAirportId() ?>"
                                                    <?php  if (isset($_POST['filter']))
                                                                if ($airport->getAirportId() == $_POST['filter_flight_to'])
                                                                    echo 'selected' ?> > 
                                                    <?php echo $airport->getAirportName() ?> 
                                                </option>
                                <?php   break;  }   }   } ?>
                            </select> 
                        </td>                        
                        <td>
                            <select class="form-control" name="filter_flight_pilot_id">
                                <option>all pilots</option>
                                <?php foreach ($arrayOfPilots as $pilot) { 
                                        foreach ($arrayOfAllFlights as $flight){
                                            if ($pilot->getPilotId() == $flight->getFlightPilotId()){ ?>
                                                <option value=" <?php echo $pilot->getPilotId() ?>" 
                                                    <?php if (isset($_POST['filter']))
                                                                if ($pilot->getPilotId() == $_POST['filter_flight_pilot_id'])
                                                                    echo 'selected' ?> > 
                                                    <?php echo $pilot->getPilotName() ?> 
                                                </option>
                                <?php   break;  }   }   } ?>
                            </select> 
                        </td>
                        <td><button class="btn btn-primary" name="filter">filter</button></td>
                    </tr>
                <?php foreach ($arrayOfFlights as $flight) {
                    $updateId = -1;
                    if (isset($_POST['update']))
                        $updateId = $_POST['update'];
                    if ($updateId == $flight->getFlightId()){
                ?>
                        <form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
                            <tr>
                                <td><strong><?php echo $flight->getFlightId() ?></strong></td>
                                <td><input name="flight_no" value="<?php echo $flight->getFlightNo() ?>"></td>
                                <td><input name="flight_datetime" value="<?php echo $flight->getFlightDatetime() ?>"></td>
                                <td>
                                    <select class="form-control" name="flight_from">
                                        <?php foreach ($arrayOfAirport as $airport) { ?>
                                            <option
                                            <?php
                                            if ($flight->getFlightFrom() == $airport->getAirportId()) 
                                            echo  'selected' ?>
                                            value=" <?php echo $airport->getAirportId() ?>"> <?php echo $airport->getAirportName() ?> </option>
                                        <?php } ?>
                                    </select> 
                                </td>
                                <td>
                                    <select class="form-control" name="flight_to">
                                        <?php foreach ($arrayOfAirport as $airport) { ?>
                                            <option
                                            <?php
                                            if ($flight->getFlightTo() == $airport->getAirportId()) 
                                            echo  'selected' ?>
                                            value=" <?php echo $airport->getAirportId() ?>"> <?php echo $airport->getAirportName() ?> </option>
                                        <?php } ?>
                                    </select> 
                                </td>
                                <td>
                                    <select class="form-control" name="flight_pilot_id">
                                        <?php foreach ($arrayOfPilots as $pilot) { ?>
                                            <option
                                            <?php
                                            if ($flight->getFlightPilotId() == $pilot->getPilotId()) 
                                            echo  'selected' ?>
                                            value=" <?php echo $pilot->getPilotId() ?>"> <?php echo $pilot->getPilotName() ?> </option>
                                        <?php } ?>
                                    </select> 
                                </td>
                                <td><button class="btn btn-primary" name="updateNow" value="<?php echo $flight->getFlightId() ?>">Update</button></td>
                            </tr>
                        </form>
                <?php
                    } else {
                ?>
                    <tr>
                        <td><strong><?php echo $flight->getFlightId() ?></strong></td>
                        <td><?php echo $flight->getFlightNo() ?></td>
                        <td><?php echo $flight->getFlightDatetime() ?></td>
                        <td><?php echo $flight->getAirportModel($flight->getFlightFrom())->getAirportName() ?></td>
                        <td><?php echo $flight->getAirportModel($flight->getFlightTo())->getAirportName() ?></td>
                        <td><?php echo $flight->getPilotModel()->getPilotName() ?></td>
                        <td><button class="btn btn-default" name="delite" value="<?php echo $flight->getFlightId() ?>">Delite</button></td>
                        <td><button class="btn btn-default" name="update" value="<?php echo $flight->getFlightId() ?>">Update</button></td>
                    </tr>
                <?php } 
                }   
                ?>
            </table>
        </form>
    </main>
    <?php
        session_destroy();
    ?>
</body>
</html>