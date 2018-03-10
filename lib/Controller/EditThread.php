<?php

namespace MyApp\Controller;

class EditThread extends \MyApp\Controller {

  public function run($id) {
    // ログインしてなければログインさせる
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    // スレッドの情報を取得
    $threadModel = new \MyApp\Model\Post();
    $this->setValues('thread', $threadModel->findThread($id));

    // スレッド作成者ではない場合
    if($this->getValues()->thread->user_id !== $this->me()->id){
      echo "編集はスレッド作成者のみです";
      exit;
    }

    // POSTが来たらスレッドを編集
    if ($_SERVER['REQUEST_METHOD'] === POST) {
      $this->editThread($id);
    }
  }

  // スレッド編集
  protected function editThread($thread_id){
    try {
      $title = $_POST['title'];
      $overview = $_POST['overview'];
      $threadModel = new \MyApp\Model\Post();
      $threadModel->edit($title, $overview, $thread_id);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return;
    }

    // redirect to the thread
    header('Location: ' . SITE_URL . '/thread.php?id=' . $thread_id);
    exit;
  }

}
