<?php
session_start();
require_once("include_page.php");
//$currentUser=unserialize($_SESSION['user']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_server";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname );

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "Select prioritylevel, Action, ResolutionType, TicketNum FROM action_center";
$sqlTransactions = "Select Transactiondate, Description, Reference, Balance FROM transactions";
$sqlFlag = "Select Account, ThreatType, AccountSummary FROM flag_user";
$sqlcheck = "Select CheckNum, Account, VerificationStatus FROM checkverification";
$sqlcustomer = "Select PriorityLevel, ResolutionType, Ticket FROM customersuppport";
$result = $conn->query($sql);
$resultTransactions = $conn->query($sqlTransactions);
$resultflag = $conn->query($sqlFlag);
$resultcheck= $conn->query($sqlcheck);
$resultcustomer = $conn->query($sqlcustomer);
//$bankAccounts = $currentUser->getBankAccounts();

/*
 * Alternative way to initialize the bank accounts if the first one does not work properly
$db = new DataBaseActions();
$bankAccounts = $db->getBankingAccounts($currentUser->getSSN());
*/

?>

<html>
<head>
    <title> Main Page </title>
    <link rel="stylesheet" href="./css/admin_style.css?v=<?php echo time(); ?>">
</head>


<body>


<div id="container">

    <img id="background_img" src="background.jpg">

    <div id="header">
        <img src="iBank%20recolor.png">

        <h1 class = "greeting">
            Welcome Admin!
        </h1>

        <div id="nav-bar">
            <ul>
                <li><a href="main.php">Home</a></li>
                <li><a href="transfer.php">Transfer</a></li>
                <li><a href="stocks.php">Stocks</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>

    <div id="main_holder">
        <div id="main">
            <div id="primary">
                <div class="card" id="accounts">
                    <div id="credit_accounts" class="accounts_list">

                        <!-- Use PHP forloop to print list of acounts, then use CSS to format them all -->
                        <div class="acc_item">
                            <img src="iBank%20recolor.png">
                            <div class="todo_synopsis">
                              <h2 class = "greeting">
                                  Action Center
                              </h2>
                            </div>

                        </div>
                        <table style="width:100%">
                          <tr>
                            <th>Priority level</th>
                            <th>Action</th>
                            <th>Resolution type</th>
                            <th>Ticket #</th>

                          </tr>




                        <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              $prioritylvl=$row["prioritylevel"];
                              $Action=$row["Action"];
                              $ResolutionType=$row["ResolutionType"];
                              $TicketNum=$row["TicketNum"];

                              echo "
                                           <tr>
                                              <th>
                                              $prioritylvl
                                              </th>
                                              <th>
                                              $Action
                                              </th>
                                              <th>
                                              $ResolutionType
                                              </th>
                                              <th>
                                              $TicketNum
                                              </th>
                                           </tr>
                                          ";


                                //echo "<br> id: ". $row["prioritylevel"]. " - Name: ". $row["Action"]. " " . $row["ResolutionType"] .$row["TicketNum"]. "<br>";
                            }
                        } else {
                            echo "0 results";
                        }

                         ?>
                        </table>






                    </div>

                </div>
                <div class="card" id="accounts">
                    <div id="credit_accounts" class="accounts_list">

                        <!-- Use PHP forloop to print list of acounts, then use CSS to format them all -->
                        <div class="acc_item">
                            <img src="iBank%20recolor.png">
                            <div class="todo_synopsis">
                              <h2 class = "greeting">
                                  User Transaction History
                              </h2>


                            </div>

                        </div>
                        <table style="width:100%">
                          <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Account</th>


                          </tr>




                          <?php
                          if ($resultflag->num_rows > 0) {
                              // output data of each row
                              while($row = $resultTransactions->fetch_assoc()) {
                                $Date=$row["Transactiondate"];
                                $Description=$row["Description"];
                                $Refnum=$row["Reference"];



                                echo "
                                             <tr>
                                                <th>
                                                $Date
                                                </th>
                                                <th>
                                                $Description
                                                </th>
                                                <th>
                                                $Refnum
                                                </th>

                                             </tr>
                                            ";


                                  //echo "<br> id: ". $row["prioritylevel"]. " - Name: ". $row["Action"]. " " . $row["ResolutionType"] .$row["TicketNum"]. "<br>";
                              }
                          } else {
                              echo "0 results";
                          }

                           ?>
                          </table>




                    </div>

                </div>
                <div class="card" id="accounts">
                    <div id="credit_accounts" class="accounts_list">

                        <!-- Use PHP forloop to print list of acounts, then use CSS to format them all -->
                        <div class="acc_item">
                            <img src="iBank%20recolor.png">
                            <div class="todo_synopsis">
                              <h2 class = "greeting">
                                  User Logs
                              </h2>


                            </div>

                        </div>
                    </div>

                </div>            </div>
            <div id="secondary">
                <div class="card" id="spending">
                    <label>Flagged Users</label>
                    <?php echo "<br>" ?>
                    <table style="width:100%">
                      <tr>
                        <th>|Account #</th>
                        <th>Threat Type</th>
                        <th>Account summary</th>

                      </tr>




                        <?php
                        if ($resultflag->num_rows > 0) {
                            // output data of each row
                            while($row = $resultflag->fetch_assoc()) {
                              $Account=$row["Account"];
                              $ThreatType=$row["ThreatType"];
                              $AccountSummary=$row["AccountSummary"];

                              echo "
                                           <tr>
                                              <th>
                                              $Account
                                              </th>
                                              <th>
                                              $ThreatType
                                              </th>
                                              <th>
                                              $AccountSummary
                                              </th>
                                           </tr>
                                          ";


                                //echo "<br> id: ". $row["prioritylevel"]. " - Name: ". $row["Action"]. " " . $row["ResolutionType"] .$row["TicketNum"]. "<br>";
                            }
                        } else {
                            echo "0 results";
                        }

                         ?>
                        </table>


                    <!-- Draw a diagram representation of spendings according to filter chosen -->
                </div>
                <div class="card" id="goals">
                    <label>Check Verification</label>
                    <?php echo "<br>" ?>
                    <table style="width:100%">
                      <tr>
                        <th>Check #</th>
                        <th>Account</th>
                        <th>Verification Status</th>

                      </tr>




                            <?php
                            if ($resultcheck->num_rows > 0) {
                                // output data of each row
                                while($row = $resultcheck->fetch_assoc()) {
                                  $CheckNum=$row["CheckNum"];
                                  $Account=$row["Account"];
                                  $VerificationStatus=$row["VerificationStatus"];

                                  echo "
                                               <tr>
                                                  <th>
                                                  $CheckNum
                                                  </th>
                                                  <th>
                                                  $Account
                                                  </th>
                                                  <th>
                                                  $VerificationStatus
                                                  </th>
                                               </tr>
                                              ";


                                    //echo "<br> id: ". $row["prioritylevel"]. " - Name: ". $row["Action"]. " " . $row["ResolutionType"] .$row["TicketNum"]. "<br>";
                                }
                            } else {
                                echo "0 results";
                            }

                             ?>
                            </table>


                    <!-- Calculated by (balance now - balance when goal was set) divided by goal value -->
                    <!-- Use PHP forloop to print list of all goals, then use CSS to format them all -->
                </div>
                <div class="card" id="goals">
                    <label>Customer Suppport</label>
                    <?php echo "<br>" ?>
                    <table style="width:100%">
                      <tr>
                        <th>Priority Level</th>
                        <th>Resolution Type</th>
                        <th>Ticket #</th>

                      </tr>

                      <?php
                      if ($resultcustomer->num_rows > 0) {
                          // output data of each row
                          while($row = $resultcustomer->fetch_assoc()) {
                            $PriorityLevel=$row["PriorityLevel"];
                            $ResolutionType=$row["ResolutionType"];
                            $Ticket=$row["Ticket"];

                            echo "
                                         <tr>
                                            <th>
                                            $PriorityLevel
                                            </th>
                                            <th>
                                            $ResolutionType
                                            </th>
                                            <th>
                                            $Ticket
                                            </th>
                                         </tr>
                                        ";


                              //echo "<br> id: ". $row["prioritylevel"]. " - Name: ". $row["Action"]. " " . $row["ResolutionType"] .$row["TicketNum"]. "<br>";
                          }
                      } else {
                          echo "0 results";
                      }

                       ?>
                      </table>


                    <!-- Calculated by (balance now - balance when goal was set) divided by goal value -->
                    <!-- Use PHP forloop to print list of all goals, then use CSS to format them all -->
                </div>

            </div>
        </div>
    </div>


    <div id="footer">

        <div id="footer-left">
            <h3>Footer Left</h3>
            <p>Footer Left Content</p>
        </div>
        <div id="footer-right">
            <h3>Footer Right</h3>
            <p>Footer Right Content</p>
        </div>

    </div>
<<?php
$conn->close();
 ?>

</div>
</body>
</html>
