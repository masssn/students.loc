<?php

/**
 * Класс для представления данных. В принципе можно было и не делать, но все же.
 */

namespace app\views;

class View
{

    public $atributes = [];

    public function setAtributes($param)
    {
        $this->atributes = $param;
    }

    public function display($template)
    {
        ob_start();
        require $template;
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}
