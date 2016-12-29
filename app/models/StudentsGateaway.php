<?php

namespace app\models;

/**
 * Класс для таблицы students, реализующий(ну по крайней мере как я его понимаю)
 * паттерн TableDataGateaway
 */
class StudentsGateaway
{

    public $dbh;

    public function __construct()
    {
        $db = new \app\DB();
        $this->dbh = $db->conect();
    }

    /*
     * простейшая генерация пароля, ничего сложнее я придумать не могу
     */

    protected function generatePassword()
    {
        $string = "qwertyuiopasdfghjklzxcvbnm0123456789";
        $pass;
        $count = mb_strlen($string);
        for ($i = 0; $i < 8; $i++) {
            $char = mb_substr($string, rand(0, $count), 1);
            $pass .= $char;
        }
        return $pass;
    }

    /*
     * добавляет новую запись в таблицу.
     */

    public function addStudent($params)
    {
        //генерация пароля
        $params["password"] = $this->generatePassword();
        //подставляет в масив placeholders значения ячеек из params
        $placeholders = [];
        foreach ($params as $v) {
            $placeholders[] = $v;
        }
        $query = 'INSERT INTO 
                 students(name, second_name, gender, group_number, 
                 birth_year, summary, email, local, password)
                 VALUES
                 (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($placeholders);
        setcookie('user_pass', $params["password"], time() + 3600000);
    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }

//возвращает запись из таблицы по паролю
    public function getByPassword($password)
    {
        $sql = "SELECT 
                name, second_name, group_number, summary, gender, birth_year, email, local
                FROM 
                students WHERE password = :x";
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':x', $password);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

//возвращает все записи из таблицы с сортировкой и лимитом
    public function getAll($sort, $start, $limit)
    {
        $sql = "SELECT 
                name, second_name, group_number, summary
                FROM 
                students
                ORDER BY " . $sort . " LIMIT " . $start . "," . $limit;
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':x', $sort);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /* поиск, так и не довел до ума. Конструкции типа LIKE: WHERE x LIKE '%hello% 
     * у меня не работают 
     * */

    public function search($search, $sort, $start, $limit)
    {

        $sql = "SELECT
                name, second_name, group_number, summary
                FROM 
                students
                WHERE 
                :x IN(name, second_name, group_number, summary) 
                ORDER BY " . $sort . " LIMIT " . $start . "," . $limit;
        ;
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':x', $search);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

//обновляет данные в таблице по паролю
    public function update($password, $params)
    {
        $placeholders = [];
        foreach ($params as $v) {
            $placeholders[] = $v;
        }
        $sql = "UPDATE 
               students
               SET 
               name=?,second_name=?, gender = ?, group_number = ?, 
               birth_year = ?, summary = ?, email = ?, local = ?
               WHERE 
               password = '{$password}'";
        $sth = $this->dbh->prepare($sql);
        $sth->execute($placeholders);
    }

    public function getCount()
    {
        $sql = "SELECT COUNT(*) FROM students";
        $stmt = $this->dbh->query($sql);
        return $stmt->fetchColumn();
    }

    public function getCountBySearch($search)
    {
        if (empty($search))
            return 0;
        $sql = "SELECT COUNT(*) FROM 
                students 
                WHERE 
                " . $search . "
                IN
                (name, second_name, group_number, summary)";
        $stmt = $this->dbh->query($sql);
        return $stmt->fetchColumn();
    }

}
