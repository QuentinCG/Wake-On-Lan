<?php
/*
 * \brief Example to wake a device on LAN (graphical tool)
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 21 February 2017
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2017 Quentin Comte-Gaz
 * \version 1.0
 */
?>

<?php

require_once __DIR__.'/../../utils/wakeOnLan.php';

// Wake on LAN if already requested
if (isset($_GET['macAddress']) && isset($_GET['broadcastIp']) && isset($_GET['port']))
{
  $macAddress = htmlentities($_GET['macAddress']);
  $broadcastIp = htmlentities($_GET['broadcastIp']);
  $port = htmlentities($_GET['port']);

  if (wakeOnLan($macAddress, $broadcastIp, $port))
  {
    echo("'{$macAddress}' is waking up!");
  }
  else
  {
    echo("Coud not contact '{$macAddress}' (with broadcast ip '{$broadcastIp}' and port '{$port}').");
  }
}
// Show everything to request a wake on LAN
else
{

?>

<p>Wake device on LAN:</p>
<form name="form" action="index.php" method="get">
  <table summary="" border="0">
    <tbody>
      <tr>
        <td>
          Mac address
        </td>
        <td>
          <input name="macAddress" id="macAddress" type="text" value="74:D0:2B:C2:E8:F4" />
        </td>
      </tr>
      <tr>
        <td>
          Broadcast IP
        </td>
        <td>
          <input name="broadcastIp" id="broadcastIp" type="text" value="192.168.1.255" />
        </td>
      </tr>
      <tr>
        <td>
          Port
        </td>
        <td>
          <input name="port" id="port" type="text" value="7" />
        </td>
      </tr>
    </tbody>
  </table>
  <input type="submit" value="Submit" />
</form>

<?php

}

?>
