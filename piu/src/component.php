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
    
    <!-- Component CSS -->
    <link href="components/<?= $component ?>.css" rel="stylesheet">


    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">


    <title><?= is_null($component) ? ":(" : "Viewing: $component" ?></title>
</head>
<body>
    <?php if (is_null($component)) { ?>
        <div class="alert alert-danger" role="alert" style="margin: 2rem;">
            You didn't give me a component to render! Choose one:
        </div>

        <form style='margin: 2rem'>
            <div class="input-group mb-3" style="max-width: 25rem;">
                <select name="c" id="c" class="form-select" aria-label="Default select example">
                    <?php
                        $files = scandir("components");
                        foreach ($files as $key => $value) {
                            if (preg_match("/(.*).php$/", $value, $match)) { ?>
                                <option value="<?=$match[1]?>"><?=$match[1]?></option>
                    <?php }
                        } ?>
                </select>
                <button type="submit" class="btn btn-dark">Go!</button>
            </div>
        </form>
        
    <?php } else {
        include "components/$component.php";
    } ?>
</body>

</html>
