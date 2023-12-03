<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advent of Code</title>
    <link rel="stylesheet" href="css/styles.css">


</head>
<body>
<header>
    <h1>Advent of Code</h1>
    <p>Welcome to the Code Adventure!</p>
</header>

<nav>
    <ul class="file-list">
        <?php
        function listFolder($directorio) {
            $content = scandir($directorio);

            echo '<ul>';
            foreach ($content as $item) {
                if ($item != '.' && $item != '..') {
                    $fullPath = $directorio . '/' . $item;
                    echo '<li>';
                    if (is_dir($fullPath)) {
                        echo '<strong>' . $item . '</strong>';
                        listFolder($fullPath);
                    } else {
                        echo '<a href="' . $fullPath . '">' . $item . '</a>';
                    }
                    echo '</li>';
                }
            }
            echo '</ul>';
        }

        $path = '../src';

        listFolder($path);
        ?>
    </ul>
</nav>
</body>
</html>
