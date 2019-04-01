<?php
    session_start();
    require_once '../business-logic/pilot-business-logic.php';
    
    $bl = new BusinessLogicPilots;

    if (isset($_POST['delite'])){
        $bl->deliteId($_POST['delite']);
    }
    
    $arrayOfPilot = $bl->get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show pilots</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
</head>
<body>
    <header class="container">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="../view/flights-view-show.php">Show flights</a></li>
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
                    <tr class="font-weight-bold">
                        <td><strong>Pilot id</strong></td>
                        <td><strong>Pilot name</strong></td>
                        <td><strong>Pilot level</strong></td>
                        <td><strong>Pilot picture src</strong></td>
                    </tr>        
                <?php foreach ($arrayOfPilot as $pilot) { ?>
                    <tr>
                        <td><strong><?php echo $pilot->getPilotId() ?></strong></td>
                        <td><?php echo $pilot->getPilotName() ?></td>
                        <td><?php echo $pilot->getPilotLevel() ?></td>
                        <td> <img src="<?php echo $pilot->getPilotPictureSrc()?>" width="80px" height="80px"/> </td>
                        <td><button class="btn btn-default" name="delite" value="<?php echo $pilot->getPilotId() ?>">Delite</button></td>
                        <td><button class="btn btn-default" name="update" value="<?php echo $pilot->getPilotId() ?>">Update</button></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </main>
    <?php
        session_destroy();
    ?>
</body>
</html>