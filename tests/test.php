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
  }
?>
