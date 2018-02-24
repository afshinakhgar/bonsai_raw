<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/24/18
 * Time: 3:36 PM
 */

namespace Kernel\Helpers;


class HashHelper
{
    /**
     * Receives a string password and hashes it.
     *
     * @param string $password
     * @return string $hash
     */
    public static function hash($password){
//        return (string)password_hash($password, PASSWORD_DEFAULT);
        return sha1(md5($password));
    }

    /**
     * Verifies if an hash corresponds to the given password
     *
     * @param string $password
     * @param string $hash
     * @return boolean If the hash was generated from the password
     */
    public static function checkHash($string, $hash){
        if( password_verify( $string, $hash ) ){
            return true;
        }
        return false;
    }
}