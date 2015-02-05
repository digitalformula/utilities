<?php
/**
 *
 * Contains the Currency class
 *
 * @author Chris Rasmussen, digitalformula.net
 * @category Libraries & Utilities
 * @license Apache License, Version 2.0
 * @package DigitalFormula\Utilities
 * @extends \Exception
 *
 */

namespace DigitalFormula\Utilities;

/**
 *
 * The Currency class
 *
 * @author Chris Rasmussen, digitalformula.net
 * @category Libraries & Utilities
 * @license Apache License, Version 2.0
 * @package DigitalFormula\Utilities
 * @extends \Exception
 *
 */
class Currency
{

	/**
     * Perform a currency conversion
     * @param integer $amount The amount to convert
     * @param string $baseCurrency The currency to convert from
     * @param string $quoteCurrency The currency to convert to
     * @returns integer The converted value
     * @throws \DigitalFormula\Utilities\CurrencyConversionException
     */
    public static function YahooCurrencyConversion( $amount, $baseCurrency, $quoteCurrency )
    {
        try
        {
            $base_in = array( "{$baseCurrency}" );
            $quote_in = array( "{$quoteCurrency}" );
            $open = fopen( "http://quote.yahoo.com/d/quotes.csv?s=$base_in[0]$quote_in[0]=X&f=sl1d1t1c1ohgv&e=.csv", "r" );
            $exchangeRate = fread( $open, 2000 );
            fclose( $open );
            $exchangeRate = explode(
                ',',
                str_replace( "\"", "", $exchangeRate )
            );
            $results = ( $exchangeRate[ 1 ] * $amount );
            $amount = number_format( $amount );
            return( $results );
        }
        catch( \Exception $e )
        {
        	$message = $e->getMessage();
            throw new \DigitalFormula\Utilities\CurrencyConversionException( $message, 1 );
        }
    }
    /* YahooCurrencyConversion */
    
}
/* Currency */