<div class="mbg" id="m-env">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Nuevo envío <button class="mclose" onclick="closeM('m-env')"><i class="ti ti-x"></i></button></div>
    <label class="fl">Cliente</label><input class="fi" id="e-cliente" placeholder="Nombre del cliente">
    <label class="fl">Camiseta(s)</label><input class="fi" id="e-prods" placeholder="Ej: Real Madrid Local L 24/25">
    <label class="fl">Origen del pedido</label>
    <select class="fi" id="e-origen"><option>Instagram</option><option>WhatsApp</option><option>Tienda física</option><option>Web</option><option>Otro</option></select>
    <label class="fl">Transportista</label>
    <select class="fi" id="e-trans"><option>MRW</option><option>Zoom</option><option>Recoger en tienda</option></select>
    <label class="fl">Dirección de entrega</label>
    <input class="fi" id="e-dir" placeholder="Calle, ciudad, código postal">
    <label class="fl">Importe ($)</label>
    <input class="fi" id="e-imp" type="number" min="0" step="0.01" placeholder="0.00">
    <label class="fl">Estado</label>
    <select class="fi" id="e-estado"><option value="preparando">Preparando</option><option value="ruta">En ruta</option><option value="entregado">Entregado</option></select>
    <label class="fl">Notas (opcional)</label>
    <textarea class="fi" id="e-notas" rows="2" style="resize:none" placeholder="Ej: El cliente pidió envolver para regalo"></textarea>
    <input type="hidden" id="e-id">
    <button class="abtn abtn-g" onclick="saveEnvio()"><i class="ti ti-check"></i> Guardar envío</button>
  </div>
</div>

<!-- MODAL: CALCULADORA DE BOLÍVARES -->
<div class="mbg" id="m-calc">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Calculadora de bolívares <button class="mclose" onclick="closeM('m-calc')"><i class="ti ti-x"></i></button></div>

    <div style="display:flex;gap:6px;margin-bottom:12px" id="calc-tasas"></div>

    <label class="fl" style="margin-top:0">Monto en dólares ($)</label>
    <input class="fi" id="calc-usd" type="number" min="0" step="0.01" inputmode="decimal" placeholder="0.00" oninput="calcularBs()" style="font-size:22px;font-weight:800;text-align:center;padding:14px">

    <div style="text-align:center;margin:14px 0;color:var(--txh);font-size:22px"><i class="ti ti-arrows-down"></i></div>

    <div style="background:var(--gl);border:2px solid var(--gm);border-radius:14px;padding:18px;text-align:center">
      <div style="font-size:12px;font-weight:700;color:var(--gd);text-transform:uppercase">Equivale a</div>
      <div id="calc-bs" style="font-size:30px;font-weight:800;color:var(--gd);margin-top:4px">Bs 0,00</div>
      <div id="calc-tasa-info" style="font-size:12px;color:var(--gd);opacity:.75;margin-top:4px">—</div>
    </div>

    <div style="font-size:12px;color:var(--txm);margin-top:14px;text-align:center">Solo para consultar. No registra ninguna venta.</div>
  </div>
</div>

<!-- MODAL: CERRAR CAJA -->
<div class="mbg" id="m-cierre">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Cerrar caja del día <button class="mclose" onclick="closeM('m-cierre')"><i class="ti ti-x"></i></button></div>
    <div id="cierre-resumen" style="background:var(--gray);border-radius:12px;padding:14px;margin-bottom:14px"></div>
    <label class="fl" style="margin-top:0">Clave de cierre</label>
    <input class="fi" id="cierre-clave" type="password" inputmode="numeric" placeholder="••••" autocomplete="off">
    <div id="cierre-err" style="color:var(--rd);font-size:13px;font-weight:600;margin-top:6px;min-height:16px"></div>
    <button class="abtn abtn-g" onclick="confirmarCierre()" id="cierre-btn"><i class="ti ti-lock-check"></i> Confirmar cierre</button>
  </div>
</div>

<!-- MODAL: NOTIFICACIONES (encargado) -->
<div class="mbg" id="m-push">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Notificaciones <button class="mclose" onclick="closeM('m-push')"><i class="ti ti-x"></i></button></div>
    <div id="push-estado-mgr" style="margin-top:6px">Cargando…</div>
  </div>
</div>

<!-- MODAL: EXPORTAR REPORTE -->
<div class="mbg" id="m-buscarfecha">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Ventas por fecha <button class="mclose" onclick="closeM('m-buscarfecha')"><i class="ti ti-x"></i></button></div>
    <div style="display:flex;gap:8px;margin-bottom:12px">
      <button id="bf-tab-dia" onclick="bfModo('dia')">Por día</button>
      <button id="bf-tab-mes" onclick="bfModo('mes')">Por mes</button>
    </div>
    <input type="date" id="bf-dia" class="fi" onchange="bfBuscar()">
    <input type="month" id="bf-mes" class="fi" style="display:none" onchange="bfBuscar()">
    <div id="bf-result" style="margin-top:14px"></div>
  </div>
</div>
<div class="mbg" id="m-analitica">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Analítica de ventas <button class="mclose" onclick="closeM('m-analitica')"><i class="ti ti-x"></i></button></div>
    <div id="analitica-body"></div>
  </div>
</div>
<div class="mbg" id="m-repo">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Reposición sugerida <button class="mclose" onclick="closeM('m-repo')"><i class="ti ti-x"></i></button></div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:12px">Tallas que se venden y están por agotarse, con cuánto pedir según las ventas del último mes.</div>
    <div id="repo-list"></div>
  </div>
</div>
<div class="mbg" id="m-export">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Exportar reporte <button class="mclose" onclick="closeM('m-export')"><i class="ti ti-x"></i></button></div>
    <div style="font-size:14px;color:var(--txm);margin-bottom:14px" id="ex-sub">—</div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
      <button onclick="exportarReporte('pdf')" style="padding:18px 10px;border-radius:12px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:14px;font-weight:800;color:var(--txd);display:flex;flex-direction:column;align-items:center;gap:8px">
        <i class="ti ti-file-type-pdf" style="font-size:32px;color:#e5484d"></i>PDF
        <span style="font-size:11px;font-weight:600;color:var(--txm)">Para imprimir o enviar</span>
      </button>
      <button onclick="exportarReporte('excel')" style="padding:18px 10px;border-radius:12px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:14px;font-weight:800;color:var(--txd);display:flex;flex-direction:column;align-items:center;gap:8px">
        <i class="ti ti-file-type-xls" style="font-size:32px;color:#16a34a"></i>Excel
        <span style="font-size:11px;font-weight:600;color:var(--txm)">Para el contador</span>
      </button>
    </div>
  </div>
</div>

<!-- MODAL: ESCÁNER DE CÓDIGO DE BARRAS -->
<div class="mbg" id="m-scan">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Escanear código <button class="mclose" onclick="cerrarScanner()"><i class="ti ti-x"></i></button></div>
    <div id="scan-reader" style="width:100%;border-radius:14px;overflow:hidden;background:#000;min-height:240px"></div>
    <div id="scan-status" style="font-size:13px;color:var(--txm);text-align:center;margin-top:10px">Apunta la cámara al código de barras de la etiqueta</div>
    <div style="display:flex;align-items:center;gap:8px;margin:14px 0 4px">
      <div style="flex:1;height:1px;background:var(--grayb)"></div>
      <span style="font-size:11px;color:var(--txh);font-weight:700">O ESCRÍBELO A MANO</span>
      <div style="flex:1;height:1px;background:var(--grayb)"></div>
    </div>
    <div style="display:grid;grid-template-columns:1fr auto;gap:8px">
      <input class="fi" id="scan-manual" inputmode="numeric" placeholder="Ej: 020330784" style="margin-bottom:0">
      <button class="abtn abtn-g abtn-sm" onclick="scanManual()" style="margin-top:0;padding:0 18px"><i class="ti ti-search"></i></button>
    </div>
  </div>
</div>

<!-- MODAL: CÓDIGO CONOCIDO → SUMAR STOCK -->
<div class="mbg" id="m-scan-add">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Camiseta reconocida <button class="mclose" onclick="closeM('m-scan-add')"><i class="ti ti-x"></i></button></div>
    <div style="background:var(--gl);border-radius:12px;padding:14px 16px;margin-bottom:12px;display:flex;align-items:center;gap:12px">
      <i class="ti ti-shirt" style="font-size:28px;color:var(--g)"></i>
      <div>
        <div style="font-size:16px;font-weight:800" id="sa-nombre">—</div>
        <div style="font-size:13px;color:var(--txm)">Talla <b id="sa-talla">—</b> · Stock actual: <b id="sa-stock">0</b> UND</div>
      </div>
    </div>
    <label class="fl">Unidades que llegaron</label>
    <input class="fi" id="sa-cant" type="number" min="1" value="1" style="text-align:center;font-size:18px;font-weight:700">
    <input type="hidden" id="sa-camid"><input type="hidden" id="sa-talla-h">
    <button class="abtn abtn-g" onclick="confirmarSumarStock()"><i class="ti ti-plus"></i> Sumar al inventario</button>
    <button class="abtn abtn-gray abtn-sm" onclick="closeM('m-scan-add');abrirScannerInventario()" style="margin-top:8px"><i class="ti ti-scan"></i> Escanear otra</button>
  </div>
</div>

<!-- MODAL: CÓDIGO NUEVO → ASOCIAR A CAMISETA -->
<div class="mbg" id="m-scan-asociar">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Código nuevo <button class="mclose" onclick="closeM('m-scan-asociar')"><i class="ti ti-x"></i></button></div>
    <div style="background:var(--al);border-radius:12px;padding:13px 16px;margin-bottom:12px;display:flex;align-items:center;gap:10px">
      <i class="ti ti-barcode" style="font-size:24px;color:var(--ad)"></i>
      <div>
        <div style="font-size:12px;font-weight:700;color:var(--ad);text-transform:uppercase;letter-spacing:.4px">Primera vez que se escanea</div>
        <div style="font-size:15px;font-weight:800;font-family:monospace" id="as-codigo">—</div>
      </div>
    </div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:10px">Dime a qué camiseta y talla corresponde este código. Solo se hace una vez — la próxima vez la app la reconocerá sola.</div>
    <label class="fl">Camiseta</label>
    <select class="fi" id="as-cam"></select>
    <label class="fl">Talla</label>
    <select class="fi" id="as-talla"><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option><option value="10">10 (niño)</option><option value="12">12 (niño)</option><option value="14">14 (niño)</option><option value="16">16 (niño)</option><option value="U">Única (producto sin talla)</option></select>
    <label class="fl">Unidades que llegaron (0 = solo asociar)</label>
    <input class="fi" id="as-cant" type="number" min="0" value="1" style="text-align:center;font-weight:700">
    <button class="abtn abtn-g" onclick="confirmarAsociarCodigo()"><i class="ti ti-link"></i> Asociar y guardar</button>
    <button class="abtn abtn-gray abtn-sm" onclick="crearCamisetaDesdeScan()" style="margin-top:8px"><i class="ti ti-plus"></i> La camiseta no existe — crearla</button>
  </div>
</div>

<!-- MODAL: NUEVA VENTA -->
<div class="mbg" id="m-carrito">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Venta con varios productos <button class="mclose" onclick="closeM('m-carrito')"><i class="ti ti-x"></i></button></div>
    <label class="fl">Tipo de venta</label>
    <div style="display:flex;gap:8px;margin-bottom:10px">
      <button id="cart-tipo-tienda" onclick="carritoTipoSet('tienda')">Tienda física</button>
      <button id="cart-tipo-online" onclick="carritoTipoSet('online')">Online</button>
    </div>
    <div id="cart-cliente-wrap" style="display:none;margin-bottom:6px">
      <label class="fl">Cliente</label>
      <input class="fi" id="cart-cliente" placeholder="Nombre del cliente" oninput="carritoActualizarConfirm()">
      <label class="fl" style="margin-top:8px">Canal</label>
      <select class="fi" id="cart-canal"><option>Instagram</option><option>WhatsApp</option><option>Web</option></select>
    </div>
    <div class="stitle">Agregar producto</div>
    <select class="fi" id="cart-cam" onchange="carritoAutoPrecio()"></select>
    <select class="fi" id="cart-talla" style="margin-top:8px"><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option><option>10</option><option>12</option><option>14</option><option>16</option><option>U</option></select>
    <div style="display:flex;gap:8px;margin-top:8px">
      <div style="flex:1"><label class="fl">Cantidad</label><input class="fi" id="cart-cant" type="number" min="1" value="1"></div>
      <div style="flex:1"><label class="fl">Precio ($ c/u)</label><input class="fi" id="cart-precio" type="number" min="0" step="0.01"></div>
    </div>
    <button class="abtn abtn-gray abtn-sm" onclick="carritoAgregarProducto()" style="margin-top:8px"><i class="ti ti-plus"></i> Agregar al carrito</button>
    <div class="stitle">Carrito</div>
    <div id="cart-items"></div>
    <div class="stitle">Pago dividido</div>
    <div id="cart-pagos"></div>
    <button class="abtn abtn-gray abtn-sm" onclick="carritoAgregarPago()" style="margin-top:6px"><i class="ti ti-plus"></i> Agregar método de pago</button>
    <div id="cart-resumen-pago"></div>
    <button class="abtn abtn-g" id="cart-confirm" onclick="confirmarCarrito()" style="margin-top:14px;opacity:.4;pointer-events:none"><i class="ti ti-check"></i> Registrar venta</button>
  </div>
</div>
<div class="mbg" id="m-venta">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Registrar venta <button class="mclose" onclick="closeM('m-venta')"><i class="ti ti-x"></i></button></div>

    <!-- Tipo de venta: tienda o envío -->
    <label class="fl">Tipo de venta</label>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:4px">
      <button id="tipo-tienda" onclick="setTipoVenta('tienda')"
        style="padding:14px;border-radius:12px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:14px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:6px">
        <i class="ti ti-building-store" style="font-size:26px"></i>Tienda física
      </button>
      <button id="tipo-envio" onclick="setTipoVenta('envio')"
        style="padding:14px;border-radius:12px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:14px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:6px">
        <i class="ti ti-map-pin" style="font-size:26px"></i>Envío
      </button>
    </div>

    <!-- Número automático para tienda -->
    <div id="v-numero-wrap" style="display:none">
      <div style="background:var(--gl);border-radius:12px;padding:13px 16px;margin-top:10px;display:flex;align-items:center;gap:10px">
        <i class="ti ti-hash" style="font-size:22px;color:var(--g)"></i>
        <div>
          <div style="font-size:12px;font-weight:700;color:var(--txm);text-transform:uppercase;letter-spacing:.4px">Venta en tienda</div>
          <div style="font-size:20px;font-weight:800;color:var(--g)" id="v-num-display">#001</div>
        </div>
      </div>
    </div>

    <!-- Nombre cliente (solo envío) -->
    <div id="v-nombre-wrap" style="display:none">
      <label class="fl">Nombre del cliente</label>
      <input class="fi" id="v-cliente" placeholder="Nombre del cliente">
    </div>

    <!-- MODO: escribir libre, seleccionar del stock, o escanear -->
    <div id="v-modo-wrap" style="display:none;margin-top:14px">
      <label class="fl">¿Cómo registrar la camiseta?</label>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px">
        <button id="modo-libre" onclick="setModoVenta('libre')"
          style="padding:11px;border-radius:10px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:13px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:5px">
          <i class="ti ti-pencil" style="font-size:22px"></i>Escribir
        </button>
        <button id="modo-stock" onclick="setModoVenta('stock')"
          style="padding:11px;border-radius:10px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:13px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:5px">
          <i class="ti ti-shirt" style="font-size:22px"></i>Del stock
        </button>
        <button id="modo-scan" onclick="modoEscanear()"
          style="padding:11px;border-radius:10px;border:2px solid var(--gm);background:var(--gl);cursor:pointer;font-size:13px;font-weight:700;color:var(--gd);display:flex;flex-direction:column;align-items:center;gap:5px">
          <i class="ti ti-scan" style="font-size:22px"></i>Escanear
        </button>
      </div>
    </div>

    <!-- MODO LIBRE: escribir camiseta a mano -->
    <div id="v-libre-wrap" style="display:none">
      <label class="fl">Camiseta vendida</label>
      <input class="fi" id="v-cam-libre" placeholder="Ej: Argentina Local M 24/25, Brasil Visitante L…">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
        <div><label class="fl">Cantidad (UND)</label><input class="fi" id="v-cant-libre" type="number" min="1" value="1"></div>
        <div><label class="fl">Importe ($)</label><input class="fi" id="v-imp-libre" type="number" min="0" step="0.01" placeholder="0.00" oninput="recalcularBs()"></div>
      </div>
    </div>

    <!-- MODO STOCK: seleccionar del inventario -->
    <div id="v-stock-wrap" style="display:none">
      <button class="abtn abtn-g abtn-sm" onclick="escanearParaVenta()" style="margin-top:10px;margin-bottom:6px"><i class="ti ti-scan"></i> Escanear código de la camiseta</button>
      <label class="fl">Camiseta del inventario</label>
      <select class="fi" id="v-cam" onchange="toggleTallaVenta();autoPrecioVenta()"></select>
      <div id="v-talla-wrap">
      <label class="fl">Talla</label>
      <select class="fi" id="v-talla" onchange="actualizarDispVenta()"><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option><option value="10">10 (niño)</option><option value="12">12 (niño)</option><option value="14">14 (niño)</option><option value="16">16 (niño)</option><option value="U" hidden>Única</option></select>
      </div>
      <div id="v-disp" style="display:none;margin:2px 0 6px;padding:9px 12px;border-radius:10px;font-size:13px;font-weight:700"></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
        <div><label class="fl">Cantidad (UND)</label><input class="fi" id="v-cant" type="number" min="1" value="1" oninput="autoPrecioVenta()"></div>
        <div><label class="fl">Importe ($)</label><input class="fi" id="v-imp" type="number" min="0" step="0.01" placeholder="0.00" oninput="impEditadoManual=true;recalcularBs()"></div>
      </div>
    </div>

    <!-- MÉTODO DE PAGO -->
    <div id="v-pago-wrap">
      <label class="fl">¿Cómo pagó?</label>
      <div id="v-pago-metodos" style="display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:6px"></div>
      <div id="v-pago-bs" style="display:none;background:var(--gl);border:1.5px solid var(--gm);border-radius:11px;padding:11px;margin-bottom:8px">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:7px">
          <span style="font-size:12px;font-weight:700;color:var(--gd)">A pagar en bolívares</span>
          <span style="font-size:11px;color:var(--gd);opacity:.8" id="v-tasa-info">—</span>
        </div>
        <div style="display:flex;gap:6px;margin-bottom:7px" id="v-tasa-selector"></div>
        <div style="display:flex;align-items:center;gap:8px">
          <span style="font-size:20px;font-weight:800;color:var(--gd)">Bs</span>
          <input class="fi" id="v-monto-bs" type="number" min="0" step="0.01" style="font-size:18px;font-weight:800;padding:8px 10px;background:#fff">
        </div>
      </div>
      <div id="v-pago-campos"></div>
    </div>

    <!-- Canal (solo envío) -->
    <div id="v-canal-wrap" style="display:none">
      <label class="fl">Origen del pedido</label>
      <select class="fi" id="v-canal"><option>Instagram</option><option>WhatsApp</option><option>Web</option></select>
    </div>

    <button class="abtn abtn-g" onclick="saveVenta()" id="v-save-btn" style="opacity:.4;pointer-events:none;margin-top:14px">
      <i class="ti ti-check"></i> Registrar venta
    </button>
  </div>
</div>

<!-- MODAL: EDITAR VENTA -->
<div class="mbg" id="m-editventa">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Editar venta <button class="mclose" onclick="closeM('m-editventa')"><i class="ti ti-x"></i></button></div>

    <div style="background:var(--gray);border-radius:12px;padding:12px 15px;margin-bottom:12px;display:flex;align-items:center;gap:10px">
      <i class="ti ti-receipt" style="font-size:22px;color:var(--txm)"></i>
      <div>
        <div style="font-size:14px;font-weight:800" id="ev-titulo">—</div>
        <div style="font-size:12px;color:var(--txm)" id="ev-sub">—</div>
      </div>
    </div>

    <!-- Nombre editable solo en ventas libres (escritas a mano) -->
    <div id="ev-nombre-wrap" style="display:none">
      <label class="fl">Camiseta vendida</label>
      <input class="fi" id="ev-nombre" placeholder="Ej: Argentina Local M 24/25">
    </div>

    <!-- Talla editable solo en ventas del stock -->
    <div id="ev-talla-wrap" style="display:none">
      <label class="fl">Talla</label>
      <select class="fi" id="ev-talla"><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option><option value="10">10 (niño)</option><option value="12">12 (niño)</option><option value="14">14 (niño)</option><option value="16">16 (niño)</option><option value="U" hidden>Única</option></select>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
      <div><label class="fl">Cantidad (UND)</label><input class="fi" id="ev-cant" type="number" min="1" value="1"></div>
      <div><label class="fl">Importe ($)</label><input class="fi" id="ev-imp" type="number" min="0" step="0.01"></div>
    </div>

    <div id="ev-cliente-wrap" style="display:none">
      <label class="fl">Nombre del cliente</label>
      <input class="fi" id="ev-cliente" placeholder="Nombre del cliente">
    </div>

    <input type="hidden" id="ev-id">
    <button class="abtn abtn-g" onclick="guardarEdicionVenta()" id="ev-save-btn"><i class="ti ti-check"></i> Guardar cambios</button>
  </div>
</div>

<!-- MODAL: DEVOLUCIÓN -->
<div class="mbg" id="m-dev">
  <div class="modal">
    <div class="mtitle">Nueva devolución / cambio <button class="mclose" onclick="closeM('m-dev')"><i class="ti ti-x"></i></button></div>
    <label class="fl">Cliente</label><input class="fi" id="d-cliente" placeholder="Nombre del cliente">
    <label class="fl">Motivo</label>
    <select class="fi" id="d-motivo"><option>Talla incorrecta</option><option>Equipo incorrecto</option><option>Defecto de fábrica</option><option>Otro</option></select>
    <label class="fl">Camiseta que devuelve <span style="font-size:11px;color:var(--txh)">(vuelve al stock)</span></label>
    <div style="display:flex;gap:6px;margin-bottom:5px">
      <button type="button" id="d-dev-modo-inv" onclick="setDevModo('dev','inv')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--gm);background:var(--gl);color:var(--gd)">Del inventario</button>
      <button type="button" id="d-dev-modo-txt" onclick="setDevModo('dev','txt')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--grayb);background:#fff;color:var(--txm)">Escribir</button>
    </div>
    <select class="fi" id="d-dev-cam" onchange="fillTallasDev('dev')" style="margin-bottom:6px"></select>
    <select class="fi" id="d-dev-talla"></select>
    <input class="fi" id="d-dev" placeholder="Ej: Barça Local M 24/25" style="display:none">

    <label class="fl">Camiseta que quiere <span style="font-size:11px;color:var(--txh)">(sale del stock)</span></label>
    <div style="display:flex;gap:6px;margin-bottom:5px">
      <button type="button" id="d-sol-modo-inv" onclick="setDevModo('sol','inv')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--gm);background:var(--gl);color:var(--gd)">Del inventario</button>
      <button type="button" id="d-sol-modo-txt" onclick="setDevModo('sol','txt')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--grayb);background:#fff;color:var(--txm)">Escribir</button>
    </div>
    <select class="fi" id="d-sol-cam" onchange="fillTallasDev('sol')" style="margin-bottom:6px"></select>
    <select class="fi" id="d-sol-talla"></select>
    <input class="fi" id="d-sol" placeholder="Ej: Barça Local L 24/25" style="display:none">
    <label class="fl">Importe ($)</label>
    <input class="fi" id="d-imp" type="number" min="0" step="0.01" placeholder="0.00">
    <input type="hidden" id="d-id">
    <button class="abtn abtn-g" onclick="saveDevolucion()"><i class="ti ti-check"></i> Registrar</button>
  </div>
</div>

<!-- MODAL: TRANSACCIÓN (dueño) -->
<div class="mbg" id="m-tx">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle"><span id="tx-title">Registrar gasto</span> <button class="mclose" onclick="closeM('m-tx')"><i class="ti ti-x"></i></button></div>
    <div id="tx-tipo-wrap">
      <label class="fl" style="margin-top:0">Tipo</label>
      <select class="fi" id="tx-tipo" onchange="toggleTxTipo()"><option value="gasto">Gasto</option><option value="ingreso">Ingreso</option></select>
    </div>
    <label class="fl">Descripción</label><input class="fi" id="tx-desc" placeholder="Ej: Bolsas para la tienda, pago de luz…">
    <div class="frow">
      <div><label class="fl">Importe ($)</label><input class="fi" id="tx-imp" type="number" min="0" step="0.01" placeholder="0.00"></div>
      <div id="tx-cat-wrap"><label class="fl">Categoría</label><select class="fi" id="tx-cat"><option>Mercancía</option><option>Servicios</option><option>Transporte</option><option>Local</option><option>Otros</option></select></div>
      <div id="tx-canal-wrap" style="display:none"><label class="fl">Canal</label><select class="fi" id="tx-canal"><option>Tienda física</option><option>Instagram</option><option>WhatsApp</option><option>Web</option><option>Otro</option></select></div>
    </div>
    <button class="abtn abtn-g" onclick="saveTx()" id="tx-save-btn"><i class="ti ti-check"></i> Guardar</button>
  </div>
</div>

<!-- MODAL: AJUSTE STOCK -->
<div class="mbg" id="m-ajuste">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle"><span id="aj-title">Ajustar stock</span><button class="mclose" onclick="closeM('m-ajuste')"><i class="ti ti-x"></i></button></div>
    <p id="aj-name" style="font-size:14px;color:var(--txm);margin-bottom:14px"></p>
    <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:8px">
      <div><label class="fl" style="margin-top:0;text-align:center">S</label><input class="fi" id="aj-S" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">M</label><input class="fi" id="aj-M" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">L</label><input class="fi" id="aj-L" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">XL</label><input class="fi" id="aj-XL" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">XXL</label><input class="fi" id="aj-XXL" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">10<span style="font-size:9px;display:block;color:var(--txh)">niño</span></label><input class="fi" id="aj-10" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">12<span style="font-size:9px;display:block;color:var(--txh)">niño</span></label><input class="fi" id="aj-12" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">14<span style="font-size:9px;display:block;color:var(--txh)">niño</span></label><input class="fi" id="aj-14" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">16<span style="font-size:9px;display:block;color:var(--txh)">niño</span></label><input class="fi" id="aj-16" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
      <div><label class="fl" style="margin-top:0;text-align:center">Única<span style="font-size:9px;display:block;color:var(--txh)">otro</span></label><input class="fi" id="aj-U" type="number" min="0" style="text-align:center;padding:10px 6px"></div>
    </div>
    <input type="hidden" id="aj-id">
    <button class="abtn abtn-g" onclick="saveAjuste()"><i class="ti ti-check"></i> Actualizar stock</button>
  </div>
</div>

<!-- MODAL: NUEVA CAMISETA EN INVENTARIO -->
<div class="mbg" id="m-nueva-cam">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle"><span id="ncam-title">Nueva camiseta</span><button class="mclose" onclick="closeM('m-nueva-cam')"><i class="ti ti-x"></i></button></div>

    <label class="fl" style="margin-top:0">¿Qué tipo de producto es?</label>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:4px">
      <button type="button" id="nc-chip-cam" onclick="setCatProducto('camiseta')" style="padding:11px;border-radius:11px;border:2px solid var(--g);background:var(--gl);cursor:pointer;font-size:13px;font-weight:800;color:var(--gd)">👕 Camiseta</button>
      <button type="button" id="nc-chip-otro" onclick="setCatProducto('otro')" style="padding:11px;border-radius:11px;border:2px solid var(--grayb);background:#fff;cursor:pointer;font-size:13px;font-weight:800;color:var(--txm)">📦 Otro producto</button>
    </div>
    <div id="nc-cat-wrap" style="display:none">
      <label class="fl">¿Qué producto es?</label>
      <input class="fi" id="nc-categoria" placeholder="Ej: Balón, Medias, Guantes, Gorra…">
    </div>

    <label class="fl" id="nc-lbl-nombre">Equipo / Club</label>
    <input class="fi" id="nc-equipo" placeholder="Ej: Real Madrid, Barça, España…">

    <div class="frow" id="nc-camposcam">
      <div>
        <label class="fl">Temporada</label>
        <input class="fi" id="nc-temp" placeholder="Ej: 24/25" value="24/25">
      </div>
      <div>
        <label class="fl">Tipo</label>
        <select class="fi" id="nc-tipo">
          <option>Local</option><option>Visitante</option><option>Tercera</option><option>Portero</option>
        </select>
      </div>
    </div>

    <div id="nc-tallas-cam">
    <label class="fl">UND por talla (inventario actual)</label>
    <div style="background:var(--gray);border-radius:12px;padding:12px;display:grid;grid-template-columns:repeat(5,1fr);gap:8px;margin-bottom:4px">
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">S</label><input class="fi" id="nc-S" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">M</label><input class="fi" id="nc-M" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">L</label><input class="fi" id="nc-L" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">XL</label><input class="fi" id="nc-XL" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">XXL</label><input class="fi" id="nc-XXL" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">10 <span style="font-size:9px;color:var(--txh)">niño</span></label><input class="fi" id="nc-10" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">12 <span style="font-size:9px;color:var(--txh)">niño</span></label><input class="fi" id="nc-12" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">14 <span style="font-size:9px;color:var(--txh)">niño</span></label><input class="fi" id="nc-14" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
      <div><label style="display:block;font-size:11px;font-weight:700;color:var(--txm);text-align:center;margin-bottom:5px">16 <span style="font-size:9px;color:var(--txh)">niño</span></label><input class="fi" id="nc-16" type="number" min="0" value="0" style="text-align:center;padding:10px 4px;font-size:16px;font-weight:700"></div>
    </div>
    </div>
    <div id="nc-tallas-otro" style="display:none">
      <label class="fl">Unidades en inventario</label>
      <input class="fi" id="nc-U" type="number" min="0" value="0" style="text-align:center;font-size:18px;font-weight:700">
    </div>
    <div style="font-size:12px;color:var(--txh);margin-bottom:4px">Total: <span id="nc-total" style="font-weight:700;color:var(--g)">0</span> UND</div>

    <div class="frow">
      <div>
        <label class="fl">Stock mínimo por talla</label>
        <input class="fi" id="nc-min" type="number" min="0" value="5" placeholder="5">
      </div>
      <div>
        <label class="fl">Proveedor nº</label>
        <select class="fi" id="nc-prov">
          <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
        </select>
      </div>
    </div>

    <label class="fl">Precio de venta sugerido ($) — opcional</label>
    <input class="fi" id="nc-precio" type="number" min="0" step="0.01" placeholder="Se autocompleta al vender, siempre editable">

    <input type="hidden" id="nc-id">
    <button class="abtn abtn-g" onclick="saveNuevaCamiseta()"><i class="ti ti-check"></i> Guardar en inventario</button>
    <button class="abtn abtn-r" id="nc-btn-borrar" onclick="borrarCamiseta()" style="display:none;margin-top:8px"><i class="ti ti-trash"></i> Eliminar esta camiseta</button>
  </div>
</div>

