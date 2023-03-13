<?php
session_start();
require_once("include_page.php");
$currentUser=unserialize($_SESSION['user']);

$bankAccounts = $currentUser->getBankAccounts();

$transactions = array();

/*
 * Alternative way to initialize the bank accounts if the first one does not work properly

$bankAccounts = $db->getBankingAccounts($currentUser->getSSN());
*/

?>

<html>
  <head>
    <title> Main Page </title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  </head>
  <body>

    <div class = "topborder">
      &nbsp;&nbsp;
      <div class = "logo">
        <a href="main.php">
           <img alt="iBank" src="iBank recolor.png"
           width="250" height="70">
        </a>
      </div>
    </div>

    <h1 class = "greeting">
      Hello,
        <?php
        echo $currentUser->getFirstName();
        ?>!
    </h1>




    <div class="maindatacolumns">

      <div class="accountcolumn">
          <h2>
              Accounts:
          </h2>
          <!-- Loop that creates units for bank accounts-->
          <?php
            $i = 0;
            while($i<=count($bankAccounts)-1){
          ?>
          <div class= "accountbox">
          <h3>
              <?php
              $temp = $bankAccounts[$i]->getTransactions();

              $j = 0;
              while($j<=count($temp)-1) {
                  $transactions[count($transactions)] = $temp[$j];
                  $j++;
              }
              echo $bankAccounts[$i]->getName()." - ";
              echo $bankAccounts[$i]->getNumber();
              ?>
          </h3>
          <p>
            Balance: $<?php
              echo $bankAccounts[$i]->getBalance();;
              ?>
          </p>
        </div>
          <?php
            $i++;
            }
          ?>
      </div>
        <div class="accountcolumn">
            <h2> Transactions: </h2>
            <div class="transaction_container">
            <?php
            $i = 0;
            while($i<=count($transactions)-1){
            ?>

                <h3>
                    <?php
                    echo $transactions[$i]->getName().":  ";
                    //echo $transactions[$i]->getBalanceChange();
                    ?>
                </h3>
                <p>
                    Transaction made from account with number: $<?php
                    echo $transactions[$i]->getSenderAccount();
                    ?>
                </p>
                <h3 align="right" class="price">
                    <?php
                    echo $transactions[$i]->getBalanceChange();
                    ?>
                </h3>

                <?php
                $i++;
                if ($i<=count($transactions)-1){
                ?>
                <br>
                <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
  </div>



    <div class="featuresrow1">
      <div class="Transfer">
        <button onclick="window.location.href = 'transfer.php'">Transfer</button>
      </div>
      <div class="OpenAccount">
        <button onclick="window.location.href = 'OpenAccount.php'">Open New Account</button>
      </div>
    </div>
    <div class="featuresrow2">
      <div class="LocateATM">
        <button onclick="window.location.href = 'LocateATM.php'">Locate ATM</button>
      </div>
      <div class="CloseAccount">
        <button onclick="window.location.href = 'Deposit.php'">Deposit a Check</button>
      </div>
    </div>


  </body>
</html>

