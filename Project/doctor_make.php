<?php
session_start();    // init session
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
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

    <title>KBPS - Compose</title>

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
    <script>
        function show_patient_table(ele) {
            if (ele.value == "add_patient") {
                document.getElementById('patient_form').style.display = "block";
                document.getElementById('patient_name').required = true;
                document.getElementById('patient_age').required = true;
                document.getElementById('patient_gender').required = true;
            }
            else {
                document.getElementById('patient_form').style.display = "none";
                document.getElementById('patient_name').required = false;
                document.getElementById('patient_age').required = false;
                document.getElementById('patient_gender').required = false;
            }
        }
    </script>

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
            <a class="navbar-brand" href="doctor_index.php">Knowledge-Based Prescription System</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    Doctor
                    <!--                        TODO: Username -->
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="doctor_index.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                </li>
                <li class="active">
                    <a href="doctor_make.php"><i class="fa fa-fw fa-edit"></i> Compose</a>
                </li>
                <li>
                    <a href="doctor_list.php"><i class="fa fa-fw fa-desktop"></i> Prescription List</a>
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
                        Compose
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="doctor_index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> Compose
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <form role="form">
                <div class="form-group">
                    <label>Patient</label>
                    <select class="form-control" title="Select Patient" onchange="show_patient_table(this)">
                        <option value="add_patient">Add New</option>

                        <option>Patient 1</option>
                        <option>Patient 2</option>
                        <option>Patient 3</option>
                        <option>Patient 4</option>
                        <option>Patient 5</option>
                    </select>
                </div>

                <div id="patient_form" style="display: block">
                    <div class="form-group">
                        <label>Patient Name</label>
                        <input class="form-control" id="patient_name" placeholder="Enter Patient Name">
                    </div>
                    <div class="form-group">
                        <label>Patient Age</label>
                        <input type="number" class="form-control" id="patient_age" placeholder="Enter Patient Age">
                    </div>
                    <div class="form-group">
                        <label>Patient Gender</label>
                        <select class="form-control" id="patient_gender" title="Select Patient Gender">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Symptoms</label>
                    <input class="form-control" placeholder="Select patient symptoms">
                </div>

                <div class="form-group">
                    <label>Diseases</label>
                    <input class="form-control" placeholder="Select patient diseases">
                </div>

                <div class="form-group">
                    <label>Medicine</label>
                    <select multiple class="form-control">
                        <option>Medicine 1</option>
                        <option>Medicine 2</option>
                        <option>Medicine 3</option>
                        <option>Medicine 4</option>
                        <option>Medicine 5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Description</label>
                            <textarea class="form-control" rows="3"
                                      placeholder="Write prescription description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>

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
