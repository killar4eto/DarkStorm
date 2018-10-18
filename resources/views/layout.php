<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acher a small MVC framework</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand mb-0 h1" href="/">Acher</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><?=$language_menu['home']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pictures"><?=$language_menu['pictures']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/features"><?=$language_menu['features']; ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=$language_menu['language']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/language/english"><?=$language_menu['language_english']; ?></a>
                            <a class="dropdown-item" href="/language/bulgarian"><?=$language_menu['language_bulgarian']; ?></a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="container">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span><?php echo implode('</p><p>', $error); ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span><?php echo $success; ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php echo $content; // This is the view output ?>

    </section>
    <footer class="container">
        <hr />
        <p>© Acher 2014-2018.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>