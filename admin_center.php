<?php
session_start();
require_once("include_page.php");

$db = new DataBaseActions();

$adminTasks = $db->getAdminTasks();
$userList = $db->getUsers();
$logList = $db-> getLogsWithoutAdminTasks();

?>


<script>
    // function to find what div is clicked
    function clicked(e) {
        //get the p element inside div with id acc_name
        var item = e.target;
        //console.log(item);

        var causeNum = item.getElementsByClassName("cause_num")[0];
        var causeNum = causeNum.textContent.split("=")[1].trim();
        //console.log(causeNum);


        //does item have class user?
        if (item.classList.contains("todo")){
            //console.log(item.id);
            var img = item.id.split(":")[1];
            var email = item.id.split(":")[0];

            var imgurl = "http://localhost/" + img;
            //console.log(imgurl);

            //get img from element with id check_img
            var checkImg = document.getElementById("check-img");
            //console.log(checkImg);
            checkImg.src = imgurl;

            var taskNameTitle = document.getElementById("fname");
            taskNameTitle.innerText = item.getElementsByTagName("h3")[0].innerText;

            var emailTitle = document.getElementById("femail");
            emailTitle.innerText = email;
            emailTitle.style.marginLeft = "10px";


            console.log(fname);

            //handle the visual selection
            if(!item.classList.contains("selected")){
                item.classList.add("selected");
                item.style.boxShadow = "0 4px 2px -2px gray";
                //unselect all other items
                var items = document.getElementsByClassName("todo");
                for (var i = 0; i < items.length; i++) {
                    if(items[i] != item){
                        items[i].classList.remove("selected");
                        items[i].style.boxShadow = "none";
                    }
                }

            } else {
                item.classList.remove("selected");
                item.style.boxShadow = "none";
            }
        }
    }



    function approve(e, approve){

        //create cookie, to be used in approve.php
        var checkImg = document.getElementById("check-img");
        var imgurl = checkImg.src.split("localhost/")[1];

        //put imgurl in cookie
        document.cookie = "img=" + imgurl;

        window.location.href = "approve.php?check=" + imgurl+"&approve="+approve;


    }


</script>



<html>
<head>
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="./css/admin_center_style.css?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>

</head>


<body>


<div id="header">
    <img src="logo_admin.png">

    <div class="nav">

        <ul class="nav1">
            <li class="navi"><a href="first.html">Log Out</a></li>
        </ul>
    </div>
</div>


<h1 class = "greeting">
    &nbsp;&nbsp;
    ADMIN

</h1>




<div id="main_holder">

    <div id="col1" class="todo-box">
        <label for="creditaccounts"><h2>TO-DO LIST</h2></label>
        <?php

        if (count($adminTasks) == 0){
            //TODO: create new div for no tasks
            ?>
            <div id="0" class="todo" onclick="clicked(event)">

                <div class="todo_synopsis">
                    <div class="todo_name">
                        <h2>The TO-DO list is empty. </h2>
                    </div>
                    <br>
                    <div class="todo_info">
                        <h3>&nbsp;There is no job for now - do not for get to check later!</h3>
                    </div>

                    <br><br><br>

                </div>

            </div>
            <?php
        } else {
            $i = 0;
            while($i<count($adminTasks)){ ?>
                <div id="<?php echo $db->getUser($db->getAccount($adminTasks[$i]->getCausedBy())->getOwnerSSN())->getEmail();?>:<?php echo $adminTasks[$i]->getDescription();?>" class="todo" onclick="clicked(event)">

                    <div class="todo_synopsis">
                        <div >
                            <h3><?php echo $adminTasks[$i]->getName();?></h3>
                            <p class="cause_num">&nbsp;Cause source ID = <?php echo $adminTasks[$i]->getCausedBy();?> </p>
                        </div>
                        <br>

                    </div>

                </div>

                <?php
                $i++;
            }

        } ?>


        <div class="users-box">
            <h2 class="user-label">LIST OF USERS</h2>

            <?php
            $i = 0;
            while($i<=count($userList)-1){
                ?>
                <div id="<?php echo $userList[$i]->getEmail() ?>" class="user" onclick="clicked(event)">

                    <div class="user_synopsis">
                        <div class="acc_name">
                            <h3><?php echo $userList[$i]->getFirstName()." ".$userList[$i]->getLastName();?> </h3> <p class="email">&nbsp;<?php echo $userList[$i]->getEmail();?> </p>
                        </div>
                        <br>
                        <!--<div class="accountbal">
                  <p class="balance">$ <?php /*echo $userList[$i]->getSignificanceLevel();*/?></p>
                </div>-->
                    </div>

                </div>
                <br>

                <?php $i++; } ?>

        </div>




    </div>

    <div class="col2">

            <div class="main_synopsis">
                <div class="acc_name">
                    <!--COULD U PLEASE MAKE THIS SAY THE NAME AND ACCOUNT NUMBER OF THE ACCOUNT THAT IS SELECTED
                    acc_num is acc_num2 because i needed to have a different css for it -->
                    <h2 id="fname">Select a task to complete </h2> <p id="femail" class="acc_num2">  </p>
                </div>


                <img id="check-img">



                <br>
                <br>
                <div id="actions">

                    <div>ACTIONS: </div>

                    <ul class="nav2">
                        <li class="navi"><a onclick="approve(event, true)">Approve</a></li>
                        <li class="navi"><a onclick="approve(event, false)">Deny</a></li>
                    </ul>
                    <br>

                </div>
            </div>

            <br>
            <br>

            <div id="transactionbox">
                <h2 class="trans">RECENT LOGS</h2>
                <div id="transactions_list">

                    <?php
                    $i = 0;
                    while($i<=count($logList)-1){
                        ?>
                        <div class="transaction_item">

                            <h3>
                                <?php
                                echo $logList[$i]->getName().":  ";
                                //echo $transactions[$i]->getBalanceChange();
                                ?>
                            </h3>
                            <div class="info">
                                <p><?php echo $logList[$i]->getDescription();?> </p>
                            </div>
                            <div class="info">
                                <p>Caused By ID = <?php echo $logList[$i]->getCausedBy()."        ";?>
                                    Significance Level:<?php echo $logList[$i]->getSignificanceLevel();?> </p>
                                <!-- TODO: add significance level if() and results and according color change for the element-->
                            </div>
                            <div class="info">
                                <p>Date: <?php echo $logList[$i]->getDate();?> </p>
                            </div>
                        </div>
                        <?php
                        $i++;

                    }
                    ?>

                </div>

            </div>

    </div>
</div>



</body>
</html>
