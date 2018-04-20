<div class="container-fluid">
    <form method="post" action="edit" style="position: fixed">
        <input hidden value="<?= $path ?>" name="fileLocation">
        <input hidden value="<?= $type ?>" name="fileType">
        <input type="submit" value="Edit" class="btn btn-warning" style="margin-top: 1%">
    </form>
</div>
<div class="container" style="background-color: lightgrey; border-radius: 7px; margin-top: 2%">
    <p> <?= nl2br($content) ?> </p>
</div>