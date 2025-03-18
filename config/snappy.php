<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"', // Ajusta esta ruta según tu instalación
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    'image' => [
        'enabled' => true,
        'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage"', // Ajusta esta ruta según tu instalación
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
]; 