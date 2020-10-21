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
      <meta charset = "utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/assets/styles/styles.css">
      <title>Разработка контрола</title>
  </head>
  <body>
    <div class="control">
        <?= $control ?>
    </div>
    <script src="/assets/scripts/script.js"></script>
  </body>
</html>
