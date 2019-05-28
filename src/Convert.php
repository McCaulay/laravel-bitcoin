<?php
namespace McCaulay\Bitcoin;

class Convert
{
    /**
     * Converts from satoshi to bitcoin.
     *
     * @param int $satoshi
     * @return string
     */
    public static function satoshiToBitcoin(int $satoshi): string
    {
        return bcdiv($satoshi, 100000000, 8);
    }

    /**
     * Converts from bitcoin to satoshi.
     *
     * @param float $bitcoin
     * @return string
     */
    public static function bitcoinToSatoshi(float $bitcoin): string
    {
        return bcmul(self::toFixed($bitcoin), 100000000);
    }

    /**
     * Brings number to fixed precision without rounding.
     *
     * @param float $number
     * @param int   $precision
     * @return string
     */
    private static function toFixed(float $number, int $precision = 8): string
    {
        return bcdiv(($number * pow(10, $precision)), pow(10, $precision), $precision);
    }
}
