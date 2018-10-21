<?php $this->layout('layouts/main') ?>

<?php $this->start('body') ?>
<div class="card border-secondary">
    <h2 class="card-header text-center"><?=$title['home'];?></h2>
    <div class="card-body">
        <h5 class="card-title text-center"><?=$language['welcome']; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted text-center"><?=$language['information']; ?></h6>


    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Level</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($characters as $char): ?>
            <tr>
                <td><?=$char['Name']?></td>
                <td><?=$char['cLevel']?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php $this->stop() ?>