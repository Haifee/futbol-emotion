<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Fútbol Emotion</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<style>
  /* ── Los estilos van aquí — se copian del HTML actual ── */
</style>
</head>
<body>
  {{-- El contenido de la app va aquí --}}
  {{-- Se reemplaza con el HTML de futbol-emotion.html --}}
  <div id="app-loading" style="display:flex;align-items:center;justify-content:center;height:100vh;font-family:sans-serif;color:#16783f;font-size:18px;font-weight:700;">
    Cargando Fútbol Emotion...
  </div>

<script>
// URL base del API — apunta al mismo servidor
const API = '{{ url("/api") }}';
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Función base para llamadas al API
async function api(method, endpoint, data = null) {
  const opts = {
    method,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': CSRF,
    },
    credentials: 'include',
  };
  if (data) opts.body = JSON.stringify(data);
  const res = await fetch(API + endpoint, opts);
  return res.json();
}

// Reemplaza localStorage con llamadas al servidor
window.DB = {
  // CAMISETAS
  getCamisetas:    () => api('GET', '/camisetas'),
  saveCamiseta:    (d) => api('POST', '/camisetas', d),
  updateCamiseta:  (id, d) => api('PUT', `/camisetas/${id}`, d),
  deleteCamiseta:  (id) => api('DELETE', `/camisetas/${id}`),
  ajustarStock:    (id, tallas) => api('PUT', `/camisetas/${id}/stock`, { tallas }),

  // VENTAS
  getVentas:  () => api('GET', '/ventas'),
  saveVenta:  (d) => api('POST', '/ventas', d),

  // PEDIDOS
  getPedidos:       () => api('GET', '/pedidos'),
  savePedido:       (d) => api('POST', '/pedidos', d),
  aprobarPedido:    (id) => api('PUT', `/pedidos/${id}/aprobar`),
  rechazarPedido:   (id) => api('PUT', `/pedidos/${id}/rechazar`),
  recibirPedido:    (id) => api('PUT', `/pedidos/${id}/recibido`),

  // ENVÍOS
  getEnvios:      () => api('GET', '/envios'),
  saveEnvio:      (d) => api('POST', '/envios', d),
  updateEnvio:    (id, d) => api('PUT', `/envios/${id}`, d),
  avanzarEnvio:   (id) => api('PUT', `/envios/${id}/estado`),

  // DEVOLUCIONES
  getDevoluciones:    () => api('GET', '/devoluciones'),
  saveDevolucion:     (d) => api('POST', '/devoluciones', d),
  completarDevolucion:(id) => api('PUT', `/devoluciones/${id}/completar`),

  // TRANSACCIONES
  getTransacciones: () => api('GET', '/transacciones'),
  saveTx:           (d) => api('POST', '/transacciones', d),
  getCierre:        () => api('GET', '/transacciones/cierre'),

  // AUTH
  login:  (rol, pin) => api('POST', '/login', { rol, pin }),
  logout: () => api('POST', '/logout'),
  me:     () => api('GET', '/me'),
};

document.getElementById('app-loading').remove();
</script>
</body>
</html>
