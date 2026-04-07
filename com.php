<?php
  require_once "init.php";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $text = trim($_POST['text']);

  if (empty($name) || empty($text)) {
    echo 'Вы должны ввести все значения в таблицах!';
  }
  else {
    try {
      $query = $pdo->prepare('INSERT INTO special(name, `text`) VALUES (?, ?)');
      $query->execute([$name, $text]);
      header("Location: com.php");
      exit;
    }
    catch (PDOException $e) {
      die('Error: ' . $e->getMessage());
    }
  }
}

try {
  $query = $pdo->prepare('SELECT * FROM special ORDER BY tim DESC');
  $query->execute();
  $c = $query->fetchAll(PDO::FETCH_OBJ);
}
catch (PDOException $e) {
  die('Error: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Музей А.C. Пушкина: лицей N9</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <header>
      <div class="img-class">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Pushkin_140-190_for_collage.jpg/500px-Pushkin_140-190_for_collage.jpg" class="img">
        <h1>Музей А.C. Пушкина: лицей N9</h1>
        <button command="show-modal" commandfor="plan">Посмотреть план сайта</button>
        <dialog id="plan" class="text">
          <h3>План сайта</h3>
          <a href="lit.html">Главная страница</a><br>
          <a href="bot1.html">Бот</a><br>
          
          <a href="com.php">Коментарии к музею</a><br>
        </dialog>
      </div>
    </header>
    <div class="text">
      <form action="com.php" method="POST" class="container">
        <label>Введите своё имя</label><br><br>
        <input type="text" name="name"><br><br>
        <label>Введите    текст</label><br><br>
        <input type="text" name="text"><br><br>
        <button>Ввести</button>
      </form>
      <?php
        foreach ($c as $b) {
          $time = date('d.m.Y H:i', strtotime($b->tim));
          echo '
                        <div class="container">
                            <h3>Пользователь: '.htmlspecialchars($b->name).'</h3>
                            <p>'.htmlspecialchars($b->text).'</p>
                            <p>'.$time.'</p>
                        </div>
                        ';
        }
      ?>
    </div>
  </body>
</html>
