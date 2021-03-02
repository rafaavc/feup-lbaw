<?php
  $component = isset($_GET['c']) ? $_GET['c'] : null;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>

    <title><?= is_null($component) ? ":(" : "Viewing: $component" ?></title>

    <style>
      body {
        padding: 0 10rem;
      }

      body > * {
        margin: 1rem 0;
      }
    </style>
  </head>
  <body>
    <?php
      if (is_null($component)) echo "<p style='color: red; margin: 2rem'>You didn't give me a component to render! (GET parameter: c)</p>";
      else include "components/$component.html";
    ?>
  </body>
</html>