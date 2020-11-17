<?php


class ServiceModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

}