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
require_once(__DIR__ . '/iphandle.php');
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
        // 
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
    public static function ifaceGetIpRange()
    {
        $ip = null;
        print(BOLD.RED."Enter ip\n".RESET);
    }

    /**
     * getHelp 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function getHelp()
    {
    }

    /**
     * shell 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function shell()
    {
        $params = array(
            0 => array(
                'param0'    => "Help"
            ),
            1 => array(
                'param1'    => "Set IP range for scan"
            ),
            2 => array(
                'param2'    => "Create new database"
            ),
            3 => array(
                'param3'    => "Search record by field"
            ),
            4 => array(
                'param4'    => "List all records"
            ),
            5 => array(
                'param5'    => "Create new database"
            )
        );

        $param_keys = array_keys($params);
        
        while (1) {
            self::banner();
            for ($i = 0; $i < count($params); $i++) {
                print("{$i}. ".(implode($params[$i]))."\n");
            }
        
            print(WHT."              \n".RESET);
            print(RED."CTRL-C to exit\n".RESET);
            print(WHT.BOLD.LINE."IPCS_Framework/>".RESET);
            $fp = fopen("php://stdin", "r");
            $line = rtrim(fgets($fp, 4096));
            $strlen = strlen($line);
            $numeric = is_numeric($line);
            
            if (($strlen = 1) && ($numeric == true)) {
                switch ($line) {
                
                    case '0':
                    
                        $line = $params[0]["param0"];
                        print($line."\n");
                        self::getHelp();
                        
                        break;
                    
                    case '1':
                    
                        $line = $params[1]["param1"];
                        print($line."\n");
                        $handle = new IpHandle();
                        $ip = $handle->getIpRange();
                        var_dump($ip);
                        $range = $handle->parseRange($ip);
                        var_dump($range);
                        
                        break;
            }
        }
    }
                
}

}

$iface = new Iface();
//var_dump($iface->options);
$iface::shell();
/*
Iface::banner();
$ip = Iface::getIP();
var_dump($ip);
$ip = Iface::validateIP($ip);
var_dump($ip);*/
