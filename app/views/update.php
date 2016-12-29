<?php require_once 'parts/header.php'; ?>
<p><a href="/index/">Главная страница</a></p>
        <p><a href="/private/">Личный кабинет</a></p>
        <p>Вы можете отредактировать ваши данные:</p>
        <form method="post" action="/update">
            <?php foreach ($this->atributes as $student) : ?>
                <p> Имя <input type="text" name="name" value="<?php echo $student['name'] ?>" required> </p>
                <p> Фамилия <input type="text" name="secondName" value="<?php echo $student['second_name'] ?>" required> </p>
                <p> Пол <select name="gender" required>
                        <?php if (!empty($student['gender'])) : ?>
                            <option selected="<?php echo $student['gender']; ?>"><?php echo $student['gender'] ?></option>
                        <?php endif; ?>

                        <option value="Мужской">Мужской</option>
                        <option value="Женский">Женский</option>
                    </select>
                </p>
                <p> Номер вашей группы <input type="text" name="groupNumber" value="<?php echo $student['group_number'] ?>" required pattern="^[ 0-9]+$"> </p>
                <p> Год рождения <input type="text" name="birthYear" value="<?php echo $student['birth_year'] ?>" required> </p>
                <p> Сумарный бал <input type="text" name="sumary" value="<?php echo $student['summary'] ?>" required> </p>
                <p> Электронный адрес <input type="email" name="email" value="<?php echo $student['email'] ?>" required> </p>
                <p> Вы местный? <select name="local" selected="<?php echo $student['local'] ?>" required>
                        <?php if (!empty($student['local'])) : ?>
                            <option selected="<?php echo $student['local']; ?>"><?php echo $student['local'] ?></option>
                        <?php endif; ?>
                        <option value="да">Да</option>
                        <option value="нет">Нет</option>
                    </select>
                    <input type="submit" value="Изменить даннные">
                <?php endforeach; ?>
        </form>
<?php require_once 'parts/footer.php'; ?>
