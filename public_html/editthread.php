<?php

// スレッド編集

require_once(__DIR__ . '/../config/config.php');


$app = new MyApp\Controller\EditThread();

$app->run($_GET['id']);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Edit Thread</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <a href="/index.php">ホームに戻る</a>
    <h1>スレッド編集</h1>
    <form action="" method="post" id="editthread">
      <p>
        <input type="text" name="title" placeholder="タイトル" size="80" value="<?= isset($app->getValues()->thread->title) ? h($app->getValues()->thread->title) : ''; ?>">
      </p>
      <p>
        <textarea type="text" name="overview" placeholder="概要" rows="8" cols="80"><?= isset($app->getValues()->thread->overview) ? h($app->getValues()->thread->overview) : ''; ?></textarea>
      </p>
      <div class="btn" onclick="document.getElementById('editthread').submit();">編集完了</div>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</body>
</html>
