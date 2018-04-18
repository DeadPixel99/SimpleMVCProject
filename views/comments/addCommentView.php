<hr>
<div class="container">
    <h2>Add new comment</h2>
    <form action="comments/addnew" method="post">
        <div class="form-group">
            <label for="email">Name:</label>
            <input type="text" class="form-control" name="sender" placeholder="Incognito...">
        </div>
        <div class="form-group">
            <label for="pwd">Comment:</label>
            <input type="text" class="form-control" name="message" placeholder="Write here...">
        </div>
        <button type="submit" class="btn btn-default">Add comment</button>
    </form>
</div>