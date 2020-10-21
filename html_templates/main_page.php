<?php
/**
 * main_page.php
 * User: Евгений Дронов
 * Date: 13.10.2020
 * Time: 12:38
 * @var string $techname - имя технологии, которую изучаем
 * @var string $button - верстка тестируемой кнопки
 */
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
      <meta charset = "utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/assets/styles/styles.css">
      <title>Изучаю Gulp</title>
  </head>
  <body>
    <div>Итак, начинаем изучать <?= $techname; ?></div>
    <?= $button ?>
    <script src="/assets/scripts/script.js"></script>
  </body>
</html>
