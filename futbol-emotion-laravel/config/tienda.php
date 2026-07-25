<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PINs de acceso
    |--------------------------------------------------------------------------
    | Se definen en las variables de entorno del servidor (Coolify).
    | Los valores por defecto existen solo para no romper instalaciones
    | antiguas: en producción SIEMPRE deben definirse PIN_MANAGER y PIN_OWNER.
    */

    'pin_manager' => env('PIN_MANAGER', '1515'),
    'pin_owner'   => env('PIN_OWNER', '2828'),

    /*
    |--------------------------------------------------------------------------
    | Bloqueo por intentos fallidos
    |--------------------------------------------------------------------------
    */

    'intentos_maximos'  => (int) env('LOGIN_INTENTOS', 5),
    'bloqueo_segundos'  => (int) env('LOGIN_BLOQUEO_SEG', 300),

    /*
    |--------------------------------------------------------------------------
    | Notificaciones push (VAPID)
    |--------------------------------------------------------------------------
    | Genera el par de llaves una sola vez y ponlas en las variables de entorno.
    */

    'vapid_public'  => env('VAPID_PUBLIC_KEY', ''),
    'vapid_private' => env('VAPID_PRIVATE_KEY', ''),
    'vapid_subject' => env('VAPID_SUBJECT', 'mailto:admin@futbolemotion.app'),

];
