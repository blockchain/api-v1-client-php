<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Blockchain\Conversion;

class Conversion
{
    /**
     * Properties
     */
    

    /**
     * Methods
     */
    /**
     * Convert an incoming integer to a BTC string value
     */
    static function BTC_int2str($val)
    {
        $a = bcmul($val, "1.0", 1);
        return bcdiv($a, "100000000", 8);
    }

    /**
     * Convert a float value to BTC satoshi integer string
     */
    static function BTC_float2int($val)
    {
        return bcmul($val, "100000000", 0);
    }

    /**
     * From comment on http://php.net/manual/en/ref.bc.php
     */
    static function bcconv($fNumber)
    {
        $sAppend = '';
        $iDecimals = ini_get('precision') - floor(log10(abs($fNumber)));
        if (0 > $iDecimals) {
            $fNumber *= pow(10, $iDecimals);
            $sAppend = str_repeat('0', -$iDecimals);
            $iDecimals = 0;
        }

        return number_format($fNumber, $iDecimals, '.', '').$sAppend;
    }
}