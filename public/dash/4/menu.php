<?php
if (!isset($_SESSION['convenio']))
    include_once PATH_HOME . DEV_PATH . "dash/4/inc/base.php";

if (isset($_SESSION['convenio']))
    include_once PATH_HOME . DEV_PATH . 'dash/4/inc/menu.php';
