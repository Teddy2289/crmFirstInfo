<?php

namespace App\Helpers;


class Date
{
    public static function getMonthsEn()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December',
        ];
    }

    public static function getMonthsFr()
    {
        return [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
            'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre',
        ];
    }

    public static function formatDateFr($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M Y');
    }
}
