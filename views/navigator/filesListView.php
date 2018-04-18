<?php
/**
 * @var $li
 */
?>

<div class="container">
    <h1>Files:</h1>
</div>
<div class="container">

</div>
<div class="container">
    <ul>
        <?php foreach ($li as $line): ?>
            <li><?= $line['name'] ?></li>
        <?php endforeach; ?>
    </ul>
</div>