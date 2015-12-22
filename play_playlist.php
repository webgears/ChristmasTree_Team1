<?php
include "autoload.php";

use Controller\LightShowController;

// Todo: Start coding here

$controller = new LightShowController();


$controller->getPlaylistContent();

$controller->playPlaylist();

?>
