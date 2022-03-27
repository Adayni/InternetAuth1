<?php
    //start the session
    session_start();

    //define and initialize variables
    $fname = $lname = $username = $email = $pword = $pwordVerif = "";
    $fnameEmpty =$lnameEmpty = $unameEmpty = $emailEmpty = $verifEmpty = $errorEmail = $errorPword = $errorMatch = $errorName = "";

    //see if values exist for username and password. If so, redirect to Home page
    if (isset($_POST['register'])) {

        //FORM DATA VALIDATION - empty fields, password length, email check 
        $fname = $_POST["fname"];
        if (empty($_POST["fname"])) {
            $fnameEmpty = '*First name field cannot be empty.';
        } else if (!preg_match ("/^[a-zA-Z-' ]*$/", $fname)) {
            $errorName = '*Name can only contain letters';
        } else {
            $fname = $_POST["fname"];
        }
        
        $lname = $_POST["lname"];
        if (empty($_POST["lname"])) {
            $lnameEmpty = '*Last name field cannot be empty.';
        } else if (!preg_match ("/^[a-zA-Z-' ]*$/", $lname)) {
            $errorName = '*Name can only contain letters';
        } else {
            $lname = $_POST["lname"];
        }
        
        if (empty($_POST["username"])) {
            $unameEmpty = '*Username field cannot be empty.';
        } else {
            $username = $_POST["username"];
        }
        
        $stuEmailPattern = "^[_a-z0-9-]+(\.[a-z0-9-]+)*@stu.aa.edu.us^";
        $email = $_POST["email"];
        if (empty($_POST["email"])) {
            $emailEmpty = '*Email field cannot be empty.';
        } else if (!preg_match ($stuEmailPattern, $email)){
            $errorEmail = '*Please use your student email.';
        } else {
            $email = $_POST["email"];
        }
        
        $pword = $_POST["pword"];
        if (empty($_POST["pword"]) || strlen($pword)>=8) {
            $errorPword = '*Password field cannot be empty, and must contain a minimum of 8 characters.';
        } else {
            $pword = $_POST["pword"];
        }
        
        $pwordVerif = $_POST["pwordVerif"];
        if (empty($_POST["pwordVerif"])) {
            $verifEmpty = '*Please re-enter your password.';
        } else if ($pword !== $pwordVerif) {
            $errorMatch = '*Passwords do not match.';
        } else {
            $pwordVerif = $_POST["pwordVerif"];

            header('Location: index.php'); //redirects to home page once registration is successful
        } 
    }

    //store data in .txt file
    $fp = fopen('register.txt', 'a');
    fwrite($fp, $fname);
    fwrite($fp, $lname);
    fwrite($fp, $username);
    fwrite($fp, $email);
    fwrite($fp, $pword);
    fwrite($fp, $pwordVerif);
    fclose($fp);
    
    //create cookie for access on other pages
    $cookie_name = "uname";
    $cookie_value = $username;
    setcookie("uname", $username, time() + (86400 * 30), "/");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!--Framework-Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!--Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Raleway&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">

        <!--Title and Favicon-->
        <title>AA Stud-Eat | Register</title>
        <link rel="icon" href="../images/AnnonaAcademy nb.png">

        <!--Added Styles-->
        <style>

            html, body {
                width: 100%;
                height: 100%;
                margin: 0 auto;
                padding: 0;
                overflow-x: hidden;
            }

            body {
                background: url("../images/bg5.png");
                background-repeat: no-repeat;
            }

            .active {
                background-color: #ddf8d7 !important;
                height: 100% !important;
            }

            .container {
                border: 2px;
                background-color: rgba(255, 250, 250, 0.85);
            }

            label {
                font-size: 12px;
                font-family: 'Raleway', sans-serif;
                padding-top: 2px;
                padding-bottom: 2px;
            }

            .custom-field {
                background: transparent !important;
                border: none !important;
                border-bottom: 2px solid green !important;
            }

            button {
                font-size: 20px;
                font-family: 'Raleway', sans-serif;
            }

            #regbtn:hover {
                box-shadow: 0 0 100px green;
                transform: scale(1.1);
            }

            /*FONTS*/
            h1 {
                text-align: center;
                font-size: 65px;
                font-family: 'Cinzel Decorative', cursive;
                padding-top: 5%;
            }

            h2 {
                text-align: center;
                font-size: 35px;
                font-family: 'Cinzel Decorative', cursive;
                padding-bottom: 20px;
            }

            h3 {
                text-align: center;
                font-size: 35px;
                font-family: 'Cinzel Decorative', cursive;
            }

            p {
                text-align: left;
                font-size: 20px;
                font-family: 'Raleway', sans-serif;
            }

        </style>

    </head>

    <body>

        <!--navigation bar-->
        <nav class="navbar navbar-expand-lg navbar-light nav-tabs" style="background-color:snow";>
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../images/Stud-eatLogo nb.png" alt="Stud-eat Logo" width="120" height="45">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item lead"><a class="nav-link" href="index.php">HOME</a></li>
                        <li class="nav-item lead"><a class="nav-link active" aria-current="page" href="register.php">REGISTER</a></li>
                        <li class="nav-item lead"><a class="nav-link" href="login.php">LOGIN</a></li>
                        <li class="nav-item lead"><a class="nav-link" href="products.php">PRODUCTS</a></li>
                        <li class="nav-item lead"><a class="nav-link" href="contact.php">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div>
            <br><br>
        </div>

        <!--Logo-->
        <div class="row">
            <div class="col md-6 d-flex justify-content-center">
                <img src="../images/AnnonaAcademy nb.png">
            </div>
        
        <!--Form-->
            <div class="col-md-6" style="padding-right: 3%;">
                <div class="container">
                    <div class="box-wrapper">
                        <div class="box box-border">
                            <div class="box-body">
                                <!--Title-->
                                <h1>Register</h1>
                                <form action="register.php" method="post">
                                    <div class="form-group">
                                        <label for=fname>First Name:</label>
                                        <input type="text" placeholder="e.g. John" class="custom-field form-control" id=fname name="fname">
                                        <span class="help-block text-danger"><?php echo $fnameEmpty; ?></span>
                                        <span class="help-block text-danger"><?php echo $errorName; ?></span>
                                    </div>  
                                    <div class="form-group">
                                        <label for=lname>Last Name:</label>
                                        <input type="text" placeholder="e.g. Doe" class="custom-field form-control" id=lname name="lname">
                                        <span class="help-block text-danger"><?php echo $lnameEmpty; ?></span>
                                        <span class="help-block text-danger"><?php echo $errorName; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for=username>Username:</label>
                                        <input type="text" placeholder="e.g. JohnDoe" class="custom-field form-control" id=username name="username">
                                        <span class="help-block text-danger"><?php echo $unameEmpty; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for=email>Email Address:</label>
                                        <input type="email" placeholder="e.g. jdoe@stu.aa.edu.us" class="custom-field form-control" id=email name="email">
                                        <span class="help-block text-danger"><?php echo $emailEmpty; ?></span>
                                        <span class="help-block text-danger"><?php echo $errorEmail; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for=pword>Password:</label>
                                        <input type="password" placeholder="Minimum of 8 characters" class="custom-field form-control" id=pword name="pword">
                                        <span class="help-block text-danger"><?php echo $errorPword; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for=pwordVerif>Re-enter Password:</label>
                                        <input type="password" class="custom-field form-control" id=pwordVerif name="pwordVerif">
                                        <span class="help-block text-danger"><?php echo $verifEmpty; ?></span>
                                        <span class="help-block text-danger"><?php echo $errorMatch; ?></span>
                                    </div><br>
                                    <div class="d-grid gap-4 form-group text-center">
                                        <input type="submit" class="btn btn-success" id=regbtn name="register" value="Register">
                                    </div><br>
                                    <div class="form group text-center" style="padding-bottom: 1px;">
                                        <p style="text-align:center;">Already registered? <a href="login.php">Login here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <br>
        </div>
        <!--Footer-->
        <footer style="height:40px; bottom:0; width: 100%; background-color:snow;">
            <p style="text-align:center;">©Annona Academy 2022</p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>