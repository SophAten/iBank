<?php
session_start();
require_once("include_page.php");
$currentUser=unserialize($_SESSION['user']);
$db = new DataBaseActions();
$currentUser = $db->getUser($currentUser->getSsn());
$bankAccounts = $currentUser->getBankAccounts();

$recentTransactions = array();
if($_GET){
    if($_GET['c']){
        echo '<script>
            alert("The account cannot be deleted, because it has unreviewed issues. Please try later");
           </script>';
    } else {
        echo '<script>
            alert("The account cannot be deleted, because the balance is not = 0. Please transfer the funds to another account and try again");
           </script>';
    }
}


?>


<script>


    // function to find what div is clicked
    function clicked(e) {

        //console.log(e.target)

        //get the p element inside div with id acc_name
        var acc_item = e.target;
        //get last 4 digits of account number from account synopsis div
        var acc_row = acc_item.getElementsByClassName("row1")[0];
        if(acc_row == undefined){
            acc_row = acc_item.getElementsByClassName("row2")[0];
            console.log(acc_row);
        }
        //console.log(acc_row);
        var acc_synopsis = acc_row.getElementsByClassName("acc_synopsis")[0];
        var acc_name_div = acc_synopsis.getElementsByClassName("acc_name")[0];
        var acc_name_summary = acc_name_div.getElementsByTagName("h3")[0];
        var acc_num = acc_name_div.getElementsByTagName("p")[0].innerHTML.split("****")[1].trim();
        var isSelected = acc_item.classList.contains("selected");
        var acc_balance = acc_synopsis.getElementsByClassName("balance")[0];

        //console.log(acc_name_summary.innerText);

        //does acc_item has class selected?
        if (isSelected) {
            //if yes, remove class selected
            acc_item.classList.remove("selected");
            /*acc_item.style.setProperty('border-top-width', '0px'); */
            acc_item.style.boxShadow = "0 0 0 0";
            updateTransactions(acc_num, isSelected);
        } else {

            acc_item.classList.add("selected");
            /*acc_item.style.setProperty('border-top-width', '0px'); */
            acc_item.style.boxShadow = "0 4px 2px -2px gray";
            updateTransactions(acc_num, isSelected);

            //recolor all other account items
            var acc_items = document.getElementsByClassName("acc_item");
            for (var i = 0; i < acc_items.length; i++) {
                if (acc_items[i] != acc_item) {
                    //acc_balance = acc_items[i].getElementsByClassName("balance")[0];
                    acc_items[i].style.boxShadow = "0 0 0 0";
                    acc_items[i].classList.remove("selected");
                }
            }
        }

        updateMainSynopsis(acc_num, acc_balance.innerHTML, acc_name_summary.innerText);

    }


    function updateTransactions(acc_num, printAll) {

        var transaction_list = document.getElementById("transactions_list");

        //console.log(transaction_list);

        if (!printAll) {
            acc_num = acc_num.trim();
            //find div transaction_list

            //iterate through each transaction in the transaction list
            for (var i = 0; i < transaction_list.children.length; i++) {
                var transaction = transaction_list.children[i];
                var transaction_item = transaction.getElementsByClassName("info")[0];
                var transaction_acc_num = transaction_item.getElementsByTagName("p")[0].innerHTML.split("****")[1].trim();

                if (transaction_item == null)
                    continue;

                var transaction_acc_num = transaction_item.getElementsByTagName("p")[0].innerHTML.substring(transaction_item.getElementsByTagName("p")[0].innerHTML.length - 5).trim();

                //if the transaction account number is the same as the account number clicked, show the transaction
                if (transaction_acc_num == acc_num) {
                    //console.log(transaction_acc_num);
                    transaction.style.display = "flex";
                } else {
                    transaction.style.display = "none";
                }

            }

        } else {

            //print all transactions
            for (var i = 0; i < transaction_list.children.length; i++) {
                var transaction = transaction_list.children[i];
                transaction.style.display = "flex";

            }
        }

    }

    function updateMainSynopsis(acc_num, acc_balance, acc_name){
        var selected_acc = document.getElementsByClassName("selected_acc")[0];


        var synopsis_container = document.getElementsByClassName("main_synopsis")[0];
        var full_acc_num = document.getElementsByClassName("selected")[0];
        if(full_acc_num != undefined) {
            var acc_num_slot = synopsis_container.getElementsByClassName("acc_num2")[0];
            acc_num_slot.innerHTML = full_acc_num.id;

            var balance_slot = synopsis_container.getElementsByClassName("balance")[0];
            balance_slot.innerHTML = acc_balance;

            //if selected account has a child with class "delete"
            if(selected_acc.getElementsByClassName("delete").length == 0){
                console.log("delete button not found");
                var delete_btn = document.createElement("button");
                delete_btn.appendChild(document.createTextNode("Delete"));
                delete_btn.classList.add("delete");
                delete_btn.addEventListener("click", deleteAccount);
                selected_acc.appendChild(delete_btn);
            }


            synopsis_container.getElementsByTagName("h2")[0].innerText = acc_name;
        } else {

            //remove delete button
            var delete_btn = selected_acc.getElementsByClassName("delete")[0];
            if(delete_btn != undefined){
                selected_acc.removeChild(delete_btn);
            }

            synopsis_container.getElementsByTagName("h2")[0].innerText = "No Accounts Selected";
        }




    }


    function deleteAccount(e) {
        var mainSynopsis = e.target.parentElement.parentElement.parentElement;

        var acc_num = mainSynopsis.getElementsByClassName("acc_num2")[0].innerHTML;
        console.log(acc_num);

        window.location.href = "closeAccount.php?number=" + acc_num;
    }

</script>


<!DOCTYPE html>
<html>
<head>
    <title> Main Page </title>
    <script src="https://kit.fontawesome.com/f5a75fbd23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/admin_style.css?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>

</head>


<body>


<div id="header">
    <img src="iBank recolor.png">
    <br>
    <br>
    <br>
    <br>
    <div class="header2">
        <div class="user">
            <h2 class="username"> <?php echo $currentUser->getFirstName(); ?> <?php echo $currentUser->getLastName();?> </h2>
        </div>
        <div class="dropdown">
            <button class="dropdownbutton">  <i class="fa-solid fa-circle-user fa-lg"></i> </button>
            <div class="dropdown-content">
                <a href="first.html">Log Out</a>
            </div>
        </div>
    </div>
</div>

<h1 class = "greeting">
    &nbsp;&nbsp;
</h1>

<div class="nav2">
    <ul class="nav2">
        <li class="navi2"><a class="actionsnav" href = "openAccount.php">Open Account</a></li>
        <li class="navi2"><a class="actionsnav" href="transfer.php">Money Transfer</a></li>
        <li class="navi2"><a class="actionsnav" href="depositcheck.php">Deposit Check</a></li>
    </ul>
</div>


<div id="main_holder">

    <div id="col1" class="creditaccounts">
        <label for="creditaccounts">CREDIT ACCOUNTS</label>
        <?php
        $i = 0;
        while($i<=count($bankAccounts)-1){
            if($bankAccounts[$i]->getAccountType() == BankAccount::$ACCOUNT_TYPE_CREDIT){


                ?>
                <div id="<?php echo $bankAccounts[$i]->getNumber() ?>" class="acc_item" onclick="clicked(event)">
                    <div class="row1">

                        <?php
                        $temp = $bankAccounts[$i]->getTransactions();

                        $j = 0;
                        while($j<=count($temp)-1) {
                            $recentTransactions[count($recentTransactions)] = $temp[$j];
                            $j++;
                        }
                        //echo $bankAccounts[$i]->getName()." - ";
                        //echo $bankAccounts[$i]->getNumber();
                        ?>
                        <div class="acc_synopsis">
                            <div class="acc_name">
                                <h3><?php echo $bankAccounts[$i]->getName();?> </h3> <p class="acc_num">&nbsp;<?php echo BankFormat::hideBankAccountNumber($bankAccounts[$i]->getNumber());?> </p>
                            </div>
                            <br>
                            <div class="accountbal">
                                <p class="balance">$<?php echo BankFormat::moneyFormat($bankAccounts[$i]->getBalance());?></p>
                                <p class="balanceinfo"> AVAILABLE BALANCE </p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

            }
            $i++;
        } ?>


        <div class="cashaccounts">
            <p class="boxlabel">DEBIT ACCOUNTS</p>
            <?php
            $i = 0;
            while($i<=count($bankAccounts)-1){
                if($bankAccounts[$i]->getAccountType() == BankAccount::$ACCOUNT_TYPE_DEBIT){


                    ?>
                    <div id="<?php echo $bankAccounts[$i]->getNumber() ?>" class="acc_item" onclick="clicked(event)">
                        <div class="row1">

                            <?php
                            $temp = $bankAccounts[$i]->getTransactions();

                            $j = 0;
                            while($j<=count($temp)-1) {
                                $recentTransactions[count($recentTransactions)] = $temp[$j];
                                $j++;
                            }
                            //echo $bankAccounts[$i]->getName()." - ";
                            //echo $bankAccounts[$i]->getNumber();
                            ?>
                            <div class="acc_synopsis">
                                <div class="acc_name">
                                    <h3><?php echo $bankAccounts[$i]->getName();?> </h3> <p class="acc_num">&nbsp;<?php echo BankFormat::hideBankAccountNumber($bankAccounts[$i]->getNumber());?> </p>
                                </div>
                                <br>
                                <div class="accountbal">
                                    <p class="balance">$<?php echo BankFormat::moneyFormat($bankAccounts[$i]->getBalance());?></p>
                                    <p class="balanceinfo"> AVAILABLE BALANCE </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>


                    <?php

                }
                $i++;
            } ?>
        </div>

        <br>
        <div class="goalsbox">
            <p class="boxlabel">GOAL ACCOUNTS</p>
            <div id="goals">
                <label class="goals">GOALS: </label>
                <?php
                $i = 0;
                while($i<=count($bankAccounts)-1){
                    if($bankAccounts[$i]->getAccountType() == BankAccount::$ACCOUNT_TYPE_GOAL){

                        ?>
                        <div class="goal" align="right"><!-- TODO: make the container look better with CSS and inner structure-->

                            <label for="file"><?php echo $bankAccounts[$i]->getName() ?>:</label>
                            <progress id="file" value="<?php echo ($bankAccounts[$i]->getBalance()) ?>" max="<?php echo $bankAccounts[$i]->getSavingsGoal() ?>"> 32% </progress>

                        </div>
                        <br>
                        <?php
                    }
                    $i++;
                }
                ?>
                <!-- Calculated by (balance now - balance when goal was set) divided by goal value -->
                <!-- Use PHP forloop to print list of all goals, then use CSS to format them all -->
            </div>
        </div>




    </div>

    <div class="col2">
        <div class="row3">
            <div class="main_synopsis">
                <div class="selected_acc">
                    <!--COULD U PLEASE MAKE THIS SAY THE NAME AND ACCOUNT NUMBER OF THE ACCOUNT THAT IS SELECTED
                    acc_num is acc_num2 because i needed to have a different css for it -->
                    <h2>Select an account to see your balance. </h2> <p class="acc_num2"> &nbsp; </p>


                </div>


                <br>
                <br>
                <!-- COULD U PLEASE MAKE THIS SAY THE BALANCE OF THE ACCOUNT THAT IS SELECTED -->
                <div class="accountbal">
                    <p class="balance"> </p>

                    <!-- change to current balance if it is a bank/cash account -->
                    <p class="balanceinfo"> AVAILABLE BALANCE </p>

                </div>


                <br>
                <br>
            </div>

            <br>
            <br>

            <div id="transactionbox">
                <h2 class="trans">TRANSACTIONS:</h2>
                <div id="transactions_list">

                    <?php
                    $i = 0;
                    while($i<=count($recentTransactions)-1){
                        ?>
                        <div class="transaction_item">

                            <h3>
                                <?php
                                echo $recentTransactions[$i]->getName().":  ";
                                //echo $transactions[$i]->getBalanceChange();
                                ?>
                            </h3>
                            <div class="info">
                                <p><?php
                                    if($recentTransactions[$i]->getType()==Transaction::TYPE_LOCAL){
                                        if($recentTransactions[$i]->getBalanceChange()>0){
                                            echo "Local transaction: Funds received from "
                                                .$db->getAccount($recentTransactions[$i]->getSenderAccount())->getName()
                                                ." by "
                                                .BankFormat::hideBankAccountNumber($recentTransactions[$i]->getRecipientAccount());
                                        } else {
                                            echo "Local transaction: Funds sent to "
                                                .$db->getAccount($recentTransactions[$i]->getRecipientAccount())->getName()
                                                ." from "
                                                .BankFormat::hideBankAccountNumber($recentTransactions[$i]->getSenderAccount());
                                        }
                                    }
                                    if ($recentTransactions[$i]->getType()==Transaction::TYPE_EXTERNAL){
                                        if ($recentTransactions[$i]->getBalanceChange()>0){
                                            echo "Refund received by account "
                                                .BankFormat::hideBankAccountNumber($recentTransactions[$i]->getRecipientAccount());
                                        }
                                        if ($recentTransactions[$i]->getBalanceChange()<0){
                                            echo "Transaction made from account with number:"
                                                .BankFormat::hideBankAccountNumber($recentTransactions[$i]->getSenderAccount());
                                        }
                                    }
                                    if ($recentTransactions[$i]->getType()==Transaction::TYPE_CHECK){
                                        if ($recentTransactions[$i]->getBalanceChange()>0){
                                            echo "Successful check deposit on account: "
                                                .BankFormat::hideBankAccountNumber($recentTransactions[$i]->getRecipientAccount());
                                        }
                                        if ($recentTransactions[$i]->getBalanceChange()<0){
                                            echo "Check deposit was denied. The funds are withdrawn from account: "
                                                .BankFormat::hideBankAccountNumber($recentTransactions[$i]->getRecipientAccount());
                                        }
                                    }

                                    ?> </p>
                            </div>

                            <h3 align="right" class="price">
                                <?php
                                echo BankFormat::moneyFormat($recentTransactions[$i]->getBalanceChange());
                                ?>
                            </h3>
                        </div>
                        <?php
                        $i++;

                    }
                    ?>

                </div>
                <br><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>



</body>
</html>
