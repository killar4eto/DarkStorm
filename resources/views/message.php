<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title><?php echo $error['title']; ?></title>
    <style type="text/css">
    *{
        margin:0;
        padding:0;
        border:0;
    }
    body {
        background:#ededed;
        font-family:sans-serif;
        margin: 40px 0 10px;
        color: #555;
    }
    hr {
        border-bottom: 1px solid #eee;
    }
    a {
        color: #000;
        font-weight: normal;
        text-decoration:none;
    }
    a:hover, a:active {
        text-decoration:underline;
    }
    h1 {
        border-bottom: 1px solid #ccc;
        font-size: 19px;
        font-weight: normal;
        padding: 14px 15px 10px;
        background-color:#f5f5f5;
    }

    .container {
        width:90%;
        margin:auto;
        border:1px solid #ccc;
        background-color:#f5f5f5;
    }

    p {
        background-color:#fff;
        padding: 12px 15px;
    }
    p.error { color:#840000; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $error['title']; ?></h1>
        <p class="error">
            <?php echo $error['message']; ?>
        </p>
        <hr />
        <p>
            <a href="javascript:history.go(-1)">Go Back</a>
        </p>
    </div>
</body>
</html>