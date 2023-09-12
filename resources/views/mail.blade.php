<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <main>
        <h1>Projects status updated</h1>
        <h3>Project: {{ $title }}</h3>
        <h3>Status: {{ $public == 1 ? 'Public' : 'Draft' }}</h3>
    </main>
</body>
</html>