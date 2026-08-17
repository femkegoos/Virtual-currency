<?php
abstract class Date
{


    private static $dagen = [
        'Monday' => 'maandag',
        'Tuesday' => 'dinsdag',
        'Wednesday' => 'woensdag',
        'Thursday' => 'donderdag',
        'Friday' => 'vrijdag',
        'Saturday' => 'zaterdag',
        'Sunday' => 'zondag'
    ];

    private static $maanden = [
        'January' => 'januari',
        'February' => 'februari',
        'March' => 'maart',
        'April' => 'april',
        'May' => 'mei',
        'June' => 'juni',
        'July' => 'juli',
        'August' => 'augustus',
        'September' => 'september',
        'October' => 'oktober',
        'November' => 'november',
        'December' => 'december'
    ];

    public static function format($datetime, $withTime = false)
    {
        if ($withTime) {
            $formaat = 'l d F Y H:i';
        } else {
            $formaat = 'l d F Y';
        }
        $datum = date($formaat, strtotime($datetime));
        $datum = str_replace(array_keys(self::$dagen), array_values(self::$dagen), $datum);
        $datum = str_replace(array_keys(self::$maanden), array_values(self::$maanden), $datum);
        return $datum;
    }
}
