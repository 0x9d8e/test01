<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <p>
        <form method="get">
            <label>Дата <input name="date" value="<?=$date ?>"></label>
            <input type="submit" value="Искать">
        </form>
    </p>
    <table>
        <tr>
            <td>Позиция</td>
            <td>Фильм</td>
            <td>Год</td>
            <td>Рейтинг</td>
            <td>Голоса</td>
        </tr>
        <?php foreach ($films as $film): ?>
            <tr>
                <td><?=$film->position ?></td>
                <td><?=$film->name ?></td>
                <td><?=$film->year ?></td>
                <td><?=$film->rating ?></td>
                <td><?=$film->votes ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>