<?php

namespace app\controllers;

/**
 * Controller - главный контроллер. Если есть нет куки пользователя - вызывается
 * метод регистрации
 */
class Controller
{

    protected $view;
    protected $gateaway;

    /**
     * в конструкторе создаются объекти View и StudentsGateaway, которые используются
     *  во всех методах.
     * */
    public function __construct()
    {
        $this->view = new \app\views\View();
        $this->gateaway = new \app\models\StudentsGateaway();
    }

    /**
     * по крайней мере, мне кажется так проще всего реализовать разделение на вызов
     * соответствующих методов.
     */
    public function route()
    {
        $password = strval($_COOKIE['user_pass']);
        if (empty($password)) {
            $this->actionRegister();
        } else {
            $this->action();
        }
    }

    /**
     * разбирается запрос, из него же вычленяется нужный экшен. По другому я
     * не знаю как
     */
    private function action()
    {
        $route = explode('/', $_SERVER['REQUEST_URI']);
        switch ($route[1]) {
            case '' :
                $this->actionIndex();
                break;
            case 'index':
                $this->actionIndex();
                break;
            case 'search':
                $this->actionSearch();
                break;
            case 'update':
                $this->actionUpdate();
                break;
            default :
                $this->error404();
        }
    }

    /**
     * метод для индекса, т.е. заглавной страницы со списком студентов
     */
    private function actionIndex()
    {

        $limit = 5;
        $navDatas = \app\Pager::getNavDatas(5, $this->gateaway->getCount());
        //из get вычленяется строка для сортировки
        $sort = array_key_exists('sort', $_GET) ? strval($_GET['sort']) : 'summary';
        //метод для получения всех записей в таблице
        $params = $this->gateaway->getAll($sort, $navDatas["start"], $limit);
        //в view добавляются нужные данны и отображается шаблон
        $this->view->link = $navDatas["link"];
        $this->view->sort = $sort;
        $this->view->pages = $navDatas["pages"];
        $this->view->setAtributes($params);
        $this->view->display('students_list_template.php');
    }

    /**
     * метод для отображения страницы регистрации
     */
    private function actionRegister()
    {
        //если post пустой - отображается форма для регистрации
        if (empty($_POST)) {
            $this->view->display('registr_template.php');
            die();
        }
        $params = $_POST;
        //сделал специальный класс(что бы контроллер не так сильно разрастался)
        //со статическими методами для валидации 
        //данных и примения к ним функций, делающих данные безопасными для
        //вставки
        $params = \app\DataHelper::makeSafeDatas($params);
        $errors = \app\DataHelper::validate($params);
        //если нет ошибок - данные добавляются и идет редирект
        if (empty($errors)) {
            $this->gateaway->addStudent($params);
            $id = $this->gateaway->getLastId();
            header('location: http://students.local');
        } else {
            $this->view->errors = $errors;
            $this->view->display('registr_template.php');
        }
        
    }

    /**
     * метод для страницы поиска
     */
    private function actionSearch()
    {
        $search = $_GET['search'];
        $count = $this->gateaway->getCountBySearch($search);
        $limit = 5;
        $navDatas = \app\Pager::getNavDatas($limit, $count);
        $sort = array_key_exists('sort', $_GET) ? strval($_GET['sort']) : 'summary';
        //выбираются данные по поиску
        $params = $this->gateaway->search($search, $sort, $navDatas["start"], $limit);
        //в view добавляются нужные данны и отображается шаблон
        $this->view->search = $search;
        $this->view->sort = $sort;
        $this->view->pages = $navDatas["pages"];
        $this->view->title = 'Список студентов';
        $this->view->setAtributes($params);
        $this->view->display('students_search.php');
    }

    /*
     * метод для страницы редактирования данных студента
     */

    public function actionUpdate()
    {
        $password = $_COOKIE['user_pass'];
        if (empty($_POST)) {
            $params = $this->gateaway->getByPassword($password);
            $this->view->setAtributes($params);
            $this->view->display('update.php');
        } else {
            $params = $_POST;
            $this->gateaway->update($password, $params);
            header('Location:/update/');
        }
    }

    protected function error404()
    {
        echo "Ошибка 404 </br> Страница " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . ' не найдена.';
    }

}
