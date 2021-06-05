<?php

session_start(); //начало сесии для авторизации

//общие служебные константы, создавая этот файл, мы разграничиваем логику, конфигурацию и тд, все на своих местах

define("ROOT", "C:/Server/data/htdocs/leitner_system/"); //константа определяющая корневую директорию, чтобы не писать кракозябру


define("MODEL_PATH", ROOT. "/models/"); //до моделей
define("VIEW_PATH", ROOT. "/views/");  // до представлений (согласно концепции MVC) 
define("CONTROLLER_PATH", ROOT. "/controllers/"); //определяет путь до контроллера
define("UPLOAD_DIR", ROOT. "/uploads/"); //определяет путь до контроллера
//константы нужны для упрощения обращения по пути, чтобы не писать длинные ROOT. "/models".... и тд

//определяем какие файлы мы будем загружать сразу

require_once("db.php"); //важно сразу подключить БД
require_once("route.php");  //файл конфигурации
require_once MODEL_PATH. "Model.php"; //модели - родители прилоежния (общие классы)
require_once VIEW_PATH. "View.php";
require_once CONTROLLER_PATH. "Controller.php";

Routing::buildRoute();