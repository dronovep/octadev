<?php
/**
 * markup.php
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 8:15
 */

/** @var string $techname - имя технологии, которую изучаем */
/** @var string $markup - разметка кнопки */
/** @var string $class - класс стилей кнопки */
/** @var string $name - имя, вписываемое в кнопку */
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
      <title>Изучаю Gulp</title>
      <link rel="stylesheet" href="/assets/styles/index.css" />
  </head>
  <body>
    <div>Итак, начинаем изучать <?= $techname; ?></div>
    <?= new Button($markup, $class, $name) ?>
    <script src="/assets/scripts/script.js"></script>
  </body>
</html>
