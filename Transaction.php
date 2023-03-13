<?php

class Transaction
{
    private $date;
    private $name;
    private $description;
    private $balanceChange;
    private $recipientAccount;
    private $senderAccount;
    private $status;
    private $type;

    //constants for the DB storage;
    public const STATUS_COMPLETED=0;
    public const STATUS_PENDING=1;
    public const STATUS_DENIED=2;

    public const TYPE_BETWEEN_ACCOUNTS=0;
    public const TYPE_LOCAL=1;
    public const TYPE_EXTERNAL=2;
    public const TYPE_CHECK=3;

    /**
     * @param $date
     * @param $name
     * @param $description
     * @param $balanceChange
     * @param $status
     * @param $type
     */
    public function __construct($date, $name, $description, $balanceChange, $recipientAccount, $senderAccount, $status, $type)
    {
        $this->date = $date;
        $this->name = $name;
        $this->description = $description;
        $this->balanceChange = $balanceChange;
        $this->status = $status;
        $this->type = $type;
        $this->recipientAccount = $recipientAccount;
        $this->senderAccount = $senderAccount;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBalanceChange()
    {
        return $this->balanceChange;
    }

    /**
     * @param mixed $balanceChange
     */
    public function setBalanceChange($balanceChange): void
    {
        $this->balanceChange = $balanceChange;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getSenderAccount()
    {
        return $this->senderAccount;
    }

    /**
     * @param mixed $senderAccount
     */
    public function setSenderAccount($senderAccount): void
    {
        $this->senderAccount = $senderAccount;
    }

    /**
     * @return mixed
     */
    public function getRecipientAccount()
    {
        return $this->recipientAccount;
    }

    /**
     * @param mixed $recipientAccount
     */
    public function setRecipientAccount($recipientAccount): void
    {
        $this->recipientAccount = $recipientAccount;
    }

}