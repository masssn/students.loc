<?php require_once 'parts/header.php'; ?>
<script src="/app/scripts/search.js"></script>
        <form method="get" action="http://students.local/search/">
            <input type="text" name="search">
            <input type="submit" value="поиск">
        </form>
        <p><a href="/index/">Главная страница</a></p>
        <p><a href="/private/">Личный кабинет</a></p>
        <table>
            <tr>
                <td>Имя</td>
                <td>Фамилия</td>
                <td>Группа</td>
                <td>Суммарный балл</td>
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
        <a href="/search/?search=<?php echo $this->search; ?>&amp;page=<?php echo $i;?>">[<?php echo $i?>]</a>
        <?php endfor; ?>
<?php require_once 'parts/footer.php'; ?>
