<?php require_once 'parts/header.php'; ?>
        <p>Для регистрации заполните все поля:</p>
        <?php if (!empty($this->errors)): ?>
            <?php foreach ($this->errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <form name="name" method="post" action="index.php" >
            <p> Имя <input type="text" name="name" required> </p>
            <p> Фамилия <input type="text" name="second_name" required> </p>
            <p> Пол <select name="gender" required>
                    <option value="Мужской">Мужской</option>
                    <option value="Женский">Женский</option>
                </select>
            </p>
            <p> Номер вашей группы <input type="text" name="group_number" required > </p>
            <p> Год рождения <input type="text" name="birth_year" required pattern="^[ 0-9]+$"> </p>
            <p> Сумарный бал <input type="text" name="sumary" required pattern="^[ 0-9]+$"> </p>
            <p> Электронный адрес <input type="email" name="email" required> </p>
            <p> Вы местный? <select name="local" required>
                    <option value="Да">Да</option>
                    <option value="Нет">Нет</option>
                </select>
                <input type="submit" value="Зарегистрироваться">
        </form>
<?php require_once 'parts/footer.php'; ?>