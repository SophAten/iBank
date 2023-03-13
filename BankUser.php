<?php
class BankUser
{
    private string $firstName;
    private $lastName;
    private $password;
    private $SSN;
    private $email;
    private $pin;
    private Array $bankAccounts;
    
    public const VERIFICATION_NOT_REQUIRED=0;
    public const VERIFICATION_REQUIRED=1;

    /**
     * @param $firstName
     * @param $lastName
     * @param $SSN
     */

    public function __construct($firstName, $lastName, $password, $SSN, $email, $pin,$bankAccounts)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->SSN = $SSN;
        $this->password = $password;
        $this->email= $email;
        $this->bankAccounts = $bankAccounts;
        $this->pin = $pin;
    }

    /**
     * @return mixed
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param mixed $pin
     */
    public function setPin($pin): void
    {
        $this->pin = $pin;
    }


    public function addNewBankAccount(BankAccount $account){
        $this->bankAccounts.add($account);
    }
    public function getFullName() :string { //used for login
        return $this->firstName . " " . $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSSN()
    {
        return $this->SSN;
    }

    /**
     * @param mixed $SSN
     */
    public function setSSN($SSN): void
    {
        $this->SSN = $SSN;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getBankAccounts(): array
    {
        return $this->bankAccounts;
    }

    public function getBankAccountsWithoutGoals(): array
    {
        $output = array();
        foreach ($this->bankAccounts as $account) {
            if($account->getAccountType()!=BankAccount::$ACCOUNT_TYPE_GOAL){
                array_push($output, $account);
            }
        }
        return $output;
    }

    /**
     * @param array $bankAccounts
     */
    public function setBankAccounts(array $bankAccounts): void
    {
        $this->bankAccounts = $bankAccounts;
    }

}
