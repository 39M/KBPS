<?php
session_start();    // init session
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location:index.php");  // not logged in, redirect
    exit();
}

$connection = mysqli_connect('localhost', 'root', '', 'KBPS_SYSTEM');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    header("Location:index.php");  // error, redirect
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KBPS - Prescription List</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin_index.php">Knowledge-Based Prescription System</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION["username"]; ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="login.php?action=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="admin_index.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                </li>
                <li>
                    <a href="admin_medicine.php"><i class="fa fa-fw fa-edit"></i> Medicine Management</a>
                </li>
                <li>
                    <a href="admin_disease.php"><i class="fa fa-fw fa-edit"></i> Disease Management</a>
                </li>
                <li>
                    <a href="admin_symptom.php"><i class="fa fa-fw fa-edit"></i> Symptom Management</a>
                </li>
                <li class="active">
                    <a href="admin_prescription.php"><i class="fa fa-fw fa-desktop"></i> Prescription List</a>
                </li>
                <li>
                    <a href="admin_log.php"><i class="fa fa-fw fa-desktop"></i> System Logs</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Prescription List
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="doctor_index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Prescription List
                        </li>
                    </ol>
                </div>
            </div>

            <form role="form" action="doctor_list.php" method="get">
                <div class="form-group input-group">
                    <input type="text" name="kw" class="form-control" title="Search Prescriptions">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID #</th>
                        <th>Patient</th>
                        <th>Brief</th>
                        <th>Date</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = 'select * from prescription';
                    if (isset($_GET['kw'])) {
                        $query .= ' where Content like \'%' . $_GET['kw'] . '%\'';
                    }

                    //                    echo $query;

                    $result = mysqli_query($connection, $query);
                    if ($result)
                        $result = $result->fetch_all();
                    else
                        $result = array();
                    foreach ($result as $p) {
                        $id = $p[0];
                        $patient = '';
                        $patient = mysqli_query($connection, 'select name from patient where id=' . $p[1])->fetch_all()[0][0];
                        $description = $p[3];
                        $date = $p[4];
                        echo '<tr>
                            <td>' . $id . '</td>
                            <td>' . $patient . '</td>
                            <td>' . $description . '</td>
                            <td>' . $date . '</td>
                            <td><a href="doctor_list.php?id=' .$id. '">See Detail</a></td>
                        </tr>';
                    }

                    ?>

                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>