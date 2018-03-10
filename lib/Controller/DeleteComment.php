<?php

namespace MyApp\Controller;

class DeleteComment extends \MyApp\Controller {

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

    // POSTが来たらコメントを削除
    if ($_SERVER['REQUEST_METHOD'] === POST) {
      switch ($_POST["sub1"]) {
        case 'はい':
          $this->deleteComment($id);
          break;

        default:
          header('Location: ' . SITE_URL . '/thread.php?id=' . $this->getValues()->comment->thread_id);
          break;
      }
    }
  }

  // コメント削除
  protected function deleteComment($comment_id){
    try {
      $commentModel = new \MyApp\Model\Comment();
      $commentModel->delete($comment_id);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return;
    }

    // redirect to home
    header('Location: ' . SITE_URL . '/thread.php?id=' . $this->getValues()->comment->thread_id);
    exit;
  }

}
