<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for banner.php
 *
 * @package banner
 * @author hIMEI <hIMEI@hiddentemple>
 * @version 0.1
 * @copyright (C) 2017 hIMEI <hIMEI@hiddentemple>
 * @license MIT
 */

error_reporting(E_ALL);

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\CliMenuBuilder;

require_once(__DIR__ . '/../vendor/autoload.php');

/* Global constants for colorize output */

const    RED    =    "\x1B[31m";
const    GRN    =    "\x1B[32m";
const    YEL    =    "\x1B[33m";
const    BLU    =    "\x1B[34m";
const    MAG    =    "\x1B[35m";
const    CYN    =    "\x1B[36m";
const    WHT    =    "\x1B[97m";
const    GRAY   =    "\e[90m";
const    RESET  =    "\x1B[0m";
const    BRED   =    "\e[41m";
const    BGRN   =    "\e[42m";
const    BYEL   =    "\e[43m";
const    BBLU   =    "\e[44m";
const    MGRAY  =    "\e[92m";
const    DEL    =    "\x1B[2D";
const    BOLD   =    "\x1B[1m";
const    LINE   =    "\x1B[4m";
/* not supported on some terminals */
const    BL     =    "\e[5mBlink";
const    HIDE   =    "\x1B[8m";
const    INV    =    "\x1B[7m";
const    ITAL   =    "\x1B[3m";


class Iface 
{
    /**
     * net Object of Net_IPv4; 
     * 
     * @var mixed
     * @access public
     */
    public $net;
    /**
     * options 
     * 
     * @var array
     * @access public
     */
    public $options = array();
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->net = new Net_IPv4; 
    }

    /**
     * banner 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function banner()
    {
        system("clear");
        print(RED."@@@ @@@@@@@   @@@@@@@  @@@@@@\n"); 
        print("@@! @@!  @@@ !@@      !@@     \n");
        print("!!@ @!@@!@!  !@!       !@@!!  \n");
        print("!!: !!:      :!!          !:! \n");
        print(":    :        :: :: : ::.: :  \n");
        print(BOLD.BRED.LINE.WHT."  ###    framework    ###   \n".RESET);
    }

    /**
     * getIP Gets ip range from user input.
     * 
     * @static
     * @access public
     * @return string $ip_range.
     */
    public static function getIP()
    {
        $ip_range = null;
        print(BOLD.RED."Enter ip range\n".RESET);
        fscanf(STDIN, "%s\n", $ip_range);
        
        for ($i = 0; $i < strlen($ip_range); $i++) {
            if (!ctype_digit($ip_range[$i]) && ($ip_range[$i] !== trim('.')) && ($ip_range[$i] !== trim('/'))) {
                    die("There was no ip\n");
            }
        }
          
        return $ip_range;
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


}

$iface = new Iface();
var_dump($iface->options);

Iface::banner();
$ip = Iface::getIP();
var_dump($ip);
$ip = Iface::validateIP(:wq$ip);
var_dump($ip);
