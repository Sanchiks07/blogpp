<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jauns ieraksts</title>
</head>
<body>
    <h1>Izveido jaunu ierakstu</h1>

    <form method="POST" action="/store">
        <label>
            <textarea class="ieraksts" name="content"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea><br>
        </label>

        <button type="submit">Publicēt</button>

        <?php if(isset($errors["content"])) { ?>
            <p class="error"><?= $errors["content"] ?></p>
        <?php } ?>
    </form>
</body>
</html>