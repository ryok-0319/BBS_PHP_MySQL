<?php

namespace MyApp\Controller;

class Thread extends \MyApp\Controller {

  public function run($id) {
    // ログインしてなければログインさせる
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    // スレッドの情報を取得
    $threadModel = new \MyApp\Model\Post();
    $this->setValues('thread', $threadModel->findThread($id));


    // コメント一覧を取得
    $commentModel = new \MyApp\Model\Comment();
    $this->setValues('comments', $commentModel->findAll($id));

    // POSTが来たらコメントを作成
    if ($_SERVER['REQUEST_METHOD'] === POST) {
      $this->createComment($id);
    }
  }

  // コメント作成
  protected function createComment($thread_id){
    try {
      $user_id = ((int)$this->me()->id);
      $content = $_POST['content'];
      $commentModel = new \MyApp\Model\Comment();
      $commentModel->create($user_id, $content, $thread_id);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return;
    }

    // redirect to home
    header('Location: ' . SITE_URL . '/thread.php?id=' . $thread_id);
    exit;
  }

}
