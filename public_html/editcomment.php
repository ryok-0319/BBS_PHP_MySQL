<?php

// スレッド編集

require_once(__DIR__ . '/../config/config.php');


$app = new MyApp\Controller\EditComment();

$app->run($_GET['id']);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Edit Comment</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <a href="/index.php">ホームに戻る</a>
    <h1>コメント編集</h1>
    <form action="" method="post" id="editcomment">
      <p>
        <textarea type="text" name="content" placeholder="コメント" rows="5" cols="60"><?= isset($app->getValues()->comment->content) ? h($app->getValues()->comment->content) : ''; ?></textarea>
      </p>
      <div class="btn" onclick="document.getElementById('editcomment').submit();">編集完了</div>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</body>
</html>
