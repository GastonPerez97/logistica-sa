<?php

class UrlHelper
{
    public function getModuleFromRequestOr($default){
        return isset($_GET["module"]) ? $_GET["module"] : $default;
    }

    public function getActionFromRequestOr($default){
        return isset($_GET["action"]) ? $_GET["action"] : $default;
    }
}