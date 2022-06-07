<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Home Page Here ...</h1>
    <hr>
    <form action="/form/" method="post">
        <input type="hidden" name="csrf" value="<?php echo e(\App\Core\CSRFToken::_token()); ?>">
        <input type="text" name="username">
        <input type="submit" value="Go">
    </form>
</body>
</html>