<div class="container">
    <div class="row">
        <h1>Controllers list</h1>
    </div>
</div>
<div class="container">
    <ul>
        <?php foreach ($clist as $value): ?>
        <li><a href="#"><?= $value ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>