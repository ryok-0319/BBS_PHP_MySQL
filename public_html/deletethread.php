<?php

// スレッド削除

require_once(__DIR__ . '/../config/config.php');


$app = new MyApp\Controller\DeleteThread();

$app->run($_GET['id']);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Delete Thread</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <a href="/index.php">ホームに戻る</a>
    <h1>スレッド削除</h1>
    <h2>本当に削除しますか？</h2>
    <form action="" method="post">
      <input type="submit" value="はい" name="sub1">
      <input type="submit" value="いいえ" name="sub1">
    </form>
  </div>
</body>
</html>
