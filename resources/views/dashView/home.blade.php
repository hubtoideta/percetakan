<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        @method('DELETE')
        <button type="submit"aria-current="page" href="">Log Out</button>
    </form>
</body>
</html>