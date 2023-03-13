
<?php
require_once("include_page.php");
//error_reporting(E_ALL ^ E_WARNING);

/*if($_GET['registration_status']){
    $registrationStatus = $_GET['registration_status'];
}*/

$errorMessage = false;
$message = "";
if ($_GET){
    $errorMessage = true;
    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $ssn = $_GET["ssn"];
    $email = $_GET["email"];
    $pin = $_GET["pin"];

    if ($_GET["failure"] == "ssn") {
        $message = "Entered ssn is not unique!";
        $ssn = "";
    }
    if ($_GET["failure"] == "email") {
        $message = "This email is already taken!";
        $email = "";
    }
    if ($_GET["failure"] == "pw") {
        $message = "The passwords do not match!";
    }
    if ($_GET["failure"] == "db") {
        $message = "Oh! Our database does not answer. Please try later or contact administrators.";
    }
}
?>

<html>
<head>
    <title> Register </title>
    <link rel="stylesheet" href="./css/login_style.scss">

</head>


<body>

    <div id="container">

        <div id = "register-box">

            <div id="info">

                <div class="big-text">
                    iBank
                </div>

                <form id="register_form" action="registration_logic.php" method="post">
                  <div class="item-container">
                    <div id="namerow">
                      <div class="register-input-half">
                        <input type="text" class="input-field" placeholder=" " name="first_name"
                               <?php if($errorMessage){echo "value = ".$_GET['firstname'];} ?> required/>
                        <label class="input-label">First name</label>
                      </div>
                      <div class="register-input-half">
                        <input type="text" class="input-field" placeholder=" " name="last_name"
                               <?php if($errorMessage){echo "value = ".$_GET['lastname'];} ?> required/>
                        <label class="input-label">Last name</label>
                      </div>
                    </div>
                    <div class="register-input">
                      <input type="email" class="input-field" placeholder=" " name="email"  oninvalid="this.setCustomValidity('This email is already taken!)"
                             oninput="this.setCustomValidity('')"
                          <?php if($errorMessage){echo 'value = "'.$_GET['email'].'"';} ?> required/>
                      <label class="input-label">Email</label>
                    </div>
                    <div class="register-input">
                      <input type="password" class="input-field"  pattern="[0-9]*" minlength="9" maxlength="9" placeholder=" " name="ssn"  oninvalid="this.setCustomValidity('The SSN must be unique')"
                             oninput="this.setCustomValidity('')"
                          <?php if($errorMessage){echo 'value = "'.$_GET['ssn'].'"';} ?>
                             required/>
                      <label class="input-label">Social Security Number</label>
                    </div>
                    <div class="register-input">
                        <input type="password" class="input-field" placeholder=" " name="password" required/>
                        <label class="input-label">Password</label>
                    </div>
                    <div class="register-input">
                        <input type="password" class="input-field" placeholder=" " name="password_confirm" required/>
                        <label class="input-label">Confirm Password</label>
                    </div>
                    <div class="register-input">
                        <input type="password" pattern="[0-9]*" minlength= "4" maxlength="4" class="input-field" placeholder=" " name="pin"
                               <?php if($errorMessage){echo "value = ".$_GET['pin'];} ?> required/>
                        <label class="input-label">Custom 4-Digit Pin</label>
                    </div>

                    <div id="buttons">
                        <?php if($errorMessage){echo '<div class="error-message">'.$message.'</div>';}?>
                        <input id="submit_btn" type="submit" value = "Register">

                    </div>

                  </div>


                </form>
            </div>

            <div id="ads">
                <h1 id="register_message">
                  &nbsp;iBank.
                </h1>
                <br>
                <h3 id="register2_message">
                    Simpler. Faster. Friendlier.
                </h3>
            </div>


        </div>

    </div>

</body>
</html>
