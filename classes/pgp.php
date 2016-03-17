<?php
/**
 * Created by PhpStorm.
 * User: alexanderzhilyaev
 * Date: 14.08.15
 * Time: 12:56
 */
class OpenPgp
{
    private static function getGnupg()
    {
        if(!class_exists('gnupg')){
            throw new Exception('install gnupg please!');
        } else {
            $gpg = new gnupg();
            $gpg->seterrormode(gnupg::ERROR_EXCEPTION);
            return $gpg;
        }
    }
    public static function decrypt($message, $private_key)
    {
        $gpg = self::getGnupg();
        $private_key = $gpg -> import($private_key);
        $gpg -> adddecryptkey($private_key['fingerprint'],"");
        $enc = $gpg -> decrypt($message);
        if(!$enc){
            return $gpg -> geterror();
        } else {
            return $enc;
        }
    }
    public static function encrypt($message, $public_key)
    {
        /*try{*/
            $gpg = self::getGnupg();
            $public_key = $gpg -> import($public_key);
            $gpg -> addencryptkey($public_key['fingerprint']);
            $enc = $gpg -> encrypt($message);
        /*}catch (Exception $e) {
            return $e->getmessage();
        }*/
        return $enc;
    }
}