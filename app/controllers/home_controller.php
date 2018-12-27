<?php


$lastChapTab = Chapter::getLastChapter();


$chapTitle = $lastChapTab['chap_title'];
$chapDate = date_rewrite($lastChapTab['chap_date_created'], 'short');
$chapContent = nl2br($lastChapTab['chap_content']);








?>