<!DOCTYPE html>
<html>
<head>
    <title>Todo Details</title>
</head>
<body>
    <h1>Title :</h1> <br>
    <h2>{{ $todo->title }}</h2>
    <br>
    <hr>
    <h1>Description :</h1>
    <br>
    <p>{{ $todo->description }}</p>
    <br>
    <hr>
    <p>Date: {{ $todo->date }}</p>
    <p>Time: {{ $todo->time }}</p>
</body>
</html>
