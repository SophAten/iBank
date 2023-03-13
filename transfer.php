<?php
session_start();
require_once("include_page.php");
$currentUser=unserialize($_SESSION['user']);

$db = new DataBaseActions();
$currentUser = $db->getUser($currentUser->getSsn());
$bankAccounts = $currentUser->getBankAccounts();
$recentTransactions = array();

$toAccountNumber = null;
$fromAccountNumber = null;

/*
 * Alternative way to initialize the bank accounts if the first one does not work properly
$db = new DataBaseActions();
$bankAccounts = $db->getBankingAccounts($currentUser->getSSN());
*/

?>


<html>
<head>
    <title> Settings </title>
    <link rel="stylesheet" href="css/transfer_style.css?v=<?php echo time(); ?>">
</head>

<script>
    function optionClicked(e) {
        let btpressed = e.target.id;

        /* //change background color of button clicked
        let button = document.getElementById(e.target.id);
        button.style.backgroundColor = "#315a8a";
        let selected = button.classList.contains("active");
        if (selected) {
            return;
        }
        button.classList.add("active");

        //change background color of other buttons
        let buttons = document.getElementsByClassName("nav-item");
        for (let i = 0; i < buttons.length; i++) {
            if (buttons[i].id != e.target.id) {
                buttons[i].style.backgroundColor = "#1e3d5a";
                buttons[i].classList.remove("active");
            }
        } *; */

        console.log(btpressed);

        switch(btpressed){
            case "lt":
                document.getElementById("user-transfer").style.display = "flex";
                document.getElementById("external-transfer").style.display = "none";
                document.getElementById("check-deposit").style.display = "none";
                break;
            case "et":
                document.getElementById("user-transfer").style.display = "none";
                document.getElementById("external-transfer").style.display = "flex";
                document.getElementById("check-deposit").style.display = "none";
                break;
            case "cd":
                document.getElementById("user-transfer").style.display = "none";
                document.getElementById("external-transfer").style.display = "none";
                document.getElementById("check-deposit").style.display = "flex";
                break;

            case "b":
                window.location.href = "Admin.php";
                break;
        }

    }

    function fromAccountClicked(e) {
        deleteCookie("fromAccountNumber");
        console.log(e.target.id);
        let acc_item = document.getElementById(e.target.id);
        let selected = acc_item.classList.contains("active");
        acc_item.style.backgroundColor = "#12437e";
        acc_item.style.color = "white";
        var acc_synopsis = acc_item.getElementsByClassName("acc_synopsis")[0];
        var acc_name = acc_synopsis.getElementsByClassName("acc_name")[0];
        var secondHalf = acc_name.getElementsByTagName("p")[0].innerHTML.substring(acc_name.getElementsByTagName("p")[0].innerHTML.length-25).split("-")[1];
        //console.log(secondHalf.trim());
        var acc_num = secondHalf.trim();

        document.cookie = "fromAccountNumber =" + acc_num;

        console.log(acc_num);

        if (selected) {
            return;
        }
        acc_item.classList.add("active");

        console.log(acc_name);




        //change background color of other buttons
        let buttons = document.getElementsByClassName("acc_item");


        for (let i = 0; i < buttons.length; i++) {

            var to_acc_synopsis = buttons[i].getElementsByClassName("acc_synopsis")[0];
            var to_acc_name = to_acc_synopsis.getElementsByClassName("acc_name")[0];
            var to_secondHalf = to_acc_name.getElementsByTagName("p")[0].innerHTML.substring(to_acc_name.getElementsByTagName("p")[0].innerHTML.length-25).split("-")[1];
            //console.log(to_secondHalf.trim());
            var to_acc_num = to_secondHalf.trim();


            //change background of all other from buttons
            if (buttons[i].id != e.target.id && !buttons[i].classList.contains("to")) {
                buttons[i].style.backgroundColor = "inherit";
                buttons[i].classList.remove("active");
                buttons[i].style.color = "black";

            }


            //remove the class if the account number is the same, but the button is not the same
            if (buttons[i].classList.contains("to") && to_acc_num == acc_num) {
                buttons[i].classList.add("hidden");
            }
            if(buttons[i].classList.contains("to") && to_acc_num != acc_num){
                buttons[i].classList.remove("hidden");
            }

        }



    }

    function buttonPressed(){
        //console.log("button pressed");
    }


    function toAccountClicked(e) {
        deleteCookie("toAccountNumber");

        let acc_item = document.getElementById(e.target.id);
        let selected = acc_item.classList.contains("active");
        acc_item.style.backgroundColor = "#12437e";
        acc_item.style.color = "white";

        var acc_synopsis = acc_item.getElementsByClassName("acc_synopsis")[0];
        var acc_name = acc_synopsis.getElementsByClassName("acc_name")[0];
        var secondHalf = acc_name.getElementsByTagName("p")[0].innerHTML.substring(acc_name.getElementsByTagName("p")[0].innerHTML.length-25).split("-")[1];
        console.log(secondHalf.trim());
        var acc_num = secondHalf.trim();
        document.cookie = "toAccountNumber =" + acc_num;

        if (selected) {
            return;
        }
        acc_item.classList.add("active");

        ///change background color of other buttons
        let buttons = document.getElementsByClassName("to acc_item");
        for (let i = 0; i < buttons.length; i++) {
            if (buttons[i].id != e.target.id) {
                buttons[i].style.color = "black";
                buttons[i].style.backgroundColor = "inherit";
                buttons[i].classList.remove("active");
            }
        }



    }

    function deleteCookie(name) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

</script>

<body>

  <div id="header">
      <img src="iBank recolor.png">
      <br>
      <br>
      <br>
      <br>
      <div class="header2">
          <li class="navi"> </a> </li>
          &nbsp;&nbsp;
          <li class="navi"> <a class="nav" href="Admin.php" >Main </a> </li>
          </div>
    </div>

    <h1 class = "greeting">
        &nbsp;
    </h1>

    <div class="nav2">
        <ul class="nav2">
            <li id="lt" class="nav-item" onclick="optionClicked(event)">Local Transfer</li>
            <li id="et" class="nav-item" onclick="optionClicked(event)"> External Transfer</li>
        </ul>
    </div>
    <br>
    <br>
<div id="container">
    <div id = "transfer-box">
        <div id="transfer-account">
            <p id="ta_title">Transfer from:</p>
            <div id="transfer-from">
                <?php
                $i = 0;
                while($i<=count($bankAccounts)-1){
                    if($bankAccounts[$i]->getAccountType() != BankAccount::$ACCOUNT_TYPE_GOAL){

                        ?>
                        <div id="<?php echo $i ?>" class="from acc_item" onclick="fromAccountClicked(event)">

                            <div class="acc_synopsis">
                                <div class="acc_name">
                                    <!--Account: xxxxxx5243 -->
                                    <p class = "acc_num"><?php echo $bankAccounts[$i]->getName()." - ".$bankAccounts[$i]->getNumber();?></p>
                                </div>
                                <div class="acc_balance">
                                    <p>Balance: $ <?php echo BankFormat::moneyFormat($bankAccounts[$i]->getBalance());?></p>
                                </div>
                            </div>

                        </div>
                        <?php

                    }
                    $i++;
                } ?>
            </div>
        </div>

        <!-- <div id="transfer-nav">
            <div id="lt" class="nav-item" onclick="optionClicked(event)">
                <p>Local Transfer</p>
            </div>
            <div id="et" class="nav-item" onclick="optionClicked(event)">
                <p>External Transfer</p>
            </div>

            <div id="b" class="nav-item" onclick="optionClicked(event)">
                <p>Back</p>
            </div>
        </div> -->

        <br><br>

        <div id="transfer-actions" style="display: flex">
            <div class="show" id="user-transfer">
                <form action="transfer_logic.php" method="post">

                    <p id="tt_title">Transfer to:</p>
                    <div id="transfer-to">
                        <?php
                        $i = 0;
                        while($i<=count($bankAccounts)-1){



                            ?>
                            <div id="to<?php echo $i ?>" class="to acc_item" onclick="toAccountClicked(event)">


                                <div class="acc_synopsis">
                                    <div class="acc_name">
                                        <!--Account: xxxxxx5243 -->
                                        <p class = "acc_num"><?php echo $bankAccounts[$i]->getName()." - " .$bankAccounts[$i]->getNumber();?></p>
                                    </div>
                                    <div class="acc_balance">
                                        <p>Balance: $ <?php echo BankFormat::moneyFormat($bankAccounts[$i]->getBalance());?></p>
                                    </div>
                                </div>

                            </div>
                            <?php


                            $i++;
                        } ?>
                    </div>
                    <br>
                    <br>



                    <div class="s-box">
                        <p>Amount:</p>
                        <input type="number" id="amount" name="amount" placeholder="Enter amount" step="0.01" min="0.01" required>
                        <input type="hidden" id="transactionType" name="transactionType" value="local">
                        <input type="submit" onclick="buttonPressed()">
                    </div>
                </form>
            </div>

            <div id="external-transfer" style="display: none">
                <form method="post" action="transfer_logic.php">

                    <div>

                        <p>Amount:</p>
                        <input type="number" min="0.01" step="0.01" id="amount" name="amount" placeholder="Enter amount" required>
                    </div>
                    <div>
                        <p>Transfer to:</p>
                        <input type="text" id="transfer-to" name="transfer-to" placeholder="Enter account number" required>
                    </div>


                    <div>

                        <input type="hidden" id="transactionType" name="transactionType" value="external">
                        <input type="submit">
                    </div>
                </form>
            </div>

            <div id="check-deposit" style="display: none">
                <form action="transfer_logic.php" method="post" enctype="multipart/form-data">
                    <p>Deposit to:</p>

                    <input type="file" id="fileToUpload" name="fileToUpload" required>

                    <!-- <input type="file" id="front" name="frontOfCheck"> -->
                    <div>
                        <p>Amount:</p>
                        <input type="number" min="0.01" step="0.01" id="amount" name="amount" placeholder="Enter amount" required>
                    </div>

                    <input type="hidden" id="transactionType" name="transactionType" value="check">
                    <button type="submit" value="upload Images" name="submit">Deposit</button>

                </form>
            </div>


        </div>
    </div>
</body>
</html>
