<?php
/*
 * \brief Example to wake a specific device on LAN
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 20 February 2017
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2017 Quentin Comte-Gaz
 * \version 1.0
 */
?>

<?php

require_once __DIR__.'/../../utils/wakeOnLan.php';

$macAddress = '01:02:03:04:05:06';
$broadcastIp = '192.168.1.255';
$port = 7;

if (wakeOnLan($macAddress, $broadcastIp, $port))
{
  echo("'{$macAddress}' is waking up!\n");
}
else
{
  echo("Coud not contact '{$macAddress}' (with broadcast ip '{$broadcastIp}' and port '{$port}').\n");
}

?>
