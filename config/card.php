<?php

use App\Product;

return [
    'modelClassName' => Product::class,
    'modelAdditionKeys' => [
        'title', 'catId', 'alias'
    ],
];