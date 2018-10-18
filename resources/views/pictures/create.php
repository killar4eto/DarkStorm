<div class="card border-secondary">
    <h2 class="card-header text-center"><?=$title['add_picture']; ?></h2>
    <div class="card-body">
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="/pictures" method="post">
                    <div class="form-group">
                        <label for="title"><?=$title['form']['title']; ?></label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="url"><?=$title['form']['url']; ?></label>
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                    <button type="submit" class="btn btn-primary"><?=$title['button']['submit']; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>