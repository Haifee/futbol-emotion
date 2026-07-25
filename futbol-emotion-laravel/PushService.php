<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class PushService
{
    /**
     * Envía una notificación push a todos los dispositivos de un rol.
     *
     * @param string $rol      'owner' | 'manager'
     * @param string $titulo   Título de la notificación
     * @param string $cuerpo   Texto del mensaje
     * @param array  $extra    Datos opcionales (url, tag…)
     */
    public static function enviarARol(string $rol, string $titulo, string $cuerpo, array $extra = []): void
    {
        // Si la librería no está instalada todavía, no romper la app
        if (!class_exists(WebPush::class)) {
            return;
        }

        $publica = config('tienda.vapid_public');
        $privada = config('tienda.vapid_private');

        if (!$publica || !$privada) {
            return; // VAPID no configurado aún
        }

        $subs = DB::table('push_subscriptions')->where('rol', $rol)->get();
        if ($subs->isEmpty()) {
            return;
        }

        try {
            $webPush = new WebPush([
                'VAPID' => [
                    'subject'    => config('tienda.vapid_subject', 'mailto:admin@futbolemotion.app'),
                    'publicKey'  => $publica,
                    'privateKey' => $privada,
                ],
            ]);

            $payload = json_encode(array_merge([
                'title' => $titulo,
                'body'  => $cuerpo,
                'icon'  => '/icon-192.png',
                'badge' => '/icon-192.png',
            ], $extra));

            foreach ($subs as $sub) {
                $subscription = Subscription::create([
                    'endpoint' => $sub->endpoint,
                    'keys'     => [
                        'p256dh' => $sub->p256dh,
                        'auth'   => $sub->auth,
                    ],
                ]);
                $webPush->queueNotification($subscription, $payload);
            }

            // Enviar y limpiar suscripciones muertas
            foreach ($webPush->flush() as $report) {
                $endpoint = $report->getRequest()->getUri()->__toString();
                if (!$report->isSuccess() && $report->isSubscriptionExpired()) {
                    DB::table('push_subscriptions')->where('endpoint', $endpoint)->delete();
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Push fallo: ' . $e->getMessage());
        }
    }

    /**
     * Aplica la matriz de notificaciones: dado un evento, decide a quién avisar.
     *
     * @param string $evento  venta|gasto|pedido_creado|pedido_recibido|stock_critico|devolucion|devolucion_resuelta
     * @param string $actor   rol que hizo la acción (owner|manager) — no se le notifica a sí mismo
     */
    public static function evento(string $evento, string $actor, string $titulo, string $cuerpo): void
    {
        // Matriz: evento => roles que reciben
        $matriz = [
            'venta'               => ['owner', 'manager'], // cada quien recibe la del otro
            'gasto'               => ['owner'],
            'pedido_creado'       => ['owner'],
            'pedido_recibido'     => ['owner'],
            'stock_critico'       => ['owner', 'manager'],
            'devolucion'          => ['owner'],
            'devolucion_resuelta' => ['manager'],
        ];

        $destinos = $matriz[$evento] ?? [];

        foreach ($destinos as $rol) {
            // Nadie recibe notificación de su propia acción
            if ($rol === $actor) {
                continue;
            }
            self::enviarARol($rol, $titulo, $cuerpo);
        }
    }
}
