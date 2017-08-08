<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Net_Nmap Example
 *
 * PHP version 5
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330,Boston,MA 02111-1307 USA
 *
 * @author    Luca Corbo <lucor@ortro.net>
 * @copyright 2008 Luca Corbo
 * @license   GNU/LGPL v2.1
 * @link      http://www.ortro.net
 */

/**
 * Scan network to retrieve hosts and services information.
 */

require_once 'Net/Nmap.php';

//Define the target to scan
$target = array('192.168.0.1');

$options = array('output_file' => __DIR__.'/testNmap.xml',
                 'nmap_binary' => '/usr/bin/nmap');

try {
    $nmap = new Net_Nmap($options);
    
    //Enable nmap options
    $nmap_options = array('os_detection' => true,
                          'service_info' => true,
                          'port_ranges' => 'U:53,111,137,T:21-25,80,139,8080',
                          //'all_options' => true
                          );
                          
    $nmap->enableOptions($nmap_options);
    
    //Scan target
    $res = $nmap->scan($target);
    
    //Get failed hosts 
    $failed_to_resolve = $nmap->getFailedToResolveHosts();
    
    if (count($failed_to_resolve) > 0) {
        echo 'Failed to resolve given hostname/IP: ' .  
             implode (', ', $failed_to_resolve) . 
             "\n";
    }
    
    //Parse XML Output to retrieve Hosts Object
    $hosts = $nmap->parseXMLOutput();

    //Print results
    foreach ($hosts as $key => $host) {
        echo 'Hostname: ' . $host->getHostname() . "\n";
        echo 'Address: ' . $host->getAddress() . "\n";
        echo 'OS: ' . $host->getOS() . "\n";
        echo 'Status: ' . $host->getStatus . "\n";
        $services = $host->getServices();
        echo 'Number of discovered services: ' . count($services) . "\n";
        foreach ($services as $key => $service) {
            echo "\n";
            echo 'Service Name: ' . $service->name . "\n";
            echo 'Port: ' . $service->port . "\n";
            echo 'Protocol: ' . $service->protocol . "\n";
            echo 'Product information: ' . $service->product . "\n";
            echo 'Product version: ' . $service->version . "\n";
            echo 'Product additional info: ' . $service->extrainfo . "\n";
        }
    }
} catch (Net_Nmap_Exception $ne) {
    echo $ne->getMessage();
}
?>
