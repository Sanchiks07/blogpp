<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Rediģē savu ierakstu</h1>

    <form action="/update" method="POST">
        <input type="hidden" name="id" value="<?= $post->id ?>" />

        <label>
            <textarea class="ieraksts" name="content"><?= htmlspecialchars($post->content ?? "") ?></textarea><br>
        </label>

        <button type="submit">Saglabāt</button>

        <?php if(isset($errors["content"])) { ?>
            <p class="error"><?= $errors["content"] ?></p>
        <?php } ?>
    </form>
</body>
</html>