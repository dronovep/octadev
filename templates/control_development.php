<?php
/**
 * Шаблон страницы разработки контрола
 * User: Евгений Дронов
 * Date: 13.10.2020
 * Time: 13:21
 * @var string $control - верстка разрабатываемого контрола
 */
?>
<!DOCTYPE html>
<html lang="ru" class="control_development">
  <head>
      <title>Разработка контрола</title>
      <link rel="stylesheet" href="/assets/styles/index.css" />
  </head>
  <body>
    <div class="control">
        <?= $control ?>
    </div>
    <script src="/assets/scripts/script.js"></script>
  </body>
</html>
