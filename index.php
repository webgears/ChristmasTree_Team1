<?php
include "autoload.php";

use Controller\LightShowController;

// Todo: Start coding here

$controller = new LightShowController();


$controller->getPlaylistContent();

?>

<table>

    <?php
    foreach($controller->getPlaylistContent() as $song) {
    ?>

    <tr><td>

            <?php echo($song); ?>

    </td></tr>

    <?php
    }
    ?>
    
</table>
