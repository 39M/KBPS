<?php
    session_start();
    if (isset($_SESSION['role']))
    {
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            unset($_SESSION['role']);
            unset($_SESSION['username']);
            unset($_SESSION['userid']);
            header("Location:index.php");  // logged out, redirect
            exit();
        }
        header("Location:".$_SESSION['role']."_index.php");  // logged in, redirect
        exit();
    }
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($role == "doctor") {
            if ($username == "Alice" and $password == "123456") {
                $_SESSION['role'] = "doctor";
                $_SESSION['userid'] = 1;
                $_SESSION['username'] = "Alice";
                header("Location:doctor_index.php");
            } else if ($username == "Bob" and $password == "123456") {
                $_SESSION['role'] = "doctor";
                $_SESSION['userid'] = 2;
                $_SESSION['username'] = "Bob";
                header("Location:doctor_index.php");
            } else if ($username == "Carl" and $password == "123456") {
                $_SESSION['role'] = "doctor";
                $_SESSION['userid'] = 3;
                $_SESSION['username'] = "Carl";
                header("Location:doctor_index.php");
            } else {
                header("Location:index.php?doctor_fail#doctor");
            }
        }
        else if ($role == "admin") {
            if ($username == "Dan" and $password == "123456") {
                $_SESSION['role'] = "admin";
                $_SESSION['userid'] = 4;
                $_SESSION['username'] = "Dan";
                header("Location:admin_index.php");
            } else if ($username == "Eve" and $password == "123456") {
                $_SESSION['role'] = "admin";
                $_SESSION['userid'] = 5;
                $_SESSION['username'] = "Eve";
                header("Location:admin_index.php");
            } else if ($username == "Frank" and $password == "123456") {
                $_SESSION['role'] = "admin";
                $_SESSION['userid'] = 6;
                $_SESSION['username'] = "Frank";
                header("Location:admin_index.php");
            } else {
                header("Location:index.php?admin_fail#admin");
            }
        }
    } else {
        header("Location:index.php");
    }
?>