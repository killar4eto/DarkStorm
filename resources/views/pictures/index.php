<div class="card border-secondary">
    <h2 class="card-header text-center"><?=$title['pictures'];?> <a href="/pictures/create" class="btn btn-primary btn-sm"><?=$title['button']['add_picture']; ?></a></h2>
    <div class="card-body text-center">
        <div class="row">
            <?php foreach($pictures as $picture): ?>
            <div class="col-3 mx-auto mb-4">
                <a href="/pictures/<?=$picture['id']?>">
                    <img class="img-fluid" src="<?=$picture['url']; ?>" alt="<?=$picture['title']?>">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>