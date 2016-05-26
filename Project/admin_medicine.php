<?php
session_start();    // init session
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location:index.php");  // not logged in, redirect
    exit();
}
require_once("connect.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Knowledge-Based Prescription System</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

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
                <li class="active">
                    <a href="admin_medicine.php"><i class="fa fa-fw fa-edit"></i> Medicine Management</a>
                </li>
                <li>
                    <a href="admin_disease.php"><i class="fa fa-fw fa-edit"></i> Disease Management</a>
                </li>
                <li>
                    <a href="admin_symptom.php"><i class="fa fa-fw fa-edit"></i> Symptom Management</a>
                </li>
                <li>
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
                        Medicine Management
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="admin_index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Medicine Management
                        </li>
                        <div style="text-align:right; margin-top: -1.2pc;"><a href="admin_medicine.php?action=new">New Medicine</a> <i id="createDefectBtn" class="fa fa-plus-circle fa-lg"></i></div>

                    </ol>
                </div>
            </div>

            <?php
                if (isset($_POST['medicine_name'])) {
                    
                    if (isset($_GET['action']) && $_GET['action'] == 'new') {

                        // INSERT INTO
                        $sql = "INSERT INTO medicine (ID, Name, Category, Description, Property, Adverse_effect, Pharmacokinetics, Mechanism) VALUES (NULL, '".$_POST["medicine_name"]."', '".$_POST["medicine_category"]."', '".$_POST["medicine_description"]."', '".$_POST["medicine_property"]."', '".$_POST["medicine_adverse_effect"]."', '".$_POST["medicine_pharmacokinetics"]."', '".$_POST["medicine_mechanism"]."')";
                      //  die($sql);
                        $flag = mysqli_query($con, $sql);
                            if ($flag == true) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                                echo "<strong>Success!</strong> You have inserted medicine " . $_POST["medicine_name"] . ".";
                                echo "</div>";
                            } else {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                                echo "<strong>Failed!</strong> Unable to insert medicine " .$_POST["medicine_name"];
                                echo "</div>";
                            }
                    } else if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                        // UPDATE
                    }
                }
                $showform = false;
                if (isset($_GET['action']) && $_GET['action'] == 'new') {
                    $showform = true;
                    $id = "";
                    $name = "";
                    $category = "";
                    $description = "";
                    $property = "";
                    $adverse_effect = "";
                    $pharmacokinetics = "";
                    $mechanism = "";
                }
                else if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                    $showform = true;
                    $id = $_GET['id'];
                    $result =mysqli_query($con, "SELECT FROM medicine WHERE id=".$_GET['id']);
                    $row = mysqli_fetch_array($result);
                    $name = $row['name'];
                    $category = $row['category'];
                    $description = $row['description'];
                    $property = $row['property'];
                    $adverse_effect = $row['adverse_effect'];
                    $pharmacokinetics = $row['pharmacokinetics'];
                    $mechanism = $row['mechanism'];
                }
                if ($showform) {
                    ?>

                <form role="form" method="post" action="admin_medicine.php?action=<?php echo $_GET['action'];?>">

                        <div id="patient_form" style="display: block">
                            <?php if ($_GET['action'] == 'edit') { ?>
                            <div class="form-group">
                                <label>Medicine ID</label>
                                <input class="form-control" name="ID" placeholder="Enter Medicine ID" value= <?php echo $id;?> >
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Medicine Name</label>
                                <input class="form-control" name="medicine_name" placeholder="Enter Medicine Name" value= <?php echo $name;?>>
                            </div>


                            <div class="form-group">
                                <label> Medicine Category</label>
                                <input class="form-control" name="medicine_category" placeholder="Enter Medicine Category" value= <?php echo $category;?>>
                            </div>


                            <div class="form-group">
                                <label> medicine_description</label>
                                <textarea  rows="3"  class="form-control" name="medicine_description" placeholder="Enter medicine_description" value= <?php echo $adverse_effect;?>></textarea>
                            </div>


                            <div class="form-group">
                                <label> Medicine medicine_roperty</label>
                                <textarea  rows="3" class="form-control" name="medicine_property" placeholder="Enter medicine_property" value= <?php echo $pharmacokinetics;?>></textarea>
                            </div>

                            <div class="form-group">
                                <label> Medicine medicine_pharmacokinetics</label>
                                <textarea  rows="3" class="form-control" name="medicine_pharmacokinetics" placeholder="Enter medicine_pharmacokinetics" value = <?php echo $mechanism;?>></textarea>
                            </div>


                            <div class="form-group">
                                <label> Medicine medicine_mechanism</label>
                                <textarea  rows="3" class="form-control" name="medicine_mechanism" placeholder="Enter medicine_mechanism" value = <?php echo $mechanism;?>></textarea>
                            </div>

                                                    <div class="form-group">
                                <label> Medicine medicine_adverse_effect</label>
                                <textarea  rows="3" class="form-control" name="medicine_adverse_effect" placeholder="Enter medicine_adverse_effect" value = <?php echo $mechanism;?>></textarea>
                            </div>



                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>

                    <?php
                }
                else {

            ?>

            <div class="row">
                <div class="col-lg-12">
                    <form role="form" method="get" action="admin_medicine.php">
                        <div class="form-group input-group">
                            <input type="hidden" name="action" value="search">
                            <input name="keyword" type="text" class="form-control" title="Search Prescriptions">
                        <span class="input-group-btn">
                            <button onclick="submit()" class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </form>
                    <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                            $flag = mysqli_query($con, "DELETE FROM medicine WHERE id=".$_GET['id']);
                            if ($flag == true) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                                echo "<strong>Success!</strong> You have deleted medicine #" . $_GET['id'] . ".";
                                echo "</div>";
                            } else {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
                                echo "<strong>Failed!</strong> Unable to delete medicine #" . $_GET['id'] . ". Maybe it is referenced by other instances.";
                                echo "</div>";
                            }
                        }
                    ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (isset($_GET['action']) && $_GET['action'] == 'search' && isset($_GET['keyword'])) {
                                    $sql = "SELECT ID, Name, Category, Description FROM medicine WHERE Name LIKE '%".$_GET["keyword"]."%'";
                                } else {
                                    $sql = "SELECT ID, Name, Category, Description FROM medicine";
                                }
                                $medicine = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_array($medicine)) {
                                    printf("<tr></tr><td>%d</td><td>%s</td><td>%s</td>", $row['ID'], $row['Name'], $row['Category']);
                                    if (strlen($row["Description"]) > 50) printf("<td>%s...</td>", substr($row["Description"], 0, 50));
                                    else printf("<td>%s</td>", $row["Description"]);
                                    printf("<td><a href='admin_medicine.php?action=edit&id=%d'>Edit</a></td><td><a href='admin_medicine.php?action=delete&id=%d'>Delete</a></td></tr>", $row['ID'], $row['ID']);
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php } ?>
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

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>

