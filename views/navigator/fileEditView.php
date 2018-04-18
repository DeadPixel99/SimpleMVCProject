<form method="post" action="saveEditedFile">
    <div class="container form-group" style="background-color: lightgrey; border-radius: 7px; margin-top: 2%">
        <textarea name="newContent" class="form-control" style="height: 80vh"> <?= $content ?> </textarea>
    </div>
    <div class="container-fluid"  style="position: fixed">
        <input hidden value="<?= $path ?>" name="fileLocation">
        <input type="submit" value="Save" class="btn btn-success" style="margin-top: 1%">
    </div>
</form>
