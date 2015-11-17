<?php

namespace DigitalFormula\MyAssetDb\Utilities;

use Sentinel;

class Text {

    /**
     * Information about the current logged-in user
     *
     * @var
     */
    var $user;

    public function __construct()
    {
        $this->user = Sentinel::getUser();
    }

    /**
     * Convert a standard string into a slug-appropriate version
     *
     * @param $text
     * @return mixed|string
     */
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

    /**
     * Generate a random password (up to 40 characters)
     *
     * @param $length
     * @return string
     */
    public static function generatePassword( $length )
    {
        return ( substr( sha1( mt_rand() ), 0, $length ) );
    }
    /* generatePassword */

    /**
     * Generate a random hex string of any length
     * Default length = 64 characters
     *
     * @param int $length
     * @return string
     */
    public static function generateRandomHexString( $length = 64 )
    {
        $characters = '0123456789abcdefABCDEF';
        $charactersLength = strlen( $characters );
        $randomString = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            $randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
        }
        return $randomString;
    }
    /* generateRandomHexString */

    /**
     * Encrypt any string based on a supplied encryption key
     *
     * @param $text
     * @return string
     */
    public static function encryptText( $text, $cipher = 'AES-256-CBC'  )
    {
        $iv_size = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
        $iv = mcrypt_create_iv( $iv_size, MCRYPT_RAND );
        $enc = openssl_encrypt( $text, $cipher, Sentinel::getUser()->settings()->first()->enc_key, 0, $iv );
        $stored = base64_encode( $iv . $enc );
        return $stored;
    }
    /* encryptText */

    /**
     * Decrypt any string based on a supplied encryption key
     *
     * @param $text
     * @return string
     */
    public static function decryptText( $text, $cipher = 'AES-256-CBC' )
    {

        $new_iv_size = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
        $decoded = base64_decode( $text );
        $new_iv = str_replace( substr( $decoded, $new_iv_size ), '', $decoded );
        $enc_str = str_replace( $new_iv, '', $decoded );
        $dec = openssl_decrypt( $enc_str, $cipher, Sentinel::getUser()->settings()->first()->enc_key, 0, $new_iv );
        return( $dec );
    }
    /* decryptText */

}