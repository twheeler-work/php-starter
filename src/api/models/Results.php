<?php

/////////////////////////////////////////////////////////
// Results rendering functions
/////////////////////////////////////////////////////////

class Results
{
    public static function render($results)
    {
        $render = '';

        foreach ($results as $i) {

            $render .= "<div></div>";
        }

        return $render;
    }
}
