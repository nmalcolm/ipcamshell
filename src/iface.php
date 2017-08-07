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
const    BL     =    "\e[5mBlink"; /* not supported on some terminals */
const    HIDE   =    "\x1B[8m";
const    INV    =    "\x1B[7m";
const    ITAL   =    "\x1B[3m";


class Iface
{

system("clear");
print(RED."@@@ @@@@@@@   @@@@@@@  @@@@@@\n"); 
print("@@! @@!  @@@ !@@      !@@     \n");
print("!!@ @!@@!@!  !@!       !@@!!  \n");
print("!!: !!:      :!!          !:! \n");
print(":    :        :: :: : ::.: :  \n");
print(BOLD.BRED.LINE.WHT."  ###    framework    ###   \n".RESET);
