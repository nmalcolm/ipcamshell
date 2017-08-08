<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for 
 *
 * @package 
 * @author hIMEI <hIMEI@hiddentemple>
 * @version 0.1
 * @copyright (C) 2017 hIMEI <hIMEI@hiddentemple>
 * @license MIT
 */

use Leth\IPAddress\IP;
use Leth\IPAddress\IPv4;
use Leth\IPAddress\IPv6;

use Bankiru\IPTools;
use Bankiru\IPTools\Interfaces\RangeConverterInterface;
use Bankiru\IPTools\Interfaces\RangeFactoryInterface;
use Bankiru\IPTools\Interfaces\RangeInterface;

error_reporting(E_ALL);

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/iface.php');

class IpHandle 
{
    public function __construct()
    {
//        parent::__construct();    
    }

    /**
     * Validate the syntax of the given IP adress
     *
     * Using the PHP long2ip() and ip2long() functions, convert the IP
     * address from a string to a long and back.  If the original still
     * matches the converted IP address, it's a valid address.  This
     * function does not allow for IP addresses to be formatted as long
     * integers.
     *
     * @param  string $ip IP address in the format x.x.x.x
     * @return bool       true if syntax is valid, otherwise false
     */

    public static function validateIP($ip)

    {
        if ($ip == long2ip(ip2long($ip))) {
            return true;
        } else {
            return false;
        }
    }

    public static function parseRange($ip_range)
    {
        $range_factory = new Bankiru\IPTools\RangeFactory();
        $range = $range_factory->parse($ip_range);
        return $range;
    }

    public static function rangeIterator($range)
    {
        $range_iter = new Bankiru\IPTools\RangeIterator($range);
        foreach ($range_iter as $key => $value) {
            print($value."\n");
        }
    }

    public static function getIpRange()
    {
        $ip_range = null;
        Iface::ifaceGetIpRange();
        fscanf(STDIN, "%s\n", $ip_range);
        
        for ($i = 0; $i < strlen($ip_range); $i++) {
            if (!ctype_digit($ip_range[$i]) && 
              ($ip_range[$i] !== trim('.')) && 
              ($ip_range[$i] !== trim('/')) &&
              ($ip_range[$i] !== trim('-')) &&
              ($ip_range[$i] !== trim('*')) &&
              ($ip_range[$i] !== trim(','))) {
                    die("There was no ip\n");
            }
        }
          
        return $ip_range;
    } 
}

$handle = new IpHandle();
$ip = $handle->getIpRange();
var_dump($ip);
$range = $handle->parseRange($ip);
var_dump($range);
$handle->rangeIterator($range);
//$str_range = $handle->stringify($range);
//var_dump($str_range);




