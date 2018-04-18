<?php
/**
 * @var $li
 */
?>

<div class="container">
    <h1>Files:</h1>
</div>
<div class="container btn-group">

</div>
<div class="container">
    <ul style="list-style: none">
        <?php foreach ($li as $line): ?>
            <li> <?= $line['icon'] ?>
                <a href=" <?=$line['path'] ?> ">
                    <?= $line['name'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>