<?php

namespace MyApp\Controller;

class EditComment extends \MyApp\Controller {

  public function run($id) {
    // ログインしてなければログインさせる
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    // コメントの情報を取得
    $commentModel = new \MyApp\Model\Comment();
    $this->setValues('comment', $commentModel->findComment($id));

    // コメント作成者ではない場合
    if($this->getValues()->comment->user_id !== $this->me()->id){
      echo "編集はコメント作成者のみです";
      exit;
    }

    // POSTが来たらコメントを編集
    if ($_SERVER['REQUEST_METHOD'] === POST) {
      $this->editComment($id);
    }
  }

  // コメント編集
  protected function editComment($comment_id){
    try {
      $content = $_POST['content'];
      $commentModel = new \MyApp\Model\Comment();
      $commentModel->edit($content, $comment_id);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return;
    }

    // redirect to the thread
    header('Location: ' . SITE_URL . '/thread.php?id=' . $this->getValues()->comment->thread_id);
    exit;
  }

}
