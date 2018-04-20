<?php
/**
 * @var $li
 */
?>

<div class="container">
    <h1>Files:</h1>
</div>
<div class="container">
    <ul style="list-style: none">
        <?php foreach ($li as $line): ?>
            <li> <?= $line['icon'] ?>
                <a href=" <?=$line['path']."&type={$line['type']}" ?> ">
                    <?= $line['name'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="container btn-group" style="margin-top: 3%">
    <form method="post" action="navigator/makeOrRemoveDir">
        <input type="hidden" name="futurePath" value="<?= $line['location'] ?>">
        <input type="text" name="dirName">
        <input type="submit" class="btn btn-success" name="buttn" value="Create dir">
        <input type="submit" class="btn btn-danger" name="buttn" value="Remove dir">
    </form>
</div>
<div class="col-5" style="margin-top: 1%">
    <form method="post" action="navigator/loadFile" style="margin-left: 2%; background-color: lightgrey; border-radius: 7px" enctype="multipart/form-data">
        <input type="hidden" name="futurePath" value="<?= $line['location'] ?>">
        <input type="file" class="file" name="uploadedFile[]" multiple>
        <input type="submit" class="btn btn-warning" value="Download file">
    </form>
</div>