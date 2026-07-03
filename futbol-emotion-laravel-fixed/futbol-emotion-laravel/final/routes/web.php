<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Fútbol Emotion — Rutas Web
|--------------------------------------------------------------------------
| Sirve la app HTML principal desde el servidor Laravel.
| Todas las rutas que no sean /api/* cargan la app.
*/

Route::get('/', function () {
    return view('app');
});

// Ruta de migración (solo accesible en el servidor)
Route::get('/migrar', function () {
    return file_get_contents(public_path('migrar.html'));
});
