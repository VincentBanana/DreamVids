<?php
session_start();

$content = 'pages/home.php';
$model = 'models/m_home.php';
$view = 'views/v_home.php';

if(!empty($_GET['page'])) {
        $page = htmlentities($_GET['page']);
        $pages = scandir('./pages');

        if(!empty($page) && in_array($page.'.php', $pages)) {
                $content = 'pages/'.$page.'.php';
                $model = 'models/m_'.$page.'.php';
                $view = 'views/v_'.$page.'.php';
        }
}

include 'includes/bdd.class.php';
include 'includes/functions.php';
include 'classes/LoggedUser.php';
include 'includes/tasks.php';
include $model;
include $content;
include 'views/_top.php';
include $view;
include 'views/_btm.php';
?>