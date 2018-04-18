<div class="container">
    <table class="table-striped table">
        <thead>
            <tr>
                <th><p><strong><?= $message ?></strong></p></th><br>
            </tr>
        </thead>
        <tbody>
        <tr>
            <p><?= $sender ?></p>
        </tr>
        <tr>
            <td>
                <form method="post" action="comments/delete">
                    <input type="hidden" name="file" value="<?= $file ?>">
                    <input type="submit" class="btn-danger" value="Delete">
                </form>
            </td>
        </tr>
        </tbody>
    </table>
</div>