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

$going_to_make = false;
$patient_add_failed = false;
$prescription_add_failed = false;

if (isset($_POST['patient'])) {
    $going_to_make = true;

    if ($_POST['patient'] == 'add_patient') {
        $p_name = $_POST['patient_name'];
        $p_gender = $_POST['patient_gender'];
        $p_age = $_POST['patient_age'];

        $query = "INSERT INTO patient (Name, Gender, Age) VALUES ('$p_name', '$p_gender', $p_age)";
//        echo $query;
        if (!mysqli_query($connection, $query)) {
            $patient_add_failed = true;
        }
        $p_id = $connection->insert_id;
    } else
        $p_id = $_POST['patient'];

    $d_id = 1;
    $content = $_POST['description'];

    $query = "INSERT INTO prescription (patient_ID, doctor_ID, Content, Date) VALUES ($p_id, $d_id, '$content', now())";
//    echo $query;
    if (!mysqli_query($connection, $query))
        $prescription_add_failed = true;
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
    <link href="css/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="css/bootstrap-tagsinput-typeahead.css" rel="stylesheet">

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
                    <a href="doctor_make.php"><i class="fa fa-fw fa-edit"></i> New Prescription</a>
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
                        New Prescription
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="doctor_index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> New Prescription
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <form role="form" action="doctor_make.php" method="post">
                <div class="form-group">
                    <label>Patient</label>
                    <select required class="form-control" name="patient" title="Select Patient"
                            onchange="show_patient_table(this)">
                        <option value="add_patient">Add New</option>

                        <?php
                        $result = mysqli_query($connection, 'select * from patient')->fetch_all();
                        foreach ($result as $m)
                            echo '<option value="' . $m[0] . '">' . $m[1] . '</option>'
                        ?>

                        <!--                        <option>Patient 2</option>-->
                    </select>
                </div>

                <div id="patient_form" style="display: block">
                    <div class="form-group">
                        <label>Patient Name</label>
                        <input required class="form-control" id="patient_name" name="patient_name"
                               placeholder="Enter Patient Name">
                    </div>
                    <div class="form-group">
                        <label>Patient Age</label>
                        <input required type="number" class="form-control" id="patient_age" name="patient_age"
                               placeholder="Enter Patient Age">
                    </div>
                    <div class="form-group">
                        <label>Patient Gender</label>
                        <select required class="form-control" id="patient_gender" name="patient_gender"
                                title="Select Patient Gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Others</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label>Symptoms</label><br>
                    <input required class="form-control" data-role="tagsinput" name="symptoms" placeholder="Select patient symptoms">
                </div>

                <div class="form-group">
                    <label>Diseases</label><br>
                    <input required class="form-control" data-role="tagsinput" name="diseases" placeholder="Select patient diseases">
                </div>

                <div class="form-group">
                    <label>Medicine</label><br>
                    <select required multiple data-role="tagsinput" class="form-control" title="medicine" name="medicine" placeholder="Select medicine">
<!--                        --><?php
//                        $result = mysqli_query($connection, 'select * from medicine')->fetch_all();
//                        foreach ($result as $m)
//                            echo '<option value="' . $m[1] . '">' . $m[1] . '</option>'
//                        ?>
                        <!--                        <option>Medicine 1</option>-->
                    </select>
                </div>

                <div class="form-group">
                    <label>Description</label>
                            <textarea required class="form-control" name="description" rows="3"
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
<script src="js/bootstrap-tagsinput.js"></script>
<script src="js/bootstrap-tagsinput-angular.js"></script>

<?php

if (!$going_to_make)
    exit();

if ($patient_add_failed) {
    echo '<script language="javascript">' .
        'alert("Patient add failed!")' .
        '</script>';
    exit();
}

if ($prescription_add_failed)
    echo '<script language="javascript">' .
        'alert("Prescription made failed!")' .
        '</script>';
else
    echo '<script language="javascript">' .
        'alert("Prescription made successfully!")' .
        '</script>';
?>

</body>

</html>
