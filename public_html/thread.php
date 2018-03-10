<?php

// スレッド一覧

require_once(__DIR__ . '/../config/config.php');


$app = new MyApp\Controller\Thread();

$app->run($_GET['id']);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Thread</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <a href="/index.php">ホームに戻る</a>
    <h1>タイトル：<?= h($app->getValues()->thread->title); ?></h1>
    <h1>説明：<?= h($app->getValues()->thread->overview); ?></h1>
    <h1>作成者ID：<?= h($app->getValues()->thread->user_id); ?></h1>
    <?php if($app->getValues()->thread->user_id == $app->me()->id) : ?>
      <div class="edit">
        <a href="editthread.php?id=<?= h($app->getValues()->thread->id); ?>">スレッド編集</a>
        <a href="deletethread.php?id=<?= h($app->getValues()->thread->id); ?>">スレッド削除</a>
      </div>
    <?php endif; ?>
    <h1>コメント一覧</h1>
    <div>
      <?php foreach ($app->getValues()->comments as $comment) : ?>
        <div class="comments">
          <?= h($comment->created_at); ?>
          <h4><?= h($comment->content); ?></h4>
          <?php if($app->me()->id == $comment->user_id) : ?>
            <div class="edit">
              <a href="editcomment.php?id=<?= h($comment->id); ?>">編集</a>
              <a href="deletecomment.php?id=<?= h($comment->id); ?>">削除</a>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <form action="" method="post" id="comment">
      <p>
        <textarea type="text" name="content" placeholder="コメント" rows="5" cols="60"></textarea>
      </p>
      <div class="btn" onclick="document.getElementById('comment').submit();">コメント投稿</div>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</body>
</html>
