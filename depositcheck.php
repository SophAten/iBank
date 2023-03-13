<?php
session_start();
require_once("include_page.php");
$currentUser=unserialize($_SESSION['user']);

$db = new DataBaseActions();
$bankAccounts = $currentUser->getBankAccounts();


?>
<html>
<head>
    <title> Check Deposit </title>
    <script src="https://kit.fontawesome.com/f5a75fbd23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="nav">
    <nav>
        <ul>

            <img alt="iBank" src="iBank recolor.png" width="150" height="35" align ="left" class= "logo1">
            <li class="navi"> </a> </li>
            &nbsp;&nbsp;
            <li class="navi"> <a href="Admin.php" >Main </a> </li> <!-- need to change this cuz main doesnt work without loggin in  -->
            &nbsp;&nbsp;
        </ul>
    </nav>
</div>


<h1 class = "greeting">
    Check Deposit
</h1>
<br>
<br>
<br>

<div class="form">


    <!--  <h4 class="accountheading">
        &nbsp;&nbsp;   &nbsp;&nbsp;  Open A New Account     &nbsp;&nbsp; &nbsp;&nbsp;
      </h4>
        <br>
        <br>
    -->
    <img id="output" width="50%" />
    <form class="openingAccount" action="deposit_check_logic.php" method="post" enctype="multipart/form-data"> <!-- need to change the action  -->

        <div>
            <div class="accountname">

                <label for="fileToUpload"> Select a scan of the check </label>
                <br>
                <div><br></div>
                <input type="file" accept="image" onchange="loadFile(event)" id="fileToUpload" name="fileToUpload"  required>
            </div>
            <div class="deposit">
                <label for="deposit"> Amount </label>
                <input type="number" step="0.01" placeholder="Ex: $250" name="deposit" id="pin_input" min="0.01" required>
                <input hidden value="<?php echo $currentUser->getSsn() ?>" name="ssn"/>
            </div>
        </div>
        <script>
            var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
        <div>
            <div class="accounttype">
                <label for="accounttype"></label>
                <select placeholder="Account type" name="account_type" id="account_type_input" required>
                    <option disabled hidden selected>Select Account</option>
                    <?php
                    $k = 0;
                    while($k<=count($bankAccounts)-1){
                    if( $bankAccounts[$k]->getAccountType() == BankAccount::$ACCOUNT_TYPE_DEBIT){
                    ?>
                        <option>
                            <?php echo $bankAccounts[$k]->getName()." (".substr(BankFormat::hideBankAccountNumber($bankAccounts[$k]->getNumber()),-6).")";?>
                        </option>

                    <?php
                        }
                        $k++;
                    }?>
                </select>
            </div>
        </div>

        <div class="accountsubmit">
            <input type="submit" value="Deposit" id="form_button" />
        </div>
</div>






<br>


</body>
