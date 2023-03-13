<?php

class BankAccount
{
    private $name;
    private $number;
    private $ownerSSN;
    private $balance;
    private $savings_goal;
    private $account_type;
    private array $transactions;

    public static $ACCOUNT_TYPE_CREDIT = 1;
    public static $ACCOUNT_TYPE_DEBIT = 2;
    public static $ACCOUNT_TYPE_GOAL = 3;

    public function __construct($name, $number, $ownerSSN, $balance, $transactions, $savings_goal, $account_type)
    {
        $this->name = $name;
        $this->number = $number;
        $this->ownerSSN = $ownerSSN;
        $this->balance = $balance;
        $this->transactions = $transactions;
        $this->savings_goal = $savings_goal;
        $this->account_type = $account_type;
    }


    public function getSavingsGoal()
    {
        return $this->savings_goal;
    }


    public function setSavingsGoal($savings_goal): void
    {
        $this->savings_goal = $savings_goal;
    }

    public function getAccountType()
    {
        return $this->account_type;
    }


    public function setAccountType($account_type): void
    {
        $this->account_type = $account_type;
    }

    public function getBalance()
    {
        return $this->balance;
    }


    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number): void
    {
        $this->number = $number;
    }

    public function getOwnerSSN()
    {
        return $this->ownerSSN;
    }

    public function setOwnerSSN($ownerSSN): void
    {
        $this->ownerSSN = $ownerSSN;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function setTransactions(array $transactions): void
    {
        $this->transactions = $transactions;
    }



}