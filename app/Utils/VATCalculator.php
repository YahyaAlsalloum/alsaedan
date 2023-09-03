<?php


namespace App\Utils;


trait VATCalculator
{
    public function calculateVATAmount($vatType, $vatAmount, $price)
    {
        switch ($vatType) {
            case 0: // add vat//excluded
                $vatPercentage = $vatAmount / 100;
                $vat = 1 + $vatPercentage;
                $result = $price * $vat;
                return $result;
                break;
            case 1: // exclude vat//included
                $vatPercentage = $vatAmount / 100;
                $vat = 1 + $vatPercentage;
                $result = $price / $vat;
                return $result;
                break;
            default:
                return $price;
        }
    }

    public function calculateNetAmount($vatType, $vatAmount, $price)
    {
        switch ($vatType) {
            case 0: // add vat
                $vatPercentage = $vatAmount / 100;
                $vat = 1 + $vatPercentage;
                $result = ($price / $vat) / 100;
                return $result;
                break;
            case 1: // exclude vat
                $vatPercentage = $vatAmount / 100;
                $vat = 1 + $vatPercentage;
                $result = ($price / $vat);
                return $result;
                break;
            default:
                return $price;
        }
    }

}
