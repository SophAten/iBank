<?php

class BankLog
{
    private string $description;
    private string $name;
    private int $significanceLevel;
    private $date;
    private $causedBy;

    public static int $SIGNIFICANCE_LEVEL_INFO = 0;
    public static int $SIGNIFICANCE_LEVEL_WARN = 1;
    public static int $SIGNIFICANCE_LEVEL_TRANSACTION = 2;
    public static int $SIGNIFICANCE_LEVEL_CONCERNING = 3; //For example an attempt to insert a code inside a field

    public static int $SIGNIFICANCE_LEVEL_ADMIN_ACTION_NEEDED = 5;

    /**
     * @param string $description
     * @param string $name
     * @param int $significanceLevel
     * @param $date
     * @param $causedBy
     */
    public function __construct(string $description, string $name, int $significanceLevel, $date, $causedBy)
    {
        $this->description = $description;
        $this->name = $name;
        $this->significanceLevel = $significanceLevel;
        $this->date = $date;
        $this->causedBy = $causedBy;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSignificanceLevel(): int
    {
        return $this->significanceLevel;
    }

    /**
     * @param int $significanceLevel
     */
    public function setSignificanceLevel(int $significanceLevel): void
    {
        $this->significanceLevel = $significanceLevel;
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
    public function getCausedBy()
    {
        return $this->causedBy;
    }

    /**
     * @param mixed $causedBy
     */
    public function setCausedBy($causedBy): void
    {
        $this->causedBy = $causedBy;
    }




}