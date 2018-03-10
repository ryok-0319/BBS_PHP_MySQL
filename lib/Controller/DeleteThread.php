<?php

namespace MyApp\Controller;

class DeleteThread extends \MyApp\Controller {

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

    // POSTが来たらスレッドを削除
    if ($_SERVER['REQUEST_METHOD'] === POST) {
      switch ($_POST["sub1"]) {
        case 'はい':
          $this->deleteThread($id);
          break;

        default:
          header('Location: ' . SITE_URL . '/thread.php?id=' . $this->getValues()->thread->id);
          break;
      }
    }
  }

  // スレッド削除
  protected function deleteThread($thread_id){
    try {
      $threadModel = new \MyApp\Model\Post();
      $threadModel->delete($thread_id);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return;
    }

    // redirect to home
    header('Location: ' . SITE_URL);
    exit;
  }

}
