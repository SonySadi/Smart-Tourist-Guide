<?php
//error_reporting(0 
session_start();
include('./../connection.php');

if (isset($_POST['date']) && $_POST['date'] && !empty($_POST['date'])) {
    $id = $_SESSION['id'];
    $date = $_POST['date'];
    $city = $_POST['city'];
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];
    $dayNo = date('w', strtotime($date));
    $lstime = "9:00";
    $letime = "23:00";

    $likes = "";
    $habits = "";
    for ($i = 1; $i <= 9; $i++) {
        $var1 = $_POST['like' . $i];
        if (isset($var1)) {
            $likes .= $var1;
            $likes .= ",";
        }
    }

    $sql = "INSERT INTO schedule1(userId,day,city,stime,etime,date1,likes,lstime,letime) 
	VALUES('$id','$dayNo','$city','$stime','$etime','$date','$likes','$lstime','$letime')";

    if (!$conn->query($sql)) {
        echo 'Could not enter data: ' . $conn->error;
    } else {
        header('location:home.php');
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact V3</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/checkbox.css" />

    <!--===============================================================================================-->
</head>

<body>
    <!-- Header -->
    <div class="header">
        <a href="home.php" class="logo">Smart City Traveller</a>
        <div class="header-right">
            <a class="active" href="home.php">Home</a>
            <a href="/logout.php"><img src="images/icons/user_ironman.png" /> <b> <?php echo $_SESSION['name']; ?></b> signout</a>
            <a href="../aboutus/aboutus.html">About us</a>
        </div>
    </div>

    <!-- Content -->

    <div class="bg-contact3" style="background-image: url('images/home_slider.jpg')">
        <div class="container-contact3">
            <div class="wrap-contact3">
                <form class="contact3-form validate-form" name="myForm" 
                onsubmit="return validateForm()" class="login100-form validate-form" method="POST" action="schedule.php">
                    <div class="wrap-input3 validate-input" data-validate="Enter your DOB">
                        <label class="input3" name="likes">
                            <b> Enter Date</b>
                        </label>
                        <input class="input3" type="date" name="date" placeholder="Enter date" />
                        <span class="focus-input3"></span>
                    </div>

                    <div class="wrap-input3 validate-input" data-validate="Enter City">
                        <label class="input3" name="likes">
                            <b> Enter City</b>
                        </label>
                        <select name="city" id="cities"></select>
                        <span class="focus-input3"></span>
                    </div>

                    <div class="wrap-input3 validate-input" data-validate="Enter Start Time">
                        <label class="input3" name="likes">
                            <b> Enter Start Time </b>
                        </label>
                        <input class="input3" type="time" name="stime" placeholder="start time" />
                        <span class="focus-input3"></span>
                    </div>
                    <div class="wrap-input3 validate-input" data-validate="Enter End Time">
                        <label class="input3" name="likes">
                            <b> Enter End Time </b>
                        </label>
                        <input class="input3" type="time" name="etime" placeholder="end time" />
                        <span class="focus-input3"></span>
                    </div>
                    <br /><br />
                    <div>
                        <span>
                            <label class="input3" name="likes">
                                <b> Enter Interests</b>
                            </label>
                            <br />
                            <label class="container">Restaurant
                                <input type="checkbox" name="like1" value="restaurant" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Coffee
                                <input type="checkbox" name="like2" value="coffee" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Food
                                <input type="checkbox" name="like3" value="food" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Shopping
                                <input type="checkbox" name="like4" value="shopping" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Historic Sites
                                <input type="checkbox" name="like5" value="historic sites" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Temple
                                <input type="checkbox" name="like6" value="temple" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Breakfast
                                <input type="checkbox" name="like7" value="breakfast" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Lunch
                                <input type="checkbox" name="like8" value="lunch" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="container">Dinner
                                <input type="checkbox" name="like9" value="dinner" />
                                <span class="checkmark"></span>
                            </label>
                        </span>
                    </div>

                    <div class="container-contact3-form-btn">
                        <button class="contact3-form-btn" type="submit" name="signin">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script src="js/city.js"></script>
    <script>
        var x = document.getElementById("cities");
        for (let i = 0; i < cities.length; i++) {
            const city = cities[i];
            var option = document.createElement("option");
            if (i != 0) {
                option.text = city.city;
            }
            x.add(option);
        }
    </script>
</body>

</html>