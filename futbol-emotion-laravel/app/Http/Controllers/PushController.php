<?php

namespace App\Http\Controllers;

use App\Services\PushService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PushController extends Controller
{
    /** Entrega la clave pública VAPID para que el navegador se suscriba */
    public function clavePublica()
    {
        return response()->json([
            'clave' => config('tienda.vapid_public', ''),
        ]);
    }

    /** Guarda (o actualiza) la suscripción de un dispositivo */
    public function suscribir(Request $request)
    {
        $request->validate([
            'rol'           => 'required|in:owner,manager',
            'endpoint'      => 'required|string',
            'keys.p256dh'   => 'required|string',
            'keys.auth'     => 'required|string',
        ]);

        $endpoint = $request->input('endpoint');
        $hash = hash('sha256', $endpoint);

        DB::table('push_subscriptions')->updateOrInsert(
            ['endpoint_hash' => $hash],
            [
                'rol'        => $request->input('rol'),
                'endpoint'   => $endpoint,
                'p256dh'     => $request->input('keys.p256dh'),
                'auth'       => $request->input('keys.auth'),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return response()->json(['ok' => true]);
    }

    /** Elimina la suscripción de un dispositivo (cuando desactiva las notificaciones) */
    public function desuscribir(Request $request)
    {
        $endpoint = $request->input('endpoint');
        if ($endpoint) {
            DB::table('push_subscriptions')->where('endpoint_hash', hash('sha256', $endpoint))->delete();
        }
        return response()->json(['ok' => true]);
    }

    /** Envía una notificación de prueba al rol indicado */
    public function prueba(Request $request)
    {
        $rol = $request->input('rol', 'owner');
        PushService::enviarARol($rol, 'Fútbol Emotion', 'Notificación de prueba ✅ ¡Funciona!');
        return response()->json(['ok' => true]);
    }
}
