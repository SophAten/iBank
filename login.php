<?php

session_start();
$status = 0;
$getReceived = false;
if ($_GET){
    $getReceived = true;
    $status = $_GET['status']; //0 - clean, 1 - registered, 2 - wrong login, 3 - db refreshed;
    $name = $_GET['login'];
}

?>


<html>
<head>
    <title> Login </title>
    <link rel="stylesheet" href="./css/login_style.scss?v=<?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>

</head>

</head>


<body>

<div id="container">

    <div id = "login-box">

        <div id="info">

            <div class="big-text">
                iBank
            </div>


            <form action="/bridge.php" method="post">
                <div class="item-container">

                    <div class="login-input1">
                        <input type="text" class="input-field" placeholder=" " name="name" required
                            <?php if ($getReceived and $status!=3) echo "value = $name"; ?>
                        />
                        <label class="login-label">Email</label>
                    </div>
                    <div class="login-input2">
                        <input type="password" class="input-field" placeholder=" " name="password" required/>
                        <label class="login-label">Password</label>
                    </div>
                    <!-- When db is stable - delete this line part -->

                    <!-- When db is stable - delete this line part -->
                    <?php
                    if($status==2){echo '<div class="error-message">Wrong username or password. Please try again.</div>';}
                    if($status==3){echo '<div class="error-message">DataBase was reinitialized. Try to log in again.</div>';}
                    ?>

                    <div id="buttons">
                        <input id="submit_btn" type="submit" value = "Login">
                    </div>
                </div>
            </form>
            <button class="edit" onclick="window.location.href='fixDB.php';">Having issues?</button>
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
