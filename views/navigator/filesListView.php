<?php
/**
 * @var $li
 */
?>

<div class="container">
    <h1>Files:</h1>
</div>
<div class="container btn-group">
    <form method="post" action="makeDir">
        <input type="submit" class="btn btn-success" value="Create dir">
    </form>
</div>
<div class="container">
    <ul style="list-style: none">
        <?php foreach ($li as $line): ?>
            <li> <?= $line['icon'] ?>
                <a href=" <?=$line['path']."&type={$line['type']}" ?> ">
                    <?= $line['name'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>