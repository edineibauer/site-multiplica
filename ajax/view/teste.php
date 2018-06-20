<?php

ob_start();

echo "<div class='container-900 padding-64'><div class='col card padding-medium color-white'>";
$form = new \FormCrud\Form("noticias");
$form->showForm();
echo "</div></div>";

$data['data']['content'] = ob_get_contents();
ob_end_clean();