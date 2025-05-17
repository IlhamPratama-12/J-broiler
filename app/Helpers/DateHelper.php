<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    protected static $formatTanggal = 'd/m/Y';
    protected static $formatTanggalWaktu = 'Y/m/d H:i:s';
    protected static $defaultSelisihTanggal = 14;

    public static function stringToDate($string)
    {
        return Carbon::createFromFormat(self::$formatTanggal, $string)->format('Y-m-d');
    }

    public static function dateToString($date)
    {
        if (isset($date)) {
            return Carbon::parse($date)->format(self::$formatTanggal);
        } else {
            return "";
        }
    }

    public static function dateToStringIndonesia($date)
    {
        if (isset($date)) {
            $month = Carbon::parse($date)->month;
            switch ($month) {
                case '01':
                    $thisMonth = "Januari";
                    break;
                case '02':
                    $thisMonth = "Februari";
                    break;
                case '03':
                    $thisMonth = "Maret";
                    break;
                case '04':
                    $thisMonth = "April";
                    break;
                case '05':
                    $thisMonth = "Mei";
                    break;
                case '06':
                    $thisMonth = "Juni";
                    break;
                case '07':
                    $thisMonth = "Juli";
                    break;
                case '08':
                    $thisMonth = "Agustus";
                    break;
                case '09':
                    $thisMonth = "September";
                    break;
                case '10':
                    $thisMonth = "Oktober";
                    break;
                case '11':
                    $thisMonth = "November";
                    break;
                case '12':
                    $thisMonth = "Desember";
                    break;
                default:
                    $thisMonth = "test";
                    break;
            }
            return Carbon::parse($date)->format('d ') . $thisMonth . Carbon::parse($date)->format(' Y');
        } else {
            return "";
        }
    }

    public static function monthToStringIndonesia($month)
    {
        if (isset($month)) {
            switch ($month) {
                case '01':
                    $thisMonth = "Januari";
                    break;
                case '02':
                    $thisMonth = "Februari";
                    break;
                case '03':
                    $thisMonth = "Maret";
                    break;
                case '04':
                    $thisMonth = "April";
                    break;
                case '05':
                    $thisMonth = "Mei";
                    break;
                case '06':
                    $thisMonth = "Juni";
                    break;
                case '07':
                    $thisMonth = "Juli";
                    break;
                case '08':
                    $thisMonth = "Agustus";
                    break;
                case '09':
                    $thisMonth = "September";
                    break;
                case '10':
                    $thisMonth = "Oktober";
                    break;
                case '11':
                    $thisMonth = "November";
                    break;
                case '12':
                    $thisMonth = "Desember";
                    break;
                default:
                    $thisMonth = "test";
                    break;
            }
            return $thisMonth;
        } else {
            return "";
        }
    }

    public static function dateTimeToString($date, $format = 'd/m/Y H:i:s')
    {
        return Carbon::parse($date)->format($format);
    }

    public static function stringToDateTime($string)
    {
        return Carbon::createFromFormat(self::$formatTanggalWaktu, $string);
    }

    public static function nowString()
    {
        return Carbon::now()->format(self::$formatTanggal);
    }

    public static function getTglAwalString()
    {
        return self::getTglAwalDefault()->format(self::$formatTanggal);
    }

    public static function getTglAwalDefault()
    {
        return Carbon::now()->subDays(self::$defaultSelisihTanggal);
    }

    public static function now(){
        return Carbon::now();
    }
    public static function month(){
        $month = [
            [
                'name' => 'Januari',
                'value'=> 1
            ],
            [
                'name' => 'Februari',
                'value'=> 2
            ],
            [
                'name' => 'Maret',
                'value'=> 3
            ],
            [
                'name' => 'April',
                'value'=> 4
            ],
            [
                'name' => 'Mei',
                'value'=> 5
            ],
            [
                'name' => 'Juni',
                'value'=> 6
            ],
            [
                'name' => 'Juli',
                'value'=> 7
            ],
            [
                'name' => 'Agustus',
                'value'=> 8
            ],
            [
                'name' => 'September',
                'value'=> 9
            ],
            [
                'name' => 'Oktober',
                'value'=> 10
            ],
            [
                'name' => 'November',
                'value'=> 11
            ],
            [
                'name' => 'Desember',
                'value'=> 12
            ]
        ];
        return $month;
    }
}
