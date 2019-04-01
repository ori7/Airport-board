<?php
    session_start();
    require_once '../business-logic/pilot-business-logic.php';

    $bl = new BusinessLogicPilots;

    if (!empty($_POST['pilot_name']) && !empty($_POST['pilot_level']) && !empty($_FILES['pilot_picture'])){

        $folder = '../images/';
        if(move_uploaded_file($_FILES['pilot_picture']['tmp_name'], $folder . $_FILES['pilot_picture']['name'])) {   

            $newPilot = new PilotModel([
                'pilot_name' => $_POST['pilot_name'],
                'pilot_level' => $_POST['pilot_level'],
                'pilot_picture_src' => $folder . $_FILES['pilot_picture']['name']
            ]);
        }

        $bl->set($newPilot);

        $_SESSION['alert'] = 'The pilot added successfully!';

        header("Location: pilot-view-show.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add pilot</title>
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
                <li><a href="../view/airport-view.php">Add airport</a></li>
                <li><a href="../view/country-view.php">Add country</a></li>
            </ul>
        </div>
        </nav>
    </header>
    <main class="container">
        <br>
        <form class="form-horizontal col-sm-offset-1 col-sm-3" style="border:1px solid black" action='<?php echo basename($_SERVER['PHP_SELF']); ?>' enctype="multipart/form-data" method='POST'>
            <h3>Add pilot</h3>
            <div class="form-group">
                <label for="pilot_name" class="col-sm-5 control-label">Pilot name:</label>
                <div class="col-sm-10">
                    <input class="form-control" id="pilot_name" placeholder="Pilot name" name="pilot_name">
                </div>
            </div>
            <div class="form-group">
                <label for="pilot_level" class="col-sm-5 control-label">Pilot level:</label>
                <div class="col-sm-10">
                    <input class="form-control" id="pilot_level" placeholder="pilot level" name="pilot_level">
                </div>
            </div>
            <div class="form-group">
                <label for="pilot_picture" class="col-sm-5 control-label">Pilot picture:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="pilot_picture" placeholder="Pilot picture" name="pilot_picture">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Add pilot</button>
                </div>
            </div>
        </form>
    </main>
</body>
</html>