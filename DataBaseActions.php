<?php
require_once('include_page.php');

class DataBaseActions extends Exception
{
    public $conn;
    public static string $dbname = 'bank_server';
    private array $transactions = array();

    public function __construct()
    {

        $this->conn = mysqli_connect("localhost","root","");
        if (!$this->conn)
        {
            die('Could not connect: ' . mysqli_error());

        }
        if (mysqli_num_rows(mysqli_query($this->conn,"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '". DatabaseActions::$dbname ."'"))) {

            //echo "Database $dbname already exists.";

            $this->conn = mysqli_connect("localhost", "root", "", DataBaseActions::$dbname);

            //inserting test data - if fails - the database version is incompatible with the current version and is to be dropped and replaced
        } else {
            $this->createTheDB();
            $this->conn = mysqli_connect("localhost", "root", "", DatabaseActions::$dbname); // creating connection with the DB
            if(!$this->conn){ //check connection
                die("Connection fails: " . mysqli_connect_error());
            }
        }


    }
    public function dropTheDb(){
        $this->conn = mysqli_connect("localhost","root","");
        mysqli_query($this->conn,"DROP DATABASE ". DatabaseActions::$dbname);
        $this->createTheDB();

    }

    public function createTheDB(){
        $this->conn = mysqli_connect("localhost","root","");
        mysqli_query($this->conn,"CREATE DATABASE ". DatabaseActions::$dbname);
        $this->conn = mysqli_connect("localhost", "root", "", DataBaseActions::$dbname);
        $sql = "CREATE TABLE IF NOT EXISTS `bank_accounts` (`name` VARCHAR(255) NOT NULL , `number` VARCHAR(255) NOT NULL , `owner_ssn` VARCHAR(255) NOT NULL, `balance` VARCHAR(255) NOT NULL, `account_type` VARCHAR(255) NOT NULL, `goal` VARCHAR(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $results = mysqli_query($this->conn, $sql);
        $sql = "CREATE TABLE IF NOT EXISTS `bank_users` (`firstname` varchar(255) NOT NULL,`lastname` varchar(255) NOT NULL,`password` varchar(255) NOT NULL,`ssn` varchar(255) NOT NULL,`email` varchar(255) NOT NULL, `pin` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $results = mysqli_query($this->conn, $sql);
        $sql = "CREATE TABLE IF NOT EXISTS `bank_transactions` (`date` varchar(255) NOT NULL,`name` varchar(255) NOT NULL,
`description` varchar(255) NOT NULL,`balance_change` varchar(255) NOT NULL,`recipient` varchar(255) NOT NULL, `sender` varchar(255) NOT NULL,
`status` varchar(255) NOT NULL, `type` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $results = mysqli_query($this->conn, $sql);
        $sql = "CREATE TABLE IF NOT EXISTS `bank_logs` (`description` varchar(255) NOT NULL,`name` varchar(255) NOT NULL,
`significanceLevel` varchar(255) NOT NULL,`date` varchar(255) NOT NULL,`causedBy` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $results = mysqli_query($this->conn, $sql);
        //$description, $name, $significanceLevel, $date, $causedBy
        //check if the table has more than 5 objects, otherwise create objects
        $sql = "SELECT * from bank_accounts";


        if ($result = mysqli_query($this->conn, $sql)) {


            $this->addTransaction('11.03.2022', 'Coca-Cola 0.3 @Starbacks', 'empty description',
                2.01, 'Starbucks Bank Account * 0222', '1111222233334444', Transaction::STATUS_COMPLETED, Transaction::TYPE_EXTERNAL);
            $this->addTransaction('11.03.2022', 'Coca-Cola 0.3 @Starbacks', 'empty description',
                2.01, 'Starbucks Bank Account * 0222', '2222333524564896', Transaction::STATUS_COMPLETED, Transaction::TYPE_EXTERNAL);
            $this->addTransaction('11.03.2022', 'Pack of Chips @Starbacks', 'empty description',
                3.12, 'Starbucks Bank Account * 0222', '6666666666666666', Transaction::STATUS_COMPLETED, Transaction::TYPE_EXTERNAL);
            $this->addTransaction('11.03.2022', 'Coca-Cola 0.3 @Starbacks', 'empty description',
                2.01, 'Starbucks Bank Account * 0222', '6666666666666666', Transaction::STATUS_COMPLETED, Transaction::TYPE_EXTERNAL);
            $this->addTransaction('11.03.2022', '45059 DELIPEETS CAFFEE SAN JOSE CA', 'empty description',
                34.52, 'Starbucks Bank Account * 0222', '6666666666666666', Transaction::STATUS_COMPLETED, Transaction::TYPE_EXTERNAL);
            $this->addTransaction('11.03.2022', 'REFUND FROM BESTBUY. ORDER NUMBER: 237cfdr6r7', 'The refund processing might take time: allow up to 5 work days for it to process',
                212.99, '7777777777777777', 'Starbucks Bank Account * 0222', Transaction::STATUS_COMPLETED, Transaction::TYPE_EXTERNAL);


            // Return the number of rows in result set
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type` ) VALUES ('Debit Account', '1111222233334444', '100000000', '999.99', '2');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`, `account_type`) VALUES ('Credit Account', '2222333524564896', '100000000', '10499.99', '1');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`, `account_type`) VALUES ('Debit Account', '6666666666666666', '999999999', '2000.00', '2');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`, `account_type`) VALUES ('Credit Account', '7777777777777777', '999999999', '10501.99', '1');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type`) VALUES ('Credit Account 2', '7777777777777773', '999999999', '100501.99', '1');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type`, `goal`) VALUES ('New Car', '7777777777777772', '999999999', '1300', '3', '10000');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type`, `goal`) VALUES ('Summer Trip', '7777777777777771', '999999999', '1800', '3', '5000');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type`, `goal`) VALUES ('New Car', '7777777777777770', '100000000', '690', '3', '1000');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_users` (`firstname`, `lastname`, `password`, `ssn`, `email`, `pin`) VALUES('Sophia', 'Lastname', 'pass', '100000000', 'email.com', '1111');";
                $results = mysqli_query($this->conn, $sql);
                $sql = "INSERT INTO `bank_users` (`firstname`, `lastname`, `password`, `ssn`, `email`, `pin`) VALUES('Mikhail', 'F', 'pass', '999999999', 'me@email.com', '2222')";
                $results = mysqli_query($this->conn, $sql);
            //new thing for testing
            $this->addLog("checkScans/testCheckImage.png", "Test Verify Check Deposit 1", BankLog::$SIGNIFICANCE_LEVEL_ADMIN_ACTION_NEEDED, "today", "7777777777777777");
            $this->addLog("checkScans/testCheckImage3.png", "Test Verify Check Deposit 3", BankLog::$SIGNIFICANCE_LEVEL_ADMIN_ACTION_NEEDED, "today", "7777777777777777");
            //end of the thing


        }
        //Add transactions:



    }
    public function addAccount($name, $owner_ssn, $balance, $account_type){
        // creating connection with the DB
        $newNumber = $this->newCardNumber();
        $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type`)
                VALUES ('$name', '$newNumber', '$owner_ssn', '$balance', '$account_type');";
        $results = mysqli_query($this->conn, $sql);
        if ($results) {
            //log - user has been added
            $this->addLog("New account ".$newNumber." was successfully opened with initial balance = $".$balance, "Successful Account Opening", BankLog::$SIGNIFICANCE_LEVEL_INFO,date("Y-m-d h:i:sa"),$owner_ssn);
        } else {
            echo mysqli_error($this->conn);
        }
    }

    public function addGoal($name, $owner_ssn, $goal, $account_type){
        // creating connection with the DB
        $newNumber = $this->newCardNumber();
        $sql = "INSERT INTO `bank_accounts` (`name`, `number`, `owner_ssn`, `balance`,`account_type`, `goal`)
                VALUES ('$name', '$newNumber', '$owner_ssn', 0, '$account_type', '$goal');";
        $results = mysqli_query($this->conn, $sql);
        if ($results) {
            //log - user has been added
            $this->addLog("New Goal ".$newNumber." was successfully opened with target balance = $".$goal, "Successful Account Opening", BankLog::$SIGNIFICANCE_LEVEL_INFO,date("Y-m-d h:i:sa"),$owner_ssn);
        } else {
            echo mysqli_error($this->conn);
        }
    }

    public function addUser($firstName, $lastName, $password, $ssn, $email, $pin){
        // creating connection with the DB
        $sql = "INSERT INTO bank_users (firstname, lastname, password, SSN, email, pin)
                        values ('$firstName', '$lastName','$password', '$ssn','$email', '$pin')";
        $results = mysqli_query($this->conn, $sql);
        if ($results) {
            //log - user has been added
            $this->addLog("User ".$firstName." ".$lastName." successfully registered", "Successful User Registration", BankLog::$SIGNIFICANCE_LEVEL_INFO,date("Y-m-d h:i:sa"),$ssn);
        } else {
            echo mysqli_error($this->conn);
            $this->addLog("User ".$firstName." ".$lastName." failed to register", "Failed User Registration", BankLog::$SIGNIFICANCE_LEVEL_WARN,date("Y-m-d h:i:sa"),$ssn);
        }

    }

    public function addLog($description, $name, $significanceLevel, $date, $causedBy){
        // creating connection with the DB
        $sql = "INSERT INTO bank_logs (description, name, significanceLevel, date, causedBy)
                        values ('$description', '$name','$significanceLevel', '$date','$causedBy')";
        $results = mysqli_query($this->conn, $sql);
        if ($results) {
            //log - user has been added
        } else {
            echo mysqli_error($this->conn);
        }
    }
    //($row->date, $row->name, $row->description, $row->balance_change, $row->recipient, $row->sender, $row->status, $row->type);
    private function addTransaction($date, $name, $description, $balance_change, $recipient, $sender, $status, $type){
        // creating connection with the DB
        $sql = "INSERT INTO bank_transactions (date, name, description, balance_change, recipient, sender, status, type)
                         values ('$date', '$name','$description', '$balance_change', '$recipient', '$sender', '$status', '$type')";
        return mysqli_query($this->conn, $sql);
    }


    public function makeTransaction($date, $name, $description, $balance_change, $recipient, $sender, $status, $type){
        $results = $this->addTransaction($date, $name, $description, $balance_change, $recipient, $sender, $status, $type);

        if($type == Transaction::TYPE_LOCAL || $type == Transaction::TYPE_EXTERNAL){

            if ($results){
                $this->logSuccessfulTransaction($balance_change,$recipient,$sender);
                $this->changeBalance($recipient, $sender, $balance_change);
            } else $this->logFailedTransaction($balance_change,$recipient,$sender);
        }
        if($type == Transaction::TYPE_CHECK){
            //TODO: add the logs
            if($results){
                $this->logCheckDeposit($balance_change, $recipient, $sender);
                $this->depositCheck($recipient, $balance_change);
            } //else fail

            //$this->addPendingCheck($recipient, $balance_change);
            //$this->depositCheck($recipient, $balance_change);
        }
    }

    public function logCheckDeposit($balance, $recipient, $checkName){
            $this->addLog($checkName,
                "New Check Deposit. Balance = ".$balance,
                BankLog::$SIGNIFICANCE_LEVEL_ADMIN_ACTION_NEEDED,
                date("Y-m-d h:i:sa"),$recipient);
    }

    public function approveCheck($checkName){
        $this->updateCheckLog($checkName);
    }

    public function denyCheck($checkName){
        $log = $this->getLog($checkName);
        $sql = "DELETE FROM bank_logs WHERE description = '$checkName'";
        $result = mysqli_query($this->conn, $sql);
        $account = $this->getAccount($log->getCausedBy());
        $user = $this->getUser($account->getOwnerSSN());
        $posOfEqualitySign = strpos($log->getName(),"=");

        $balance = substr($log->getName(),$posOfEqualitySign+2);
        $this->depositCheck($account->getNumber(), 0-$balance);
        $this->addLog("Check Deposit with sum = ".$balance." was denied. The funds are withdrawn from user ".$this->getUser($account->getOwnerSSN())->getFullName(),
            "Check Deposit Denied",
            BankLog::$SIGNIFICANCE_LEVEL_INFO,
            date("Y-m-d h:i:sa"),
            $log->getCausedBy());
        $this->addTransaction(date("Y-m-d h:i:sa"),"Denied Check Deposit",
            "The funds were withdrawn due to deny of the deposit",
            0-$balance,
            $account->getNumber(),
            "denied deposit",
            Transaction::STATUS_DENIED,
            Transaction::TYPE_CHECK);
    }

    public function updateCheckLog($checkName){
        $log = $this->getLog($checkName);
        $sql = "DELETE FROM bank_logs WHERE description = '$checkName'";
        $result = mysqli_query($this->conn, $sql);
        $this->addLog($log->getName(),"Check Deposit Verified", BankLog::$SIGNIFICANCE_LEVEL_INFO, date("Y-m-d h:i:sa"), $log->getCausedBy());
    }

    public function depositCheck($recipient, $balance){
        $newBalance = $this->getAccount($recipient)->getBalance()+$balance;
        $this->updateValue($recipient, $newBalance);
    }

    public function changeBalance($recipient, $sender, $balance_change){
        $newRecipientBalance = $this->getAccount($recipient)->getBalance()+$balance_change;
        $newSenderBalance = $this->getAccount($sender)->getBalance()-$balance_change;

        $this->updateValue($recipient, $newRecipientBalance);
        $this->updateValue($sender, $newSenderBalance);

    }
    public function updateValue($recipient, $newBalance){
        $sql = sprintf("UPDATE bank_accounts SET balance=%s WHERE number=%s", $newBalance, $recipient);
        $results = mysqli_query($this->conn, $sql);
    }

    public function getAccount($number){
        $sql = "SELECT * FROM bank_accounts WHERE number=$number";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_object($result);
        return new BankAccount($row->name, $row->number, $row->owner_ssn, $row->balance, $this->getTransactions($row->number), $row->goal, $row->account_type );
    }

    public function closeAccount($number){
        $this->addLog("account number ".$number." was closed",
            "Account Closed",
            BankLog::$SIGNIFICANCE_LEVEL_INFO,
            date("Y-m-d h:i:sa"),
            $this->getUser($this->getAccount($number)->getOwnerSSN())->getEmail(),
        );
        $sql = "DELETE FROM bank_accounts WHERE number = '$number'";
        $result = mysqli_query($this->conn, $sql);

    }
    public function getUser($ssn){
        $sql = "SELECT * FROM bank_users WHERE ssn=$ssn";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_object($result);
        return new BankUser($row->firstname,$row->lastname,$row->password,$row->ssn,$row->email,$row->pin, $this->getBankingAccounts($row->ssn));
    }

    public function getLog($description){
        $sql = "SELECT * FROM bank_logs WHERE description='$description'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_object($result);
        return new BankLog($row->description,$row->name,$row->significanceLevel,$row->date,$row->causedBy);
    }

    public function getUsers()
    {
        $i = 0;
        $arr = array();

        $sql = "SELECT * FROM bank_users";
        $result = mysqli_query($this->conn, $sql);
        while($row=mysqli_fetch_object($result)){

            $arr[$i]=new BankUser($row->firstname,$row->lastname,$row->password,$row->ssn,$row->email, $row->pin, $this->getBankingAccounts($row->ssn));
            $i++;
        }
        return $arr;
    }

    public function getLogs(){
        $i = 0;
        $arr = array();

        $sql = "SELECT * FROM bank_logs";
        $result = mysqli_query($this->conn, $sql);
        while($row=mysqli_fetch_object($result)){

            $arr[$i]=new BankLog($row->description,$row->name,$row->significanceLevel,$row->date,$row->causedBy);
            $i++;
        }

        return $arr;
    }
    public function getLogsWithoutAdminTasks(){
        $i = 0;
        $arr = array();

        $sql = "SELECT * FROM bank_logs WHERE significanceLevel != 5";
        $result = mysqli_query($this->conn, $sql);
        while($row=mysqli_fetch_object($result)){

                $arr[$i]=new BankLog($row->description,$row->name,$row->significanceLevel,$row->date,$row->causedBy);
            $i++;
        }
        return $arr;
    }

    public function recoverFullAccountNumber($string, $ssn){
        $string = substr($string, -5,4);
        $accounts = $this->getBankingAccounts($ssn);

        for ($i = 0; $i<count($accounts);$i++){
            if (substr($accounts[$i]->getNumber(),-4)==$string){
                return $accounts[$i]->getNumber();
            }
        }
        return -1;
    }

    public function getAdminTasks(){
        $i = 0;
        $arr = array();

        $sql = "SELECT * FROM bank_logs WHERE significanceLevel = 5";
        $result = mysqli_query($this->conn, $sql);
        while($row=mysqli_fetch_object($result)){

                $arr[$i]=new BankLog($row->description,$row->name,$row->significanceLevel,$row->date,$row->causedBy);

            $i++;
        }

        return $arr;
    }
    public function loginWithSSN($ssn, $password): ?BankUser
    {
        $sql = "SELECT * FROM bank_users WHERE ssn='$ssn'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_object($result);
        if ($row == null){
            return null;
        }
        $user = new BankUser($row->firstname,$row->lastname,$row->password,$row->ssn,$row->email, $row->pin, $this->getBankingAccounts($row->ssn));
        if ($user->getPassword() == $password){
            $this->addLog("User ".$row->firstName." ".$row->lastName." successfully logged in", "Successful Login", BankLog::$SIGNIFICANCE_LEVEL_INFO,date("Y-m-d h:i:sa"),$ssn);
            return $user;

        } else {
            $this->addLog("User ".$row->firstName." ".$row->lastName." tried to log in with wrong password: Expected: ".$user->getPassword()." Provided: $password",
                "Failed to Login", BankLog::$SIGNIFICANCE_LEVEL_CONCERNING,date("Y-m-d h:i:sa"),$ssn);
        }
        return null;
    }

    public function initializeDB(){ //temporary method for the presentation
        $result= mysqli_query($this->conn,"TRUNCATE TABLE bank_users");
        $this->addUser("Sophia","Lastname", "pass", "10", "email.com");

    }


    //method checks if the user exists and if the password is correct. If success - returns SSN for POST, so that the
    //main page can load the current user by unique SSN number

    public function login($fullNameOrSsnOrEmail, $password){

        //TODO: comment this part before final release: from here ------->
        $user = $this->loginWithSSN($fullNameOrSsnOrEmail, $password);
        if($user != null){
            return $user->getSSN();
        }
        $user = $this->loginWithFullName($fullNameOrSsnOrEmail, $password);
        if ($this->checkPassword($user,$password)){
            return $user->getSSN();
        }
        //<----------to here

        $user = $this->loginWithEmail($fullNameOrSsnOrEmail, $password);
        if ($this->checkPassword($user,$password)){
            return $user->getSSN();
        }
        return null;

    }

    public function loginWithFullName($fullName, $password){
        $users = $this->getUsers();
        foreach ($users as $user){
            if ($user->getFullName() == $fullName and $user->getPassword() == $password){
                return $user;
            }
        }
        return null;
    }

    public function loginWithEmail($email, $password){
        $users = $this->getUsers();
        foreach ($users as $user){
            if ($user->getEmail() == $email and $user->getPassword() == $password){
                return $user;
            }
        }
        return null;
    }

    public function atmLogin($email, $pin) :String{
        $users = $this->getUsers();

        foreach ($users as $user){
            if ($user->getEmail() == $email and $user->getPin() == $pin){
                return $this->accountsArray($user->getBankAccountsWithoutGoals());
            }
        }
        return 0;
    }

    public function withdraw($accountNumber, $amount){

        $this->log_ATM_Withdraw($accountNumber, $amount);
        $this->updateValue($accountNumber, $this->getAccount($accountNumber)->getBalance()-$amount);
        return $this->getAccount($accountNumber)->getBalance();
    }

    public function accountsArray($accounts) :String{
        $i = 0;
        $output = "";
        while($i<=count($accounts)-1){
            $output = $output.$accounts[$i]->getNumber()." ";
            $i++;
        }
        return substr($output, 0, -1);
    }

    private function checkPassword($user, $password): bool
    {
        if ($user!=null){
            if ($user->getPassword()==$password) return true;
        }

        return false;
    }

    public function ssnIsUnique($ssn){
        $sql = "SELECT * FROM bank_accounts WHERE owner_ssn='$ssn'";
        $result = mysqli_query($this->conn, $sql);
        if($row=mysqli_fetch_object($result)){
            return false;
        }
        return true;
    }

    public function emailIsUnique($email){
    $sql = "SELECT * FROM bank_users WHERE email='$email'";
    $result = mysqli_query($this->conn, $sql);
    if($row=mysqli_fetch_object($result)){
        return false;
    }
    return true;
}

    public function getBankingAccounts($ssn){

        $sql = "SELECT * FROM bank_accounts WHERE owner_ssn='$ssn'";
        $result = mysqli_query($this->conn, $sql);
        $arr = array();
        $i = 0;

        while($row=mysqli_fetch_object($result)){

            $arr[$i]=new BankAccount($row->name,
                $row->number,
                $ssn,
                $row->balance,
                $this->getTransactions($row->number),
                $row->goal,
                $row->account_type
            );

            $i++;
        }
        return $arr;
    }

    public function getTransactions($number){

        $sql = "SELECT * FROM bank_transactions WHERE sender='$number' or recipient='$number'";
        $result = mysqli_query($this->conn, $sql);
        $arr = array();
        $i = 0;

        while($row=mysqli_fetch_object($result)){
            $balance_change=$row->balance_change;
            if($row->sender==$number) {
               $balance_change=0-$balance_change;
                    }
            $arr[$i] = new Transaction($row->date,
                $row->name,
                $row->description,
                $balance_change,
                $row->recipient,
                $row->sender,
                $row->status,
                $row->type);
            $transactions[$i] = $arr[$i];
            $i++;
        }



        return $arr;
    }

    private function log_ATM_Withdraw($accountNumber, $balanceChange){
        $this->addLog("Successful withdraw of ".BankFormat::moneyFormat($balanceChange). " from account ".$accountNumber,
            "Successful Withdraw",
            BankLog::$SIGNIFICANCE_LEVEL_TRANSACTION,
            date("Y-m-d h:i:sa"),
            $accountNumber);
    }
    private function logSuccessfulTransaction($balance_change, $recipient, $sender){
        $this->addLog("New successful transaction from ".$sender." to ".$recipient." with balance change = ".$balance_change,
            "New Successful Transaction",
            BankLog::$SIGNIFICANCE_LEVEL_TRANSACTION,
            date("Y-m-d h:i:sa"),
            $sender);
    }

    private function logFailedTransaction($balance_change, $recipient, $sender){
        $this->addLog("Transaction from ".$sender." to ".$recipient." with balance change = "
            .$balance_change." failed. Reason: ".mysqli_error($this->conn),
            "Failed Transaction",
            BankLog::$SIGNIFICANCE_LEVEL_WARN,
            date("Y-m-d h:i:sa"),$sender);

    }


    public function getNumberOfBankingAccounts(){
        $sql = "SELECT * FROM bank_accounts";
        $result = mysqli_query($this->conn, $sql);
        $size = 0;
        $i = 0;

        while($row=mysqli_fetch_object($result)){
            $size++;
            $i++;
        }

        return $size;
    }

    public function newCardNumber(){
        $numberOfAccounts= $this->getNumberOfBankingAccounts();
        return "420066990000".(1000+$numberOfAccounts);
    }



}
