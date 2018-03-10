<?php

// 新規登録

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Post();

$app->run();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="" method="post" id="post">
      <p>
        <input type="text" name="title" placeholder="タイトル">
      </p>
      <p>
        <input type="text" name="overview" placeholder="概要">
      </p>
      <div class="btn" onclick="document.getElementById('post').submit();">スレッド作成</div>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</body>
</html>
