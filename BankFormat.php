<?php

abstract class BankFormat
{
    static public function hideBankAccountNumber($number){
        return "**** ".substr(strval($number),-4);
    }

    static public function moneyFormat($number){

        return number_format($number, 2,'.', ',');
    }
}