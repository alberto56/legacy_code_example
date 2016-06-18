<?php

class LegacyCodeExampleMock extends LegacyCodeExample {

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
