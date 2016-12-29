<?php

namespace app;

/**
 * Класс для валидации данных и прогонки их через функции для безопасности даннных
 */
class DataHelper
{

    public static function validate($datas)
    {

        $errors = [];
        if (mb_strlen($datas['name']) > 20 || preg_match("^[0-9]^", $datas['name'])) {
            $errors['name'] = 'Вы ввесли слишком длинное имя! Имя должно быть максимум 20 символов без цифр';
        }
        if (mb_strlen($datas['second_name']) > 20 || preg_match("^[0-9]^", $datas['second_name'])) {
            $errors['second_name'] = 'Вы ввели слишком длинную фамилию! Фамилия должна быть максимум 20 символов без цифры!'
            ;
        }
        if (mb_strlen($datas['group_number']) > 5) {
            $errors['group_number'] = 'Неправильный формат группы! Максимум 5 символов, а у вас '
                    . mb_strlen($datas['group_number']);
        }
        if (!filter_var($datas['birth_year'], FILTER_VALIDATE_INT) && mb_strlen($datas['birth_year']) > 5 || mb_strlen($datas['birth_year']) < 4 || preg_match("^[A-z]^", $datas['birth_year'])) {
            $errors['birth_year'] = 'Вы ввели неправильный формат года рождения! Введите полностью ваш год рождения!';
        }
        if (!filter_var($datas['sumary'], FILTER_VALIDATE_INT) && mb_strlen($datas['summary']) > 5 && mb_strlen($datas['summary']) < 4) {
            $errors['birth_year'] = 'Вы ввели неправильный формат вашего балла!';
        }
        if (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Вы введи некоректный электронный адрес!';
        }
        return $errors;
    }

    public static function makeSafeDatas($datas)
    {
        foreach ($datas as $value) {
            $value = trim($value);
            $value = strip_tags($value);
            $value = stripslashes($value);
        }
        return $datas;
    }

}
