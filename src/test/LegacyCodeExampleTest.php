<?php

require_once('/testable/mycode/LegacyCodeExample.php');

class LegacyCodeExampleTest extends \PHPUnit_Framework_TestCase {

  /**
   * @dataProvider providerTestSequential
   */
  public function testTestSequential($start_count, $end_count) {
    $legacy_code = new LegacyCodeExample();

    $dummy_data = array();
    for ($i = 0; $i < $start_count; $i++) {
      $dummy_data[] = 'whatever';
    }

    $this->assertTrue(count($dummy_data) == $start_count, count($dummy_data) . " == $start_count");
    $legacy_code->trimData($dummy_data);
    $this->assertTrue(count($dummy_data) == $end_count, count($dummy_data) . " != $end_count");
  }

  public function providerTestSequential() {
    return array(
      array(20, 5),
      array(10, 5),
      array(3, 3),
      array(0, 0),
    );
  }

}
