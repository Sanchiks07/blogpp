<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi ieraksti</title>
</head>
<body>
    <h1>Visi bloga ieraksti</h1>

    <p><a href="/create">Pievienot jaunu ierakstu</a></p>

    <ul>
        <?php foreach ($posts as $post) { ?>
            <li><a href="show?id=<?= $post->id ?>"> <?= htmlspecialchars($post->content) ?> </a></li>
        <?php } ?>
    </ul>
</body>
</html>