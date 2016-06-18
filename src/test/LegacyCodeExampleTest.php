<?php

require_once('/testable/mycode/LegacyCodeExample.php');
require_once('/testable/mycode/mock/LegacyCodeExampleMock.php');

class LegacyCodeExampleTest extends \PHPUnit_Framework_TestCase {

  /**
   * @dataProvider providerTestSequential
   */
  public function testTestSequential($start_count, $end_count, $message) {
    $legacy_code = new LegacyCodeExampleMock();

    $dummy_data = array();
    for ($i = 0; $i < $start_count; $i++) {
      $dummy_data[] = 'whatever';
    }

    $this->assertTrue(count($dummy_data) == $start_count, count($dummy_data) . " == $start_count");
    $legacy_code->trimData($dummy_data);
    $this->assertTrue(count($dummy_data) == $end_count, count($dummy_data) . " != $end_count");

    $last_message = $legacy_code->getLastMessage();
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

}
