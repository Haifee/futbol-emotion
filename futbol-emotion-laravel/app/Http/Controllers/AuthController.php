<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * PINs leídos de las variables de entorno (config/tienda.php).
     * Ya no viven en el código: cada instalación define los suyos.
     */
    private function pines(): array
    {
        return [
            'manager' => (string) config('tienda.pin_manager'),
            'owner'   => (string) config('tienda.pin_owner'),
        ];
    }

    private function claveIntentos(Request $request): string
    {
        return 'login_intentos_' . sha1($request->ip());
    }

    private function claveBloqueo(Request $request): string
    {
        return 'login_bloqueo_' . sha1($request->ip());
    }

    public function login(Request $request)
    {
        $request->validate([
            'rol' => 'required|string',
            'pin' => 'required|string|max:12',
        ]);

        $maxIntentos = max(1, (int) config('tienda.intentos_maximos', 5));
        $bloqueoSeg  = max(30, (int) config('tienda.bloqueo_segundos', 300));

        // 1) Bloqueado por intentos fallidos
        $bloqueadoHasta = Cache::get($this->claveBloqueo($request));
        if ($bloqueadoHasta && $bloqueadoHasta > time()) {
            $faltan = (int) ceil(($bloqueadoHasta - time()) / 60);
            return response()->json([
                'error'     => "Demasiados intentos fallidos. Intenta de nuevo en {$faltan} minuto" . ($faltan > 1 ? 's' : '') . '.',
                'bloqueado' => true,
                'segundos'  => $bloqueadoHasta - time(),
            ], 429);
        }

        $rol   = $request->input('rol');
        $pin   = (string) $request->input('pin');
        $pines = $this->pines();

        // 2) Usuario desactivado por el dueño
        if ($rol === 'manager' && $this->usuarioBloqueado()) {
            return response()->json([
                'error' => 'Este acceso está desactivado. Comunicate con el dueño.',
            ], 403);
        }

        // 3) Verificación del PIN (comparación en tiempo constante)
        $valido = isset($pines[$rol]) && hash_equals($pines[$rol], $pin);

        if (!$valido) {
            $intentos = ((int) Cache::get($this->claveIntentos($request), 0)) + 1;
            Cache::put($this->claveIntentos($request), $intentos, now()->addSeconds($bloqueoSeg));

            if ($intentos >= $maxIntentos) {
                Cache::put($this->claveBloqueo($request), time() + $bloqueoSeg, now()->addSeconds($bloqueoSeg));
                Cache::forget($this->claveIntentos($request));
                $this->registrarIntentoFallido($intentos, true);

                $minutos = (int) ceil($bloqueoSeg / 60);
                return response()->json([
                    'error'     => "Demasiados intentos fallidos. Acceso bloqueado por {$minutos} minuto" . ($minutos > 1 ? 's' : '') . '.',
                    'bloqueado' => true,
                    'segundos'  => $bloqueoSeg,
                ], 429);
            }

            $restantes = $maxIntentos - $intentos;
            return response()->json([
                'error'     => "PIN incorrecto. Te quedan {$restantes} intento" . ($restantes > 1 ? 's' : '') . '.',
                'restantes' => $restantes,
            ], 401);
        }

        // 4) Éxito
        Cache::forget($this->claveIntentos($request));
        Cache::forget($this->claveBloqueo($request));

        $request->session()->regenerate();
        session(['rol' => $rol]);

        return response()->json(['ok' => true, 'rol' => $rol]);
    }

    private function usuarioBloqueado(): bool
    {
        try {
            $fila = DB::table('configuracion')->where('clave', 'manager_bloqueado')->first();
            return $fila && $fila->valor === '1';
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function registrarIntentoFallido(int $intentos, bool $bloqueado): void
    {
        try {
            DB::table('actividad')->insert([
                'tipo'        => 'seguridad',
                'descripcion' => 'Intentos de acceso fallidos (' . $intentos . ')',
                'extra'       => $bloqueado ? 'Acceso bloqueado temporalmente' : '',
                'rol'         => 'sistema',
                'created_at'  => now(),
            ]);
        } catch (\Throwable $e) {
            // El login nunca debe romperse por el registro de auditoría
        }
    }

    public function logout(Request $request)
    {
        session()->forget('rol');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['ok' => true]);
    }

    public function me(Request $request)
    {
        $rol = session('rol');
        if (!$rol) {
            return response()->json(['autenticado' => false], 401);
        }
        return response()->json(['autenticado' => true, 'rol' => $rol]);
    }
}
