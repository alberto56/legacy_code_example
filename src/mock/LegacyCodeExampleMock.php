<?php

class LegacyCodeExampleMock extends LegacyCodeExample {

  function drupalSetMessage($message) {
    $this->lastMessage = $message;
  }

  function t($string, $args) {
    // We are using an installation of phpunit that does not know Drupal at
    // all, just return a string here.
    return $string . ' ' . serialize($args);
  }

  function getLastMessage() {
    return isset($this->lastMessage) ? $this->lastMessage : 'NO MESSAGE';
  }

}
