<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller {

  public function run() {
    // ログインしてなければログインさせる
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    // スレッド一覧を取得
    $threadModel = new \MyApp\Model\Post();
    $this->setValues('threads', $threadModel->findAll());

    // POST がきたらスレッド作成
    if ($_SERVER['REQUEST_METHOD'] === POST) {
      $this->createThread();
    }
  }

  // スレッド作成
  protected function createThread($values){
    try {
      $threadModel = new \MyApp\Model\Post();
      $threadModel->create([
        'user_id' => ((int)$this->me()->id),
        'title' => $_POST['title'],
        'overview' => $_POST['overview']
      ]);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return;
    }

    // ホームに戻る
    header('Location: ' . SITE_URL);
    exit;
  }

}
