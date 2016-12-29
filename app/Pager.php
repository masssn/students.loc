<?php

namespace app;

/**
 * Класс для получения данных, необходимых для постраничной навигации. остановился
 * на одном методе. $currentPage определяет текущую страницу(null по умолчанию)
 * $navDatas["start"] - строка в таблице, с которой необходимо выгружать данные
 * из таблицы. Если стартовая страница = 0 то и строка нулевая, если от текущей
 * страницы отнимается единица(для правильного отображения данных на странице,
 * n-я страница) умножается на $limit - лимит записей на странице и округляется
 * в бОльшую сторону. Все данные возвращаются в массиве $navDatas.
 */
class Pager
{

    public static function getNavDatas($limit, $count)
    {
        $currentPage = array_key_exists('page', $_GET) ? strval($_GET['page']) : NULL;
        $navDatas = [];
        if ($currentPage == NULL || $currentPage == 1) {
            $navDatas["start"] = 0;
        } else {
            $navDatas["start"] = ($currentPage - 1) * $limit;
        }
        $navDatas["link"] = $navDatas["start"] / 5 + 1;
        $navDatas["pages"] = ceil($count / $limit);
        return $navDatas;
    }

}
