<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/prisma/matrix', function () {
    return view('workbench::matrix');
});

Route::get('/prisma/showcase', function () {
    return view('workbench::showcase');
});
