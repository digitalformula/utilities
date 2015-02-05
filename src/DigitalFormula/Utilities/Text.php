<?php
/**
 *
 * Contains the Text class
 *
 * @author Chris Rasmussen, digitalformula.net
 * @category Libraries & Utilities
 * @license Apache License, Version 2.0
 * @package DigitalFormula\Text
 * @extends \Exception
 *
 */

namespace DigitalFormula\Utilities;

/**
 *
 * The Text class
 *
 * @author Chris Rasmussen, digitalformula.net
 * @category Libraries & Utilities
 * @license Apache License, Version 2.0
 * @package DigitalFormula\Utilities
 * @extends \Exception
 *
 */
class Text
{

    public static function slugify( $text )
    {
        /* replace non letter or digits by - */
        $text = preg_replace( '~[^\\pL\d]+~u', '-', $text );
        /* trim */
        $text = trim( $text, '-' );
        /* transliterate */
        $text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );
        /* lowercase */
        $text = strtolower( $text );
        /* remove unwanted characters */
        $text = preg_replace( '~[^-\w]+~', '', $text );
        if ( empty( $text ) )
        {
            return 'n-a';
        }
        return $text;
    }
    /* slugify */

}
/* Text */