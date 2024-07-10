<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>List</h2>
    <ul>
        @foreach ($categoriesList as $category)
            <li>{{ $category->name }}</li>
            @if( $category->parent_id )
            <ul>
                <li>{{ $category->parent->name }}</li>
            </ul>
            @endif
        @endforeach
    </ul>
</body>
</html>
