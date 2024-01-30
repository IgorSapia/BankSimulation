<?php

namespace App\Services;

abstract class Services
{
    function cleanCPF($cpfDirty) {
        $cpfClean = preg_replace('/[^0-9]/', '', $cpfDirty);

        return $cpfClean;
    }

    function cleanCNPJ($cnpjDirty) {
        $cnpjClean = preg_replace('/[^0-9]/', '', $cnpjDirty);

        return $cnpjClean;
    }

    function floatToInt($floatValue) {
        return (int)($floatValue * 100);
    }

    function getUserByEmail($email, UserService $userService){
        return $userService->getUserIdByEmail($email);
    }

    function convertDateToDatetime($date) {
        $dateObj = DateTime::createFromFormat('d/m/Y', $date);

        if ($dateObj !== false) {
            return $dateObj->format('Y-m-d');
        } else {
            return false;
        }
    }

    function intToFloat($intValue){
        $floatValue = $intValue / 100;

        return number_format($floatValue, 2);
    }
}
