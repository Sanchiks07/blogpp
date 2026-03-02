<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1><?= htmlspecialchars($post->content) ?></h1>

    <a class="edit" href="edit?id=<?= $post->id ?>">Rediģēt</a>

    <form method="POST" action="/destroy">
        <input name="id" value="<?= $post->id ?>" type="hidden" />
        <button class="delete" onClick="return (Vai tu esi drošš, ka vēlies idzēst šo ierakstu?)">Dzēst</button>
    </form>
</body>
</html>