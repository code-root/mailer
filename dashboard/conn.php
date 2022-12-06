<?php 

                $servername = "localhost";
                $username = "sofa_user";
                $password = "sofa100200";
                $dbname = "rreact_api"; 
                

                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $conn->set_charset('utf8');

                // Check connection
                if (!$conn) {

                    die("Connection failed Call +966559188636");
                    exit;
                }

                
  function chack_login () {

  @  $isUserLoggedIn = isset($_SESSION['username']  ) ? true : false;
  @   $customerId = $isUserLoggedIn && is_numeric($_SESSION['customerId']) ? intval($_SESSION['customerId']) : 0;
  @   $status = $_SESSION['status'];

        if (!$isUserLoggedIn) {    
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL= ' .  '../login.php">';
            exit;
        }
  }


   ?>