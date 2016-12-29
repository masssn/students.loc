<?php require_once 'parts/header.php'; ?>
        <form method="get" action="/search/">
            <input type="text" name="search">
            <input type="submit" value="поиск">
        </form>
        <p><a href="/index/">Главная страница</a></p>
        <p><a href="/update/">Личный кабинет</a></p>
        <table>
            <tr>
                <td> <a href="/index/?sort=name&page=<?php echo $this->link; ?>">Имя</a></td>
                <td> <a href="/index/?sort=second_name&page=<?php echo $this->link; ?>">Фамилия</a></td>
                <td> <a href="/index/?sort=group_number&page=<?php echo $this->link; ?>">Группа</a></td>
                <td> <a href="/index/?sort=summary&page=<?php echo $this->link; ?>">Сумарный балл</a></td>
            </tr>
            <?php foreach ($this->atributes as $student) : ?>
                <tr>
                    <td> <?php echo htmlspecialchars($student['name']); ?></td>
                    <td> <?php echo htmlspecialchars($student['second_name']); ?></td>
                    <td> <?php echo htmlspecialchars($student['group_number']); ?></td>
                    <td> <?php echo htmlspecialchars($student['summary']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php for($i = 1; $i <= $this->pages; $i++) : ?>
        <a href="/index/?sort=<?php echo $this->sort; ?>&page=<?php echo $i;?>">[<?php echo $i?>]</a>
        <?php endfor; ?>
<?php require_once 'parts/footer.php'; ?>
