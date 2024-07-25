@props(['catalog'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalog PDF</title>
</head>
<body>
    @foreach ($catalog->items as $item)
        <x-item-card :item="$item"></x-item-card>
    @endforeach
</body>
</html>
