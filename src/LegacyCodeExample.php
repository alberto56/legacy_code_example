<?php

class LegacyCodeExample {

  function result() {
    global $user;
    $nid = arg(1);
    $node = node_load($nid);

    if (in_array($nid, array(5, 16, 93, 11))) {
      // certain special nodes do not have repos, redirect to the main node page.
      if (node_access('view', $node, $user)) {
        drupal_set_message('The repos for the requested node are not available.');
        drupal_goto('node/' . $nid);
      }
      else {
        return 'Sorry, you do not have access to this repo!';
      }
    }

    if (!node_access('view', $node, $user)) {
      $user_roles = user_roles($user);

      if (in_array('authenticated user', $user_roles)) {
        drupal_set_message('Please ask your account manager for access to this resource.');
      }

      return 'Sorry, you do not have access to this repo!';
    }

    $response = drupal_http_request('https://api.github.com/users/' . $node->title . '/repos');

    if ($response->code == 200) {
      $data = drupal_json_decode($response->data);
      $this->trimData($data);

      if ($data[0]['name'] == 'HelloWorld') {
        return 'No GitHub repo(s) available for ' . $node->title;
      }
      else {
        $return = '<h1>' . $node->title . ' has ' . count($data) . ' repo(s)</h1>';
        foreach ($data as $repo) {
          $return .= '<h2>' . $repo['full_name'] . '</h2>';
          $return .= '<p><a href="' . $repo['html_url'] . '">' . $repo['full_name'] . '</a>: ' . $repo['description'] . '</p>';
        }
        return $return;
      }
    }
    else {
      return 'Repo list not available for now; please check later.';
    }
  }

  function trimData(&$data) {
    if (count($data) > 5) {
      $this->drupalSetMessage($this->t('There are @count total repos, here are the first five:', array('@count' => count($data))));
      $data = array_splice($data, count($data) - 5);
    }
  }

  function drupalSetMessage($message) {
    return drupal_set_message($message);
  }

  function t($string, $args) {
    return t($string, $args);
  }

}
