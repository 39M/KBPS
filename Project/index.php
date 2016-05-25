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
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>Knowledge-Based Prescription System</h1>
            <h3>Select your role</h3>
            <a href="#doctor" class="btn btn-dark btn-lg">I am a doctor</a>
            <a href="#admin" class="btn btn-dark btn-lg">I am an administrator</a>
        </div>
    </header>

    <header id="doctor" class="header">
        <div class="text-vertical-center">
            <h1>Doctor Login</h1>
            <h3>Username</h3>
            <h3><input type="password" placeholder="password"></h3>
            <br>
            <button class="btn btn-dark btn-lg">Login to Workspace</button>
        </div>
    </header>

    <header id="admin" class="header">
        <div class="text-vertical-center">
            <h1>Administrator Login</h1>
            <h3>Username: </h3>
            <h3>Password: </h3>
            <br>
            <a href="#admin" class="btn btn-dark btn-dark">Login to Dashboard</a>
        </div>
    </header>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Knowledge-Based Prescription System</strong>
                    </h4>
                    <p>Yet Another Database Group<br>Xivid, Nil, Tony</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> +86 13029990587</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:kbps@vivid.name">kbps@vivid.name</a>
                        </li>
                    </ul>
                    <br>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Yet Another Database Group 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
        // Scrolls to the selected menu item on the page
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    </script>
</body>

</html>
