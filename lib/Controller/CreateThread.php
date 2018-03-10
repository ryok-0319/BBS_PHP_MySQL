<?php

namespace MyApp\Controller;

class CreateThread extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    // validate
    try {
      $this->_validate();
    } catch (\MyApp\Exception\InvalidTitle $e) {
      $this->setErrors('title', $e->getMessage());
    } catch (\MyApp\Exception\InvalidOverview $e) {
      $this->setErrors('overview', $e->getMessage());
    }

    if ($this->hasError()) {
      return;
    } else {
      // create thread
      $postModel = new \MyApp\Model\Post();
      $postModel->create([
        'title' => $_POST['title'],
        'overview' => $_POST['overview']
      ]);
    }

    // redirect to home
    header('Location: ' . SITE_URL);
    exit;
  }

  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit;
    }

    if (!isset($_POST['title']) || !isset($_POST['overview'])) {
      echo "Invalid Form!";
      exit;
    }

    if ($_POST['title'] === '' || $_POST['overview'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }

  }

}
