
<html>
<head>
    <title> Open Account </title>
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
    Open a New Account
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


    <form class="openingAccount" action="openAccount_logic.php" method="post"> <!-- need to change the action  -->

        <div>
            <div class="accountname">
                <label for="accountname"> Account Name</label>
                <input type="text" pattern="[A-Za-z0-9].{1,}" placeholder="Ex: Main Credit Card" name="accountname" id="name_input" required>
            </div>
            <div class="deposit">
                <label for="deposit"> Amount </label>
                <input type="number" placeholder="Ex: $250" name="deposit" id="pin_input" required>
            </div>
        </div>

        <div>
            <div class="accounttype">
                <label for="accounttype"></label>
                <select placeholder="Account type" name="account_type" id="account_type_input" required>
                    <option disabled hidden selected>Account Type</option>
                    <option>Credit Account</option>
                    <option>Debit Account</option>
                    <option>Goal Account</option>
                </select>
            </div>
        </div>

        <div class="accountsubmit">
            <input type="submit" value="Open Account" id="form_button" />
        </div>
</div>


<div class="opencontainer">
    <div class "creditcard">
    <div class="names">
        <p><i class="fa-solid fa-credit-card fa-lg"></i>Credit Account</P>
    </div>
    <br>
    <p class="info"> Open a new credit card account. </p>
    <ul class="openacc">
        <li class="accinfo">No Annual Fees</li>
        <li class="accinfo">Up to 10% Cash Back on Featured Categories</li>
        <li class="accinfo">Easy and comfortable credit limits</li>
        <li class="accinfo">Even More Benefits..</li>
    </ul>
</div>
<div class "checking">
<div class="names">
    <p><i class="fa-solid fa-money-check-dollar fa-lg"></i> Debit Account</p>
</div>
<br>
<p class="info"> Open a new checking account. </p>
<ul class="openacc">
    <li class="accinfo">No Annual Fees</li>
    <li class="accinfo">Earn 1% Cash Back!</li>
    <li class="accinfo">Even More Benefits..</li>
</ul>
</div>
<div class "savings">
<div class="names">
    <p><i class="fa-solid fa-piggy-bank fa-lg"></i>Goal</p>
</div>
<br>
<p class="info"> Start saving on a new goal </p>
<ul class="openacc">
    <li class="accinfo">No Annual Fees</li>
    <li class="accinfo">1% Monthly bonus based on the balance</li>
    <li class="accinfo">Like Savings, but with meaning and soul</li>
    <li class="accinfo">Even More Benefits..</li>
</ul>
</div>
</div>

<br>


</body>
