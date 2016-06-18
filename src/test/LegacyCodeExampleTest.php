<?php

require_once('/testable/mycode/LegacyCodeExample.php');

class LegacyCodeExampleTest extends \PHPUnit_Framework_TestCase {

  /**
   * @dataProvider providerTestSequential
   */
  public function testTestSequential($start_count, $end_count, $message) {
    $legacy_code = $this->getMockBuilder('LegacyCodeExample')
      ->setMethods(array('drupalSetMessage', 't'))
      ->getMock();
    $legacy_code->method('drupalSetMessage')
      ->will($this->returnCallback(array($this, 'drupalSetMessage')));
    $legacy_code->method('t')
      ->will($this->returnCallback(array($this, 't')));

    $dummy_data = array();
    for ($i = 0; $i < $start_count; $i++) {
      $dummy_data[] = 'whatever';
    }

    $this->assertTrue(count($dummy_data) == $start_count, count($dummy_data) . " == $start_count");
    $legacy_code->trimData($dummy_data);
    $this->assertTrue(count($dummy_data) == $end_count, count($dummy_data) . " != $end_count");

    $last_message = $this->getLastMessage();
    $this->assertTrue($last_message == $message, "$last_message == $message");
  }

  public function providerTestSequential() {
    return array(
      array(20, 5, 'There are 20 total repos, here are the first five:'),
      array(10, 5, 'There are 10 total repos, here are the first five:'),
      array(3, 3, 'NO MESSAGE'),
      array(0, 0, 'NO MESSAGE'),
    );
  }

  function drupalSetMessage($message) {
    $this->lastMessage = $message;
  }

  function t($string, $args) {
    // Reproduce t() becasue PHPUnit does not know about it.
    $return = $string;
    foreach ($args as $key => $value) {
      $return = str_replace($key, $value, $return);
    }
    return $return;
  }

  function getLastMessage() {
    return isset($this->lastMessage) ? $this->lastMessage : 'NO MESSAGE';
  }

}
