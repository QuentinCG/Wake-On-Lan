<?php
  require __DIR__ .'/../vendor/autoload.php';
  require __DIR__ .'/../utils/wakeOnLan.php';

  class Test extends PHPUnit_Framework_TestCase
  {
    public function testSuccess()
    {
      $macAddress = '01:02:03:04:05:06';
      $broadcastIp = '192.168.1.255';
      $port = 7;

      $this->assertTrue(wakeOnLan($macAddress, $broadcastIp));
      $this->assertTrue(wakeOnLan($macAddress, $broadcastIp, $port));
    }

    public function testFailInvalidMacAddress()
    {
      $macAddress = 'IN:VA:LI:DM:AC:AD';
      $broadcastIp = '192.168.1.255';
      $port = 7;

      $this->assertFalse(wakeOnLan($macAddress, $broadcastIp));
      $this->assertFalse(wakeOnLan($macAddress, $broadcastIp, $port));
    }

    public function testFailInvalidBroadcastIp()
    {
      $macAddress = '01:02:03:04:05:06';
      $broadcastIp = '%!*=)°].INVALID-BROADCAST-IP...';
      $port = 7;

      $this->assertFalse(wakeOnLan($macAddress, $broadcastIp));
      $this->assertFalse(wakeOnLan($macAddress, $broadcastIp, $port));
    }
  }
?>
