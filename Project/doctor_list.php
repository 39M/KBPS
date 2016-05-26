<?php
session_start();    // init session
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    header("Location:index.php");  // not logged in, redirect
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
            <a class="navbar-brand" href="doctor_index.php">Knowledge-Based Prescription System</a>
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
                    <a href="doctor_index.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                </li>
                <li>
                    <a href="doctor_make.php"><i class="fa fa-fw fa-edit"></i> Compose</a>
                </li>
                <li class="active">
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

            <form role="form">
                <div class="form-group input-group">
                    <input type="text" class="form-control" title="Search Prescriptions">
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
                        <th>Time</th>
                        <th>Price (USD)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>110</td>
                        <td>Patient 10</td>
                        <td>Brief Description</td>
                        <td>2016-01-05</td>
                        <td>13:32</td>
                        <td>71.32</td>
                    </tr>
                    <tr>
                        <td>109</td>
                        <td>Patient 9</td>
                        <td>Brief Description</td>
                        <td>2016-01-04</td>
                        <td>09:32</td>
                        <td>23.71</td>
                    </tr>
                    <tr>
                        <td>108</td>
                        <td>Patient 8</td>
                        <td>Brief Description</td>
                        <td>2016-01-03</td>
                        <td>13:32</td>
                        <td>201.21</td>
                    </tr>
                    <tr>
                        <td>107</td>
                        <td>Patient 7</td>
                        <td>Brief Description</td>
                        <td>2016-01-02</td>
                        <td>20:08</td>
                        <td>9.63</td>
                    </tr>
                    <tr>
                        <td>106</td>
                        <td>Patient 6</td>
                        <td>Brief Description</td>
                        <td>2016-01-02</td>
                        <td>18:38</td>
                        <td>89.65</td>
                    </tr>
                    <tr>
                        <td>105</td>
                        <td>Patient 5</td>
                        <td>Brief Description</td>
                        <td>2016-01-02</td>
                        <td>11:52</td>
                        <td>86.35</td>
                    </tr>
                    <tr>
                        <td>104</td>
                        <td>Patient 4</td>
                        <td>Brief Description</td>
                        <td>2016-01-01</td>
                        <td>15:08</td>
                        <td>23.45</td>
                    </tr>
                    <tr>
                        <td>103</td>
                        <td>Patient 3</td>
                        <td>Brief Description</td>
                        <td>2016-01-01</td>
                        <td>14:22</td>
                        <td>70.28</td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Patient 2</td>
                        <td>Brief Description</td>
                        <td>2016-01-01</td>
                        <td>14:00</td>
                        <td>98.91</td>
                    </tr>
                    <tr>
                        <td>101</td>
                        <td>Patient 2</td>
                        <td>Brief Description</td>
                        <td>2016-01-01</td>
                        <td>13:50</td>
                        <td>89.60</td>
                    </tr>
                    <tr>
                        <td>100</td>
                        <td>Patient 1</td>
                        <td>Brief Description</td>
                        <td>2016-01-01</td>
                        <td>13:09</td>
                        <td>23.17</td>
                    </tr>
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
