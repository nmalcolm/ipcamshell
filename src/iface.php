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
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        // it will be static method's class
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
     * mainMenu 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function mainMenu()
    {
        $art = <<<ART
@@@ @@@@@@@   @@@@@@@  @@@@@@
   @@! @@!  @@@ !@@      !@@     
 !!@ @!@@!@!  !@!       !@@!!  
 !!: !!:      :!!          !:! 
 ::: :::       :: :: : ::.: :  
  ###    framework    ###   
ART;
//        $art = print(Iface::banner());
        $itemCallable = function (CliMenu $menu) {
                echo $menu->getSelectedItem()->getText();
        };

        $get_ip = function (CliMenu $menu) {
                $range = self::getIP();
                print($range);
                return $range;
        };

         $menu = (new CliMenuBuilder)
            ->addAsciiArt($art)
            ->setTitle('IPCamShell_Framework')
            ->addLineBreak()
            ->addStaticItem('Prepare and scan')
            ->addStaticItem('---------')
            ->addItem('Set IP diapason', $get_ip)
            ->addItem('Scan IP diapason for vuln cams', $itemCallable)
            ->addItem('Third Item', $itemCallable)
            ->addLineBreak()
            ->addStaticItem('Section 2')
            ->addStaticItem('---------')
            ->addItem('Fourth Item', $itemCallable)
            ->addItem('Fifth Item', $itemCallable)
            ->addItem('Sixth Item', $itemCallable)
            ->addLineBreak()
            ->addStaticItem('Section 3')
            ->addStaticItem('---------')
            ->addItem('Seventh Item', $itemCallable)
            ->addItem('Eighth Item', $itemCallable)
            ->addItem('Ninth Item', $itemCallable)
            ->addLineBreak()
            ->setWidth(70)
            ->setBackgroundColour('black')
            ->setForegroundColour('red')
            ->setPadding(4)
            ->setMargin(4)
            ->setUnselectedMarker(' ')
            ->setSelectedMarker('>')
            ->setTitleSeparator('- ')
            ->build();

        $menu->open();
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

        return $ip_range;
    }

}

//Iface::banner();
Iface::mainMenu();
