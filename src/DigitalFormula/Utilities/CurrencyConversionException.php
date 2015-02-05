<?php
/**
 *
 * Contains the CurrencyConversionException class
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
 * CurrencyConversionException exception class
 *
 * @package DigitalFormula\Utilities
 *
 */
class CurrencyConversionException extends \Exception
{
    /**
     * Create a new CurrencyConversionException with $message.
     * @param string $message The message to return along with the exception
     * @param integer $code The exception's return code
     * @param \Exception $previous The previous exception, if available
     */
    public function __construct( $message, $code = 0, \Exception $previous = null )
    {
        parent::__construct( $message, $code, $previous );
    }
    /* __construct */

}
/* CurrencyConversionException */