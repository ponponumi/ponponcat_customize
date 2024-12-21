<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php the_title() ?></h1>
    <div><?php the_content() ?></div>
    <p>設定名: <?php setting_get_test() ?></p>
</body>
</html>
