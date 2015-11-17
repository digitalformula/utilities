<?php
/**
 *
 * Contains the Currency class
 * Intended for use with Laravel >=5.1
 *
 * @author Chris Rasmussen, digitalformula.net
 * @category Libraries & Utilities
 * @license Apache License, Version 2.0
 * @package DigitalFormula\Utilities
 *
 */

namespace DigitalFormula\Utilities;

use Log;
use Sentinel;

/**
 *
 * The Currency class
 * Intended for use with Laravel >=5.1
 *
 * @author Chris Rasmussen, digitalformula.net
 * @category Libraries & Utilities
 * @license Apache License, Version 2.0
 * @package DigitalFormula\Utilities
 *
 */
class Currency
{

    /**
     * Perform a real-time currency conversion using CurrencyLayer API
     *
     * @param $amount
     * @param $from
     * @param $to
     * @return int|string
     */
    public static function CurrencyLayerConversion( $amount, $from, $to )
    {
        if( $from == $to )
        {
            return $amount;
        }
        else {
            try {
                $endpoint = 'convert';
                $access_key = env( 'CURRENCY_LAYER_ACCESS_KEY' );
                $ch = curl_init( 'https://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '' );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $json = curl_exec($ch);
                curl_close($ch);
                $conversionResult = json_decode($json, true);
                switch( $conversionResult[ 'success' ] )
                {
                    case true:
                        return number_format( $conversionResult['result'], 2 );
                        break;
                    case false;
                        Log::error( $conversionResult[ 'error' ][ 'info' ], [ 'email' => Sentinel::getUser()->email, 'from' => $from, 'to' => $to ] );
                        return 0;
                        break;
                }
            }
            catch ( Exception $e ) {
                $message = $e->getMessage();
                Log::error( $message, [ 'email' => Sentinel::getUser()->email, 'from' => $from, 'to' => $to ] );
                return 0;
            }
        }
    }
    /* CurrencyLayerConversion */

}
/* Currency */