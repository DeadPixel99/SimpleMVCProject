<hr>
<div class="container">
    <h2>Create folder</h2>
    <form action="makeDirProccess" method="post">
        <div class="form-group">
            <label for="email">New folder name:</label>
            <input type="hidden" name="path" value="<?= $path ?>">
            <input type="text" class="form-control" name="folderName" placeholder="Incognito...">
        </div>
        <button type="submit" class="btn btn-default">Create</button>
    </form>
</div>