<?php
/*
 * \brief Wake a device on LAN
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 20 February 2017
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2017 Quentin Comte-Gaz
 * \version 1.0
 */
?>

<?php

/*!
 * \brief wakeOnLan Wake up a device which is connected on LAN
 *
 * \param macAddrHexa (str) Mac address on hexadecimal format
 * \param broadcastAddress (str) Broadcast address on hexadecimal format
 * \param port (int, default) Port used to contact the device
 * \param timeout (int, default) Time to wait response from the device
 *
 * \return (bool) Wake up request received by the device
 */
function wakeOnLan($macAddrHexa, $broadcastAddress, $port = 7, $timeout = 2)
{
  $result = false;

  // Check if mac address is valid and get its binary version
  $macAddrHexa = str_replace(':', '', $macAddrHexa);
  if (ctype_xdigit($macAddrHexa) && strlen($macAddrHexa) == 12)
  {
    $macAddressBinary = pack('H12', $macAddrHexa);

    // Create the magic packet to wake up the device on lan
    $magicPacket = str_repeat(chr(0xFF), 6).str_repeat($macAddressBinary, 16);

    // Send the packet if possible to connect with UDP protocol
    $con = fsockopen('udp://'.$broadcastAddress, $port, $errno, $errstr, $timeout)
    if (!$con)
    {
      error_log("Can't open UDP socket '{$errno}': '{$errstr}'");
    }
    else
    {
      if (fputs($con, $magicPacket) >= strlen($magicPacket))
      {
        $result = true;
      }
      else
      {
        error_log("Can't send UDP packet");
      }
      fclose($con);
    }
  }
  else
  {
    error_log("Mac address '{$macAddrHexa}' invalid: Only 0-9 and A-F are allowed (max size of 12 hexadecimal elements)");
  }
  
  return $result;
}

?>
