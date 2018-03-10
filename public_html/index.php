<?php

// スレッド一覧

require_once(__DIR__ . '/../config/config.php');


$app = new MyApp\Controller\Index();

$app->run();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>スレッド一覧<span class="fs12">(<?= count($app->getValues()->threads); ?>)</span></h1>
    <ul>
      <?php foreach ($app->getValues()->threads as $thread) : ?>
        <li><a href="thread.php?id=<?= h($thread->id); ?>"><?= h($thread->title); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <h1>スレッド作成</h1>
    <form action="" method="post" id="post">
      <p>
        <input type="text" name="title" placeholder="タイトル" size="80">
      </p>
      <p>
        <textarea type="text" name="overview" placeholder="概要" rows="8" cols="80"></textarea>
      </p>
      <div class="btn" onclick="document.getElementById('post').submit();">スレッド作成</div>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</body>
</html>
