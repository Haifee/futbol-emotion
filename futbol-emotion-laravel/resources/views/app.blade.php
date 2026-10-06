<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Fútbol Emotion</title>
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#16a34a">
<link rel="icon" type="image/png" sizes="192x192" href="/icon-192.png">
<link rel="apple-touch-icon" href="/icon-192.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<style>
:root{
  --g:#16a34a;--gl:#dcfce7;--gm:#22c55e;--gd:#15803d;--gx:#bbf7d0;
  --r:#ef4444;--rl:#fee2e2;--rd:#dc2626;
  --a:#f59e0b;--al:#fef3c7;--ad:#d97706;
  --p:#8b5cf6;--pl:#ede9fe;--pd:#7c3aed;
  --b:#3b82f6;--bl:#dbeafe;--bd:#2563eb;
  --gray:#f8fafc;--grayb:#e2e8f0;
  --tx:#0f172a;--txm:#64748b;--txh:#94a3b8;
  --bg:#f1f5f9;--card:#ffffff;
  --shadow:0 2px 12px rgba(0,0,0,.07);
  --shadow-lg:0 8px 30px rgba(0,0,0,.13);
}
body.noche{
  --bg:#0f172a;--card:#1e293b;
  --gray:#273449;--grayb:#334155;
  --tx:#f1f5f9;--txm:#94a3b8;--txh:#7c8aa0;
  --g:#4ade80;--gd:#4ade80;--gm:#22c55e;--gl:#143524;--gx:#143524;
  --r:#f87171;--rd:#f87171;--rl:#3a1f1f;
  --a:#fbbf24;--ad:#fbbf24;--al:#3a2f14;
  --p:#a78bfa;--pd:#a78bfa;--pl:#2a2246;
  --b:#38bdf8;--bd:#38bdf8;--bl:#163049;
  --shadow:0 2px 12px rgba(0,0,0,.45);--shadow-lg:0 10px 34px rgba(0,0,0,.6);
}
*{box-sizing:border-box;margin:0;padding:0;-webkit-tap-highlight-color:transparent}
html,body{height:100%;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--bg);color:var(--tx)}

/* LOGIN */
#ls{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:100vh;padding:24px;background:#071810;--bg:#f1f5f9;--card:#ffffff;--gray:#f8fafc;--grayb:#e2e8f0;--tx:#0f172a;--txm:#64748b;--txh:#94a3b8}
.llogo{font-size:32px;font-weight:800;color:#fff;margin-bottom:6px;letter-spacing:-1px;display:flex;align-items:center;gap:10px}
.llogo-ico{display:none}
.llogo span{color:#22c55e}
.lsub{color:rgba(255,255,255,.4);font-size:11px;margin-bottom:28px;letter-spacing:1.5px;text-transform:uppercase}
.lcard{background:var(--card);border-radius:28px;padding:30px 24px;width:100%;max-width:380px;box-shadow:0 20px 60px rgba(0,0,0,.3)}
.lroles{display:flex;flex-direction:column;gap:10px;margin-bottom:22px}
.lrole{padding:16px 18px;border-radius:16px;border:2px solid var(--grayb);cursor:pointer;display:flex;align-items:center;gap:14px;transition:all .2s;background:var(--card)}
.lrole:active{transform:scale(.98)}
.lrole.sel{border-color:#22c55e;background:#f0fdf4;box-shadow:0 0 0 3px rgba(34,197,94,.12)}
.lrico{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.ico-m{background:#dcfce7;color:#15803d}
.ico-o{background:#ede9fe;color:#7c3aed}
.lrname{font-size:16px;font-weight:700;color:var(--tx)}
.lrdesc{font-size:12px;color:var(--txm);margin-top:2px}
.lpilab{font-size:11px;font-weight:700;color:var(--txm);margin-bottom:8px;display:block;text-transform:uppercase;letter-spacing:.6px}
.lpi{width:100%;padding:16px;font-size:28px;letter-spacing:12px;border:2px solid var(--grayb);border-radius:16px;text-align:center;outline:none;color:var(--tx);background:var(--gray);transition:all .2s}
.lpi:focus{border-color:#22c55e;background:var(--card);box-shadow:0 0 0 4px rgba(34,197,94,.1)}
.lbtn{width:100%;padding:16px;background:#16a34a;color:#fff;border:none;border-radius:16px;font-size:17px;font-weight:700;cursor:pointer;margin-top:14px;box-shadow:0 4px 15px rgba(22,163,74,.4)}
.lbtn:active{opacity:.92;transform:scale(.99)}.lerr{color:#ef4444;font-size:13px;text-align:center;margin-top:10px;min-height:18px;font-weight:600}

/* APP */
#app{display:none;flex-direction:column;height:100vh;max-width:520px;margin:0 auto;background:#f1f5f9;overflow:hidden}

/* TOPBAR */
.topbar{display:flex;align-items:center;justify-content:space-between;padding:13px 18px 11px;background:#071810;flex-shrink:0;box-shadow:0 2px 12px rgba(0,0,0,.25)}
.tbrand{font-size:19px;font-weight:800;letter-spacing:-.5px;display:flex;align-items:center;gap:8px}
.tbrand-dot{width:8px;height:8px;background:#22c55e;border-radius:50%}
.tbrand span{color:#22c55e}
.tright{display:flex;align-items:center;gap:8px}
.chip{font-size:11px;padding:5px 12px;border-radius:20px;font-weight:700}
.chip-m{background:rgba(34,197,94,.18);color:#86efac}
.chip-o{background:rgba(139,92,246,.18);color:#c4b5fd}
.btnout{background:rgba(255,255,255,.08);border:none;color:rgba(255,255,255,.6);font-size:19px;cursor:pointer;padding:7px;display:flex;align-items:center;border-radius:10px}
.btnout:active{background:rgba(255,255,255,.15)}

/* PAGES */
.pages{flex:1;overflow-y:auto;background:var(--bg)}
.page{display:none;padding:16px}.page.active{display:block}

/* NAV */
.bnav{display:flex;border-top:1px solid var(--grayb);background:var(--card);flex-shrink:0;padding-bottom:env(safe-area-inset-bottom,0);box-shadow:0 -4px 16px rgba(0,0,0,.06)}
.ni{flex:1;display:flex;flex-direction:column;align-items:center;padding:10px 2px 8px;cursor:pointer;color:var(--txh);font-size:10px;font-weight:600;gap:3px;border:none;background:none;position:relative;transition:all .2s}
.ni i{font-size:22px;transition:all .2s}
.ni.active{color:#16a34a}.ni.active i{color:#16a34a;transform:scale(1.12)}
.ni.active::after{content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:28px;height:3px;background:#16a34a;border-radius:3px 3px 0 0}
.nbadge{position:absolute;top:7px;right:calc(50% - 20px);background:#ef4444;color:#fff;font-size:9px;font-weight:800;min-width:16px;height:16px;border-radius:8px;display:flex;align-items:center;justify-content:center;padding:0 3px;box-shadow:0 2px 6px rgba(239,68,68,.5)}

/* CARDS */
.card{background:var(--card);border-radius:20px;padding:16px;margin-bottom:12px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 4px 16px rgba(0,0,0,.04)}

/* METRIC GRID */
.mgrid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px}
.mc{border-radius:18px;padding:16px;position:relative;overflow:hidden;min-height:90px}

.mcl{font-size:10px;color:rgba(255,255,255,.75);margin-bottom:8px;font-weight:700;text-transform:uppercase;letter-spacing:.7px}
.mcv{font-size:22px;font-weight:800;line-height:1;color:#fff}
.mcs{font-size:11px;color:rgba(255,255,255,.55);margin-top:4px}
.mc-ico{position:absolute;bottom:10px;right:12px;font-size:32px;opacity:.15;color:#fff}

/* BIG BUTTONS */
.bigbtn{display:flex;align-items:center;gap:14px;padding:18px;background:var(--card);border:none;border-radius:18px;margin-bottom:10px;cursor:pointer;width:100%;text-align:left;box-shadow:0 1px 4px rgba(0,0,0,.06),0 4px 16px rgba(0,0,0,.04);transition:all .2s}
.bigbtn:active{background:var(--gray);transform:scale(.99)}
.bbico{width:52px;height:52px;border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0}
.bbtitle{font-size:16px;font-weight:700;color:var(--tx)}.bbsub{font-size:12px;color:var(--txm);margin-top:3px}

/* PILLS */
.pill{font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;white-space:nowrap}
.pok{background:var(--gl);color:var(--gd)}.pwarn{background:var(--al);color:var(--ad)}
.pbad{background:var(--rl);color:var(--rd)}.ppurp{background:var(--pl);color:var(--pd)}
.pgray{background:var(--gray);color:var(--txm)}.pblue{background:var(--bl);color:var(--bd)}

/* BUTTONS */
.abtn{padding:15px;border-radius:14px;font-size:15px;font-weight:700;cursor:pointer;border:none;display:flex;align-items:center;justify-content:center;gap:8px;width:100%;margin-top:10px;letter-spacing:.1px;transition:all .2s}
.abtn:active{opacity:.88;transform:scale(.98)}
.abtn-g{background:#16a34a;color:#fff;box-shadow:0 4px 14px rgba(22,163,74,.35)}
.abtn-r{background:var(--rl);color:var(--rd)}
.abtn-a{background:var(--gl);color:var(--gd);border:1.5px solid var(--gm)}
.abtn-gray{background:var(--gray);color:var(--tx);border:1.5px solid var(--grayb)}
.abtn-sm{padding:9px 14px;font-size:13px;margin-top:8px;border-radius:10px}
.abtn-blue{background:#2563eb;color:#fff;box-shadow:0 4px 14px rgba(37,99,235,.35)}

/* FORMS */
.fl{display:block;font-size:11px;font-weight:700;color:var(--txm);margin-bottom:6px;margin-top:14px;text-transform:uppercase;letter-spacing:.5px}
.fl:first-of-type{margin-top:0}
.fi{width:100%;padding:13px 14px;border:1.5px solid var(--grayb);border-radius:12px;font-size:15px;color:var(--tx);background:var(--gray);outline:none;appearance:none;transition:all .2s}
.fi:focus{border-color:#22c55e;background:var(--card);box-shadow:0 0 0 3px rgba(34,197,94,.12)}
.frow{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.stitle{font-size:11px;font-weight:700;color:var(--txh);text-transform:uppercase;letter-spacing:.6px;margin:18px 0 9px;display:flex;align-items:center;gap:7px}
.stitle:first-child{margin-top:0}
.stitle::after{content:'';flex:1;height:1px;background:var(--grayb)}

/* PROV GRID */
.prov-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px}
.prov-card{padding:22px 12px;border:2px solid var(--grayb);border-radius:18px;cursor:pointer;text-align:center;background:var(--card);transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.prov-card:active{transform:scale(.96)}
.prov-card.sel{border-color:#22c55e;background:var(--gl);box-shadow:0 0 0 3px rgba(34,197,94,.12)}
.prov-num{font-size:40px;font-weight:800;color:var(--g);line-height:1}
.prov-lbl{font-size:12px;color:var(--txm);margin-top:4px;font-weight:600}

/* TALLAS */
.trow{display:flex;align-items:center;gap:10px;padding:12px 0;border-bottom:1px solid var(--gray)}
.trow:last-child{border-bottom:none}
.tlab{font-size:16px;font-weight:700;width:80px;flex-shrink:0}
.tlab-und{font-size:11px;color:var(--txm);font-weight:600}
.tcant{display:flex;align-items:center;gap:12px;flex-shrink:0;margin-left:auto}
.cbtn{width:42px;height:42px;border-radius:12px;border:1.5px solid var(--grayb);background:var(--gray);font-size:24px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--tx);transition:all .15s}
.cbtn:active{background:#dcfce7;border-color:#22c55e;transform:scale(.92)}
.cval{font-size:22px;font-weight:800;min-width:36px;text-align:center}
.cval.pos{color:#16a34a}

/* STOCK TALLAS */
.tgrid{display:grid;grid-template-columns:repeat(5,1fr);gap:7px;margin-top:10px}
.tbox{background:var(--gray);border-radius:12px;padding:9px 4px;text-align:center;border:1px solid var(--grayb)}
.tbox-lab{font-size:11px;color:var(--txm);font-weight:700;margin-bottom:2px}
.tbox-und{font-size:9px;color:var(--txh);font-weight:600;margin-top:1px}
.tbox-val{font-size:20px;font-weight:800}

/* LIST ITEMS */
.li{display:flex;align-items:flex-start;gap:12px;padding:12px 0;border-bottom:1px solid var(--gray)}
.li:last-child{border-bottom:none;padding-bottom:0}.li:first-child{padding-top:0}
.liico{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0}
.ig{background:var(--gl);color:var(--gd)}.ia{background:var(--al);color:var(--ad)}
.ir{background:var(--rl);color:var(--rd)}.ip{background:var(--pl);color:var(--pd)}
.ib{background:var(--bl);color:var(--bd)}.igr{background:var(--gray);color:var(--txm)}
.libody{flex:1;min-width:0}
.liname{font-size:14px;font-weight:700;color:var(--tx)}
.lisub{font-size:12px;color:var(--txm);margin-top:2px;line-height:1.4}
.liright{text-align:right;flex-shrink:0}

/* MODAL */
.mbg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:100;align-items:flex-end;justify-content:center;backdrop-filter:blur(4px)}
#m-scan{z-index:120}
#m-scan-add,#m-scan-asociar{z-index:110}
.mbg.open{display:flex}
.modal{background:var(--card);border-radius:28px 28px 0 0;padding:22px 20px 36px;width:100%;max-width:520px;max-height:92vh;overflow-y:auto}
.modal-handle{width:40px;height:4px;background:var(--grayb);border-radius:2px;margin:0 auto 18px}
.mtitle{font-size:18px;font-weight:800;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between}
.mclose{background:var(--gray);border:none;font-size:20px;color:var(--txm);cursor:pointer;display:flex;align-items:center;padding:7px;border-radius:10px}
.mclose:active{background:var(--grayb)}

/* ALERT BOX */
.abox{border-radius:16px;padding:14px 16px;margin-bottom:10px;display:flex;align-items:center;gap:13px}
.abox-r{background:var(--rl)}.abox-a{background:var(--al)}.abox-g{background:var(--gl)}.abox-p{background:var(--pl)}
.abox i{font-size:24px;flex-shrink:0}
.abox-r i{color:var(--rd)}.abox-a i{color:var(--ad)}.abox-g i{color:var(--gd)}.abox-p i{color:var(--pd)}
.abox-title{font-size:14px;font-weight:700}
.abox-r .abox-title{color:var(--rd)}.abox-a .abox-title{color:var(--ad)}.abox-g .abox-title{color:var(--gd)}.abox-p .abox-title{color:var(--pd)}
.abox-sub{font-size:12px;opacity:.75;margin-top:2px}

/* SEARCH */
.swrap{position:relative;margin-bottom:12px}
.swrap i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--txh);font-size:17px}
.sinput{width:100%;padding:12px 14px 12px 40px;border:1.5px solid var(--grayb);border-radius:14px;font-size:14px;color:var(--tx);background:var(--card);outline:none;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.sinput:focus{border-color:#22c55e}

/* FBAR */
.fbar{display:flex;gap:8px;margin-bottom:14px;overflow-x:auto;padding-bottom:4px}
.fbar::-webkit-scrollbar{display:none}
.ftag{padding:8px 16px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;border:none;white-space:nowrap;background:var(--card);color:var(--txm);flex-shrink:0;box-shadow:0 1px 4px rgba(0,0,0,.08)}
.ftag.on{background:#16a34a;color:#fff}

/* PROGRESS */
.pbar{height:7px;background:#e2e8f0;border-radius:4px;overflow:hidden;margin-top:6px}
.pfill{height:100%;border-radius:4px}

/* TOAST */
#toast{position:fixed;bottom:88px;left:50%;transform:translateX(-50%) translateY(14px);background:#0f172a;color:#fff;padding:11px 22px;border-radius:22px;font-size:13px;font-weight:600;opacity:0;transition:opacity .25s,transform .25s;z-index:999;white-space:nowrap;pointer-events:none;box-shadow:0 8px 24px rgba(0,0,0,.2)}
#toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.empty{text-align:center;padding:44px 20px;color:var(--txm)}
.empty i{font-size:44px;margin-bottom:12px;display:block;color:var(--txh)}
.empty p{font-size:14px;font-weight:500}
.sep{height:1px;background:var(--gray);margin:8px 0}

/* UND BADGE */
.und{font-size:10px;font-weight:700;color:var(--txh);letter-spacing:.3px}

/* ── DARK MODE ───────────────────────────────────────────────────────────── */

/* ── HERO GREETING ───────────────────────────────────────────────────────── */
.hero-card{
  border-radius:22px;padding:22px 20px 20px;margin-bottom:16px;
  position:relative;overflow:hidden;color:#fff;
  background:linear-gradient(135deg,#052e16 0%,#14532d 50%,#166534 100%);
}
.hero-card::before{
  content:'';position:absolute;width:200px;height:200px;border-radius:50%;
  background:rgba(255,255,255,.04);top:-60px;right:-40px;pointer-events:none
}
.hero-card::after{
  content:'⚽';position:absolute;right:18px;bottom:-10px;
  font-size:80px;opacity:.08;line-height:1;pointer-events:none
}
.hero-hora{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:10px}
.hero-saludo{font-size:24px;font-weight:800;margin-bottom:4px;line-height:1.2;letter-spacing:-.3px}
.hero-sub{font-size:13px;color:rgba(255,255,255,.6);line-height:1.5;margin-bottom:16px}
.hero-badge{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(255,255,255,.1);backdrop-filter:blur(4px);
  border:1px solid rgba(255,255,255,.12);
  border-radius:20px;padding:5px 14px;font-size:12px;font-weight:700;
  letter-spacing:.3px
}

/* ── METRIC CARDS ─────────────────────────────────────────────────────────── */
.mgrid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px}
.mc{border-radius:16px;padding:16px;position:relative;overflow:hidden;min-height:90px}
.mc-g{background:linear-gradient(145deg,#14532d,#15803d)}
.mc-r{background:linear-gradient(145deg,#7f1d1d,#991b1b)}
.mc-p{background:linear-gradient(145deg,#4c1d95,#5b21b6)}
.mc-b{background:linear-gradient(145deg,#1e3a8a,#1d4ed8)}
.mc-a{background:linear-gradient(145deg,#78350f,#92400e)}
.mc-cyan{background:linear-gradient(145deg,#164e63,#0e7490)}
.mc::after{content:'';position:absolute;width:70px;height:70px;border-radius:50%;background:rgba(255,255,255,.06);bottom:-20px;right:-15px}
.mcl{font-size:10px;color:rgba(255,255,255,.6);margin-bottom:6px;font-weight:700;text-transform:uppercase;letter-spacing:.7px}
.mcv{font-size:26px;font-weight:800;line-height:1;color:#fff}
.mcs{font-size:11px;color:rgba(255,255,255,.5);margin-top:4px}
.mc-ico{position:absolute;bottom:10px;right:12px;font-size:26px;opacity:.15;color:#fff}

/* ── QUICK ACTIONS ────────────────────────────────────────────────────────── */
.bigbtn{transition:all .18s}
.bigbtn:active{transform:scale(.985)}


/* ══ RESPONSIVE: la app se adapta a escritorio. En móvil (< 860px) NO cambia nada. ══ */
#app.on{display:flex}
@media (min-width:860px){
  #app.on{
    max-width:1320px;
    display:grid;
    grid-template-columns:240px 1fr;
    grid-template-rows:auto 1fr;
    grid-template-areas:"top top" "nav main";
    border-left:1px solid var(--grayb);
    border-right:1px solid var(--grayb);
  }
  .topbar{grid-area:top}
  .pages{grid-area:main;min-height:0;overflow-x:hidden}
  .bnav{
    grid-area:nav;
    flex-direction:column;
    align-items:stretch;
    justify-content:flex-start;
    border-top:none;
    border-right:1px solid var(--grayb);
    padding:16px 12px;
    gap:3px;
  }
  .ni{
    flex:none;
    flex-direction:row;
    justify-content:flex-start;
    gap:13px;
    padding:12px 16px;
    border-radius:11px;
    font-size:14px;
    position:relative;
  }
  .ni i{font-size:21px}
  .ni.active{background:var(--gl,#dcfce7)}
  .ni.active::after{display:none}
  .nbadge{top:50%;right:14px;transform:translateY(-50%)}
  .page{padding:28px 40px;max-width:1080px;margin:0 auto}
  .mgrid{grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px}
  .stock-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:14px;align-items:start}
  .stock-grid .card{margin-bottom:0}
  .acc-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  .acc-grid .bigbtn{margin-bottom:0}
  .dash2{display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:start}
  .dash2 .stitle:first-child{margin-top:0}
  .ventas-lista{display:grid;grid-template-columns:repeat(auto-fit,minmax(360px,1fr));gap:10px;padding:10px}
  .ventas-lista .li{border-bottom:none;background:var(--gray);border-radius:12px;padding:12px}
  /* Modales como diálogo centrado en PC (no hoja pegada abajo) */
  .mbg{align-items:center}
  .modal{border-radius:20px;max-width:560px;padding:24px 24px 26px;max-height:88vh}
  #m-carrito .modal{max-width:960px}
  #m-carrito .cart-cols{display:grid;grid-template-columns:1fr 1fr;gap:26px;align-items:start}
  #m-carrito .cart-left>.stitle:first-child,#m-carrito .cart-right>.stitle:first-child{margin-top:0}
  .modal-handle{display:none}
}
</style>
</head>
<body>

<!-- LOGIN -->
<div id="ls">
  <div style="margin-bottom:8px">
    <img src="data:image/png;base64,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" alt="Fútbol Emotion" style="height:72px;object-fit:contain;background:var(--card);border-radius:14px;padding:8px 18px">
  </div>
  <div class="lsub">Sistema de gestión interno</div>
  <div class="lcard">
    <label class="lpilab">¿Quién eres?</label>
    <div class="lroles">
      <div class="lrole" id="lr-m" onclick="selRole('manager')">
        <div class="lrico ico-m"><i class="ti ti-user"></i></div>
        <div><div class="lrname">Soy el encargado</div><div class="lrdesc">Gestiono stock, pedidos y envíos</div></div>
      </div>
      <div class="lrole" id="lr-o" onclick="selRole('owner')">
        <div class="lrico ico-o"><i class="ti ti-crown"></i></div>
        <div><div class="lrname">Soy el dueño</div><div class="lrdesc">Apruebo pedidos y veo todo</div></div>
      </div>
    </div>
    <label class="lpilab">PIN de acceso</label>
    <input class="lpi" type="password" id="lpin" placeholder="••••" maxlength="4" inputmode="numeric">
    <button class="lbtn" onclick="doLogin()">Entrar</button>
    <div class="lerr" id="lerr"></div>
  </div>
</div>

<!-- APP -->
<div id="app">
  <div class="topbar">
    <div class="tbrand" style="display:flex;align-items:center"><img src="data:image/png;base64,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" alt="Fútbol Emotion" style="height:28px;object-fit:contain"></div>
    <div class="tright">
      <span class="chip" id="rchip"></span>
      <button class="btnout" id="hdr-calc" onclick="abrirCalc()" title="Calculadora"><i class="ti ti-calculator"></i></button>
      <button class="btnout" id="hdr-tema" onclick="toggleTema()" title="Modo día/noche"><i class="ti ti-moon"></i></button>
      <button class="btnout" id="hdr-hist" onclick="goTo('historial')" style="display:none;position:relative"><i class="ti ti-bell"></i></button>
      <button class="btnout" id="hdr-push-mgr" onclick="abrirPushModal()" style="display:none"><i class="ti ti-bell"></i></button>
      <button class="btnout" id="hdr-ajustes" onclick="goTo('ajustes')" style="display:none"><i class="ti ti-settings"></i></button>
      <button class="btnout" onclick="doLogout()"><i class="ti ti-logout"></i></button>
    </div>
  </div>
  <div class="pages">

    <div class="page active" id="page-home"><div id="home-c"></div></div>
    <div class="page" id="page-pedido"><div id="ped-c"></div></div>
    <div class="page" id="page-stock"><div id="stk-c"></div></div>
    <div class="page" id="page-envios"><div id="env-c"></div></div>
    <div class="page" id="page-dev"><div id="dev-c"></div></div>
    <div class="page" id="page-ventas"><div id="ven-c"></div></div>
    <div class="page" id="page-aprobar"><div id="apr-c"></div></div>
    <div class="page" id="page-fin"><div id="fin-c"></div></div>
    <div class="page" id="page-verstock"><div id="vs-c"></div></div>
    <div class="page" id="page-misventas"><div id="mv-c"></div></div>
    <div class="page" id="page-caja"><div id="caja-c"></div></div>
    <div class="page" id="page-ajustes"><div id="aj2-c"></div></div>
    <div class="page" id="page-historial"><div id="hist-c"></div></div>
    <div class="page" id="page-clientes"><div id="cli-c"></div></div>
    <div class="page" id="page-nomina"><div id="nom-c"></div></div>
    <div class="page" id="page-mas"><div id="mas-c"></div></div>
    <div class="page" id="page-dashboard"><div id="dash-c"></div></div>

  </div>
  <div class="bnav" id="bnav"></div>
</div>

<!-- MODAL: NUEVO ENVÍO -->
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

<!-- MODAL: CALCULADORA (general) -->
<div class="mbg" id="m-calcgen">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle">Calculadora <button class="mclose" onclick="closeM('m-calcgen')"><i class="ti ti-x"></i></button></div>
    <div id="calc-display" style="background:var(--tx);color:#fff;border-radius:14px;padding:18px 16px;text-align:right;font-size:30px;font-weight:800;min-height:34px;word-break:break-all;line-height:1.15">0</div>
    <div id="calc-keys" style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-top:12px"></div>
    <div style="font-size:12px;color:var(--txm);margin-top:12px;text-align:center">Solo para hacer cuentas. No registra ninguna venta.</div>
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
      <button onclick="exportarReporte('pdf')" style="padding:18px 10px;border-radius:12px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:14px;font-weight:800;color:var(--txd);display:flex;flex-direction:column;align-items:center;gap:8px">
        <i class="ti ti-file-type-pdf" style="font-size:32px;color:#e5484d"></i>PDF
        <span style="font-size:11px;font-weight:600;color:var(--txm)">Para imprimir o enviar</span>
      </button>
      <button onclick="exportarReporte('excel')" style="padding:18px 10px;border-radius:12px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:14px;font-weight:800;color:var(--txd);display:flex;flex-direction:column;align-items:center;gap:8px">
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
    <div class="cart-cols">
    <div class="cart-left">
    <label class="fl">Tipo de venta</label>
    <div style="display:flex;gap:8px;margin-bottom:10px">
      <button id="cart-tipo-tienda" onclick="carritoTipoSet('tienda')">Tienda física</button>
      <button id="cart-tipo-online" onclick="carritoTipoSet('online')">Online</button>
    </div>
    <div id="cart-cliente-wrap" style="display:none;margin-bottom:6px">
      <label class="fl">Cliente</label>
      <input class="fi" id="cart-cliente" placeholder="Nombre del cliente" oninput="carritoActualizarConfirm()">
      <div class="frow" style="margin-top:8px">
        <div><label class="fl" style="margin-top:0">Cédula (opcional)</label><input class="fi" id="cart-cedula" placeholder="Ej: V-12345678" maxlength="20"></div>
        <div><label class="fl" style="margin-top:0">Teléfono (opcional)</label><input class="fi" id="cart-telefono" inputmode="tel" placeholder="Ej: 0414 0000000" maxlength="20"></div>
      </div>
      <label class="fl" style="margin-top:8px">Canal</label>
      <select class="fi" id="cart-canal"><option>Instagram</option><option>WhatsApp</option><option>Web</option></select>
    </div>
    <div class="stitle">Agregar producto</div>
    <button class="abtn abtn-g abtn-sm" onclick="escanearParaCarrito()" style="margin-top:0;margin-bottom:8px"><i class="ti ti-scan"></i> Escanear código</button>
    <input class="fi" id="cart-cam-search" placeholder="Buscar camiseta…" autocomplete="off" oninput="carritoBuscarCam()" onfocus="carritoBuscarCam()" onblur="setTimeout(()=>{const l=document.getElementById('cart-cam-list');if(l)l.style.display='none'},180)">
    <div id="cart-cam-list" style="display:none;margin-top:4px;border:1.5px solid var(--grayb);border-radius:12px;overflow:hidden;max-height:230px;overflow-y:auto"></div>
    <select class="fi" id="cart-cam" onchange="carritoAutoPrecio()" style="display:none"></select>
    <select class="fi" id="cart-talla" style="margin-top:8px" onchange="carritoStockInfo()"><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option><option>10</option><option>12</option><option>14</option><option>16</option><option>U</option></select>
    <div id="cart-stock-info" style="font-size:12px;margin-top:6px"></div>
    <div style="display:flex;gap:8px;margin-top:8px">
      <div style="flex:1"><label class="fl">Cantidad</label><input class="fi" id="cart-cant" type="number" min="1" value="1"></div>
      <div style="flex:1"><label class="fl">Precio ($ c/u)</label><input class="fi" id="cart-precio" type="number" min="0" step="0.01"></div>
    </div>
    <button class="abtn abtn-gray abtn-sm" onclick="carritoAgregarProducto()" style="margin-top:8px"><i class="ti ti-plus"></i> Agregar al carrito</button>
    </div>
    <div class="cart-right">
    <div class="stitle">Carrito</div>
    <div id="cart-items"></div>
    <div id="cart-desc-row" style="display:flex;gap:8px;align-items:center;margin-top:8px">
      <span style="font-size:12.5px;font-weight:700;color:var(--txm);white-space:nowrap"><i class="ti ti-discount-2"></i> Descuento</span>
      <input class="fi" id="cart-desc-val" type="number" min="0" step="0.01" inputmode="decimal" placeholder="0" oninput="carritoSetDescVal(this.value)" style="flex:1">
      <select class="fi" id="cart-desc-tipo" onchange="carritoSetDescTipo(this.value)" style="width:64px"><option value="pct">%</option><option value="monto">$</option></select>
    </div>
    <div class="stitle">Pago dividido</div>
    <div id="cart-pagos"></div>
    <button class="abtn abtn-gray abtn-sm" onclick="carritoAgregarPago()" style="margin-top:6px"><i class="ti ti-plus"></i> Agregar método de pago</button>
    <div id="cart-resumen-pago"></div>
    <div style="font-size:11.5px;color:var(--txh);margin-top:8px;padding:0 2px"><i class="ti ti-info-circle"></i> En efectivo, escribe lo que te dio el cliente; el vuelto se calcula solo.</div>
    <button class="abtn abtn-g" id="cart-confirm" onclick="confirmarCarrito()" style="margin-top:14px;opacity:.4;pointer-events:none"><i class="ti ti-check"></i> Registrar venta</button>
    </div>
    </div>
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
        style="padding:14px;border-radius:12px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:14px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:6px">
        <i class="ti ti-building-store" style="font-size:26px"></i>Tienda física
      </button>
      <button id="tipo-envio" onclick="setTipoVenta('envio')"
        style="padding:14px;border-radius:12px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:14px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:6px">
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
          style="padding:11px;border-radius:10px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:13px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:5px">
          <i class="ti ti-pencil" style="font-size:22px"></i>Escribir
        </button>
        <button id="modo-stock" onclick="setModoVenta('stock')"
          style="padding:11px;border-radius:10px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:13px;font-weight:700;color:var(--txm);display:flex;flex-direction:column;align-items:center;gap:5px">
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
          <input class="fi" id="v-monto-bs" type="number" min="0" step="0.01" style="font-size:18px;font-weight:800;padding:8px 10px;background:var(--card)">
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
      <button type="button" id="d-dev-modo-txt" onclick="setDevModo('dev','txt')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--grayb);background:var(--card);color:var(--txm)">Escribir</button>
    </div>
    <select class="fi" id="d-dev-cam" onchange="fillTallasDev('dev')" style="margin-bottom:6px"></select>
    <select class="fi" id="d-dev-talla"></select>
    <input class="fi" id="d-dev" placeholder="Ej: Barça Local M 24/25" style="display:none">

    <label class="fl">Camiseta que quiere <span style="font-size:11px;color:var(--txh)">(sale del stock)</span></label>
    <div style="display:flex;gap:6px;margin-bottom:5px">
      <button type="button" id="d-sol-modo-inv" onclick="setDevModo('sol','inv')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--gm);background:var(--gl);color:var(--gd)">Del inventario</button>
      <button type="button" id="d-sol-modo-txt" onclick="setDevModo('sol','txt')" style="flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid var(--grayb);background:var(--card);color:var(--txm)">Escribir</button>
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
      <div id="tx-cat-wrap"><label class="fl">Categoría</label><select class="fi" id="tx-cat"><option>Servicios</option><option>Transporte</option><option>Local</option><option>Retiros</option><option>Otros</option></select></div>
      <div id="tx-canal-wrap" style="display:none"><label class="fl">Canal</label><select class="fi" id="tx-canal"><option>Tienda física</option><option>Instagram</option><option>WhatsApp</option><option>Web</option><option>Otro</option></select></div>
    </div>
    <button class="abtn abtn-g" onclick="saveTx()" id="tx-save-btn"><i class="ti ti-check"></i> Guardar</button>
  </div>
</div>

<!-- MODAL: NÓMINA -->
<div class="mbg" id="m-nomina">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle"><span>Pagar al personal</span> <button class="mclose" onclick="closeM('m-nomina')"><i class="ti ti-x"></i></button></div>
    <div id="nomina-body"></div>
  </div>
</div>

<!-- MODAL: FICHA CLIENTE -->
<div class="mbg" id="m-cliente">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="mtitle"><span id="cli-ficha-nom">Cliente</span> <button class="mclose" onclick="closeM('m-cliente')"><i class="ti ti-x"></i></button></div>
    <div id="cli-ficha-body"></div>
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
      <button type="button" id="nc-chip-otro" onclick="setCatProducto('otro')" style="padding:11px;border-radius:11px;border:2px solid var(--grayb);background:var(--card);cursor:pointer;font-size:13px;font-weight:800;color:var(--txm)">📦 Otro producto</button>
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

<div id="toast"></div>

<script>
// ── CONFIGURACIÓN DEL SERVIDOR ────────────────────────────────────────────────
// Cuando tengas el servidor, cambia null por la URL:
// Ejemplo: const SERVIDOR = 'http://tudominio.com'
const SERVIDOR = window.location.origin;
const MODO_SERVIDOR = !!SERVIDOR;

// Zona horaria de la tienda: TODAS las fechas del frontend se calculan en Venezuela,
// igual que el backend (Laravel = America/Caracas). Antes se usaba UTC y el día se
// adelantaba después de las 8pm. 'en-CA' formatea como YYYY-MM-DD.
const TZ = 'America/Caracas';
const fechaISO = (d = new Date()) => d.toLocaleDateString('en-CA', { timeZone: TZ });

// ── CAPA DE DATOS (localStorage o Laravel según el modo) ──────────────────────
const ld=(k,d)=>{try{return JSON.parse(localStorage.getItem('fe4_'+k))||d}catch{return d}};
const sd=(k,v)=>localStorage.setItem('fe4_'+k,JSON.stringify(v));

// Lee el valor de una cookie por nombre
function getCookie(nombre){
  const match = document.cookie.match(new RegExp('(^| )'+nombre+'=([^;]+)'));
  return match ? decodeURIComponent(match[2]) : null;
}

// Prepara la cookie de seguridad CSRF que exige Laravel Sanctum (una vez por carga de página)
let csrfListo = null;
async function asegurarCSRF(){
  if(!MODO_SERVIDOR) return;
  if(!csrfListo){
    csrfListo = fetch(SERVIDOR+'/sanctum/csrf-cookie', {credentials:'include'});
  }
  await csrfListo;
}

// Llamadas al API de Laravel
async function apiCall(method, endpoint, data=null){
  if(MODO_SERVIDOR) await asegurarCSRF();
  const opts={
    method,
    headers:{'Content-Type':'application/json','Accept':'application/json'},
    credentials:'include',
  };
  const xsrf = getCookie('XSRF-TOKEN');
  if(xsrf) opts.headers['X-XSRF-TOKEN']=xsrf;
  if(data) opts.body=JSON.stringify(data);
  let res;
  try{
    res=await fetch(SERVIDOR+'/api'+endpoint, opts);
  }catch(e){
    toast('Sin conexión con el servidor — revisa tu internet');
    throw e;
  }
  let json={};
  try{ json=await res.json(); }catch(e){}
  if(!res.ok){
    // Laravel responde {error} en nuestros controladores o {message, errors} en validaciones
    let msg=json.error||json.message||('Error del servidor ('+res.status+')');
    if(json.errors){ const first=Object.values(json.errors)[0]; if(first&&first[0]) msg=first[0]; }
    toast(msg);
    const err=new Error(msg); err.mostrado=true; throw err;
  }
  return json;
}

// ── DATOS ────────────────────────────────────────────────────────────────────
// Los PINs viven en el servidor (variables de entorno). Nunca en el código.
// ── MARCA (white-label) ────────────────────────────────
// Para entregar la app a un cliente nuevo, cambia SOLO estas dos líneas:
const MARCA = {
  nombre: 'Fútbol Emotion',   // nombre visible (título de la app y al instalar)
  color:  '#16a34a',          // color principal de la marca (hex). Déjalo así = verde actual.
};
// (El logo se cambia aparte: la imagen del encabezado + los archivos icon-192.png / icon-512.png)
function _mHex(h){h=h.replace('#','');return [parseInt(h.slice(0,2),16),parseInt(h.slice(2,4),16),parseInt(h.slice(4,6),16)];}
function _mRgb(a){return '#'+a.map(x=>Math.max(0,Math.min(255,Math.round(x))).toString(16).padStart(2,'0')).join('');}
function _mMix(hex,t,amt){const a=_mHex(hex),b=_mHex(t);return _mRgb(a.map((x,i)=>x+(b[i]-x)*amt));}
function aplicarMarca(){
  try{
    document.title = MARCA.nombre;
    const logo=document.querySelector('.tbrand img'); if(logo) logo.alt=MARCA.nombre;
    // Solo recolorea si el color cambió (así el verde original queda idéntico por defecto)
    if(MARCA.color && MARCA.color.toLowerCase()!=='#16a34a'){
      const c=MARCA.color, r=document.documentElement.style;
      r.setProperty('--g',  c);
      r.setProperty('--gd', _mMix(c,'#000000',0.16));
      r.setProperty('--gm', _mMix(c,'#ffffff',0.10));
      r.setProperty('--gl', _mMix(c,'#ffffff',0.86));
      r.setProperty('--gx', _mMix(c,'#ffffff',0.70));
      const tc=document.querySelector('meta[name="theme-color"]'); if(tc) tc.content=c;
      const dot=document.querySelector('.tbrand-dot'); if(dot) dot.style.background=c;
    }
  }catch(e){}
}
aplicarMarca();
function toggleTema(){ const noche=!document.body.classList.contains('noche'); document.body.classList.toggle('noche',noche); try{localStorage.setItem('tema',noche?'noche':'dia');}catch(e){} const b=document.getElementById('hdr-tema'); if(b) b.innerHTML='<i class="ti ti-'+(noche?'sun':'moon')+'"></i>'; }
function aplicarTema(){ let t='dia'; try{t=localStorage.getItem('tema')||'dia';}catch(e){} const noche=(t==='noche'); document.body.classList.toggle('noche',noche); const b=document.getElementById('hdr-tema'); if(b) b.innerHTML='<i class="ti ti-'+(noche?'sun':'moon')+'"></i>'; }
aplicarTema();

// ── Registrar service worker (necesario para instalar la app y para push) ──
if('serviceWorker' in navigator){
  window.addEventListener('load', ()=>{
    navigator.serviceWorker.register('/sw.js').catch(()=>{});
  });
}

let CONFIG={proveedor_1:'',proveedor_2:'',proveedor_3:'',proveedor_4:'',manager_bloqueado:'0'};
function nombreRol(r=role){
  const nom=(r==='owner'?CONFIG.nombre_owner:CONFIG.nombre_manager)||'';
  if(nom.trim()) return nom.trim();
  return r==='manager'?'Encargado':'Dueño';
}
function nombreProv(n){
  const nom=(CONFIG['proveedor_'+n]||'').trim();
  return (role==='owner'&&nom) ? nom : 'Proveedor '+n;
}
const TALLAS=['S','M','L','XL','XXL','10','12','14','16']; // adulto + niño
const TALLAS_TODAS=[...TALLAS,'U']; // U = talla Única (productos que no son camisetas)
let catProducto='camiseta';
function esCamiseta(c){ return !c.categoria || c.categoria==='camiseta'; }
function tallasDe(c){ return esCamiseta(c) ? TALLAS : ['U']; }
function nombreProducto(c){
  if(esCamiseta(c)) return `${c.equipo} ${c.tipo} ${c.temp}`;
  const cat=(c.categoria||'').trim();
  return (!cat || cat.toLowerCase()===String(c.equipo).trim().toLowerCase()) ? c.equipo : `${c.equipo} (${cat})`;
}
function setCatProducto(cat){
  catProducto=cat;
  const esCam=cat==='camiseta';
  document.getElementById('nc-chip-cam').style.cssText='padding:11px;border-radius:11px;cursor:pointer;font-size:13px;font-weight:800;'+(esCam?'border:2px solid var(--g);background:var(--gl);color:var(--gd)':'border:2px solid var(--grayb);background:var(--card);color:var(--txm)');
  document.getElementById('nc-chip-otro').style.cssText='padding:11px;border-radius:11px;cursor:pointer;font-size:13px;font-weight:800;'+(!esCam?'border:2px solid var(--g);background:var(--gl);color:var(--gd)':'border:2px solid var(--grayb);background:var(--card);color:var(--txm)');
  document.getElementById('nc-cat-wrap').style.display=esCam?'none':'block';
  document.getElementById('nc-camposcam').style.display=esCam?'grid':'none';
  document.getElementById('nc-tallas-cam').style.display=esCam?'block':'none';
  document.getElementById('nc-tallas-otro').style.display=esCam?'none':'block';
  document.getElementById('nc-lbl-nombre').textContent=esCam?'Equipo / Club':'Nombre del producto';
  document.getElementById('nc-equipo').placeholder=esCam?'Ej: Real Madrid, Barça, España…':'Ej: Balón Champions, Medias blancas…';
  actualizarTotalNC();
}
let role=null, curPage='';

let camisetas=ld('camisetas',[
  {id:1,equipo:'Real Madrid',temp:'24/25',tipo:'Local',tallas:{S:12,M:20,L:18,XL:8,XXL:3},min:5,prov:1},
  {id:2,equipo:'FC Barcelona',temp:'24/25',tipo:'Local',tallas:{S:8,M:15,L:4,XL:2,XXL:1},min:5,prov:2},
  {id:3,equipo:'Atlético de Madrid',temp:'24/25',tipo:'Local',tallas:{S:2,M:3,L:2,XL:1,XXL:0},min:5,prov:2},
  {id:4,equipo:'Selección España',temp:'24/25',tipo:'Local',tallas:{S:15,M:25,L:20,XL:10,XXL:4},min:8,prov:1},
  {id:5,equipo:'Manchester City',temp:'24/25',tipo:'Local',tallas:{S:4,M:6,L:5,XL:2,XXL:0},min:4,prov:3},
]);
let pedidos=ld('pedidos',[]);
let envios=ld('envios',[
  {id:1,cliente:'Manuel Torres',prods:'Real Madrid Local L 24/25',origen:'Instagram',trans:'MRW',dir:'Calle Mayor 5, Madrid',imp:89.99,estado:'ruta',notas:'',fecha:'2026-06-25'},
  {id:2,cliente:'Claudia Martín',prods:'Barça Local M 24/25 x2',origen:'WhatsApp',trans:'SEUR',dir:'Av. Diagonal 88, Barcelona',imp:179.98,estado:'preparando',notas:'Envolver para regalo',fecha:'2026-06-25'},
  {id:3,cliente:'Diego Sánchez',prods:'España Local XL 24/25',origen:'Tienda física',trans:'Recogida en tienda',dir:'',imp:94.99,estado:'entregado',notas:'',fecha:'2026-06-23'},
]);
let devoluciones=ld('devoluciones',[
  {id:1,cliente:'Laura Pérez',motivo:'Talla incorrecta',dev:'Barça Local M 24/25',sol:'Barça Local L 24/25',imp:89.99,estado:'pendiente',fecha:'2026-06-24'},
]);
let ventas=ld('ventas',[
  {id:1,camId:4,equipo:'Selección España Local 24/25',talla:'L',cant:1,canal:'Tienda física',imp:94.99,fecha:'2026-06-25'},
  {id:2,camId:2,equipo:'FC Barcelona Local 24/25',talla:'M',cant:2,canal:'Instagram',imp:179.98,fecha:'2026-06-24'},
  {id:3,camId:1,equipo:'Real Madrid Local 24/25',talla:'L',cant:1,canal:'WhatsApp',imp:89.99,fecha:'2026-06-23'},
]);
let transacciones=ld('transacciones',[
  {id:1,tipo:'ingreso',desc:'Venta España Local L',imp:94.99,canal:'Tienda física',fecha:'2026-06-25'},
  {id:2,tipo:'gasto',desc:'Pedido Proveedor 1',imp:450,canal:'Proveedor',fecha:'2026-06-24'},
  {id:3,tipo:'ingreso',desc:'Venta Barça Local M x2',imp:179.98,canal:'Instagram',fecha:'2026-06-24'},
  {id:4,tipo:'ingreso',desc:'Venta Real Madrid Local L',imp:89.99,canal:'WhatsApp',fecha:'2026-06-23'},
]);
// ── Rendimiento: por defecto se carga solo lo reciente; el histórico viejo se pide bajo demanda ──
const MESES_CARGA_INICIAL=3;
function cutoffCargaInicial(){ const d=new Date(); d.setMonth(d.getMonth()-MESES_CARGA_INICIAL); return fechaISO(d); }
let historialCompleto=false;            // true cuando ya se trajo TODO el histórico
let cutoffCarga=cutoffCargaInicial();   // fecha desde la que están cargadas ventas/transacciones
let ids={ped:1,env:4,dev:2,ven:4,tx:5,c:6,ventaTienda:ld('ventaTienda',1)};
let pedActual={provId:null,lineas:[]};
let envFilter='activos', devFilter='todos', tipoVenta=null;

// ── LOGIN ────────────────────────────────────────────────────────────────────
function selRole(r){
  document.getElementById('lr-m').classList.toggle('sel',r==='manager');
  document.getElementById('lr-o').classList.toggle('sel',r==='owner');
  role=r; document.getElementById('lpin').focus();
}
function doLogin(){
  if(!role){document.getElementById('lerr').textContent='Elige tu rol primero';return}
  const pin=document.getElementById('lpin').value;
  if(MODO_SERVIDOR){
    // Modo servidor — autenticar con Laravel
    document.getElementById('lerr').textContent='Conectando...';
    apiCall('POST','/login',{rol:role,pin}).then(data=>{
      if(data.ok) iniciarApp();
      else{document.getElementById('lerr').textContent='PIN incorrecto';document.getElementById('lpin').value='';}
    }).catch(e=>{
      document.getElementById('lerr').textContent=e.message||'Error de conexión con el servidor';
      document.getElementById('lpin').value='';
    });
  } else {
    // Modo local (sin servidor): solo demostración, no hay datos reales que proteger
    iniciarApp();
  }
}
function iniciarApp(){
  document.getElementById('lerr').textContent='';
  document.getElementById('ls').style.display='none';
  document.getElementById('app').classList.add('on');
  document.getElementById('rchip').textContent=nombreRol();
  document.getElementById('rchip').className='chip '+(role==='manager'?'chip-m':'chip-o');
  if(MODO_SERVIDOR) cargarDatosServidor().then(()=>{buildNav();goTo('home');});
  else {buildNav();goTo('home');}
}
async function cargarDatosServidor(){
  toast('Cargando datos del servidor...');
  historialCompleto=false;
  cutoffCarga=cutoffCargaInicial();
  try{
    const [c,p,e,d,v,t,act]=await Promise.all([
      apiCall('GET','/camisetas'),
      apiCall('GET','/pedidos'),
      apiCall('GET','/envios'),
      apiCall('GET','/devoluciones'),
      apiCall('GET','/ventas?desde='+cutoffCarga),
      apiCall('GET','/transacciones?desde='+cutoffCarga),
      apiCall('GET','/actividad?rol='+role),
    ]);
    camisetas = c;
    pedidos = p.map(x=>({id:x.id,provId:x.proveedor_id,lineas:x.lineas,notas:x.notas,estado:x.estado,fecha:x.fecha}));
    envios = e.map(x=>({id:x.id,cliente:x.cliente,prods:x.productos,origen:x.origen,trans:x.transportista,dir:x.direccion,imp:parseFloat(x.importe),estado:x.estado,notas:x.notas,fecha:x.fecha}));
    devoluciones = d.map(x=>({id:x.id,cliente:x.cliente,motivo:x.motivo,dev:x.camiseta_devuelta,sol:x.camiseta_solicitada,devCamId:x.dev_camiseta_id,devTalla:x.dev_talla,solCamId:x.sol_camiseta_id,solTalla:x.sol_talla,imp:parseFloat(x.importe),estado:x.estado,fecha:x.fecha}));
    ventas = v.map(x=>({id:x.id,camId:x.camiseta_id,equipo:x.equipo,talla:x.talla,cant:x.cantidad,canal:x.canal,cliente:x.cliente,cedula:x.cliente_cedula||'',telefono:x.cliente_telefono||'',numeroVenta:x.numero_venta,imp:parseFloat(x.importe),fecha:x.fecha,pagos:x.pagos||[]}));
    transacciones = t.map(x=>({id:x.id,tipo:x.tipo,desc:x.descripcion,imp:parseFloat(x.importe),canal:x.canal,fecha:x.fecha,venta_id:x.venta_id||null}));
    actividad = act.actividad;
    notifsVistas = act.vistas;
    actualizarBadgeNotif();
    try{ CONFIG={...CONFIG, ...(await apiCall('GET','/config'))}; }catch(e){}
    try{ cierresCaja=await apiCall('GET','/cierres'); }catch(e){ cierresCaja=[]; }
    try{ cierresMensuales=await apiCall('GET','/cierres/mensuales'); }catch(e){ cierresMensuales=[]; }
    try{ const est=await apiCall('GET','/cierres/estado'); cajaPendiente=est.caja_pendiente||null; }catch(e){ cajaPendiente=null; }
    mostrarAvisoCajaPendiente();
    toast('✓ Datos cargados');
  }catch(e){
    toast('Error cargando datos — usando datos locales');
  }
}
// Trae TODO el histórico (ventas + transacciones) bajo demanda. Idempotente.
async function cargarHistorialCompleto(){
  if(historialCompleto) return true;
  if(typeof MODO_SERVIDOR!=='undefined' && !MODO_SERVIDOR){ historialCompleto=true; return true; }
  toast('Cargando histórico completo...');
  try{
    const [v,t]=await Promise.all([
      apiCall('GET','/ventas?desde=all'),
      apiCall('GET','/transacciones?desde=all'),
    ]);
    ventas = v.map(x=>({id:x.id,camId:x.camiseta_id,equipo:x.equipo,talla:x.talla,cant:x.cantidad,canal:x.canal,cliente:x.cliente,cedula:x.cliente_cedula||'',telefono:x.cliente_telefono||'',numeroVenta:x.numero_venta,imp:parseFloat(x.importe),fecha:x.fecha,pagos:x.pagos||[]}));
    transacciones = t.map(x=>({id:x.id,tipo:x.tipo,desc:x.descripcion,imp:parseFloat(x.importe),canal:x.canal,fecha:x.fecha,venta_id:x.venta_id||null}));
    historialCompleto=true;
    cutoffCarga='2000-01-01';
    toast('✓ Histórico completo cargado');
    return true;
  }catch(e){
    toast('No se pudo cargar el histórico completo');
    return false;
  }
}
async function cargarHistorialCompletoUI(){
  const ok=await cargarHistorialCompleto();
  if(ok && typeof curPage!=='undefined' && curPage==='caja' && typeof renderCaja==='function') renderCaja();
}
function doLogout(){
  role=null;
  if(MODO_SERVIDOR) apiCall('POST','/logout').catch(()=>{});
  document.getElementById('ls').style.display='flex';
  document.getElementById('app').classList.remove('on');
  document.getElementById('lpin').value='';
  document.getElementById('lr-m').classList.remove('sel');
  document.getElementById('lr-o').classList.remove('sel');
}

// ── NAV ──────────────────────────────────────────────────────────────────────
function buildNav(){
  const nav=document.getElementById('bnav');
  const tabs=role==='manager'
    ?[{id:'home',icon:'ti-home',label:'Inicio'},{id:'misventas',icon:'ti-cash',label:'Ventas'},{id:'pedido',icon:'ti-clipboard-list',label:'Pedir'},{id:'stock',icon:'ti-shirt',label:'Stock'},{id:'caja',icon:'ti-report-money',label:'Caja'}]
    :[{id:'home',icon:'ti-home',label:'Inicio'},{id:'misventas',icon:'ti-cash',label:'Ventas'},{id:'stock',icon:'ti-shirt',label:'Stock'},{id:'pedido',icon:'ti-clipboard-list',label:'Pedir'},{id:'caja',icon:'ti-report-money',label:'Caja'},{id:'mas',icon:'ti-dots',label:'Más'}];
  nav.innerHTML=tabs.map(t=>`<button class="ni" id="ni-${t.id}" onclick="goTo('${t.id}')"><i class="ti ${t.icon}"></i><span>${t.label}</span></button>`).join('');
  // Historial y Ajustes pasan al encabezado (solo dueño)
  document.getElementById('hdr-hist').style.display=role==='owner'?'flex':'none';
  document.getElementById('hdr-ajustes').style.display=role==='owner'?'flex':'none';
  document.getElementById('hdr-push-mgr').style.display=role==='manager'?'flex':'none';
  updateBadges();
  actualizarBadgeNotif();
}
function updateBadges(){
  const pendPed=pedidos.filter(p=>p.estado==='pendiente').length;
  const pendEnv=envios.filter(e=>e.estado!=='entregado').length;
  const niApr=document.getElementById('ni-aprobar');
  const niEnv=document.getElementById('ni-envios');
  if(niApr&&pendPed>0) niApr.innerHTML+=`<span class="nbadge">${pendPed}</span>`;
  if(niEnv&&pendEnv>0) niEnv.innerHTML+=`<span class="nbadge">${pendEnv}</span>`;
}
function goTo(p){
  curPage=p;
  document.querySelectorAll('.page').forEach(x=>x.classList.remove('active'));
  document.querySelectorAll('.ni').forEach(x=>x.classList.remove('active'));
  const pg=document.getElementById('page-'+p);if(pg)pg.classList.add('active');
  const ni=document.getElementById('ni-'+p);if(ni)ni.classList.add('active');
  ({home:renderHome,pedido:renderPedido,stock:renderStock,envios:renderEnvios,dev:renderDev,ventas:renderVentas,misventas:renderMisVentas,aprobar:renderAprobar,fin:renderFin,verstock:renderVerStock,caja:renderCaja,ajustes:renderAjustes,historial:renderHistorial,clientes:renderClientes,nomina:renderNomina,mas:renderMas,dashboard:renderDashboard})[p]?.();
}

// ── HELPERS ───────────────────────────────────────────────────────────────────
const fmt=n=>'$'+n.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g,',');
function toast(msg){const t=document.getElementById('toast');t.textContent=msg;t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2600)}
function openM(id){document.getElementById(id).classList.add('open')}
function closeM(id){document.getElementById(id).classList.remove('open')}
function setv(id,val){const s=document.getElementById(id);if(!s)return;for(let o of s.options)if(o.value===val||o.text===val){o.selected=true;break}}
document.querySelectorAll('.mbg').forEach(m=>m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('open')}));
document.getElementById('lpin').addEventListener('keydown',e=>{if(e.key==='Enter')doLogin()});

// ── SINCRONIZACIÓN DUAL (local / servidor) ────────────────────────────────────
async function syncCamisetas(accion, data, id=null){
  if(MODO_SERVIDOR){
    if(accion==='add')    return apiCall('POST','/camisetas',data);
    if(accion==='update') return apiCall('PUT',`/camisetas/${id}`,data);
    if(accion==='delete') return apiCall('DELETE',`/camisetas/${id}`);
    if(accion==='stock')  return apiCall('PUT',`/camisetas/${id}/stock`,{tallas:data});
  } else {
    sd('camisetas',camisetas);
  }
}
async function syncVenta(data){
  if(MODO_SERVIDOR) return apiCall('POST','/ventas',data);
  else sd('ventas',ventas);
}

// ── ESCÁNER DE CÓDIGO DE BARRAS ───────────────────────────────────────────────
let scannerActivo=null, scanCallback=null, pendingCodigo=null, pendingTalla=null, impEditadoManual=false;
let scanContinuo=false, ultimoCodigo=null, ultimoScanTs=0, contadorSesion=0;

function abrirScanner(cb, continuo=false){
  scanCallback=cb;
  scanContinuo=continuo; ultimoCodigo=null; ultimoScanTs=0; contadorSesion=0;
  document.getElementById('scan-manual').value='';
  document.getElementById('scan-status').textContent='Iniciando cámara…';
  openM('m-scan');
  const config={
    fps:10,
    qrbox:{width:260,height:150},
    formatsToSupport:[
      Html5QrcodeSupportedFormats.EAN_13, Html5QrcodeSupportedFormats.EAN_8,
      Html5QrcodeSupportedFormats.UPC_A,  Html5QrcodeSupportedFormats.UPC_E,
      Html5QrcodeSupportedFormats.CODE_128, Html5QrcodeSupportedFormats.CODE_39,
      Html5QrcodeSupportedFormats.QR_CODE
    ]
  };
  scannerActivo=new Html5Qrcode('scan-reader');
  scannerActivo.start(
    {facingMode:'environment'}, config,
    (texto)=>{ procesarScan(texto); },
    ()=>{} // errores por frame (no encontró código en ese cuadro): ignorar
  ).then(()=>{
    document.getElementById('scan-status').textContent='Apunta la cámara al código de barras de la etiqueta';
  }).catch(()=>{
    document.getElementById('scan-status').textContent='⚠ No se pudo abrir la cámara (revisa el permiso). Puedes escribir el código a mano abajo.';
  });
}
function pararScanner(){
  if(scannerActivo){
    const s=scannerActivo; scannerActivo=null;
    try{ s.stop().then(()=>s.clear()).catch(()=>{}); }catch(e){}
  }
}
function cerrarScanner(){ pararScanner(); scanCallback=null; scanContinuo=false; closeM('m-scan'); }
function scanManual(){
  const c=document.getElementById('scan-manual').value.trim();
  if(!c){toast('Escribe el código primero');return}
  procesarScan(c);
}
function procesarScan(codigo){
  if(scanContinuo){
    // Anti-rebote: la cámara lee ~10 veces/seg — ignorar el mismo código por 1.8s
    const ahora=Date.now();
    if(codigo===ultimoCodigo && ahora-ultimoScanTs<1800) return;
    ultimoCodigo=codigo; ultimoScanTs=ahora;
    if(navigator.vibrate) navigator.vibrate(80);
    if(scanCallback) scanCallback(codigo); // NO cerrar: sigue escaneando
    return;
  }
  pararScanner(); closeM('m-scan');
  if(navigator.vibrate) navigator.vibrate(80);
  const cb=scanCallback; scanCallback=null;
  if(cb) cb(codigo);
}
async function buscarCodigo(codigo){
  return apiCall('GET','/camisetas/barcode/'+encodeURIComponent(codigo));
}
// Si cierran el escáner tocando el fondo oscuro, apagar la cámara también
document.getElementById('m-scan').addEventListener('click',e=>{
  if(e.target===e.currentTarget){ pararScanner(); scanCallback=null; scanContinuo=false; }
});

// ── Escaneo desde INVENTARIO (entrada de mercancía) ──
function abrirScannerInventario(){
  if(!MODO_SERVIDOR){toast('El escáner requiere conexión con el servidor');return}
  // MODO CONTINUO: cada escaneo suma 1 UND y la cámara sigue abierta
  abrirScanner(async codigo=>{
    try{
      const r=await buscarCodigo(codigo);
      if(r.encontrado){
        await sumarUnaUnidad(r.camiseta.id, r.talla);
      } else {
        // Código nuevo: pausar el continuo y abrir el asociador
        pararScanner(); scanCallback=null; scanContinuo=false; closeM('m-scan');
        prepararAsociar(codigo);
      }
    }catch(e){/* apiCall ya mostró el toast */}
  }, true);
  setTimeout(()=>{
    const st=document.getElementById('scan-status');
    if(st && scannerActivo) st.textContent='Modo continuo: cada lectura suma 1 UND. Escanea una por una.';
  }, 1200);
}

async function sumarUnaUnidad(camId, talla){
  const i=camisetas.findIndex(c=>c.id===camId);
  if(i<0){toast('Camiseta no encontrada');return}
  camisetas[i].tallas[talla]=(camisetas[i].tallas[talla]||0)+1;
  try{
    await syncCamisetas('stock',camisetas[i].tallas,camId);
  }catch(e){
    camisetas[i].tallas[talla]-=1; // revertir si el servidor falló
    return;
  }
  contadorSesion++;
  registrarActividad('stock',`Entrada por escaneo: ${camisetas[i].equipo} ${camisetas[i].tipo} Talla ${talla}`,`+1 UND`);
  toast(`✓ ${camisetas[i].equipo} ${talla} — ahora ${camisetas[i].tallas[talla]} UND`);
  const st=document.getElementById('scan-status');
  if(st) st.textContent=`✓ ${contadorSesion} escaneada${contadorSesion>1?'s':''} esta sesión. Sigue escaneando o cierra al terminar.`;
  if(curPage==='stock'){ stkQuery=''; renderStock(); } // limpiar búsqueda para que la escaneada siempre se vea
}
function prepararAsociar(codigo){
  pendingCodigo=codigo;
  document.getElementById('as-codigo').textContent=codigo;
  const sel=document.getElementById('as-cam');
  sel.innerHTML=camisetas.length
    ? camisetas.map(c=>`<option value="${c.id}">${nombreProducto(c)}</option>`).join('')
    : '<option value="">Sin camisetas — crea una nueva</option>';
  document.getElementById('as-cant').value=1;
  openM('m-scan-asociar');
}
async function confirmarSumarStock(){
  const id=+document.getElementById('sa-camid').value;
  const talla=document.getElementById('sa-talla-h').value;
  const cant=+document.getElementById('sa-cant').value||0;
  if(cant<1){toast('La cantidad debe ser al menos 1');return}
  const i=camisetas.findIndex(c=>c.id===id);
  if(i<0){toast('Camiseta no encontrada');return}
  camisetas[i].tallas[talla]=(camisetas[i].tallas[talla]||0)+cant;
  if(!MODO_SERVIDOR) sd('camisetas',camisetas);
  try{
    await syncCamisetas('stock',camisetas[i].tallas,id);
  }catch(e){
    camisetas[i].tallas[talla]-=cant; // revertir si el servidor falló
    return;
  }
  registrarActividad('stock',`Entrada por escaneo: ${camisetas[i].equipo} ${camisetas[i].tipo} Talla ${talla}`,`+${cant} UND`);
  closeM('m-scan-add');
  toast(`✓ +${cant} UND · ${camisetas[i].equipo} ${talla}: ${camisetas[i].tallas[talla]} UND`);
  if(curPage==='stock') renderStock();
}
async function confirmarAsociarCodigo(){
  const camId=+document.getElementById('as-cam').value;
  const talla=document.getElementById('as-talla').value;
  const cant=+document.getElementById('as-cant').value||0;
  if(!camId){toast('Selecciona una camiseta, o créala nueva');return}
  try{
    await apiCall('POST','/camisetas/barcode',{codigo:pendingCodigo,camiseta_id:camId,talla});
  }catch(e){ return; }
  const i=camisetas.findIndex(c=>c.id===camId);
  if(cant>0 && i>=0){
    camisetas[i].tallas[talla]=(camisetas[i].tallas[talla]||0)+cant;
    try{ await syncCamisetas('stock',camisetas[i].tallas,camId); }catch(e){}
  }
  registrarActividad('stock',`Código de barras asociado: ${i>=0?camisetas[i].equipo+' '+camisetas[i].tipo:''} Talla ${talla}`,cant>0?`+${cant} UND`:'Solo asociación');
  closeM('m-scan-asociar');
  pendingCodigo=null; pendingTalla=null;
  toast('✓ Código guardado — la próxima vez se reconoce solo');
  if(curPage==='stock') renderStock();
}
function crearCamisetaDesdeScan(){
  pendingTalla=document.getElementById('as-talla').value;
  closeM('m-scan-asociar');
  abrirNuevaCamiseta();
  toast('Crea la camiseta — el código se asociará solo al guardarla');
}

// ── Escaneo desde VENTA ──
// Atajo: elige "Escanear" en el modal de venta → activa modo stock + abre cámara
function modoEscanear(){
  setModoVenta('stock');
  escanearParaVenta();
}
function escanearParaVenta(){
  if(!MODO_SERVIDOR){toast('El escáner requiere conexión con el servidor');return}
  abrirScanner(async codigo=>{
    try{
      const r=await buscarCodigo(codigo);
      if(!r.encontrado){
        toast('Código no registrado — escanéalo primero desde Inventario');
        openM('m-venta'); // devolver al modal de venta
        return;
      }
      openM('m-venta');
      const cam=camisetas.find(c=>c.id===r.camiseta.id)||r.camiseta;
      document.getElementById('v-cam').value=String(cam.id);
      toggleTallaVenta();
      document.getElementById('v-talla').value=r.talla;
      document.getElementById('v-cant').value=1; // escaneo = 1 unidad (editable si llevan más)
      impEditadoManual=false;
      autoPrecioVenta();
      const stock=cam.tallas[r.talla]||0;
      toast(stock>0?`✓ ${cam.equipo} ${r.talla} — quedan ${stock} UND`:`⚠ ${cam.equipo} ${r.talla} está SIN STOCK`);
    }catch(e){ openM('m-venta'); }
  });
}
function escanearParaCarrito(){
  if(!MODO_SERVIDOR){toast('El escáner requiere conexión con el servidor');return}
  abrirScanner(async codigo=>{
    try{
      const r=await buscarCodigo(codigo);
      openM('m-carrito');
      if(!r.encontrado){ toast('Código no registrado — asócialo primero desde Inventario'); return; }
      const cam=camisetas.find(c=>c.id===r.camiseta.id)||r.camiseta;
      document.getElementById('cart-cam').value=String(cam.id);
      {const _sc=document.getElementById('cart-cam-search'); if(_sc)_sc.value=nombreProducto(cam);}
      carritoAutoPrecio();
      document.getElementById('cart-talla').value=r.talla;
      document.getElementById('cart-cant').value=1;
      const stock=cam.tallas[r.talla]||0;
      if(stock<=0){ toast(`⚠ ${cam.equipo} ${r.talla} está SIN STOCK`); return; }
      carritoAgregarProducto();
      toast(`✓ ${cam.equipo} ${r.talla} agregada al carrito`);
    }catch(e){ openM('m-carrito'); }
  });
}
// ── MÉTODOS DE PAGO (Venezuela) ───────────────────────────────────────────────
const BANCOS_VE=['0102 Banco de Venezuela','0104 Venezolano de Crédito','0105 Mercantil','0108 BBVA Provincial','0114 Bancaribe','0115 Exterior','0128 Banco Caroní','0134 Banesco','0137 Sofitasa','0138 Banco Plaza','0146 Bangente','0151 BFC Fondo Común','0156 100% Banco','0157 DelSur','0163 Banco del Tesoro','0166 Banco Agrícola','0168 Bancrecer','0169 Mi Banco','0171 Banco Activo','0172 Bancamiga','0174 Banplus','0175 Bicentenario','0177 Banfanb','0191 BNC','Otro'];

const METODOS_PAGO={
  efectivo_usd:  {label:'Efectivo $',   icono:'ti-cash',            bs:false},
  efectivo_bs:   {label:'Efectivo Bs',  icono:'ti-cash-banknote',   bs:true},
  pago_movil:    {label:'Pago móvil',   icono:'ti-device-mobile',   bs:true},
  punto_venta:   {label:'Punto de venta',icono:'ti-credit-card',    bs:true},
  transferencia: {label:'Transferencia',icono:'ti-building-bank',   bs:true},
  zelle:         {label:'Zelle',        icono:'ti-brand-cashapp',   bs:false},
  binance:       {label:'Binance',      icono:'ti-currency-bitcoin',bs:false},
  zinli:         {label:'Zinli',        icono:'ti-wallet',          bs:false},
  cashea:        {label:'Cashea',       icono:'ti-shopping-bag',    bs:false},
  efectivo_otra: {label:'Otra moneda',   icono:'ti-cash',            bs:false, otra:true},
};

let metodoPago=null;

let tasaElegida='bcv'; // bcv | euro | binance
function personalLista(){ try{ const a=JSON.parse(CONFIG.personal||'[]'); return (Array.isArray(a)?a:[]).map(p=>({id:p.i||p.id, nombre:p.n||p.nombre, cargo:p.c||p.cargo||'', sueldo:parseFloat(p.s!=null?p.s:p.sueldo)||0, frecuencia:p.f||p.frecuencia||'quincenal', desde:p.d||p.desde||''})).filter(p=>p.id&&p.nombre); }catch(e){ return []; } }
function nominaPagadoMes(nombre){ const m=hoy().slice(0,7); return transacciones.filter(t=>t.tipo==='gasto'&&t.canal==='Sueldos'&&String(t.desc||'').startsWith('Nómina: '+nombre)&&String(t.fecha||'').slice(0,7)===m).reduce((x,t)=>x+(t.imp||0),0); }
const NOM_PERIODO={semanal:7,quincenal:15,mensual:30};
function nominaUltimoPago(nombre){ const ps=transacciones.filter(t=>t.tipo==='gasto'&&t.canal==='Sueldos'&&String(t.desc||'').startsWith('Nómina: '+nombre)).map(t=>t.fecha).filter(Boolean).sort(); return ps.length?ps[ps.length-1]:null; }
function nominaDiasDesde(fch){ try{ const d=Math.floor((Date.now()-new Date(fch+'T00:00:00').getTime())/86400000); return d<0?0:d; }catch(e){ return 0; } }
function nominaPendientes(){ return personalLista().map(p=>{ const per=NOM_PERIODO[p.frecuencia]||15; const ult=nominaUltimoPago(p.nombre); const ref=ult||p.desde||hoy(); const dias=nominaDiasDesde(ref); return {p,dias,per,vence:dias>=per}; }).filter(x=>x.vence); }
function tasasExtra(){ try{ const a=JSON.parse(CONFIG.tasas_extra||'[]'); return (Array.isArray(a)?a:[]).map(t=>({id:t.i||t.id, nombre:t.n||t.nombre, valor:t.v||t.valor})).filter(t=>t.id&&t.nombre); }catch(e){ return []; } }
function tasasDisponibles(){ return [{k:'bcv',label:'Dólar BCV'},{k:'euro',label:'Euro BCV'},{k:'binance',label:'Binance'}].concat(tasasExtra().map(t=>({k:t.id,label:t.nombre}))); }
function tasaNombre(k){ const o=tasasDisponibles().find(x=>x.k===k); return o?o.label:k; }
function tasaValor(cual){
  const mapa={bcv:CONFIG.tasa_bcv,euro:CONFIG.tasa_euro,binance:CONFIG.tasa_binance};
  if(cual in mapa) return parseFloat(mapa[cual])||0;
  const ex=tasasExtra().find(t=>t.id===cual);
  return ex?(parseFloat(String(ex.valor).replace(',','.'))||0):0;
}
function tasaActual(){ return tasaValor(tasaElegida); }
function renderSelectorTasa(){
  const cont=document.getElementById('v-tasa-selector');
  if(!cont) return;
  const opciones=tasasDisponibles();
  cont.innerHTML=opciones.map(o=>{
    const val=tasaValor(o.k);
    const act=tasaElegida===o.k;
    const dis=val<=0;
    return `<button type="button" ${dis?'disabled':''} onclick="setTasaElegida('${o.k}')" style="flex:1;padding:6px 4px;border-radius:8px;cursor:${dis?'not-allowed':'pointer'};font-size:11px;font-weight:800;border:2px solid ${act?'var(--gd)':'var(--gm)'};background:${act?'var(--gd)':'#fff'};color:${act?'#fff':(dis?'var(--txh)':'var(--gd)')};opacity:${dis?.5:1}">${o.label}<br><span style="font-size:9px;font-weight:600">${val>0?val.toLocaleString('es-VE',{minimumFractionDigits:2}):'—'}</span></button>`;
  }).join('');
}
function setTasaElegida(k){
  if(tasaValor(k)<=0){toast('Esa tasa no está configurada (Ajustes)');return}
  tasaElegida=k;
  renderSelectorTasa();
  const info=document.getElementById('v-tasa-info');
  if(info) info.textContent=`${tasaNombre(k)}: ${tasaActual().toLocaleString('es-VE',{minimumFractionDigits:2})} Bs/$`;
  recalcularBs();
}
function fmtBs(n){ return 'Bs ' + (n||0).toLocaleString('es-VE',{minimumFractionDigits:2,maximumFractionDigits:2}); }

function selectBanco(id,label,sel=''){
  return `<label class="fl">${label}</label><select class="fi" id="${id}"><option value="">— Selecciona —</option>${BANCOS_VE.map(b=>`<option${b===sel?' selected':''}>${b}</option>`).join('')}</select>`;
}
function bancoReceptorFijo(label){
  const fijo=(CONFIG.banco_receptor||'').trim();
  return selectBanco('pg-banco-receptor',label,fijo);
}
function datosCobroFijos(){
  const banco=(CONFIG.banco_receptor||'').trim();
  const tel=(CONFIG.telefono_pago||'').trim();
  const ced=(CONFIG.cedula_pago||'').trim();
  if(!banco && !tel && !ced){
    // Sin datos configurados: mostrar el selector normal + aviso
    return `<div style="background:var(--al);border-radius:10px;padding:10px;font-size:12px;color:var(--ad);font-weight:600;margin-bottom:8px"><i class="ti ti-info-circle"></i> Configura tus datos de pago móvil en Ajustes para que salgan automáticos.</div>${selectBanco('pg-banco-receptor','¿A qué banco cayó el dinero?')}`;
  }
  // Con datos: tarjeta de solo lectura con tus datos + input oculto para guardarlos
  return `<div style="background:var(--gl);border:1.5px solid var(--gm);border-radius:11px;padding:11px;margin-bottom:8px">
    <div style="font-size:11px;font-weight:800;color:var(--gd);text-transform:uppercase;margin-bottom:5px">Tu pago móvil</div>
    ${banco?`<div style="font-size:13px;font-weight:700;color:var(--gd)"><i class="ti ti-building-bank" style="font-size:13px"></i> ${banco}</div>`:''}
    ${tel?`<div style="font-size:13px;font-weight:700;color:var(--gd)"><i class="ti ti-device-mobile" style="font-size:13px"></i> ${tel}</div>`:''}
    ${ced?`<div style="font-size:13px;font-weight:700;color:var(--gd)"><i class="ti ti-id" style="font-size:13px"></i> ${ced}</div>`:''}
  </div>
  <input type="hidden" id="pg-banco-receptor" value="${banco.replace(/"/g,'&quot;')}">`;
}

function renderMetodosPago(){
  const cont=document.getElementById('v-pago-metodos');
  if(!cont) return;
  cont.innerHTML=Object.entries(METODOS_PAGO).map(([k,m])=>{
    const act=metodoPago===k;
    return `<button type="button" onclick="setMetodoPago('${k}')" style="padding:9px 4px;border-radius:10px;cursor:pointer;display:flex;flex-direction:column;align-items:center;gap:3px;font-size:10.5px;font-weight:700;border:2px solid ${act?'var(--gm)':'var(--grayb)'};background:${act?'var(--gl)':'#fff'};color:${act?'var(--gd)':'var(--txm)'}">
      <i class="ti ${m.icono}" style="font-size:18px"></i>${m.label}</button>`;
  }).join('');
}

function setMetodoPago(k){
  metodoPago=k;
  renderMetodosPago();
  const m=METODOS_PAGO[k];
  const tasa=tasaActual();

  // Bloque de bolívares
  const boxBs=document.getElementById('v-pago-bs');
  boxBs.style.display=m.bs?'block':'none';
  if(m.bs){
    // Si la tasa elegida no existe, caer a la primera disponible
    if(tasaValor(tasaElegida)<=0){
      tasaElegida=['bcv','euro','binance'].find(k=>tasaValor(k)>0)||'bcv';
    }
    renderSelectorTasa();
    document.getElementById('v-tasa-info').textContent=tasaActual()>0
      ? `${tasaNombre(tasaElegida)}: ${tasaActual().toLocaleString('es-VE',{minimumFractionDigits:2})} Bs/$`
      : '⚠️ Sin tasa configurada (Ajustes)';
    recalcularBs();
  }

  // Campos propios de cada método
  const campos=document.getElementById('v-pago-campos');
  const refCorta='inputmode="numeric" maxlength="6"';
  const plantillas={
    efectivo_usd: '',
    efectivo_bs:  '',
    pago_movil:   `${datosCobroFijos()}
                   ${selectBanco('pg-banco-emisor','¿De qué banco te pagaron?')}
                   <label class="fl">Referencia</label><input class="fi" id="pg-referencia" inputmode="numeric" placeholder="Número de referencia">`,
    punto_venta:  `${selectBanco('pg-banco-receptor','Punto de venta (banco receptor)')}
                   ${selectBanco('pg-banco-emisor','Banco emisor (tarjeta del cliente)')}
                   <div class="frow">
                     <div><label class="fl">Últimos 6 · emisor</label><input class="fi" id="pg-ref-emisor" ${refCorta} placeholder="000000"></div>
                     <div><label class="fl">Últimos 6 · receptor</label><input class="fi" id="pg-ref-receptor" ${refCorta} placeholder="000000"></div>
                   </div>`,
    transferencia:`${datosCobroFijos()}
                   ${selectBanco('pg-banco-emisor','¿De qué banco te pagaron?')}
                   <label class="fl">Referencia</label><input class="fi" id="pg-referencia" inputmode="numeric" placeholder="Número de referencia">`,
    zelle:        `<label class="fl">Correo de quien envía</label><input class="fi" id="pg-correo" type="email" inputmode="email" placeholder="cliente@correo.com">
                   <label class="fl">Nombre de quien envía</label><input class="fi" id="pg-titular" placeholder="Nombre y apellido">
                   <label class="fl">Número de confirmación</label><input class="fi" id="pg-confirmacion" placeholder="Ej: 1234abcd">`,
    binance:      `<label class="fl">Correo Binance</label><input class="fi" id="pg-correo" type="email" inputmode="email" placeholder="cliente@correo.com">
                   <label class="fl">ID de la orden</label><input class="fi" id="pg-id-orden" inputmode="numeric" placeholder="Ej: 22458913057">`,
    zinli:        `<label class="fl">Correo Zinli</label><input class="fi" id="pg-correo" type="email" inputmode="email" placeholder="cliente@correo.com">
                   <label class="fl">Referencia</label><input class="fi" id="pg-referencia" placeholder="Número de operación">`,
    cashea:       `<div style="background:var(--al);border-radius:10px;padding:10px;font-size:12px;color:var(--ad);font-weight:600;margin-bottom:8px"><i class="ti ti-info-circle"></i> Cashea requiere que el negocio esté registrado con ellos.</div>
                   <label class="fl">Nombre del cliente</label><input class="fi" id="pg-titular" placeholder="Nombre y apellido">
                   <label class="fl">N° de orden Cashea</label><input class="fi" id="pg-referencia" placeholder="Ej: CSH-123456">`,
  };
  campos.innerHTML=plantillas[k]||'';
}

function ventasHoyPorMoneda(){
  const h=hoy();
  let bs=0, divisas=0, sinReg=0;
  ventas.filter(v=>v.fecha===h).forEach(v=>{
    const p=(v.pagos&&v.pagos[0])||null;
    if(!p){ sinReg+=v.imp; return; }
    if(p.moneda==='VES') bs+=parseFloat(p.monto)||0;
    else divisas+=v.imp;
  });
  return {bs,divisas,sinReg};
}
function importeVentaActual(){
  // El importe puede estar en el campo de stock (v-imp) o en el de venta libre (v-imp-libre)
  const libre=document.getElementById('v-imp-libre');
  const stock=document.getElementById('v-imp');
  const libreVisible=modoVenta==='libre';
  const val=libreVisible ? (+((libre||{}).value)||0) : (+((stock||{}).value)||0);
  return val;
}
function recalcularBs(){
  const inp=document.getElementById('v-monto-bs');
  if(!inp||!metodoPago||!METODOS_PAGO[metodoPago].bs) return;
  const tasa=tasaActual();
  const usd=importeVentaActual();
  if(tasa>0) inp.value=(usd*tasa).toFixed(2);
}

function datosPago(){
  if(!metodoPago) return null;
  const val=id=>{const e=document.getElementById(id); return e?e.value.trim():''};
  const m=METODOS_PAGO[metodoPago];
  const d={metodo:metodoPago};
  if(m.bs){
    d.tasa=tasaActual();
    d.tasa_tipo=tasaElegida;
    d.monto=+document.getElementById('v-monto-bs').value||0;
  }else{
    d.monto=importeVentaActual();
  }
  ['referencia','correo','titular','confirmacion'].forEach(k=>{const v=val('pg-'+k); if(v) d[k]=v});
  const mapa={'pg-banco-emisor':'banco_emisor','pg-banco-receptor':'banco_receptor','pg-ref-emisor':'ref_emisor','pg-ref-receptor':'ref_receptor','pg-id-orden':'id_orden'};
  Object.entries(mapa).forEach(([id,k])=>{const v=val(id); if(v) d[k]=v});
  return d;
}

function resumenPago(p){
  if(!p) return '';
  const m=METODOS_PAGO[p.metodo];
  if(!m) return '';
  const monto=p.moneda==='VES'?fmtBs(parseFloat(p.monto)):('$'+parseFloat(p.monto).toFixed(2));
  const extra=p.referencia||p.confirmacion||p.id_orden||p.ref_receptor||'';
  return `${m.label} · ${monto}${extra?' · Ref '+extra:''}`;
}

function toggleTallaVenta(){
  const camId=+document.getElementById('v-cam').value;
  const cam=camisetas.find(c=>c.id===camId);
  const otro=cam && !esCamiseta(cam);
  document.getElementById('v-talla-wrap').style.display=otro?'none':'block';
  if(otro) document.getElementById('v-talla').value='U';
  else if(document.getElementById('v-talla').value==='U') document.getElementById('v-talla').value='M';
}
function actualizarDispVenta(){
  const box=document.getElementById('v-disp');
  if(!box)return;
  const cam=camisetas.find(c=>c.id===+document.getElementById('v-cam').value);
  if(!cam){box.style.display='none';return}
  const talla=esCamiseta(cam)?document.getElementById('v-talla').value:'U';
  const disp=cam.tallas[talla]||0;
  const cant=+document.getElementById('v-cant').value||1;
  box.style.display='block';
  if(disp===0){
    box.style.background='var(--rl)';box.style.color='var(--rd)';
    box.innerHTML='<i class="ti ti-alert-triangle"></i> Sin stock en '+(talla==='U'?'inventario':'talla '+talla);
  }else if(cant>disp){
    box.style.background='var(--al)';box.style.color='var(--ad)';
    box.innerHTML=`<i class="ti ti-alert-circle"></i> Solo hay ${disp} UND disponible${disp>1?'s':''} — pediste ${cant}`;
  }else{
    box.style.background='var(--gl)';box.style.color='var(--gd)';
    box.innerHTML=`<i class="ti ti-package"></i> Disponibles: ${disp} UND`;
  }
}
function autoPrecioVenta(){
  actualizarDispVenta();
  setTimeout(recalcularBs,0);
  if(impEditadoManual) return;
  const camId=+document.getElementById('v-cam').value;
  const cam=camisetas.find(c=>c.id===camId);
  if(!cam || cam.precio==null || cam.precio===undefined) return;
  const cant=+document.getElementById('v-cant').value||1;
  document.getElementById('v-imp').value=(cam.precio*cant).toFixed(2);
}

// ── EDITAR / ELIMINAR VENTAS ─────────────────────────────────────────────────
function refrescarVistasVenta(){
  if(curPage==='misventas') renderMisVentas();
  if(curPage==='ventas') renderVentas();
  if(curPage==='stock') renderStock();
  if(curPage==='home') renderHome();
  if(curPage==='fin') renderFin();
  if(curPage==='caja') renderCaja();
}

function abrirEditarVenta(id){
  const v=ventas.find(x=>x.id===id); if(!v){toast('Venta no encontrada');return}
  document.getElementById('ev-id').value=id;
  document.getElementById('ev-titulo').textContent=v.equipo;
  document.getElementById('ev-sub').textContent=`${v.canal} · ${v.fecha}${v.cliente?' · '+v.cliente:''}`;
  // Nombre editable solo si fue venta libre (escrita a mano)
  document.getElementById('ev-nombre-wrap').style.display=v.camId?'none':'block';
  document.getElementById('ev-nombre').value=v.camId?'':v.equipo;
  // Talla editable solo si fue venta del stock
  document.getElementById('ev-talla-wrap').style.display=(v.camId&&v.talla!=='U')?'block':'none';
  if(v.camId) document.getElementById('ev-talla').value=v.talla;
  document.getElementById('ev-cant').value=v.cant;
  document.getElementById('ev-imp').value=v.imp;
  const esFisica=v.canal==='Tienda física';
  document.getElementById('ev-cliente-wrap').style.display=esFisica?'none':'block';
  document.getElementById('ev-cliente').value=esFisica?'':(v.cliente||'');
  openM('m-editventa');
}

async function guardarEdicionVenta(){
  const id=+document.getElementById('ev-id').value;
  const v=ventas.find(x=>x.id===id); if(!v) return;
  const btn=document.getElementById('ev-save-btn');
  const cant=+document.getElementById('ev-cant').value||1;
  const imp=+document.getElementById('ev-imp').value||0;
  const payload={cantidad:cant,importe:imp};
  if(v.camId){
    payload.talla=document.getElementById('ev-talla').value;
  } else {
    const nombre=document.getElementById('ev-nombre').value.trim();
    if(!nombre){toast('Escribe la camiseta');return}
    payload.equipo=nombre;
  }
  if(v.canal!=='Tienda física'){
    const cli=document.getElementById('ev-cliente').value.trim();
    if(!cli){toast('Escribe el nombre del cliente');return}
    payload.cliente=cli;
  }
  btn.style.pointerEvents='none'; btn.style.opacity='.5';
  try{
    if(MODO_SERVIDOR){
      await apiCall('PUT','/ventas/'+id,payload);
      await cargarDatosServidor(); // recarga stock, ventas y caja ya corregidos
    } else {
      // Modo local: revertir stock viejo y aplicar el nuevo
      if(v.camId){
        const i=camisetas.findIndex(c=>c.id===v.camId);
        if(i>=0){
          camisetas[i].tallas[v.talla]=(camisetas[i].tallas[v.talla]||0)+v.cant;
          const nt=payload.talla;
          if((camisetas[i].tallas[nt]||0)<cant){
            camisetas[i].tallas[v.talla]-=v.cant;
            toast(`Solo hay ${camisetas[i].tallas[nt]||0} UND en talla ${nt}`);
            btn.style.pointerEvents='auto';btn.style.opacity='1';
            return;
          }
          camisetas[i].tallas[nt]-=cant;
          sd('camisetas',camisetas);
          v.talla=nt;
        }
      } else if(payload.equipo){ v.equipo=payload.equipo; }
      const ti=transacciones.findIndex(t=>t.tipo==='ingreso'&&t.imp===v.imp&&t.fecha===v.fecha);
      if(ti>=0){transacciones[ti].imp=imp;transacciones[ti].desc=`Venta ${v.equipo} ${v.talla} x${cant}`;sd('transacciones',transacciones);}
      v.cant=cant; v.imp=imp;
      if(payload.cliente!==undefined) v.cliente=payload.cliente;
      sd('ventas',ventas);
    }
    registrarActividad('venta',`Venta corregida: ${payload.equipo||v.equipo}`,`${cant} UND · ${fmt(imp)}`);
    closeM('m-editventa');
    toast('Venta actualizada ✓');
    refrescarVistasVenta();
  }catch(e){/* apiCall ya mostró el toast de error */}
  btn.style.pointerEvents='auto'; btn.style.opacity='1';
}

// ── LIMPIAR HISTORIAL (solo dueño) ───────────────────────────────────────────
async function eliminarActividad(id){
  if(!confirm('¿Eliminar esta entrada del historial?')) return;
  if(MODO_SERVIDOR){
    try{ await apiCall('DELETE','/actividad/'+id); }catch(e){ return; }
  }
  actividad=actividad.filter(a=>a.id!==id);
  if(!MODO_SERVIDOR) sd('actividad',actividad);
  renderHistorial();
  toast('Entrada eliminada ✓');
}
async function limpiarHistorial(){
  if(!confirm('¿Vaciar TODO el historial de actividad? No se puede deshacer.')) return;
  if(MODO_SERVIDOR){
    try{ await apiCall('DELETE','/actividad'); }catch(e){ return; }
  }
  actividad=[]; notifsVistas=[];
  if(!MODO_SERVIDOR) sd('actividad',actividad);
  renderHistorial();
  toast('Historial vaciado ✓');
}

async function eliminarVenta(id){
  const v=ventas.find(x=>x.id===id); if(!v){toast('Venta no encontrada');return}
  const devuelve=v.camId?`\nSe devolverán ${v.cant} UND al stock (talla ${v.talla}).`:'';
  if(!confirm(`¿Eliminar la venta "${v.equipo}" de ${fmt(v.imp)}?${devuelve}\nTambién se corrige la caja. No se puede deshacer.`)) return;
  if(MODO_SERVIDOR){
    try{ await apiCall('DELETE','/ventas/'+id); }catch(e){ return; }
    await cargarDatosServidor();
  } else {
    if(v.camId){
      const i=camisetas.findIndex(c=>c.id===v.camId);
      if(i>=0){camisetas[i].tallas[v.talla]=(camisetas[i].tallas[v.talla]||0)+v.cant; sd('camisetas',camisetas);}
    }
    const ti=transacciones.findIndex(t=>t.tipo==='ingreso'&&t.imp===v.imp&&t.fecha===v.fecha);
    if(ti>=0){transacciones.splice(ti,1); sd('transacciones',transacciones);}
    ventas=ventas.filter(x=>x.id!==id); sd('ventas',ventas);
  }
  registrarActividad('venta',`Venta eliminada: ${v.equipo}`,`${v.cant} UND · ${fmt(v.imp)}`);
  toast('Venta eliminada ✓ Stock y caja corregidos');
  refrescarVistasVenta();
}
async function syncPedido(accion,data,id=null){
  if(MODO_SERVIDOR){
    if(accion==='add')     return apiCall('POST','/pedidos',data);
    if(accion==='aprobar') return apiCall('PUT',`/pedidos/${id}/aprobar`);
    if(accion==='rechazar')return apiCall('PUT',`/pedidos/${id}/rechazar`);
    if(accion==='recibido')return apiCall('PUT',`/pedidos/${id}/recibido`);
  } else {
    sd('pedidos',pedidos);
  }
}
async function syncEnvio(accion,data,id=null){
  if(MODO_SERVIDOR){
    if(accion==='add')    return apiCall('POST','/envios',data);
    if(accion==='update') return apiCall('PUT',`/envios/${id}`,data);
    if(accion==='estado') return apiCall('PUT',`/envios/${id}/estado`);
  } else {
    sd('envios',envios);
  }
}
async function syncDevolucion(accion,data,id=null){
  if(MODO_SERVIDOR){
    if(accion==='add')      return apiCall('POST','/devoluciones',data);
    if(accion==='completar')return apiCall('PUT',`/devoluciones/${id}/completar`);
    if(accion==='aprobar')  return apiCall('PUT',`/devoluciones/${id}/aprobar`);
    if(accion==='rechazar') return apiCall('PUT',`/devoluciones/${id}/rechazar`);
  } else {
    sd('devoluciones',devoluciones);
  }
}
async function syncTx(data){
  if(MODO_SERVIDOR) return apiCall('POST','/transacciones',data);
  else sd('transacciones',transacciones);
}
function stockStatus(c){
  const malas=Object.values(c.tallas).filter(v=>v<c.min).length;
  if(Object.values(c.tallas).reduce((a,b)=>a+b,0)===0) return 'critico';
  if(malas>=3) return 'critico';
  if(malas>0) return 'bajo';
  return 'ok';
}
const eIco=e=>e==='preparando'?{i:'ti-package',cls:'ip'}:e==='ruta'?{i:'ti-map-pin',cls:'ia'}:{i:'ti-check',cls:'ig'};
const ePill=e=>e==='preparando'?'ppurp':e==='ruta'?'pwarn':'pok';
const eLabel=e=>e==='preparando'?'Preparando':e==='ruta'?'En ruta':'Entregado';
const origenIco=o=>({Instagram:'ti-brand-instagram',WhatsApp:'ti-brand-whatsapp','Tienda física':'ti-building-store',Web:'ti-world',Otro:'ti-dots'})[o]||'ti-dots';

// ── HOME ─────────────────────────────────────────────────────────────────────

// ── SALUDO DINÁMICO ───────────────────────────────────────────────────────────
function getSaludo(){
  const h = new Date().getHours();
  const esManager = role === 'manager';
  if(h >= 6 && h < 12) return esManager ? '¡Buenos días! ☀️' : '¡Buenos días! ☀️';
  if(h >= 12 && h < 15) return esManager ? '¡Buen provecho! 🍽️' : '¡Buenas tardes! 👑';
  if(h >= 15 && h < 20) return esManager ? '¡Buenas tardes! 💪' : '¡Buenas tardes! 👑';
  return esManager ? '¡Buenas noches! 🌙' : '¡Buenas noches! 🌙';
}

function getSubSaludo(){
  const esManager = role === 'manager';
  const h = new Date().getHours();
  const msgs = esManager ? [
    'Tienes el control de la cancha 🎯',
    'Cada venta cuenta. ¡A por ello! ⚡',
    'El mejor equipo necesita las mejores camisetas 👕',
    'Que sea un día de muchas ventas 🏆',
    'Fútbol Emotion en marcha 🚀',
  ] : [
    'Tu negocio, bajo control total 📊',
    'Revisa las métricas del día 💰',
    'El equipo está listo para jugar 🏅',
    'Todo bajo control, jefa 👑',
    'Los números son tus mejores aliados 📈',
  ];
  return msgs[Math.floor(Math.random() * msgs.length)];
}

function getHora(){
  return new Date().toLocaleTimeString('es-ES',{hour:'2-digit',minute:'2-digit'});
}

// ══ REPOSICIÓN: cruza stock actual vs. ventas reales para sugerir qué y cuánto pedir ══
const REPO_DIAS = 30;
function fechaHace(dias){ const d=new Date(); d.setDate(d.getDate()-dias); return fechaISO(d); }
function reposicionSugerida(dias){
  dias = dias || REPO_DIAS;
  const desde = fechaHace(dias);
  const vendidas = {};
  ventas.forEach(v=>{
    if(v.camId==null || !v.talla) return;
    if(v.fecha < desde) return;
    const k = v.camId+'|'+v.talla;
    vendidas[k] = (vendidas[k]||0) + (v.cant||1);
  });
  const items = [];
  camisetas.forEach(c=>{
    Object.entries(c.tallas).forEach(([t,stock])=>{
      const vend = vendidas[c.id+'|'+t] || 0;
      if(vend<=0) return;
      if(stock>c.min) return;
      const objetivo = Math.max(c.min, vend);
      const sugerido = Math.max(1, objetivo - stock);
      items.push({camId:c.id, equipo:c.equipo, tipo:c.tipo, prov:c.prov, talla:t, stock, min:c.min, vend, sugerido, agotada: stock===0});
    });
  });
  items.sort((a,b)=>(b.agotada-a.agotada)||(b.vend-a.vend));
  return items;
}
function repoIco(i){ return i.agotada ? '<div class="liico" style="background:var(--rl);color:var(--r)"><i class="ti ti-shirt"></i></div>' : '<div class="liico ia"><i class="ti ti-shirt"></i></div>'; }
function renderRepoCard(){
  const items = reposicionSugerida();
  if(!items.length) return `<div class="abox abox-g"><i class="ti ti-circle-check"></i><div><div class="abox-title">Inventario al día</div><div class="abox-sub">Ninguna talla con ventas está por agotarse</div></div></div>`;
  const agotadas = items.filter(i=>i.agotada).length;
  const top = items.slice(0,3);
  return `<div class="card" style="border-left:4px solid var(--a)">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
      <div><div style="font-size:15px;font-weight:800">${items.length} talla${items.length>1?'s':''} por reponer</div>
      <div style="font-size:12px;color:var(--txm)">${agotadas?agotadas+' agotada'+(agotadas>1?'s':'')+' · ':''}según ventas de ${REPO_DIAS} días</div></div>
      <button onclick="abrirRepo()" style="background:var(--gray);border:none;border-radius:9px;padding:7px 11px;cursor:pointer;font-size:12px;font-weight:700;color:var(--txm)">Ver todo</button>
    </div>
    ${top.map(i=>`<div class="li">${repoIco(i)}
      <div class="libody"><div class="liname">${i.equipo} · ${i.talla}</div><div class="lisub">${i.agotada?'Agotada':'Quedan '+i.stock} · ${i.vend} vend./${REPO_DIAS}d</div></div>
      <div class="liright" style="text-align:right"><div style="font-weight:800;color:var(--g)">+${i.sugerido}</div><div style="font-size:10px;color:var(--txm)">reponer</div></div>
    </div>`).join('')}
  </div>`;
}
function renderRepoModal(){
  const cont = document.getElementById('repo-list');
  if(!cont) return;
  const items = reposicionSugerida();
  if(!items.length){ cont.innerHTML='<div style="text-align:center;color:var(--txm);padding:24px">Nada que reponer por ahora 👍</div>'; return; }
  const porProv = {};
  items.forEach(i=>{ (porProv[i.prov]=porProv[i.prov]||[]).push(i); });
  cont.innerHTML = Object.entries(porProv).map(([prov,arr])=>`
    <div class="stitle">Proveedor ${prov} · ${arr.length} talla${arr.length>1?'s':''}</div>
    <div class="card">
      ${arr.map(i=>`<div class="li">${repoIco(i)}
        <div class="libody"><div class="liname">${i.equipo} <span style="font-size:11px;color:var(--txm)">${i.tipo}</span> · ${i.talla}</div>
        <div class="lisub">${i.agotada?'⚠️ Agotada':'Quedan '+i.stock+' (mín '+i.min+')'} · ${i.vend} vend./${REPO_DIAS}d</div></div>
        <div class="liright" style="text-align:right"><div style="font-weight:800;color:var(--g);font-size:16px">+${i.sugerido}</div><div style="font-size:10px;color:var(--txm)">reponer</div></div>
      </div>`).join('')}
    </div>`).join('') + `<button class="abtn abtn-g" onclick="closeM('m-repo');goTo('pedido')" style="margin-top:14px"><i class="ti ti-clipboard-list"></i> Ir a hacer el pedido</button>`;
}
function abrirRepo(){ renderRepoModal(); openM('m-repo'); }

// ══ ANALÍTICA DE VENTAS (sobre la ventana cargada: últimos 3 meses por defecto) ══
function _semKey(f){ const [y,m,d]=f.split('-').map(Number); return Math.floor((Date.UTC(y,m-1,d)/86400000+3)/7); }
function _lunesSem(k){ const dt=new Date((k*7-3)*86400000); return dt.toISOString().slice(5,10).replace('-','/'); }
function analiticaDatos(){
  const vts=ventas;
  const totalRev=vts.reduce((a,v)=>a+(v.imp||0),0);
  const nV=vts.length;
  const ticket=nV?totalRev/nV:0;
  let ing=0,gas=0;
  transacciones.forEach(t=>{ if(t.tipo==='ingreso') ing+=(t.imp||0); else if(t.tipo==='gasto') gas+=(t.imp||0); });
  const margen= ing>0 ? Math.round((ing-gas)/ing*100) : 0;
  const porEq={};
  vts.forEach(v=>{ const e=porEq[v.equipo]=porEq[v.equipo]||{rev:0,u:0}; e.rev+=(v.imp||0); e.u+=(v.cant||1); });
  const top=Object.entries(porEq).map(([eq,o])=>({eq,rev:o.rev,u:o.u})).sort((a,b)=>b.rev-a.rev).slice(0,6);
  let fisRev=0,fisN=0,onRev=0,onN=0;
  vts.forEach(v=>{ if(v.canal==='Tienda física'){fisRev+=(v.imp||0);fisN++;} else {onRev+=(v.imp||0);onN++;} });
  const porSem={};
  vts.forEach(v=>{ if(!v.fecha) return; const k=_semKey(v.fecha); porSem[k]=(porSem[k]||0)+(v.imp||0); });
  const hoyK=_semKey(hoy()); const serie=[];
  for(let k=hoyK-7;k<=hoyK;k++) serie.push({rev:porSem[k]||0,label:_lunesSem(k)});
  return {totalRev,nV,ticket,margen,top,fisRev,fisN,onRev,onN,serie};
}
function analiticaResumen(a){
  if(!a.nV) return '';
  const canalFuerte = a.fisRev>=a.onRev ? 'tienda física' : 'online';
  const pctFuerte = Math.round(Math.max(a.fisRev,a.onRev)/((a.fisRev+a.onRev)||1)*100);
  const margenTxt = a.margen>=40?'saludable':(a.margen>=20?'aceptable':'ajustado');
  const estrella = a.top.length? a.top[0].eq : '—';
  return `<div class="card" style="background:var(--gl);border:1.5px solid var(--gm);margin-bottom:14px">
    <div style="font-size:12px;font-weight:800;color:var(--gd);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px"><i class="ti ti-bulb"></i> En resumen</div>
    <div style="font-size:14px;color:var(--tx);line-height:1.7">
      Vendiste <b>${fmt(a.totalRev)}</b> en <b>${a.nV}</b> venta${a.nV!==1?'s':''}.<br>
      Lo que más se vende: <b>${estrella}</b>.<br>
      Vendes más por <b>${canalFuerte}</b> (${pctFuerte}%).<br>
      De cada $100 que entra, te quedan <b>$${a.margen}</b>.
    </div>
  </div>`;
}
function renderAnaliticaModal(){
  const cont=document.getElementById('analitica-body'); if(!cont) return;
  const a=analiticaDatos();
  const maxRev=Math.max(1,...a.serie.map(s=>s.rev));
  const totCanal=(a.fisRev+a.onRev)||1;
  cont.innerHTML=`
    ${analiticaResumen(a)}
    <div class="mgrid" style="margin-bottom:14px">
      <div class="mc mc-g"><div class="mcl">Total vendido</div><div class="mcv">${fmt(a.totalRev)}</div><div class="mcs">Lo que entró en total</div></div>
      <div class="mc mc-b"><div class="mcl">Ticket promedio</div><div class="mcv">${fmt(a.ticket)}</div><div class="mcs">Lo que gasta cada cliente</div></div>
      <div class="mc mc-p"><div class="mcl">Margen del negocio</div><div class="mcv">${a.margen}%</div><div class="mcs">Lo que te queda de ganancia</div></div>
      <div class="mc"><div class="mcl">N.º de ventas</div><div class="mcv">${a.nV}</div></div>
    </div>
    <div class="stitle">Tendencia semanal</div>
    <div class="card">
      <div style="display:flex;align-items:flex-end;gap:6px;height:120px">
        ${a.serie.map(sm=>`<div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;height:100%">
          <div style="font-size:9px;color:var(--txm);margin-bottom:3px">${sm.rev>0?'$'+Math.round(sm.rev):''}</div>
          <div style="width:100%;background:var(--g);border-radius:5px 5px 0 0;height:${Math.max(2,Math.round(sm.rev/maxRev*88))}px"></div>
          <div style="font-size:9px;color:var(--txh);margin-top:4px">${sm.label}</div>
        </div>`).join('')}
      </div>
    </div>
    <div class="stitle">Top productos (por plata)</div>
    <div class="card">
      ${a.top.length?a.top.map((t,i)=>`<div class="li">
        <div class="liico ${i===0?'ig':i===1?'ia':'igr'}" style="font-weight:800">${i+1}</div>
        <div class="libody"><div class="liname">${t.eq}</div><div class="lisub">${t.u} unidad${t.u!==1?'es':''}</div></div>
        <div class="liright"><b style="color:var(--g)">${fmt(t.rev)}</b></div>
      </div>`).join(''):'<div style="text-align:center;color:var(--txm);padding:16px">Sin ventas en el período</div>'}
    </div>
    <div class="stitle">Por canal</div>
    <div class="card">
      <div class="li"><div class="liico ig"><i class="ti ti-building-store"></i></div><div class="libody"><div class="liname">Tienda física</div><div class="lisub">${a.fisN} venta${a.fisN!==1?'s':''} · ${Math.round(a.fisRev/totCanal*100)}%</div></div><div class="liright"><b>${fmt(a.fisRev)}</b></div></div>
      <div class="li"><div class="liico ip"><i class="ti ti-device-mobile"></i></div><div class="libody"><div class="liname">Online (IG · WhatsApp · Web)</div><div class="lisub">${a.onN} venta${a.onN!==1?'s':''} · ${Math.round(a.onRev/totCanal*100)}%</div></div><div class="liright"><b>${fmt(a.onRev)}</b></div></div>
    </div>
    <div style="font-size:11px;color:var(--txh);text-align:center;margin-top:12px">Basado en los últimos 3 meses cargados. Para todo el historial usa "Cargar todo" en Inicio.</div>`;
}
function abrirAnalitica(){
  openM('m-analitica');
  try{ renderAnaliticaModal(); }
  catch(e){ const c=document.getElementById('analitica-body'); if(c) c.innerHTML='<div style="padding:18px;color:var(--txm);text-align:center">No se pudo cargar la analítica.</div>'; console.error('Analítica:',e); }
}

// ══ VENTAS POR FECHA: revisar cualquier día o mes ══
function datosPeriodoLibre(filtroFn){
  const vts = ventas.filter(v=>v.fecha && filtroFn(v.fecha));
  const txs = transacciones.filter(t=>t.fecha && filtroFn(t.fecha));
  let ing=0,gas=0,inv=0;
  txs.forEach(t=>{ if(t.tipo==='ingreso') ing+=(t.imp||0); else if(t.tipo==='gasto'){ gas+=(t.imp||0); if(esInversion(t)) inv+=(t.imp||0); } });
  return {vts, ing, gas, inv, neto:ing-gas};
}
let bfModoActual='dia';
function bfSetTabs(){
  const dia=bfModoActual==='dia';
  const on='flex:1;padding:9px;border-radius:9px;border:none;cursor:pointer;font-size:13px;font-weight:700;background:var(--g);color:#fff';
  const off='flex:1;padding:9px;border-radius:9px;border:none;cursor:pointer;font-size:13px;font-weight:700;background:var(--gray);color:var(--txm)';
  document.getElementById('bf-tab-dia').style.cssText=dia?on:off;
  document.getElementById('bf-tab-mes').style.cssText=dia?off:on;
  document.getElementById('bf-dia').style.display=dia?'block':'none';
  document.getElementById('bf-mes').style.display=dia?'none':'block';
}
function abrirBuscarFecha(){
  openM('m-buscarfecha');
  try{
    bfModoActual='dia';
    const di=document.getElementById('bf-dia'); if(di) di.value=hoy();
    const me=document.getElementById('bf-mes'); if(me) me.value=hoy().slice(0,7);
    bfSetTabs();
    bfBuscar();
  }catch(e){ console.error('Buscador:',e); }
}
function bfModo(m){ bfModoActual=m; bfSetTabs(); bfBuscar(); }
async function bfBuscar(){
  const dia=bfModoActual==='dia';
  const val = dia ? document.getElementById('bf-dia').value : document.getElementById('bf-mes').value;
  const cont=document.getElementById('bf-result');
  if(!val){ cont.innerHTML=''; return; }
  // Si la fecha es más vieja que lo cargado, traemos el historial completo primero
  const refDate = dia ? val : val+'-01';
  if(!historialCompleto && refDate < cutoffCarga){
    cont.innerHTML='<div style="text-align:center;color:var(--txm);padding:18px">Cargando historial completo...</div>';
    await cargarHistorialCompleto();
  }
  const filtro = dia ? (fe=>fe===val) : (fe=>fe.slice(0,7)===val);
  const d = datosPeriodoLibre(filtro);
  cont.innerHTML=`
    <div class="mgrid" style="margin-bottom:12px">
      <div class="mc mc-g"><div class="mcl">Ingresos</div><div class="mcv">${fmt(d.ing)}</div></div>
      <div class="mc mc-r"><div class="mcl">${d.inv>0?'Gastos oper.':'Gastos'}</div><div class="mcv">${fmt(d.inv>0?d.gas-d.inv:d.gas)}</div></div>${d.inv>0?`<div class="mc"><div class="mcl">Inversión</div><div class="mcv">${fmt(d.inv)}</div></div>`:''}
      <div class="mc mc-p"><div class="mcl">Beneficio</div><div class="mcv">${fmt(d.neto)}</div></div>
      <div class="mc"><div class="mcl">Ventas</div><div class="mcv">${d.vts.length}</div></div>
    </div>
    <div class="stitle">Ventas ${dia?'del día':'del mes'}</div>
    <div class="card">
      ${d.vts.length ? [...d.vts].reverse().map(v=>`<div class="li">
        <div class="liico ig"><i class="ti ti-shopping-cart"></i></div>
        <div class="libody"><div class="liname">${v.equipo}${v.talla&&v.talla!=='—'?' · '+v.talla:''}</div><div class="lisub">${v.canal||''}${v.cliente?' · '+v.cliente:''}${!dia&&v.fecha?' · '+v.fecha:''}</div></div>
        <div class="liright"><b style="color:var(--g)">${fmt(v.imp)}</b></div>
      </div>`).join('') : '<div style="text-align:center;color:var(--txm);padding:16px">Sin ventas en '+(dia?'este día':'este mes')+'</div>'}
    </div>`;
}

function renderHome(){
  const cont=document.getElementById('home-c');
  const criticos=camisetas.filter(c=>stockStatus(c)==='critico');
  const bajos=camisetas.filter(c=>stockStatus(c)==='bajo');
  const pendDev=devoluciones.filter(d=>d.estado==='pendiente').length;
  const pendPed=pedidos.filter(p=>p.estado==='pendiente').length;
  const envActivos=envios.filter(e=>e.estado!=='entregado').length;

  if(role==='manager'){
    let alertas='';
    if(criticos.length) alertas+=`<div class="abox abox-r"><i class="ti ti-alert-triangle"></i><div><div class="abox-title">Sin stock suficiente</div><div class="abox-sub">${criticos.map(c=>nombreProducto(c)).join(' · ')}</div></div></div>`;
    if(bajos.length) alertas+=`<div class="abox abox-a"><i class="ti ti-alert-circle"></i><div><div class="abox-title">Stock bajo — revisar pronto</div><div class="abox-sub">${bajos.map(c=>nombreProducto(c)).join(' · ')}</div></div></div>`;
    if(pendPed) alertas+=`<div class="abox abox-p"><i class="ti ti-clock"></i><div><div class="abox-title">${pendPed} pedido(s) esperando al dueño</div><div class="abox-sub">En cuanto apruebe podrás recibirlo</div></div></div>`;
    if(pendDev) alertas+=`<div class="abox abox-a"><i class="ti ti-refresh"></i><div><div class="abox-title">${pendDev} cambio(s) de cliente pendiente(s)</div><div class="abox-sub">Ir a Cambios para gestionarlos</div></div></div>`;
    if(!alertas) alertas=`<div class="abox abox-g"><i class="ti ti-circle-check"></i><div><div class="abox-title">Todo en orden</div><div class="abox-sub">Sin alertas activas ahora mismo</div></div></div>`;

    cont.innerHTML=`
      <div class="hero-card">
        <div class="hero-hora">${getHora()} · FÚTBOL EMOTION</div>
        <div class="hero-saludo">${getSaludo()}</div>
        <div class="hero-sub">${getSubSaludo()}</div>
        <div class="hero-badge"><i class="ti ti-user"></i> Encargado</div>
      </div>
      <div class="mgrid">
        <div class="mc mc-b"><i class="ti ti-truck mc-ico"></i><div class="mcl">Envíos activos</div><div class="mcv">${envActivos}</div><div class="mcs">en proceso</div></div>
        <div class="mc ${criticos.length?'mc-r':'mc-g'}"><i class="ti ti-shirt mc-ico"></i><div class="mcl">Stock crítico</div><div class="mcv">${criticos.length}</div><div class="mcs">modelos</div></div>
        <div class="mc ${pendDev?'mc-a':'mc-g'}"><i class="ti ti-refresh mc-ico"></i><div class="mcl">Cambios</div><div class="mcv">${pendDev}</div><div class="mcs">pendientes</div></div>
        <div class="mc ${pendPed?'mc-p':'mc-cyan'}"><i class="ti ti-clipboard-list mc-ico"></i><div class="mcl">Por aprobar</div><div class="mcv">${pendPed}</div><div class="mcs">pedidos</div></div>
      </div>
      <div class="stitle">Alertas</div>
      ${alertas}
      <div class="stitle">Acciones rápidas</div>
      <div class="acc-grid">
      <button class="bigbtn" onclick="goTo('pedido')">
        <div class="bbico" style="background:var(--gl);color:var(--g)"><i class="ti ti-clipboard-list"></i></div>
        <div><div class="bbtitle">Hacer un pedido</div><div class="bbsub">Pedir camisetas al proveedor</div></div>
        <i class="ti ti-chevron-right" style="color:var(--txh);margin-left:auto;font-size:19px"></i>
      </button>
      <button class="bigbtn" onclick="openM('m-env')">
        <div class="bbico" style="background:var(--bl);color:var(--b)"><i class="ti ti-map-pin"></i></div>
        <div><div class="bbtitle">Nuevo envío</div><div class="bbsub">Registrar un envío a cliente</div></div>
        <i class="ti ti-chevron-right" style="color:var(--txh);margin-left:auto;font-size:19px"></i>
      </button>
      <button class="bigbtn" onclick="goTo('misventas')">
        <div class="bbico" style="background:var(--gl);color:var(--g)"><i class="ti ti-shopping-cart"></i></div>
        <div><div class="bbtitle">Registrar venta</div><div class="bbsub">Física o envío online</div></div>
        <i class="ti ti-chevron-right" style="color:var(--txh);margin-left:auto;font-size:19px"></i>
      </button>
      <button class="bigbtn" onclick="goTo('envios')">
        <div class="bbico" style="background:var(--bl);color:var(--b)"><i class="ti ti-map-pin"></i></div>
        <div><div class="bbtitle">Envíos</div><div class="bbsub">Ver y gestionar envíos activos</div></div>
        <i class="ti ti-chevron-right" style="color:var(--txh);margin-left:auto;font-size:19px"></i>
      </button>
      <button class="bigbtn" onclick="goTo('dev')">
        <div class="bbico" style="background:var(--al);color:var(--a)"><i class="ti ti-refresh"></i></div>
        <div><div class="bbtitle">Cambios y devoluciones</div><div class="bbsub">${pendDev>0?pendDev+' pendiente(s)':'Gestionar cambios de talla'}</div></div>
        <i class="ti ti-chevron-right" style="color:var(--txh);margin-left:auto;font-size:19px"></i>
      </button></div>`;
  } else {
  const mesActual=hoy().slice(0,7);
  const ing=transacciones.filter(t=>t.tipo==='ingreso'&&(t.fecha||'').slice(0,7)===mesActual).reduce((s,t)=>s+t.imp,0);
  const gas=transacciones.filter(t=>t.tipo==='gasto'&&(t.fecha||'').slice(0,7)===mesActual).reduce((s,t)=>s+t.imp,0);
  const neto = ing - gas;
    let alertas='';
    if(pendPed) alertas+=`<div class="abox abox-p" style="cursor:pointer" onclick="goTo('aprobar')"><i class="ti ti-clipboard-check"></i><div><div class="abox-title">${pendPed} pedido(s) esperando tu aprobación</div><div class="abox-sub">Toca aquí para revisar y aprobar</div></div><i class="ti ti-chevron-right" style="color:var(--p);margin-left:auto;font-size:20px"></i></div>`;
    if(criticos.length) alertas+=`<div class="abox abox-r"><i class="ti ti-alert-triangle"></i><div><div class="abox-title">Sin stock suficiente</div><div class="abox-sub">${criticos.map(c=>nombreProducto(c)).join(' · ')}</div></div></div>`;
    if(!alertas) alertas=`<div class="abox abox-g"><i class="ti ti-circle-check"></i><div><div class="abox-title">Sin pedidos pendientes</div><div class="abox-sub">Todo está bajo control</div></div></div>`;

    const top=Object.entries(ventas.reduce((acc,v)=>{acc[v.equipo]=(acc[v.equipo]||0)+v.imp;return acc},{})).sort((a,b)=>b[1]-a[1]).slice(0,3);

    cont.innerHTML=`
      <div class="hero-card">
        <div class="hero-hora">${getHora()} · FÚTBOL EMOTION</div>
        <div class="hero-saludo">${getSaludo()}</div>
        <div class="hero-sub">${getSubSaludo()}</div>
        <div class="hero-badge"><i class="ti ti-crown"></i> Dueña</div>
      </div>
      <div class="mgrid">
        <div class="mc mc-g"><i class="ti ti-trending-up mc-ico"></i><div class="mcl">Ingresos</div><div class="mcv">${fmt(ing)}</div></div>
        <div class="mc mc-r"><i class="ti ti-trending-down mc-ico"></i><div class="mcl">Gastos</div><div class="mcv">${fmt(gas)}</div></div>
        <div class="mc mc-p"><i class="ti ti-chart-bar mc-ico"></i><div class="mcl">Beneficio</div><div class="mcv">${fmt(neto)}</div></div>
        <div class="mc mc-b"><i class="ti ti-truck mc-ico"></i><div class="mcl">Envíos activos</div><div class="mcv">${envActivos}</div></div>
      </div>
      <div class="stitle">Ventas de hoy</div>
      <div class="mgrid">
        <div class="mc mc-g"><i class="ti ti-cash mc-ico"></i><div class="mcl">En divisas ($)</div><div class="mcv">${fmt(ventasHoyPorMoneda().divisas)}</div><div class="mcs">efectivo $, Zelle, Binance…</div></div>
        <div class="mc mc-cyan"><i class="ti ti-businessplan mc-ico"></i><div class="mcl">En bolívares</div><div class="mcv" style="font-size:19px">${fmtBs(ventasHoyPorMoneda().bs)}</div><div class="mcs">pago móvil, PDV, efectivo Bs</div></div>
      </div>
      <div class="stitle">Alertas</div>
      ${alertas}
      <div class="stitle">Reposición sugerida</div>
      ${renderRepoCard()}
      <div class="dash2">
      <div><div class="stitle">Top ventas</div>
      <div class="card">
        ${top.map(([eq,v],i)=>`<div class="li"><div class="liico ${i===0?'ig':i===1?'ia':'igr'}" style="font-size:15px;font-weight:800">${i+1}</div><div class="libody"><div class="liname">${eq}</div></div><div class="liright" style="font-weight:800;color:var(--g)">${fmt(v)}</div></div>`).join('')||'<div style="font-size:13px;color:var(--txm);padding:8px 0">Sin ventas registradas aún</div>'}
      </div></div>
      <div><div class="stitle">Últimas transacciones</div>
      <div class="card">
        ${[...transacciones].reverse().slice(0,4).map(t=>`
          <div class="li">
            <div class="liico ${t.tipo==='ingreso'?'ig':'ir'}"><i class="ti ${t.tipo==='ingreso'?'ti-arrow-up':'ti-arrow-down'}"></i></div>
            <div class="libody"><div class="liname">${t.desc}</div><div class="lisub">${t.canal} · ${t.fecha}</div></div>
            <div class="liright" style="font-weight:800;color:${t.tipo==='ingreso'?'var(--g)':'var(--r)'}">${t.tipo==='ingreso'?'+':'-'}${fmt(t.imp)}</div>
          </div>`).join('')}
      </div></div>
      </div>
`;
  }
}

// ── PEDIDO (encargado) ────────────────────────────────────────────────────────
function renderPedido(){
  const cont=document.getElementById('ped-c');
  if(!pedActual.provId){
    cont.innerHTML=`
      <div style="font-size:18px;font-weight:800;margin-bottom:4px">Hacer un pedido</div>
      <div style="font-size:13px;color:var(--txm);margin-bottom:16px">¿A qué proveedor le pides?</div>
      <div class="prov-grid">
        ${[1,2,3,4].map(n=>{
          const nom=(CONFIG['proveedor_'+n]||'').trim();
          const mostrar=(role==='owner'&&nom);
          return `<div class="prov-card" onclick="selProv(${n})">${mostrar
            ? `<div style="font-size:16px;font-weight:800;color:var(--gd);text-align:center;padding:0 8px;line-height:1.25">${nom}</div><div style="font-size:11px;font-weight:700;color:var(--txh);margin-top:4px">Proveedor ${n}</div>`
            : `<div class="prov-num">${n}</div>`}</div>`;
        }).join('')}
      </div>`;
  } else {
    cont.innerHTML=`
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px">
        <button onclick="pedActual.provId=null;renderPedido()" style="background:var(--gray);border:none;border-radius:9px;padding:7px 12px;cursor:pointer;font-size:13px;font-weight:700;color:var(--tx);display:flex;align-items:center;gap:5px"><i class="ti ti-arrow-left"></i> Volver</button>
        <div style="font-size:17px;font-weight:800">${nombreProv(pedActual.provId)}</div>
      </div>
      <div style="font-size:13px;color:var(--txm);margin-bottom:14px">Escribe la camiseta y pon cuántas necesitas de cada talla</div>
      <div id="lineas-cont"></div>
      <button class="abtn abtn-gray abtn-sm" onclick="addLinea()"><i class="ti ti-plus"></i> Añadir otra camiseta</button>
      <div style="margin-top:14px">
        <label class="fl" style="margin-top:0">Notas para el proveedor (opcional)</label>
        <textarea class="fi" id="ped-notas" rows="2" style="resize:none" placeholder="Ej: Urgente para el fin de semana">${pedActual.notas||''}</textarea>
      </div>
      <button class="abtn abtn-g" onclick="enviarPedido()"><i class="ti ti-send"></i> Enviar al dueño para aprobar</button>`;
    pedActual.lineas.forEach((l,i)=>appendLineaDOM(i,l));
    if(!pedActual.lineas.length) addLinea();
  }
}
function appendLineaDOM(i,l){
  const div=document.createElement('div');
  div.id=`linea-${i}`;div.className='ped-linea';
  div.style.cssText='background:var(--gray);border-radius:13px;padding:13px 14px;margin-bottom:10px;position:relative';
  div.innerHTML=`
    <button onclick="removeLinea(${i})" style="position:absolute;top:10px;right:10px;background:none;border:none;font-size:18px;color:var(--txm);cursor:pointer"><i class="ti ti-x"></i></button>
    <label class="fl" style="margin-top:0">Equipo / Camiseta</label>
    <input class="fi ped-equipo" style="font-size:16px" value="${l.equipo||''}" placeholder="Ej: Real Madrid Local">
    <label class="fl">Temporada</label>
    <input class="fi ped-temp" style="font-size:16px" value="${l.temp||'24/25'}" placeholder="24/25">
    <label class="fl">Tallas y cantidades</label>
    <div style="background:var(--card);border-radius:10px;padding:4px 10px">
      ${TALLAS_TODAS.map(t=>`<div class="trow">
        <div class="tlab">${t==='U'?'Única':'Talla '+t}<br><span class="tlab-und">UND</span></div>
        <div class="tcant">
          <button class="cbtn" onclick="chgCant(${i},'${t}',-1)">−</button>
          <div class="cval" id="cv-${i}-${t}">${(l.tallas&&l.tallas[t])||0}</div>
          <button class="cbtn" onclick="chgCant(${i},'${t}',1)">+</button>
        </div>
      </div>`).join('')}
    </div>`;
  document.getElementById('lineas-cont').appendChild(div);
}
function selProv(id){pedActual={provId:id,lineas:[],notas:''};renderPedido()}
function addLinea(){
  const l={equipo:'',temp:'24/25',tallas:{S:0,M:0,L:0,XL:0,XXL:0}};
  pedActual.lineas.push(l);
  appendLineaDOM(pedActual.lineas.length-1,l);
}
function removeLinea(i){pedActual.lineas.splice(i,1);renderPedido()}
function chgCant(i,t,d){
  if(!pedActual.lineas[i]) return;
  if(!pedActual.lineas[i].tallas) pedActual.lineas[i].tallas={S:0,M:0,L:0,XL:0,XXL:0};
  const nv=Math.max(0,(pedActual.lineas[i].tallas[t]||0)+d);
  pedActual.lineas[i].tallas[t]=nv;
  const el=document.getElementById(`cv-${i}-${t}`);
  if(el){el.textContent=nv;el.style.color=nv>0?'var(--g)':'var(--tx)'}
}
async function enviarPedido(){
  const notas=(document.getElementById('ped-notas')?.value||'').trim();
  const bloques=document.querySelectorAll('.ped-linea');
  const lineas=[];
  bloques.forEach((b,i)=>{
    const equipo=(b.querySelector('.ped-equipo')?.value||'').trim();
    const temp=(b.querySelector('.ped-temp')?.value||'24/25').trim();
    const tallas={};
    TALLAS_TODAS.forEach(t=>{tallas[t]=parseInt(document.getElementById(`cv-${i}-${t}`)?.textContent)||0});
    if(equipo) lineas.push({equipo,temp,tallas});
  });
  if(!lineas.length){toast('Escribe al menos una camiseta');return}
  const totalUds=lineas.reduce((s,l)=>s+Object.values(l.tallas).reduce((a,b)=>a+b,0),0);
  if(!totalUds){toast('Añade al menos una unidad con + ');return}
  const ped={id:ids.ped++,provId:pedActual.provId,lineas,notas,estado:'pendiente',fecha:hoy()};
  pedidos.push(ped);sd('pedidos',pedidos);
  pedActual={provId:null,lineas:[]};
  registrarActividad('pedido',`Pedido #${ped.id} enviado al proveedor ${ped.provId}`,`${lineas.length} línea(s) — esperando aprobación`);
  mostrarNotif('📋 Pedido enviado — esperando aprobación del dueño');
  toast('Pedido enviado al dueño ✓');
  updateBadges(); goTo('home');
}

// ── STOCK (encargado) ─────────────────────────────────────────────────────────
let stkQuery='';
function normalizarTxt(s){ return (s==null?'':String(s)).toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g,''); }
function filtrarCamisetas(q){
  if(!q||!q.trim()) return camisetas;
  const tokens = normalizarTxt(q).split(/\s+/).filter(Boolean);
  const pref = normalizarTxt(q).trim();
  const scored = camisetas.map(c=>{
    const campos = normalizarTxt([c.equipo,c.tipo,c.temp,c.categoria,nombreProv(c.prov)].filter(Boolean).join(' '));
    const eq = normalizarTxt(c.equipo);
    let hits=0; for(const tk of tokens){ if(campos.includes(tk)) hits++; }
    return {c, hits, eq, starts:(eq.startsWith(pref)||campos.includes(pref))?1:0};
  }).filter(x=>x.hits>0);                              // coincide al menos una palabra
  scored.sort((a,b)=>(b.hits-a.hits)                   // más palabras coincididas, primero
    || (b.starts-a.starts)                             // luego los que empiezan por lo buscado
    || a.eq.localeCompare(b.eq));
  return scored.map(x=>x.c);
}
function filtrarStock(){
  stkQuery=document.getElementById('stk-search').value;
  // Re-render sin perder el foco del input
  const val=stkQuery, pos=document.getElementById('stk-search').selectionStart;
  renderStock();
  const inp=document.getElementById('stk-search');
  if(inp){inp.focus();try{inp.setSelectionRange(pos,pos)}catch(e){}}
}
function limpiarBusquedaStock(){
  stkQuery='';
  renderStock();
}
function renderStock(){
  const cont=document.getElementById('stk-c');
  const criticos=camisetas.filter(c=>stockStatus(c)==='critico');
  const totalInv=camisetas.reduce((sm,c)=>sm+Object.values(c.tallas).reduce((a,b)=>a+b,0),0);
  cont.innerHTML=`
    <div class="card" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
      <div>
        <div style="font-size:11px;color:var(--txm);font-weight:700;text-transform:uppercase;letter-spacing:.5px">Total en inventario</div>
        <div style="font-size:24px;font-weight:800">${totalInv} <span style="font-size:13px;font-weight:700;color:var(--txm)">unidades</span></div>
      </div>
      <div style="text-align:right;font-size:13px;color:var(--txm);font-weight:700">${camisetas.length} modelo${camisetas.length!==1?'s':''}</div>
    </div>
    ${criticos.length?`<div class="abox abox-r" style="margin-bottom:12px"><i class="ti ti-alert-triangle"></i><div><div class="abox-title">Stock crítico — reponer urgente</div><div class="abox-sub">${criticos.map(c=>nombreProducto(c)).join(' · ')}</div></div></div>`:''}
    <button class="abtn abtn-g" onclick="abrirScannerInventario()" style="margin-top:0;margin-bottom:9px"><i class="ti ti-scan"></i> Escanear mercancía (entrada de stock)</button>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:9px;margin-bottom:12px">
      <button class="abtn abtn-gray abtn-sm" onclick="abrirNuevaCamiseta()" style="margin-top:0"><i class="ti ti-plus"></i> Nueva camiseta</button>
      <button class="abtn abtn-gray abtn-sm" onclick="abrirCarrito()" style="margin-top:0"><i class="ti ti-shopping-cart"></i> Registrar venta</button>
    </div>
    <div style="position:relative;margin-bottom:14px">
      <i class="ti ti-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--txh);font-size:17px"></i>
      <input class="fi" id="stk-search" placeholder="Buscar: equipo, tipo, temporada, proveedor…" oninput="filtrarStock()" style="padding-left:38px;margin:0" value="${stkQuery.replace(/"/g,'&quot;')}">
      ${stkQuery?`<button onclick="limpiarBusquedaStock()" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--txh);font-size:18px"><i class="ti ti-x"></i></button>`:''}
    </div>
    ${camisetas.length===0?`<div class="empty"><i class="ti ti-shirt"></i><p>Sin camisetas en inventario.<br>Pulsa "Nueva camiseta" para empezar.</p></div>`:''}
    ${(()=>{const lista=filtrarCamisetas(stkQuery);return lista.length===0&&camisetas.length>0?`<div class="empty"><i class="ti ti-search-off"></i><p>Nada coincide con "${stkQuery}"</p></div>`:(stkQuery.trim()?`<div style="font-size:12px;color:var(--txm);font-weight:700;margin-bottom:8px">${lista.length} resultado${lista.length!==1?'s':''}</div>`:'')+'<div class="stock-grid">'+lista.map(c=>{
      const s=stockStatus(c);
      const clr=s==='ok'?'var(--g)':s==='bajo'?'var(--a)':'var(--r)';
      const lbl=s==='ok'?'OK':s==='bajo'?'Stock bajo':'Crítico';
      const pill=s==='ok'?'pok':s==='bajo'?'pwarn':'pbad';
      const total=Object.values(c.tallas).reduce((a,b)=>a+b,0);
      const pct=Math.min(100,Math.round(total/(c.min*4||20)*100));
      return `<div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:9px">
          <div>
            <div style="font-size:17px;font-weight:800">${c.equipo}</div>
            <div style="font-size:12px;color:var(--txm)">${esCamiseta(c)?`${c.tipo} · ${c.temp}`:`📦 ${c.categoria}`} · ${nombreProv(c.prov)}</div>
          </div>
          <div style="text-align:right">
            <div style="font-size:21px;font-weight:800;color:${clr}">${total} <span style="font-size:12px;font-weight:700;color:${clr};opacity:.7">UND</span></div>
            <span class="pill ${pill}">${lbl}</span>
          </div>
        </div>
        <div class="tgrid">
          ${tallasDe(c).map(t=>{const v=c.tallas[t]||0;return`<div class="tbox"><div class="tbox-lab">${t==='U'?'Única':t}</div><div class="tbox-val" style="color:${v===0?'var(--r)':v<c.min?'var(--a)':'var(--tx)'}">${v}</div><div class="tbox-und">UND</div></div>`}).join('')}
        </div>
        <div class="pbar" style="margin-top:8px"><div class="pfill" style="width:${pct}%;background:${clr}"></div></div>
        <div style="font-size:11px;color:var(--txh);margin-top:4px">Mínimo por talla: ${c.min} UND</div>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:7px;margin-top:9px">
          <button class="abtn abtn-gray abtn-sm" style="font-size:12px" onclick="editarCamiseta(${c.id})"><i class="ti ti-edit"></i> Editar</button>
          <button class="abtn abtn-gray abtn-sm" style="font-size:12px" onclick="openAjuste(${c.id})"><i class="ti ti-refresh"></i> Ajustar</button>
          <button class="abtn abtn-g abtn-sm" style="font-size:12px" onclick="pedirEste(${c.id})"><i class="ti ti-clipboard-list"></i> Pedir</button>
        </div>
      </div>`;
    }).join('')+'</div>'})()}`;
}
function abrirNuevaCamiseta(){
  document.getElementById('ncam-title').textContent='Nuevo producto';
  document.getElementById('nc-categoria').value='';
  document.getElementById('nc-U').value=0;
  setCatProducto('camiseta');
  document.getElementById('nc-equipo').value='';
  document.getElementById('nc-temp').value='24/25';
  document.getElementById('nc-min').value='5';
  document.getElementById('nc-precio').value='';
  document.getElementById('nc-id').value='';
  document.getElementById('nc-btn-borrar').style.display='none';
  TALLAS_TODAS.forEach(t=>document.getElementById('nc-'+t).value=0);
  document.getElementById('nc-total').textContent='0';
  openM('m-nueva-cam');
  // Listener para calcular total en tiempo real
  TALLAS_TODAS.forEach(t=>{
    document.getElementById('nc-'+t).oninput=actualizarTotalNC;
  });
}
function actualizarTotalNC(){
  const total=catProducto==='otro'
    ? (+document.getElementById('nc-U').value||0)
    : TALLAS.reduce((s,t)=>s+(+document.getElementById('nc-'+t).value||0),0);
  document.getElementById('nc-total').textContent=total;
}
function editarCamiseta(id){
  const c=camisetas.find(x=>x.id===id);if(!c)return;
  document.getElementById('ncam-title').textContent=esCamiseta(c)?'Editar camiseta':'Editar producto';
  setCatProducto(esCamiseta(c)?'camiseta':'otro');
  document.getElementById('nc-categoria').value=esCamiseta(c)?'':c.categoria;
  document.getElementById('nc-equipo').value=c.equipo;
  document.getElementById('nc-temp').value=c.temp;
  document.getElementById('nc-min').value=c.min;
  document.getElementById('nc-precio').value=c.precio!=null?c.precio:'';
  document.getElementById('nc-id').value=c.id;
  document.getElementById('nc-btn-borrar').style.display='flex';
  TALLAS_TODAS.forEach(t=>document.getElementById('nc-'+t).value=c.tallas[t]||0);
  // Tipo y proveedor
  const selTipo=document.getElementById('nc-tipo');
  for(let o of selTipo.options) if(o.text===c.tipo){o.selected=true;break}
  const selProv=document.getElementById('nc-prov');
  for(let o of selProv.options) if(+o.value===c.prov){o.selected=true;break}
  actualizarTotalNC();
  TALLAS_TODAS.forEach(t=>{document.getElementById('nc-'+t).oninput=actualizarTotalNC});
  openM('m-nueva-cam');
}
async function saveNuevaCamiseta(){
  const equipo=document.getElementById('nc-equipo').value.trim();
  const esOtro=catProducto==='otro';
  if(!equipo){toast(esOtro?'Escribe el nombre del producto':'Escribe el nombre del equipo');return}
  let categoria='camiseta';
  if(esOtro){
    categoria=document.getElementById('nc-categoria').value.trim();
    if(!categoria){toast('Escribe qué producto es (Ej: Balón, Medias…)');return}
  }
  const tallas={};
  TALLAS_TODAS.forEach(t=>tallas[t]=+document.getElementById('nc-'+t).value||0);
  if(Object.values(tallas).some(v=>v<0)){toast('⚠️ Las cantidades no pueden ser negativas');return}
  if(+document.getElementById('nc-min').value<0){toast('⚠️ El stock mínimo no puede ser negativo');return}
  if(document.getElementById('nc-precio').value!==''&&+document.getElementById('nc-precio').value<0){toast('⚠️ El precio no puede ser negativo');return}
  if(esOtro) TALLAS.forEach(t=>tallas[t]=0); // producto sin tallas: solo U
  else tallas['U']=0; // camiseta: sin talla única
  const precioVal=document.getElementById('nc-precio').value;
  const data={
    equipo,
    categoria,
    temp:esOtro?'—':(document.getElementById('nc-temp').value.trim()||'24/25'),
    tipo:esOtro?'Otro':document.getElementById('nc-tipo').value,
    tallas,
    min:+document.getElementById('nc-min').value||5,
    prov:+document.getElementById('nc-prov').value||1,
    precio:precioVal!==''?+precioVal:null,
  };
  const editId=+document.getElementById('nc-id').value;
  const payload={equipo:data.equipo,categoria:data.categoria,temporada:data.temp,tipo:data.tipo,tallas:data.tallas,stock_minimo:data.min,proveedor_id:data.prov,precio:data.precio};
  try{
    if(editId){
      const i=camisetas.findIndex(c=>c.id===editId);
      if(i>=0) camisetas[i]={...camisetas[i],...data};
      if(!MODO_SERVIDOR) sd('camisetas',camisetas);
      await syncCamisetas('update',payload,editId);
      toast(esOtro?'Producto actualizado ✓':'Camiseta actualizada ✓');
    } else {
      if(MODO_SERVIDOR){
        const creada=await syncCamisetas('add',payload);
        data.id=creada.id;
      } else {
        data.id=ids.c++;
      }
      camisetas.push(data);
      if(!MODO_SERVIDOR) sd('camisetas',camisetas);
      registrarActividad('stock',esOtro?`Nuevo producto: ${equipo} (${categoria})`:`Nueva camiseta: ${equipo} ${data.tipo}`,esOtro?'':`${data.temp}`);
      // Si veníamos de un escaneo, asociar el código automáticamente
      if(pendingCodigo && MODO_SERVIDOR){
        try{
          await apiCall('POST','/camisetas/barcode',{codigo:pendingCodigo,camiseta_id:data.id,talla:pendingTalla||'M'});
          toast(`${equipo} añadida ✓ Código asociado a talla ${pendingTalla||'M'}`);
        }catch(e){
          toast(`${equipo} añadida ✓ pero el código no se pudo asociar`);
        }
        pendingCodigo=null; pendingTalla=null;
      } else {
        toast(`${equipo} añadida al inventario ✓`);
      }
    }
    closeM('m-nueva-cam');
    renderStock();
  }catch(e){
    toast('No se pudo guardar: '+e.message);
  }
}
async function borrarCamiseta(){
  const id=+document.getElementById('nc-id').value;
  const c=camisetas.find(x=>x.id===id);
  if(!c) return;
  if(!confirm(`¿Eliminar "${nombreProducto(c)}" del inventario? No se puede deshacer.`)) return;
  camisetas=camisetas.filter(x=>x.id!==id);
  if(!MODO_SERVIDOR) sd('camisetas',camisetas);
  await syncCamisetas('delete',null,id);
  closeM('m-nueva-cam');
  toast('Camiseta eliminada');
  renderStock();
}
function openAjuste(id){
  const c=camisetas.find(x=>x.id===id);
  document.getElementById('aj-title').textContent='Ajustar stock';
  document.getElementById('aj-name').textContent=nombreProducto(c);
  TALLAS_TODAS.forEach(t=>document.getElementById('aj-'+t).value=c.tallas[t]||0);
  document.getElementById('aj-id').value=c.id;
  openM('m-ajuste');
}
async function saveAjuste(){
  const id=+document.getElementById('aj-id').value;
  const i=camisetas.findIndex(c=>c.id===id);
  const ajVals=TALLAS_TODAS.map(t=>+document.getElementById('aj-'+t).value||0);
  if(ajVals.some(v=>v<0)){toast('⚠️ Las cantidades no pueden ser negativas');return}
  if(i>=0){TALLAS_TODAS.forEach(t=>{camisetas[i].tallas[t]=+document.getElementById('aj-'+t).value||0})}
  if(!MODO_SERVIDOR) sd('camisetas',camisetas); await syncCamisetas('stock',camisetas[i].tallas,id); const camUpd=camisetas.find(c=>c.id===id); if(camUpd) registrarActividad('stock',`Stock ajustado: ${camUpd.equipo} ${camUpd.tipo}`,`${camUpd.temp}`);
  closeM('m-ajuste');toast('Stock actualizado ✓');renderStock();
}
function pedirEste(id){
  const c=camisetas.find(x=>x.id===id);
  pedActual={provId:c.prov,lineas:[{equipo:`${c.equipo} ${c.tipo}`,temp:c.temp,tallas:{S:0,M:0,L:0,XL:0,XXL:0}}],notas:''};
  goTo('pedido');
}

// ── ENVÍOS ────────────────────────────────────────────────────────────────────
function renderEnvios(){
  const cont=document.getElementById('env-c');
  const filters=['activos','preparando','ruta','entregado'];
  const labels={activos:'Activos',preparando:'Preparando',ruta:'En ruta',entregado:'Ver entregados'};
  const q=(document.getElementById('env-search-input')?.value||'').toLowerCase();
  let list=[...envios].reverse().filter(e=>{
    const filtroEstado=envFilter==='activos'?e.estado!=='entregado':envFilter==='entregado'?e.estado==='entregado':e.estado===envFilter;
    const filtroQ=!q||e.cliente.toLowerCase().includes(q)||e.prods.toLowerCase().includes(q)||e.origen.toLowerCase().includes(q);
    return filtroEstado&&filtroQ;
  });
  cont.innerHTML=`
    <div class="swrap" style="margin-bottom:10px">
      <i class="ti ti-search"></i>
      <input class="sinput" id="env-search-input" placeholder="Buscar por cliente, camiseta, origen…" oninput="renderEnvios()" value="${q}">
    </div>
    <div class="fbar">
      ${filters.map(f=>`<button class="ftag${envFilter===f?' on':''}" onclick="setEnvF('${f}')">${labels[f]}</button>`).join('')}
    </div>
    ${role==='manager'?`<button class="abtn abtn-g abtn-sm" style="margin-top:0;margin-bottom:12px" onclick="openEnvModal()"><i class="ti ti-plus"></i> Nuevo envío</button>`:''}
    <div class="card" id="env-list">
      ${!list.length?`<div class="empty"><i class="ti ti-circle-check" style="color:var(--g)"></i><p>${q?'Sin resultados para "'+q+'"':envFilter==='activos'?'¡Todo entregado! Sin envíos pendientes':'No hay envíos en este estado'}</p></div>`:
      list.map(e=>{
        const ic=eIco(e.estado);
        const avanzar=role==='manager'&&e.estado!=='entregado'?`<button class="abtn abtn-a abtn-sm" onclick="avanzarEnv(${e.id})">${e.estado==='preparando'?'<i class="ti ti-map-pin"></i> Marcar en ruta':'<i class="ti ti-check"></i> Marcar entregado'}</button>`:'';
        return `<div class="li" style="flex-direction:column;align-items:stretch">
          <div style="display:flex;align-items:center;gap:11px">
            <div class="liico ${ic.cls}"><i class="ti ${ic.i}"></i></div>
            <div class="libody"><div class="liname">${e.cliente}</div><div class="lisub">${e.prods}</div></div>
            <div class="liright"><span class="pill ${ePill(e.estado)}">${eLabel(e.estado)}</span></div>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:10px;font-size:12px;color:var(--txm);margin-top:7px;padding-left:49px">
            <span><i class="ti ${origenIco(e.origen)}" style="font-size:13px"></i> ${e.origen}</span>
            <span><i class="ti ti-truck" style="font-size:13px"></i> ${e.trans}</span>
            ${e.dir?`<span><i class="ti ti-map" style="font-size:13px"></i> ${e.dir}</span>`:''}
            <span style="margin-left:auto;font-weight:800;color:var(--tx)">${fmt(e.imp)}</span>
          </div>
          ${e.notas?`<div style="font-size:12px;color:var(--txm);margin-top:5px;padding-left:49px;font-style:italic">"${e.notas}"</div>`:''}
          <div style="padding-left:49px">${avanzar}</div>
        </div>`;
      }).join('')}
    </div>`;
}
function setEnvF(f){envFilter=f;renderEnvios()}
async function avanzarEnv(id){
  const i=envios.findIndex(e=>e.id===id);
  if(i>=0){envios[i].estado=envios[i].estado==='preparando'?'ruta':'entregado'; if(!MODO_SERVIDOR)sd('envios',envios); await syncEnvio('estado',null,id);}
  const envUpd=envios.find(e=>e.id===id); if(envUpd) registrarActividad('estado',`${envUpd.cliente} — ${eLabel(envUpd.estado)}`,envUpd.trans);
  toast('Estado actualizado ✓');renderEnvios();updateBadges();
}
function openEnvModal(){
  ['e-cliente','e-prods','e-dir','e-notas'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('e-imp').value='';
  document.getElementById('e-id').value='';
  openM('m-env');
}
async function saveEnvio(){
  const cliente=document.getElementById('e-cliente').value.trim();
  if(!cliente){toast('Escribe el nombre del cliente');return}
  const editId=+document.getElementById('e-id').value;
  const data={cliente,prods:document.getElementById('e-prods').value.trim(),origen:document.getElementById('e-origen').value,trans:document.getElementById('e-trans').value,dir:document.getElementById('e-dir').value.trim(),imp:+document.getElementById('e-imp').value||0,estado:document.getElementById('e-estado').value,notas:document.getElementById('e-notas').value.trim(),fecha:hoy()};
  if(editId){const i=envios.findIndex(e=>e.id===editId);if(i>=0)envios[i]={...envios[i],...data}}
  else{data.id=ids.env++;envios.push(data)}
  if(!MODO_SERVIDOR) sd('envios',envios); await syncEnvio(editId?'update':'add',data,editId||null); closeM('m-env');if(!editId) registrarActividad('envio',`Envío a ${data.cliente}`,`${data.trans} · ${data.origen} · ${fmt(data.imp)}`);
  toast(editId?'Envío actualizado ✓':'Envío registrado ✓');
  renderEnvios();updateBadges();
}

// ── VENTAS (encargado) ────────────────────────────────────────────────────────
let modoVenta=null; // 'libre' o 'stock'

// ══ CARRITO: venta multi-producto con pago dividido (usa POST /ventas/carrito) ══
let carrito=[];       // {camId, equipo, talla, cant, precioUnit}
let carritoPagos=[];  // {metodo, monto}  (monto en $)
let carritoDescVal=0, carritoDescTipo='pct';   // descuento del carrito
let carritoTipo=null; // 'tienda' | 'online'
let carritoGuardando=false;

function abrirCarrito(){
  carrito=[]; carritoPagos=[]; carritoTipo=null; carritoDescVal=0; carritoDescTipo='pct';
  const sel=document.getElementById('cart-cam');
  sel.innerHTML=camisetas.length
    ? camisetas.map(c=>`<option value="${c.id}">${nombreProducto(c)}</option>`).join('')
    : '<option value="">Sin camisetas en inventario</option>';
  document.getElementById('cart-cant').value=1;
  document.getElementById('cart-cliente').value='';
  const _cc=document.getElementById('cart-cedula'); if(_cc)_cc.value='';
  const _ct=document.getElementById('cart-telefono'); if(_ct)_ct.value='';
  document.getElementById('cart-cliente-wrap').style.display='none';
  carritoTipoBotones();
  carritoAutoPrecio();
  (function(){ const _f=camisetas[0]; const _s=document.getElementById('cart-cam-search'); if(_s)_s.value=_f?nombreProducto(_f):''; const _l=document.getElementById('cart-cam-list'); if(_l){_l.style.display='none';_l.innerHTML='';} carritoStockInfo(); })();
  carritoRenderItems();
  carritoRenderPagos();
  const _dv=document.getElementById('cart-desc-val'); if(_dv) _dv.value='';
  const _dt=document.getElementById('cart-desc-tipo'); if(_dt) _dt.value='pct';
  vueltoAuto=true; vueltoMonedaPrev='usd'; vueltoTasa=0;
  poblarVueltoMonedas();
  const _vm=document.getElementById('vuelto-moneda'); if(_vm) _vm.value='usd';
  calcularVuelto();
  openM('m-carrito');
}
function carritoTipoBotones(){
  const on='flex:1;padding:11px;border-radius:10px;border:1.5px solid var(--g);background:var(--gl);color:var(--gd);font-weight:700;cursor:pointer';
  const off='flex:1;padding:11px;border-radius:10px;border:1.5px solid var(--grayb);background:var(--card);color:var(--txm);font-weight:700;cursor:pointer';
  document.getElementById('cart-tipo-tienda').style.cssText=carritoTipo==='tienda'?on:off;
  document.getElementById('cart-tipo-online').style.cssText=carritoTipo==='online'?on:off;
}
function carritoTipoSet(t){
  carritoTipo=t;
  document.getElementById('cart-cliente-wrap').style.display=(t==='online')?'block':'none';
  carritoTipoBotones(); carritoActualizarConfirm();
}
function carritoBuscarCam(){
  const inp=document.getElementById('cart-cam-search'); const list=document.getElementById('cart-cam-list');
  if(!inp||!list) return;
  const res=filtrarCamisetas(inp.value).slice(0,10);
  if(!res.length){ list.innerHTML='<div style="padding:10px 12px;font-size:13px;color:var(--txm)">Sin resultados</div>'; list.style.display='block'; return; }
  list.innerHTML=res.map(c=>{
    const tot=Object.values(c.tallas||{}).reduce((a,b)=>a+(+b||0),0);
    const col=tot<=0?'var(--rd)':(tot<=3?'var(--ad)':'var(--gd)');
    return `<div onmousedown="carritoSelCam(${c.id})" style="padding:10px 12px;cursor:pointer;border-bottom:1px solid var(--gray);display:flex;justify-content:space-between;align-items:center;gap:8px"><span style="font-size:13.5px;font-weight:600">${nombreProducto(c)}</span><span style="font-size:11px;font-weight:800;color:${col};white-space:nowrap">${tot} UND</span></div>`;
  }).join('');
  list.style.display='block';
}
function carritoSelCam(id){
  const sel=document.getElementById('cart-cam'); if(sel) sel.value=String(id);
  const c=camisetas.find(x=>x.id===id);
  const inp=document.getElementById('cart-cam-search'); if(inp&&c) inp.value=nombreProducto(c);
  const list=document.getElementById('cart-cam-list'); if(list){ list.style.display='none'; list.innerHTML=''; }
  carritoAutoPrecio();
  carritoStockInfo();
}
function carritoStockInfo(){
  const el=document.getElementById('cart-stock-info'); if(!el) return;
  const sel=document.getElementById('cart-cam'); const c=sel?camisetas.find(x=>x.id===+sel.value):null;
  const talla=document.getElementById('cart-talla').value;
  if(!c){ el.innerHTML=''; return; }
  const stock=(c.tallas&&c.tallas[talla])||0;
  const ya=carritoEnCarrito(c.id,talla);
  const disp=Math.max(0,stock-ya);
  const col=disp<=0?'var(--rd)':(disp<=2?'var(--ad)':'var(--gd)');
  el.innerHTML=`<i class="ti ti-stack-2" style="font-size:13px;color:${col}"></i> <b style="color:${col}">${disp}</b> <span style="color:var(--txm)">en existencia (talla ${talla})</span>${ya?` <span style="color:var(--txh)">· ${ya} en el carrito</span>`:''}`;
}
function carritoAutoPrecio(){
  const c=camisetas.find(x=>x.id===+document.getElementById('cart-cam').value);
  if(c && c.precio!=null) document.getElementById('cart-precio').value=(+c.precio).toFixed(2);
}
function carritoEnCarrito(camId,talla){ return carrito.filter(it=>it.camId===camId&&it.talla===talla).reduce((a,it)=>a+it.cant,0); }
function carritoAgregarProducto(){
  const camId=+document.getElementById('cart-cam').value;
  const talla=document.getElementById('cart-talla').value;
  const cant=+document.getElementById('cart-cant').value||1;
  const precio=+document.getElementById('cart-precio').value||0;
  const c=camisetas.find(x=>x.id===camId);
  if(!c){ toast('Selecciona un producto'); return; }
  const stock=c.tallas[talla]||0;
  const ya=carritoEnCarrito(camId,talla);
  if(ya+cant>stock){ toast(`Solo hay ${stock} UND en talla ${talla}${ya?` (ya tienes ${ya} en el carrito)`:''}`); return; }
  carrito.push({camId, equipo:nombreProducto(c), talla, cant, precioUnit:precio});
  document.getElementById('cart-cant').value=1;
  carritoRenderItems(); carritoRenderPagos(); carritoStockInfo();
}
function carritoQuitarProducto(i){ carrito.splice(i,1); carritoRenderItems(); carritoRenderPagos(); }
function carritoTotal(){ return carrito.reduce((a,it)=>a+it.precioUnit*it.cant,0); }
function carritoDescMonto(){ const sub=carritoTotal(); if(sub<=0) return 0; if(carritoDescTipo==='pct'){ const q=Math.min(100,Math.max(0,carritoDescVal)); return +(sub*q/100).toFixed(2);} return Math.min(sub, Math.max(0,carritoDescVal)); }
function carritoTotalCobrar(){ return +Math.max(0, carritoTotal()-carritoDescMonto()).toFixed(2); }
function carritoSetDescVal(v){ carritoDescVal=parseFloat(String(v).replace(',','.'))||0; carritoRenderItems(); carritoRenderPagos(); }
function carritoSetDescTipo(t){ carritoDescTipo=(t==='monto')?'monto':'pct'; carritoRenderItems(); carritoRenderPagos(); }
function pagoEnUsd(p){ const m=METODOS_PAGO[p.metodo]; const val=+p.monto||0; if(m&&m.otra){ const t=+p.tasa||0; return t>0? val/t : 0; } if(m&&m.bs){ const t=tasaActual(); return t>0? val/t : 0; } return val; }
function carritoPagado(){ return carritoPagos.reduce((a,p)=>a+pagoEnUsd(p),0); }
function carritoRenderItems(){
  const cont=document.getElementById('cart-items');
  if(!carrito.length){ cont.innerHTML='<div style="text-align:center;color:var(--txm);padding:12px;font-size:13px">Aún no has agregado productos</div>'; carritoActualizarConfirm(); return; }
  cont.innerHTML=`<div class="card" style="padding:4px 12px">${carrito.map((it,i)=>`<div class="li">
    <div class="libody"><div class="liname">${it.equipo} · ${it.talla}</div><div class="lisub">${it.cant} × ${fmt(it.precioUnit)}</div></div>
    <div class="liright" style="display:flex;align-items:center;gap:12px"><b style="color:var(--g)">${fmt(it.precioUnit*it.cant)}</b><button onclick="carritoQuitarProducto(${i})" style="background:none;border:none;color:var(--r);cursor:pointer;font-size:17px;line-height:1"><i class="ti ti-trash"></i></button></div>
  </div>`).join('')}
    ${(()=>{const d=carritoDescMonto(); if(d>0.001){ return `<div class="li" style="border-top:1px solid var(--grayb)"><div class="libody"><div class="lisub">Subtotal</div></div><div class="liright"><span style="color:var(--txm)">${fmt(carritoTotal())}</span></div></div>
    <div class="li"><div class="libody"><div class="lisub" style="color:var(--rd)">Descuento${carritoDescTipo==='pct'?' ('+carritoDescVal+'%)':''}</div></div><div class="liright"><span style="color:var(--rd);font-weight:700">- ${fmt(d)}</span></div></div>
    <div class="li" style="border-top:2px solid var(--grayb)"><div class="libody"><div class="liname">Total a cobrar</div></div><div class="liright"><b style="font-size:18px;color:var(--g)">${fmt(carritoTotalCobrar())}</b></div></div>`; }
      return `<div class="li" style="border-top:2px solid var(--grayb)"><div class="libody"><div class="liname">Total</div></div><div class="liright"><b style="font-size:18px">${fmt(carritoTotal())}</b></div></div>`; })()}
  </div>`;
  carritoActualizarConfirm();
}
function carritoAgregarPago(){
  const restante=+(carritoTotalCobrar()-carritoPagado()).toFixed(2);
  carritoPagos.push({metodo:'efectivo_usd', monto:Math.max(0,restante)});
  carritoRenderPagos();
}
function carritoQuitarPago(i){ carritoPagos.splice(i,1); carritoRenderPagos(); }
function montoOtraExacto(usd, tasa){ if(!(tasa>0)) return 0; const raw=usd*tasa; return tasa>=50 ? Math.round(raw) : Math.round(raw*100)/100; }
function carritoSetPagoMetodo(i,m){
  const p=carritoPagos[i];
  let tasaKey=null;
  if(m.indexOf('otra:')===0){ tasaKey=m.slice(5); m='efectivo_otra'; }
  p.metodo=m;
  const otros=carritoPagos.reduce((a,q,idx)=>idx===i?a:a+pagoEnUsd(q),0);
  const restUsd=Math.max(0,+(carritoTotalCobrar()-otros).toFixed(2));
  const met=METODOS_PAGO[m];
  if(met&&met.otra){
    if(tasaKey) p.tasaKey=tasaKey;
    if(!p.tasaKey){ const ex=tasasExtra(); p.tasaKey = ex.length?ex[0].id:''; }
    p.tasa = p.tasaKey ? tasaValor(p.tasaKey) : 0;
    p.moneda = p.tasaKey ? tasaNombre(p.tasaKey) : 'Otra';
    p.monto = montoOtraExacto(restUsd, p.tasa);
  } else {
    p.monto = (met&&met.bs)? +(restUsd*tasaActual()).toFixed(2) : restUsd;
  }
  carritoRenderPagos();
}
function carritoSetPagoMonedaOtra(i,key){ const p=carritoPagos[i]; p.tasaKey=key; p.tasa=tasaValor(key); p.moneda=tasaNombre(key); carritoMontoExacto(i); }
function carritoSetPagoTasaOtra(i,v){ carritoPagos[i].tasa=parseFloat(String(v).replace(',','.'))||0; carritoRenderResumen(); carritoActualizarConfirm(); }
function carritoSetTasa(k){
  if(tasaValor(k)<=0){toast('Esa tasa no está configurada (Ajustes)');return}
  const usds = carritoPagos.map(q=>pagoEnUsd(q));   // valor en $ con la tasa anterior
  tasaElegida=k;
  const tNew=tasaActual();
  carritoPagos.forEach((q,idx)=>{ const m=METODOS_PAGO[q.metodo]; if(m&&m.bs && tNew>0){ q.monto=+(usds[idx]*tNew).toFixed(2); } });
  carritoRenderPagos();
}
function carritoSetPagoMonto(i,v){ carritoPagos[i].monto=+v||0; carritoRenderResumen(); carritoActualizarConfirm(); }
function carritoSetPagoRef(i,v){ carritoPagos[i].referencia=v; }
function carritoMontoExacto(i){
  const otros=carritoPagos.reduce((a,q,idx)=>idx===i?a:a+pagoEnUsd(q),0);
  const restUsd=Math.max(0,+(carritoTotalCobrar()-otros).toFixed(2));
  const m=METODOS_PAGO[carritoPagos[i].metodo];
  carritoPagos[i].monto = (m&&m.otra)? montoOtraExacto(restUsd, +carritoPagos[i].tasa) : ((m&&m.bs)? +(restUsd*tasaActual()).toFixed(2) : restUsd);
  carritoRenderPagos();
}
function carritoRenderPagos(){
  const cont=document.getElementById('cart-pagos');
  const hayBs=carritoPagos.some(p=>METODOS_PAGO[p.metodo]&&METODOS_PAGO[p.metodo].bs);
  let tasaHtml='';
  if(hayBs){
    const ops=tasasDisponibles().map(o=>({k:o.k,l:o.label.replace('Dólar ','').replace(' BCV','')}));
    tasaHtml='<div style="font-size:11px;color:var(--txm);margin-bottom:4px">Tasa para los pagos en Bs:</div><div style="display:flex;gap:6px;margin-bottom:10px">'+ops.map(o=>{
      const val=tasaValor(o.k), act=tasaElegida===o.k, dis=val<=0;
      return `<button type="button" ${dis?'disabled':''} onclick="carritoSetTasa('${o.k}')" style="flex:1;padding:5px 3px;border-radius:8px;cursor:${dis?'not-allowed':'pointer'};font-size:11px;font-weight:800;border:2px solid ${act?'var(--gd)':'var(--gm)'};background:${act?'var(--gd)':'#fff'};color:${act?'#fff':'var(--gd)'};opacity:${dis?.5:1}">${o.l}<br><span style="font-size:9px;font-weight:600">${val>0?val.toLocaleString('es-VE'):'—'}</span></button>`;
    }).join('')+'</div>';
  }
  cont.innerHTML=tasaHtml+carritoPagos.map((p,i)=>{
    const m=METODOS_PAGO[p.metodo]; const esBs=m&&m.bs; const esOtra=m&&m.otra;
    const opts=Object.entries(METODOS_PAGO).filter(([k])=>k!=='efectivo_otra').map(([k,mm])=>`<option value="${k}" ${k===p.metodo?'selected':''}>${mm.label}</option>`).join('')+tasasExtra().map(t=>`<option value="otra:${t.id}" ${(p.metodo==='efectivo_otra'&&p.tasaKey===t.id)?'selected':''}>Efectivo ${t.nombre}</option>`).join('');
    const equiv=esBs?`<div style="display:flex;justify-content:space-between;align-items:center;gap:8px;margin-top:4px"><button type="button" onclick="carritoMontoExacto(${i})" style="background:var(--gl);border:1px solid var(--gm);color:var(--gd);border-radius:7px;padding:4px 9px;font-size:11px;font-weight:800;cursor:pointer"><i class="ti ti-calculator" style="font-size:12px"></i> Poner Bs exactos</button><span style="font-size:10.5px;color:var(--txm)">≈ ${fmt(pagoEnUsd(p))}</span></div>`:'';
    const otraCtrl = esOtra ? `<div style="display:flex;align-items:center;gap:8px;margin-top:6px">
        <span style="font-size:11px;color:var(--txm);white-space:nowrap">Tasa/$</span>
        <input class="fi" style="width:92px;font-size:12.5px;padding:8px 9px" type="number" min="0" step="0.0001" value="${p.tasa||''}" oninput="carritoSetPagoTasaOtra(${i},this.value)">
        <button type="button" onclick="carritoMontoExacto(${i})" style="background:var(--gl);border:1px solid var(--gm);color:var(--gd);border-radius:7px;padding:6px 10px;font-size:11px;font-weight:800;cursor:pointer;white-space:nowrap">Exacto</button>
        <span style="flex:1;text-align:right;font-size:10.5px;color:var(--txm)">≈ ${fmt(pagoEnUsd(p))}</span>
      </div>` : '';
    const usaRef = p.metodo!=='efectivo_usd' && p.metodo!=='efectivo_bs' && p.metodo!=='efectivo_otra';
    const refHtml = usaRef ? `<input class="fi" style="width:100%;margin-top:6px;font-size:13px;padding:9px 10px" placeholder="Referencia (opcional)" value="${(p.referencia||'').replace(/"/g,'&quot;')}" oninput="carritoSetPagoRef(${i},this.value)">` : '';
    return `<div style="margin-bottom:8px">
      <div style="display:flex;gap:8px;align-items:center">
        <select class="fi" style="flex:1" onchange="carritoSetPagoMetodo(${i},this.value)">${opts}</select>
        <input class="fi" style="width:104px" type="number" min="0" step="0.01" value="${p.monto}" placeholder="${esOtra?(p.moneda||'Moneda'):(esBs?'Bs':'$')}" oninput="carritoSetPagoMonto(${i},this.value)">
        <button onclick="carritoQuitarPago(${i})" style="background:none;border:none;color:var(--r);cursor:pointer;font-size:18px"><i class="ti ti-x"></i></button>
      </div>${equiv}${otraCtrl}${refHtml}
    </div>`;
  }).join('');
  carritoRenderResumen(); carritoActualizarConfirm();
}
function esEfectivoMetodo(k){ return k==='efectivo_usd'||k==='efectivo_bs'||k==='efectivo_otra'; }
function carritoEstadoPago(){
  const total=carritoTotalCobrar();
  let electUsd=0, cashRecUsd=0, hayBsEfec=false;
  carritoPagos.forEach(p=>{ if(esEfectivoMetodo(p.metodo)){ cashRecUsd+=pagoEnUsd(p); if(p.metodo==='efectivo_bs') hayBsEfec=true; } else electUsd+=pagoEnUsd(p); });
  const restanteTrasElect=Math.max(0,+(total-electUsd).toFixed(2));
  const efectivoAplicado=Math.min(cashRecUsd,restanteTrasElect);
  const pagado=+(electUsd+efectivoAplicado).toFixed(2);
  const falta=+(total-pagado).toFixed(2);
  const vuelto=+(cashRecUsd-restanteTrasElect).toFixed(2);
  const electSobra=+(electUsd-total).toFixed(2);
  return {total, electUsd, cashRecUsd, recibido:+(electUsd+cashRecUsd).toFixed(2), pagado, falta:falta>0.009?falta:0, vuelto:vuelto>0.009?vuelto:0, electSobra:electSobra>0.009?electSobra:0, cubierto:(falta<=0.009&&electSobra<=0.009), efectivoAplicado, hayBsEfec};
}
function carritoRenderResumen(){
  const st=carritoEstadoPago();
  let msg,color;
  if(st.electSobra>0){ msg=`Pago electrónico de más: ${fmt(st.electSobra)} — revísalo`; color='var(--r)'; }
  else if(st.falta>0){ msg=`Faltan ${fmt(st.falta)}`; color='var(--ad)'; }
  else { msg='✓ Pago completo'; color='var(--g)'; }
  let html=`<div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:4px;font-size:12.5px;padding:8px 2px"><span style="color:var(--txm)">Total ${fmt(st.total)} · Recibido ${fmt(st.recibido)}</span><b style="color:${color}">${msg}</b></div>`;
  if(st.vuelto>0){
    const enBs = (st.hayBsEfec && tasaActual()>0) ? `<div style="font-size:13px;color:var(--gd);opacity:.85;margin-top:2px">o ${(st.vuelto*tasaActual()).toLocaleString('es-VE',{maximumFractionDigits:2})} Bs</div>` : '';
    html+=`<div style="background:var(--gl);border:2px solid var(--gm);border-radius:12px;padding:10px 12px;text-align:center;margin-top:2px"><div style="font-size:12px;font-weight:800;color:var(--gd)">VUELTO A ENTREGAR</div><div style="font-size:24px;font-weight:800;color:var(--gd)">${fmt(st.vuelto)}</div>${enBs}</div>`;
  }
  const el=document.getElementById('cart-resumen-pago'); if(el) el.innerHTML=html;
}
let vueltoAuto=true;        // mientras true, la casilla refleja el total (autollenado)
let vueltoMonedaPrev='usd';
let vueltoTasa=0;   // tasa (por $) editable de la moneda no-$ del vuelto; 0 = usar la de Ajustes
function vueltoMonedas(){
  const arr=[{k:'usd',label:'$',factor:1}];
  tasasDisponibles().forEach(t=>{ const f=tasaValor(t.k); if(f>0) arr.push({k:t.k,label:t.label,factor:f}); });
  return arr;
}
function vueltoFactor(k){ const m=vueltoMonedas().find(x=>x.k===k); return m?m.factor:1; }
function vueltoLabelMoneda(k){ const m=vueltoMonedas().find(x=>x.k===k); return m?m.label:k; }
function fmtMoneda(k,val){ if(k==='usd') return fmt(val); return vueltoLabelMoneda(k)+' '+(val||0).toLocaleString('es-VE',{minimumFractionDigits:2,maximumFractionDigits:2}); }
function vueltoFactorEfectivo(moneda){ if(moneda==='usd') return 1; return vueltoTasa>0 ? vueltoTasa : vueltoFactor(moneda); }
function vueltoSetTasa(v){ vueltoTasa=parseFloat(String(v).replace(',','.'))||0; calcularVuelto(); }
function poblarVueltoMonedas(){
  const sel=document.getElementById('vuelto-moneda'); if(!sel) return;
  const actual=sel.value||'usd';
  const ms=vueltoMonedas();
  sel.innerHTML=ms.map(m=>`<option value="${m.k}">${m.label}</option>`).join('');
  sel.value = ms.some(m=>m.k===actual)?actual:'usd';
}
function vueltoInput(){ vueltoAuto=false; calcularVuelto(); }
function vueltoCambiarMoneda(){
  const inp=document.getElementById('vuelto-recibido');
  const sel=document.getElementById('vuelto-moneda');
  const nueva = sel ? sel.value : 'usd';
  const fOld=vueltoFactorEfectivo(vueltoMonedaPrev);
  vueltoTasa = nueva==='usd' ? 0 : vueltoFactor(nueva);   // por defecto, la tasa de Ajustes
  const fNew=vueltoFactorEfectivo(nueva);
  if(!vueltoAuto && inp && inp.value && fOld>0){
    const usd=(+inp.value)/fOld;
    inp.value=+(usd*fNew).toFixed(2);
  }
  vueltoMonedaPrev = nueva;
  calcularVuelto();
}
function calcularVuelto(){
  const out=document.getElementById('vuelto-out'); if(!out) return;
  const inp=document.getElementById('vuelto-recibido');
  const sel=document.getElementById('vuelto-moneda');
  const moneda = sel ? sel.value : 'usd';
  const factor = vueltoFactorEfectivo(moneda);
  const row=document.getElementById('vuelto-tasa-row');
  const tin=document.getElementById('vuelto-tasa');
  if(row) row.style.display = moneda==='usd' ? 'none' : 'flex';
  if(tin && moneda!=='usd' && document.activeElement!==tin){ tin.value = factor; }
  const total=carritoTotalCobrar();
  if(vueltoAuto && inp){ inp.value = +(total*factor).toFixed(2); }
  const recibidoRaw=+(inp&&inp.value)||0;
  const recibidoUsd = factor>0 ? recibidoRaw/factor : 0;
  const vueltoUsd=+(recibidoUsd-total).toFixed(2);
  if(vueltoUsd < -0.001){
    const ex = moneda!=='usd' ? ` \u00b7 ${fmtMoneda(moneda,(-vueltoUsd)*factor)}` : '';
    out.innerHTML=`<div style="background:var(--al);border:2px solid var(--ad);border-radius:12px;padding:12px;text-align:center"><div style="font-size:12px;font-weight:800;color:var(--ad)">A\u00fan falta por cobrar</div><div style="font-size:22px;font-weight:800;color:var(--ad)">${fmt(-vueltoUsd)}${ex}</div></div>`;
  } else if(vueltoUsd <= 0.001){
    out.innerHTML=`<div style="background:var(--gray);border:1px solid var(--grayb);border-radius:12px;padding:10px;text-align:center;font-size:13px;font-weight:700;color:var(--txm)"><i class="ti ti-check" style="color:var(--gd)"></i> Pago justo \u00b7 sin vuelto</div>`;
  } else {
    const ex = moneda!=='usd' ? `<div style="font-size:13px;color:var(--gd);opacity:.8;margin-top:2px">o ${fmtMoneda(moneda,vueltoUsd*factor)}</div>` : '';
    out.innerHTML=`<div style="background:var(--gl);border:2px solid var(--gm);border-radius:12px;padding:12px;text-align:center"><div style="font-size:12px;font-weight:800;color:var(--gd)">Vuelto a entregar</div><div style="font-size:26px;font-weight:800;color:var(--gd)">${fmt(vueltoUsd)}</div>${ex}</div>`;
  }
}
function carritoActualizarConfirm(){
  const btn=document.getElementById('cart-confirm'); if(!btn) return;
  const st=carritoEstadoPago();
  const clienteOk = carritoTipo==='tienda' || (carritoTipo==='online' && document.getElementById('cart-cliente').value.trim());
  const ok = carrito.length>0 && st.total>0 && carritoPagos.length>0 && st.cubierto && !!carritoTipo && clienteOk;
  btn.style.opacity=ok?'1':'.4';
  btn.style.pointerEvents=ok?'auto':'none';
}
async function confirmarCarrito(){
  if(carritoGuardando) return;
  carritoGuardando=true;
  const btn=document.getElementById('cart-confirm'); if(btn){ btn.style.pointerEvents='none'; btn.style.opacity='.5'; }
  try{
    const canal = carritoTipo==='tienda' ? 'Tienda física' : document.getElementById('cart-canal').value;
    const cliente = carritoTipo==='tienda' ? null : document.getElementById('cart-cliente').value.trim();
    const cedula = carritoTipo==='tienda' ? '' : (document.getElementById('cart-cedula').value||'').trim();
    const telefono = carritoTipo==='tienda' ? '' : (document.getElementById('cart-telefono').value||'').trim();
    const _dr = carritoTotal()>0 ? carritoTotalCobrar()/carritoTotal() : 1;
    const _st = carritoEstadoPago();
    const _ratioCash = _st.cashRecUsd>0 ? (_st.efectivoAplicado/_st.cashRecUsd) : 1;
    const payload={
      lineas: carrito.map(it=>({camiseta_id:it.camId, equipo:it.equipo, talla:it.talla, cantidad:it.cant, importe:+(it.precioUnit*it.cant*_dr).toFixed(2)})),
      canal, cliente, cedula, telefono,
      pagos: carritoPagos.map(p=>{ const met=METODOS_PAGO[p.metodo]; const fac=esEfectivoMetodo(p.metodo)?_ratioCash:1; const o={metodo:p.metodo, monto:+(+p.monto*fac).toFixed(2)}; if(met&&met.bs){ o.tasa=tasaActual(); o.tasa_tipo=tasaElegida; } if(met&&met.otra){ o.tasa=+p.tasa||0; o.moneda=p.moneda||'Otra'; } if(p.referencia && String(p.referencia).trim()) o.referencia=String(p.referencia).trim(); return o; }).filter(o=>o.monto>0.005)
    };
    const resp = await apiCall('POST','/ventas/carrito',payload);
    if(resp && resp.ventas){
      closeM('m-carrito');
      toast('✓ Venta registrada' + (resp.numero_venta?` ${resp.numero_venta}`:''));
      await cargarDatosServidor();
      if(curPage==='misventas') renderMisVentas();
      if(curPage==='stock') renderStock();
      if(curPage==='home') renderHome();
    } else {
      toast(resp && resp.error ? resp.error : 'No se pudo registrar la venta');
    }
  }catch(e){
    toast('Error: '+(e.message||'no se pudo registrar la venta'));
  }finally{
    carritoGuardando=false;
    const b=document.getElementById('cart-confirm'); if(b){ b.style.pointerEvents='auto'; b.style.opacity='1'; }
  }
}

function openVentaModal(){
  tipoVenta=null; modoVenta=null; impEditadoManual=false;
  // Reset campos
  ['v-cliente','v-cam-libre','v-imp-libre','v-imp'].forEach(id=>{const el=document.getElementById(id);if(el)el.value='';});
  const cantLibre=document.getElementById('v-cant-libre'); if(cantLibre) cantLibre.value=1;
  const cant=document.getElementById('v-cant'); if(cant) cant.value=1;
  // Reset visibilidad
  ['v-numero-wrap','v-nombre-wrap','v-modo-wrap','v-libre-wrap','v-stock-wrap','v-canal-wrap'].forEach(id=>{
    const el=document.getElementById(id); if(el) el.style.display='none';
  });
  document.getElementById('v-save-btn').style.opacity='.4';
  document.getElementById('v-save-btn').style.pointerEvents='none';
  // Reset botones tipo
  ['tipo-tienda','tipo-envio','modo-libre','modo-stock'].forEach(id=>{
    const el=document.getElementById(id); if(!el) return;
    el.style.borderColor='var(--grayb)'; el.style.background='#fff'; el.style.color='var(--txm)';
  });
  // Cargar stock si hay camisetas
  const sel=document.getElementById('v-cam');
  sel.innerHTML=camisetas.length
    ? camisetas.map(c=>`<option value="${c.id}">${nombreProducto(c)}</option>`).join('')
    : '<option value="">Sin camisetas en inventario</option>';
  toggleTallaVenta();
  metodoPago=null;
  tasaElegida='bcv';
  document.getElementById('v-pago-campos').innerHTML='';
  document.getElementById('v-pago-bs').style.display='none';
  renderMetodosPago();
  openM('m-venta');
}

function setTipoVenta(tipo){
  tipoVenta=tipo; modoVenta=null;
  const numVenta=ids.ventaTienda;
  document.getElementById('v-nombre-wrap').style.display=tipo==='envio'?'block':'none';
  document.getElementById('v-numero-wrap').style.display=tipo==='tienda'?'block':'none';
  document.getElementById('v-canal-wrap').style.display=tipo==='envio'?'block':'none';
  document.getElementById('v-modo-wrap').style.display='block';
  document.getElementById('v-libre-wrap').style.display='none';
  document.getElementById('v-stock-wrap').style.display='none';
  if(tipo==='tienda') document.getElementById('v-num-display').textContent='#'+String(numVenta).padStart(3,'0');
  // Botón guardar desactivado hasta elegir modo
  document.getElementById('v-save-btn').style.opacity='.4';
  document.getElementById('v-save-btn').style.pointerEvents='none';
  // Estilos botones tipo
  ['tipo-tienda','tipo-envio'].forEach(id=>{
    const el=document.getElementById(id); if(!el) return;
    const activo=id==='tipo-'+tipo;
    el.style.borderColor=activo?'var(--gm)':'var(--grayb)';
    el.style.background=activo?'var(--gl)':'#fff';
    el.style.color=activo?'var(--gd)':'var(--txm)';
  });
  // Reset modo botones
  ['modo-libre','modo-stock'].forEach(id=>{
    const el=document.getElementById(id); if(!el) return;
    el.style.borderColor='var(--grayb)'; el.style.background='#fff'; el.style.color='var(--txm)';
  });
}

function setModoVenta(modo){
  modoVenta=modo;
  document.getElementById('v-libre-wrap').style.display=modo==='libre'?'block':'none';
  document.getElementById('v-stock-wrap').style.display=modo==='stock'?'block':'none';
  if(modo==='stock') toggleTallaVenta();
  document.getElementById('v-save-btn').style.opacity='1';
  document.getElementById('v-save-btn').style.pointerEvents='auto';
  ['modo-libre','modo-stock'].forEach(id=>{
    const el=document.getElementById(id); if(!el) return;
    const activo=id==='modo-'+modo;
    el.style.borderColor=activo?'var(--gm)':'var(--grayb)';
    el.style.background=activo?'var(--gl)':'#fff';
    el.style.color=activo?'var(--gd)':'var(--txm)';
  });
}

// Evita ventas duplicadas por doble toque: bloquea el botón mientras guarda
let ventaGuardando=false;
async function saveVenta(){
  if(ventaGuardando) return;
  ventaGuardando=true;
  const _btn=document.getElementById('v-save-btn');
  if(_btn){_btn.style.pointerEvents='none';_btn.style.opacity='.5';}
  try{ await _saveVentaInterno(); }
  finally{
    ventaGuardando=false;
    if(_btn){_btn.style.pointerEvents='auto';_btn.style.opacity='1';}
  }
}
async function _saveVentaInterno(){
  if(!tipoVenta){toast('Elige el tipo de venta primero');return}
  if(!modoVenta){toast('Elige cómo registrar la camiseta');return}

  let canal, desc, cliente, nombreCamiseta, cant, imp;

  // Datos según tipo
  if(tipoVenta==='tienda'){
    const numVenta=ids.ventaTienda++;
    sd('ventaTienda',ids.ventaTienda);
    canal='Tienda física';
    cliente='Venta #'+String(numVenta).padStart(3,'0');
  } else {
    cliente=document.getElementById('v-cliente').value.trim();
    if(!cliente){toast('Escribe el nombre del cliente');return}
    canal=document.getElementById('v-canal').value;
  }

  // Datos según modo
  if(modoVenta==='libre'){
    nombreCamiseta=document.getElementById('v-cam-libre').value.trim();
    if(!nombreCamiseta){toast('Escribe la camiseta');return}
    cant=+document.getElementById('v-cant-libre').value||1;
    imp=+document.getElementById('v-imp-libre').value||0;
    desc=tipoVenta==='tienda'
      ? `${cliente} — ${nombreCamiseta} x${cant}`
      : `${canal} — ${cliente} · ${nombreCamiseta} x${cant}`;

    // Guardar venta libre (sin tocar stock)
    const v={id:ids.ven++,camId:null,equipo:nombreCamiseta,talla:'—',cant,canal,cliente,imp,fecha:hoy(),pagos:datosPago()?[{...datosPago(),moneda:METODOS_PAGO[metodoPago].bs?'VES':'USD'}]:[]};
    ventas.push(v); if(!MODO_SERVIDOR) sd('ventas',ventas);
    try{
      if(MODO_SERVIDOR){ const _r=await syncVenta({camiseta_id:null,equipo:nombreCamiseta,talla:'—',cantidad:cant,canal,cliente,importe:imp,pago:datosPago()}); if(_r&&_r.venta){ v.id=_r.venta.id; v.cliente=_r.venta.cliente; v.numeroVenta=_r.venta.numero_venta; if(tipoVenta==='tienda') cliente=_r.venta.cliente; } }
    }catch(e){ toast('No se pudo guardar en el servidor: '+e.message); }
    const tx={id:ids.tx++,tipo:'ingreso',desc,imp,canal,fecha:hoy()};
    transacciones.push(tx); if(!MODO_SERVIDOR) sd('transacciones',transacciones);
    registrarActividad('venta',`${tipoVenta==='tienda'?cliente+' —':cliente+' ·'} ${nombreCamiseta}`,`${cant} UND · ${fmt(imp)}`);
    closeM('m-venta');
    toast(`✓ ${tipoVenta==='tienda'?cliente:'Venta'} registrada`);

  } else {
    // Modo stock — igual que antes
    const camId=+document.getElementById('v-cam').value;
    const talla=document.getElementById('v-talla').value;
    cant=+document.getElementById('v-cant').value||1;
    imp=+document.getElementById('v-imp').value||0;
    if(!camId){toast('Selecciona una camiseta');return}
    const cam=camisetas.find(c=>c.id===camId);
    if(!cam){toast('Camiseta no encontrada');return}
    const stockActual=cam.tallas[talla]||0;
    if(stockActual<cant){toast(`Solo hay ${stockActual} UND en talla ${talla}`);return}
    desc=tipoVenta==='tienda'
      ? `${cliente} — ${cam.equipo} ${cam.tipo} ${talla} x${cant}`
      : `${canal} — ${cliente} · ${cam.equipo} ${talla} x${cant}`;
    const i=camisetas.findIndex(c=>c.id===camId);
    camisetas[i].tallas[talla]-=cant;
    if(!MODO_SERVIDOR) sd('camisetas',camisetas);
    const v={id:ids.ven++,camId,equipo:`${cam.equipo} ${cam.tipo} ${cam.temp}`,talla,cant,canal,cliente,imp,fecha:hoy(),pagos:datosPago()?[{...datosPago(),moneda:METODOS_PAGO[metodoPago].bs?'VES':'USD'}]:[]};
    ventas.push(v); if(!MODO_SERVIDOR) sd('ventas',ventas);
    { const _r=await syncVenta({camiseta_id:camId,talla,cantidad:cant,canal,cliente,importe:imp,pago:datosPago()}); if(_r&&_r.venta){ v.id=_r.venta.id; v.cliente=_r.venta.cliente; v.numeroVenta=_r.venta.numero_venta; if(tipoVenta==='tienda') cliente=_r.venta.cliente; } }
    const tx={id:ids.tx++,tipo:'ingreso',desc,imp,canal,fecha:hoy()};
    transacciones.push(tx); if(!MODO_SERVIDOR) sd('transacciones',transacciones);
    registrarActividad('venta',`${tipoVenta==='tienda'?cliente+' —':cliente+' ·'} ${cam.equipo} ${cam.tipo} Talla ${talla}`,`${cant} UND · ${fmt(imp)}`);
    closeM('m-venta');
    toast(`✓ ${tipoVenta==='tienda'?cliente:'Venta'} registrada · Stock ${talla}: ${camisetas[i].tallas[talla]} UND`);
  }

  if(curPage==='stock') renderStock();
  if(curPage==='home') renderHome();
  if(curPage==='misventas') renderMisVentas();
}

// ── DEVOLUCIONES (encargado) ──────────────────────────────────────────────────
function renderDev(){
  const cont=document.getElementById('dev-c');
  const filters=['todos','pendiente','aprobado','rechazado','cambiado'];
  const labels={todos:'Todos',pendiente:'Pendientes',aprobado:'Aprobados',rechazado:'Rechazados',cambiado:'Completados'};
  cont.innerHTML=`
    <div class="fbar">${filters.map(f=>`<button class="ftag${devFilter===f?' on':''}" onclick="setDevF('${f}')">${labels[f]}</button>`).join('')}</div>
    <button class="abtn abtn-g abtn-sm" style="margin-top:0;margin-bottom:12px" onclick="openDevModal()"><i class="ti ti-plus"></i> Registrar cambio</button>
    <div>
      ${devoluciones.filter(d=>devFilter==='todos'||d.estado===devFilter).reverse().map(d=>devCard(d)).join('')
      ||'<div class="empty"><i class="ti ti-refresh"></i><p>Sin cambios registrados</p></div>'}
    </div>`;
}
function setDevF(f){devFilter=f;renderDev()}
function devCard(d){
  const map={pendiente:{cls:'pwarn',lbl:'Pendiente'},aprobado:{cls:'pok',lbl:'Aprobado'},rechazado:{cls:'pbad',lbl:'Rechazado'},cambiado:{cls:'ppurp',lbl:'Completado'}};
  const em=map[d.estado]||map.pendiente;
  const esP=d.estado==='pendiente';
  const esAprobado=d.estado==='aprobado';
  let acciones='';
  if(esP&&role==='owner'){
    acciones=`<div style="display:flex;gap:8px;margin-top:8px">
      <button class="abtn abtn-a" style="flex:1;font-size:14px" onclick="aprobarCambio(${d.id})"><i class="ti ti-check"></i> Aprobar</button>
      <button class="abtn abtn-r" style="flex:1;font-size:14px" onclick="rechazarCambio(${d.id})"><i class="ti ti-x"></i> Rechazar</button>
    </div>`;
  } else if(esAprobado){
    acciones=`<button class="abtn abtn-a" onclick="completarCambio(${d.id})" style="margin-top:8px;font-size:14px"><i class="ti ti-check"></i> Cambio entregado al cliente</button>`;
  } else if(esP&&role==='manager'){
    acciones=`<div style="font-size:12px;color:var(--txm);margin-top:8px;font-style:italic">Esperando aprobación del dueño</div>`;
  }
  return `<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px">
      <div><div style="font-size:16px;font-weight:700">${d.cliente}</div><div style="font-size:12px;color:var(--txm)">${d.motivo} · ${d.fecha}</div></div>
      <span class="pill ${em.cls}">${em.lbl}</span>
    </div>
    <div style="background:var(--gray);border-radius:10px;padding:10px 12px;font-size:14px">
      <div style="color:var(--r);margin-bottom:4px"><i class="ti ti-arrow-down" style="font-size:13px"></i> Devuelve: <b>${d.dev}</b></div>
      <div style="color:var(--g)"><i class="ti ti-arrow-up" style="font-size:13px"></i> Quiere: <b>${d.sol}</b></div>
    </div>
    <div style="font-size:13px;font-weight:700;color:var(--txm);margin-top:7px">${fmt(d.imp)}</div>
    ${acciones}
  </div>`;
}
let devModo={dev:'inv',sol:'inv'}; // inv | txt
function llenarCamsDev(lado){
  const sel=document.getElementById(`d-${lado}-cam`);
  sel.innerHTML='<option value="">— Elige camiseta —</option>'+camisetas.map(c=>`<option value="${c.id}">${nombreProducto(c)}</option>`).join('');
  fillTallasDev(lado);
}
function fillTallasDev(lado){
  const camId=+document.getElementById(`d-${lado}-cam`).value;
  const cam=camisetas.find(c=>c.id===camId);
  const sel=document.getElementById(`d-${lado}-talla`);
  if(!cam){sel.innerHTML='<option value="">— Talla —</option>';return}
  const tallas=tallasDe(cam);
  sel.innerHTML=tallas.map(t=>{
    const st=cam.tallas[t]||0;
    return `<option value="${t}">${t==='U'?'Única':t} · ${st} en stock</option>`;
  }).join('');
}
function setDevModo(lado,modo){
  devModo[lado]=modo;
  const esInv=modo==='inv';
  document.getElementById(`d-${lado}-modo-inv`).style.cssText=`flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid ${esInv?'var(--gm)':'var(--grayb)'};background:${esInv?'var(--gl)':'#fff'};color:${esInv?'var(--gd)':'var(--txm)'}`;
  document.getElementById(`d-${lado}-modo-txt`).style.cssText=`flex:1;padding:7px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:700;border:2px solid ${!esInv?'var(--gm)':'var(--grayb)'};background:${!esInv?'var(--gl)':'#fff'};color:${!esInv?'var(--gd)':'var(--txm)'}`;
  document.getElementById(`d-${lado}-cam`).style.display=esInv?'block':'none';
  document.getElementById(`d-${lado}-talla`).style.display=esInv?'block':'none';
  document.getElementById(`d-${lado}`).style.display=esInv?'none':'block';
}
function openDevModal(){
  ['d-cliente','d-dev','d-sol'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('d-imp').value='';
  document.getElementById('d-id').value='';
  devModo={dev:'inv',sol:'inv'};
  llenarCamsDev('dev'); llenarCamsDev('sol');
  setDevModo('dev','inv'); setDevModo('sol','inv');
  openM('m-dev');
}
function ladoDevolucion(lado){
  // Devuelve {texto, camId, talla} según el modo elegido
  if(devModo[lado]==='inv'){
    const camId=+document.getElementById(`d-${lado}-cam`).value;
    const cam=camisetas.find(c=>c.id===camId);
    const talla=document.getElementById(`d-${lado}-talla`).value;
    if(cam){
      const tallaTxt=talla==='U'?'Única':talla;
      return {texto:`${nombreProducto(cam)} talla ${tallaTxt}`.trim(), camId, talla};
    }
    return {texto:'', camId:null, talla:null};
  }
  return {texto:document.getElementById(`d-${lado}`).value.trim(), camId:null, talla:null};
}
async function saveDevolucion(){
  const cliente=document.getElementById('d-cliente').value.trim();
  if(!cliente){toast('Escribe el nombre del cliente');return}
  const editId=+document.getElementById('d-id').value;
  const ladoDev=ladoDevolucion('dev'), ladoSol=ladoDevolucion('sol');
  if(!ladoDev.texto){toast('Indica la camiseta que devuelve');return}
  if(!ladoSol.texto){toast('Indica la camiseta que quiere');return}
  const data={cliente,motivo:document.getElementById('d-motivo').value,dev:ladoDev.texto,sol:ladoSol.texto,devCamId:ladoDev.camId,devTalla:ladoDev.talla,solCamId:ladoSol.camId,solTalla:ladoSol.talla,imp:+document.getElementById('d-imp').value||0,estado:'pendiente',fecha:hoy()};
  try{
    if(editId){
      const i=devoluciones.findIndex(d=>d.id===editId);
      if(i>=0)devoluciones[i]={...devoluciones[i],...data};
    } else {
      if(MODO_SERVIDOR){
        const payload={cliente:data.cliente,motivo:data.motivo,camiseta_devuelta:data.dev,camiseta_solicitada:data.sol,dev_camiseta_id:data.devCamId,dev_talla:data.devTalla,sol_camiseta_id:data.solCamId,sol_talla:data.solTalla,importe:data.imp};
        const creado=await syncDevolucion('add',payload);
        data.id=creado.id;
      } else {
        data.id=ids.dev++;
      }
      devoluciones.push(data);
      registrarActividad('devolucion',`Cambio registrado: ${cliente}`,`${data.dev} → ${data.sol}`);
    }
    if(!MODO_SERVIDOR) sd('devoluciones',devoluciones);
    closeM('m-dev');toast('Cambio registrado ✓');renderDev();
  }catch(e){
    toast('No se pudo guardar: '+e.message);
  }
}
async function aprobarCambio(id){
  try{
    await syncDevolucion('aprobar',null,id);
    const i=devoluciones.findIndex(d=>d.id===id);
    if(i>=0) devoluciones[i].estado='aprobado';
    const devUpd=devoluciones.find(d=>d.id===id); if(devUpd) registrarActividad('devolucion',`Cambio aprobado: ${devUpd.cliente}`,`${devUpd.dev} → ${devUpd.sol}`);
    toast('Cambio aprobado ✓');renderDev();renderHome();
  }catch(e){ toast('No se pudo aprobar: '+e.message); }
}
async function rechazarCambio(id){
  if(!confirm('¿Rechazar este cambio? El encargado ya no podrá completarlo.')) return;
  try{
    await syncDevolucion('rechazar',null,id);
    const i=devoluciones.findIndex(d=>d.id===id);
    if(i>=0) devoluciones[i].estado='rechazado';
    const devUpd=devoluciones.find(d=>d.id===id); if(devUpd) registrarActividad('devolucion',`Cambio rechazado: ${devUpd.cliente}`,`${devUpd.dev} → ${devUpd.sol}`);
    toast('Cambio rechazado');renderDev();renderHome();
  }catch(e){ toast('No se pudo rechazar: '+e.message); }
}
async function completarCambio(id){
  const dev=devoluciones.find(d=>d.id===id);
  // Aviso si la talla que se lleva está en 0 (pero se permite igual)
  if(dev && dev.solCamId && dev.solTalla){
    const cam=camisetas.find(c=>c.id===dev.solCamId);
    if(cam && (cam.tallas[dev.solTalla]||0)<=0){
      if(!confirm('⚠️ La camiseta que se lleva el cliente está en 0 en esa talla. ¿Completar el cambio igual?')) return;
    }
  }
  try{
    if(MODO_SERVIDOR){
      await syncDevolucion('completar',null,id);
      await cargarDatosServidor(); // refrescar stock ajustado por el servidor
    }else{
      const i=devoluciones.findIndex(d=>d.id===id);
      if(i>=0){devoluciones[i].estado='cambiado';sd('devoluciones',devoluciones);}
    }
    if(dev) registrarActividad('devolucion',`Cambio completado: ${dev.cliente}`,`${dev.dev} → ${dev.sol}`);
    toast('Cambio completado ✓ Stock actualizado');
    renderDev();renderHome();
  }catch(e){ toast('No se pudo completar: '+e.message); }
}

// ── APROBAR PEDIDOS (dueño) ───────────────────────────────────────────────────
function renderAprobar(){
  const cont=document.getElementById('apr-c');
  if(!pedidos.length){cont.innerHTML='<div class="empty"><i class="ti ti-clipboard-check"></i><p>No hay pedidos todavía</p></div>';return}
  const pend=pedidos.filter(p=>p.estado==='pendiente');
  const otros=[...pedidos].filter(p=>p.estado!=='pendiente').reverse();
  cont.innerHTML=`
    ${pend.length?`<div class="stitle">Esperando tu aprobación (${pend.length})</div>
      ${pend.map(p=>pedCard(p,true)).join('')}`
    :`<div class="abox abox-g" style="margin-bottom:12px"><i class="ti ti-circle-check"></i><div><div class="abox-title">Sin pedidos pendientes</div></div></div>`}
    ${otros.length?`<div class="stitle">Historial</div>${otros.map(p=>pedCard(p,false)).join('')}`:''}`;
}
function pedCard(p,acc){
  const map={pendiente:{cls:'pwarn',lbl:'Esperando'},aprobado:{cls:'pok',lbl:'Aprobado'},rechazado:{cls:'pbad',lbl:'Rechazado'},recibido:{cls:'ppurp',lbl:'Recibido'}};
  const em=map[p.estado]||map.pendiente;
  const totalUds=p.lineas.reduce((s,l)=>s+Object.values(l.tallas||{}).reduce((a,b)=>a+b,0),0);
  return `<div class="card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
      <div><div style="font-size:16px;font-weight:800">Pedido #${p.id}</div><div style="font-size:12px;color:var(--txm)">${nombreProv(p.provId)} · ${p.fecha} · ${totalUds} <span class="und">UND</span></div></div>
      <span class="pill ${em.cls}">${em.lbl}</span>
    </div>
    ${p.lineas.map(l=>`
      <div style="background:var(--gray);border-radius:10px;padding:10px 12px;margin-bottom:7px">
        <div style="font-weight:700;font-size:14px;margin-bottom:6px">${l.equipo} ${l.temp}</div>
        <div style="display:flex;flex-wrap:wrap;gap:6px">
          ${TALLAS_TODAS.filter(t=>l.tallas&&l.tallas[t]>0).map(t=>`<span style="background:var(--gl);border:1.5px solid var(--gm);border-radius:9px;padding:4px 11px;font-size:13px;font-weight:700;color:var(--gd)">${t==='U'?'Única':'Talla '+t} · ${l.tallas[t]} <span style="font-size:10px;opacity:.7">UND</span></span>`).join('')}
        </div>
      </div>`).join('')}
    ${p.notas?`<div style="font-size:13px;color:var(--txm);font-style:italic;margin-bottom:8px">"${p.notas}"</div>`:''}
    ${acc?`<div style="display:flex;gap:8px;margin-top:4px">
      <button class="abtn abtn-a" style="flex:1" onclick="aprobar(${p.id})"><i class="ti ti-check"></i> Aprobar</button>
      <button class="abtn abtn-r" style="flex:1" onclick="rechazar(${p.id})"><i class="ti ti-x"></i> Rechazar</button>
    </div>`:''}
    ${!acc&&p.estado==='aprobado'&&role==='manager'?`<button class="abtn abtn-gray" onclick="marcarRecibido(${p.id})" style="margin-top:4px"><i class="ti ti-package"></i> Marcar como recibido</button>`:''}
  </div>`;
}
async function aprobar(id){
  const i=pedidos.findIndex(p=>p.id===id);
  if(i>=0){pedidos[i].estado='aprobado'; if(!MODO_SERVIDOR)sd('pedidos',pedidos); await syncPedido('aprobar',null,id);}
  registrarActividad('aprobacion',`Pedido #${id} aprobado`,nombreProv(pedidos.find(p=>p.id===id)?.provId||1));
  mostrarNotif('✓ Pedido aprobado — el encargado puede recibirlo','g');
  toast('Pedido aprobado ✓');renderAprobar();renderHome();updateBadges();
}
async function rechazar(id){
  const i=pedidos.findIndex(p=>p.id===id);
  if(i>=0){pedidos[i].estado='rechazado'; if(!MODO_SERVIDOR)sd('pedidos',pedidos); await syncPedido('rechazar',null,id);}
  registrarActividad('rechazo',`Pedido #${id} rechazado`,'');
  mostrarNotif('Pedido rechazado','r');
  toast('Pedido rechazado');renderAprobar();renderHome();updateBadges();
}
async function marcarRecibido(id){
  const ped=pedidos.find(p=>p.id===id);if(!ped)return;
  ped.lineas.forEach(l=>{
    const ci=camisetas.findIndex(c=>c.equipo+' '+c.tipo===l.equipo&&c.temp===l.temp);
    if(ci>=0) TALLAS_TODAS.forEach(t=>{if(l.tallas[t]) camisetas[ci].tallas[t]=(camisetas[ci].tallas[t]||0)+l.tallas[t]});
  });
  pedidos[pedidos.findIndex(p=>p.id===id)].estado='recibido';
  if(!MODO_SERVIDOR){sd('pedidos',pedidos);sd('camisetas',camisetas);} await syncPedido('recibido',null,id);
  registrarActividad('aprobacion',`Pedido #${id} recibido en tienda`,'Stock actualizado automáticamente');
  toast('Stock actualizado automáticamente ✓');renderAprobar();
}

// ── STOCK DUEÑO ───────────────────────────────────────────────────────────────
let cliQuery='';
function clientesAgregados(){
  const map={};
  (ventas||[]).forEach(v=>{
    let nom=(v.cliente||'').trim();
    if(nom && v.numeroVenta && nom===v.numeroVenta) nom=''; // venta física anónima
    const ced=(v.cedula||'').trim();
    const tel=(v.telefono||'').trim();
    const key = ced ? 'C:'+normalizarTxt(ced) : (tel ? 'T:'+tel.replace(/\D/g,'') : (nom?'N:'+normalizarTxt(nom):''));
    if(!key) return;
    if(!map[key]) map[key]={key, nombre:nom||'(sin nombre)', cedula:ced, telefono:tel, total:0, ventasIds:{}, ultima:'', prendas:{}, canales:{}, detalle:[]};
    const c=map[key];
    if(nom && c.nombre==='(sin nombre)') c.nombre=nom;
    if(ced && !c.cedula) c.cedula=ced;
    if(tel && !c.telefono) c.telefono=tel;
    c.total += (v.imp||0);
    const vid=v.numeroVenta||('L'+v.id);
    c.ventasIds[vid]=1;
    if(!c.ultima || (v.fecha||'')>c.ultima) c.ultima=v.fecha||'';
    const prod=(v.equipo||'')+(v.talla&&v.talla!=='—'?' · '+v.talla:'');
    if(prod.trim()) c.prendas[prod]=(c.prendas[prod]||0)+(v.cant||1);
    if(v.canal) c.canales[v.canal]=1;
    c.detalle.push({fecha:v.fecha||'', prod, imp:v.imp||0, canal:v.canal||''});
  });
  return Object.values(map).map(c=>({
    key:c.key, nombre:c.nombre, cedula:c.cedula, telefono:c.telefono, total:c.total, compras:Object.keys(c.ventasIds).length, ultima:c.ultima,
    prendas:Object.entries(c.prendas).sort((a,b)=>b[1]-a[1]).map(x=>x[0]),
    canales:Object.keys(c.canales),
    detalle:c.detalle.sort((a,b)=>String(b.fecha).localeCompare(String(a.fecha)))
  })).sort((a,b)=>b.total-a.total);
}
function waLink(tel){ let d=String(tel||'').replace(/\D/g,''); if(!d) return ''; if(d.slice(0,2)==='58'){} else if(d[0]==='0') d='58'+d.slice(1); else if(d.length===10) d='58'+d; return 'https://wa.me/'+d; }
function abrirWhatsCliente(telEnc){ const u=waLink(decodeURIComponent(telEnc)); if(u) window.open(u,'_blank'); else toast('Este cliente no tiene teléfono guardado'); }
function clienteEnvios(nombre){ const k=normalizarTxt(nombre); return (envios||[]).filter(e=>normalizarTxt(e.cliente||'')===k); }
function clienteDevoluciones(nombre){ const k=normalizarTxt(nombre); return (devoluciones||[]).filter(d=>normalizarTxt(d.cliente||'')===k); }
function _fechaKey(d){ return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0'); }
function _dashDias(n){ const arr=[]; const base=new Date(hoy()+'T00:00:00'); for(let i=n-1;i>=0;i--){ const d=new Date(base); d.setDate(d.getDate()-i); arr.push(d); } return arr; }
function _dashBarH(label,val,max,color,rightTxt){
  const w=Math.max(2,Math.round((val/(max||1))*100));
  return `<div style="margin-bottom:9px"><div style="display:flex;justify-content:space-between;gap:8px;font-size:12px;margin-bottom:3px"><span style="color:var(--txm);max-width:60%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${label}</span><b style="white-space:nowrap">${rightTxt||fmt(val)}</b></div><div style="background:var(--gray);border-radius:6px;height:10px;overflow:hidden"><div style="height:100%;width:${w}%;background:${color};border-radius:6px"></div></div></div>`;
}
function renderDashboard(){
  const cont=document.getElementById('dash-c'); if(!cont) return;
  const a=analiticaDatos();
  const mesAct=hoy().slice(0,7);
  const dPrev=new Date(hoy()+'T00:00:00'); dPrev.setMonth(dPrev.getMonth()-1);
  const mesAnt=dPrev.getFullYear()+'-'+String(dPrev.getMonth()+1).padStart(2,'0');
  const vMes=ventas.filter(v=>String(v.fecha||'').slice(0,7)===mesAct);
  const revMes=vMes.reduce((s,v)=>s+(v.imp||0),0);
  const nMes=vMes.length; const ticketMes=nMes?revMes/nMes:0;
  const revAnt=ventas.filter(v=>String(v.fecha||'').slice(0,7)===mesAnt).reduce((s,v)=>s+(v.imp||0),0);
  const pct = revAnt>0 ? Math.round((revMes-revAnt)/revAnt*100) : (revMes>0?100:0);
  let ingMes=0,gasMes=0; transacciones.forEach(t=>{ if(String(t.fecha||'').slice(0,7)===mesAct){ if(t.tipo==='ingreso') ingMes+=(t.imp||0); else if(t.tipo==='gasto') gasMes+=(t.imp||0);} });
  const benMes=+(ingMes-gasMes).toFixed(2);
  const dias=_dashDias(14);
  const revPorDia={}; ventas.forEach(v=>{ const k=String(v.fecha||''); if(k) revPorDia[k]=(revPorDia[k]||0)+(v.imp||0); });
  const serieDia=dias.map(d=>({rev:revPorDia[_fechaKey(d)]||0, dia:d.getDate()}));
  const maxDia=Math.max(1,...serieDia.map(s=>s.rev));
  const payAgg={}; ventas.forEach(v=>(v.pagos||[]).forEach(pg=>{ const k=pg.metodo||'otro'; payAgg[k]=(payAgg[k]||0)+(+pg.monto_usd||0); }));
  const payArr=Object.entries(payAgg).map(([k,val])=>({k,val,label:(METODOS_PAGO[k]&&METODOS_PAGO[k].label)||k})).filter(x=>x.val>0.01).sort((x,y)=>y.val-x.val);
  const payTot=payArr.reduce((sm,x)=>sm+x.val,0)||1;
  const maxTop=Math.max(1,...a.top.map(t=>t.rev));
  const totCanal=(a.fisRev+a.onRev)||1;
  const maxMes=Math.max(revMes,revAnt,1);
  cont.innerHTML=`
    <button onclick="goTo('home')" style="background:var(--gray);border:none;border-radius:9px;padding:7px 12px;cursor:pointer;font-size:13px;font-weight:700;color:var(--tx);display:flex;align-items:center;gap:5px;margin-bottom:12px"><i class="ti ti-arrow-left"></i> Volver</button>
    <div style="font-size:19px;font-weight:800;margin-bottom:3px">Dashboard</div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:14px">Resumen del mes</div>
    <div class="mgrid" style="margin-bottom:14px">
      <div class="mc mc-g"><div class="mcl">Ventas del mes</div><div class="mcv">${fmt(revMes)}</div></div>
      <div class="mc mc-p"><div class="mcl">Beneficio del mes</div><div class="mcv">${fmt(benMes)}</div></div>
      <div class="mc mc-b"><div class="mcl">N.º de ventas</div><div class="mcv">${nMes}</div></div>
      <div class="mc"><div class="mcl">Ticket promedio</div><div class="mcv">${fmt(ticketMes)}</div></div>
    </div>
    <div class="stitle">Este mes vs mes pasado</div>
    <div class="card">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
        <div><div style="font-size:12px;color:var(--txm)">Ventas este mes</div><div style="font-size:22px;font-weight:800">${fmt(revMes)}</div></div>
        <div style="background:${pct>=0?'var(--gl)':'var(--rl)'};color:${pct>=0?'var(--gd)':'var(--rd)'};border-radius:10px;padding:6px 12px;font-weight:800;font-size:14px"><i class="ti ti-${pct>=0?'trending-up':'trending-down'}"></i> ${pct>=0?'+':''}${pct}%</div>
      </div>
      ${_dashBarH('Este mes', revMes, maxMes, 'var(--g)')}
      ${_dashBarH('Mes pasado', revAnt, maxMes, 'var(--txh)')}
    </div>
    <div class="stitle">Ventas por día (últimos 14)</div>
    <div class="card">
      <div style="display:flex;align-items:flex-end;gap:4px;height:110px">
        ${serieDia.map(s=>`<div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;height:100%">
          <div style="width:100%;background:${s.rev>0?'var(--g)':'var(--grayb)'};border-radius:4px 4px 0 0;height:${Math.max(2,Math.round(s.rev/maxDia*82))}px"></div>
          <div style="font-size:8.5px;color:var(--txh);margin-top:3px">${s.dia}</div>
        </div>`).join('')}
      </div>
    </div>
    <div class="stitle">Ingresos vs gastos (mes)</div>
    <div class="card">
      ${_dashBarH('Ingresos', ingMes, Math.max(ingMes,gasMes,1), 'var(--g)')}
      ${_dashBarH('Gastos', gasMes, Math.max(ingMes,gasMes,1), 'var(--r)')}
      <div style="display:flex;justify-content:space-between;border-top:1px solid var(--grayb);margin-top:8px;padding-top:8px;font-weight:800"><span>Beneficio</span><span style="color:${benMes>=0?'var(--gd)':'var(--rd)'}">${fmt(benMes)}</span></div>
    </div>
    ${payArr.length?`<div class="stitle">Cómo te pagan</div><div class="card">${payArr.slice(0,6).map(x=>_dashBarH(x.label, x.val, payTot, 'var(--b)', Math.round(x.val/payTot*100)+'%')).join('')}</div>`:''}
    <div class="stitle">Más vendidos</div>
    <div class="card">
      ${a.top.length?a.top.map((t,i)=>_dashBarH(t.eq, t.rev, maxTop, i===0?'var(--g)':'var(--gm)')).join(''):'<div style="text-align:center;color:var(--txm);padding:12px">Sin ventas aún</div>'}
    </div>
    <div class="stitle">Por canal</div>
    <div class="card">
      <div class="li"><div class="liico ig"><i class="ti ti-building-store"></i></div><div class="libody"><div class="liname">Tienda física</div><div class="lisub">${a.fisN} venta${a.fisN!==1?'s':''} · ${Math.round(a.fisRev/totCanal*100)}%</div></div><div class="liright"><b>${fmt(a.fisRev)}</b></div></div>
      <div class="li"><div class="liico ip"><i class="ti ti-device-mobile"></i></div><div class="libody"><div class="liname">Online (IG · WhatsApp · Web)</div><div class="lisub">${a.onN} venta${a.onN!==1?'s':''} · ${Math.round(a.onRev/totCanal*100)}%</div></div><div class="liright"><b>${fmt(a.onRev)}</b></div></div>
    </div>
    <div style="font-size:11px;color:var(--txh);text-align:center;margin-top:12px">Basado en los últimos meses cargados. Para todo el historial usa "Cargar todo" en Inicio.</div>`;
}
function renderMas(){
  const cont=document.getElementById('mas-c'); if(!cont) return;
  const pendPed=pedidos.filter(p=>p.estado==='pendiente').length;
  const pendDev=devoluciones.filter(d=>d.estado==='pendiente').length;
  const item=(oc,icon,bg,color,title,sub)=>`<button class="bigbtn" onclick="${oc}"><div class="bbico" style="background:${bg};color:${color}"><i class="ti ${icon}"></i></div><div><div class="bbtitle">${title}</div><div class="bbsub">${sub}</div></div><i class="ti ti-chevron-right" style="color:var(--txh);margin-left:auto;font-size:19px"></i></button>`;
  cont.innerHTML=`
    <div style="font-size:19px;font-weight:800;margin-bottom:3px">Más opciones</div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:14px">Gestión y reportes</div>
    <div class="acc-grid">
      ${item("goTo('dashboard')",'ti-chart-bar','var(--pl)','var(--p)','Dashboard','Ventas, tendencias y comparativas')}
      ${item("goTo('clientes')",'ti-users','var(--bl)','var(--b)','Clientes','Historial y mejores clientes')}
      ${item("goTo('nomina')",'ti-wallet','var(--gl)','var(--g)','Personal y nómina','Tu equipo y sus pagos')}
      ${item("abrirBuscarFecha()",'ti-calendar-search','var(--bl)','var(--b)','Ventas por fecha','Revisa cualquier día o mes')}
      ${item("goTo('verstock')",'ti-shirt','var(--gl)','var(--g)','Ver stock','Inventario completo por tallas')}
      ${item("goTo('aprobar')",'ti-clipboard-check',pendPed>0?'var(--al)':'var(--gray)',pendPed>0?'var(--a)':'var(--txm)','Pedidos a proveedores',pendPed>0?pendPed+' esperando tu aprobación':'Sin pedidos pendientes')}
      ${item("goTo('dev')",'ti-refresh',pendDev>0?'var(--al)':'var(--gray)',pendDev>0?'var(--a)':'var(--txm)','Cambios y devoluciones',pendDev>0?pendDev+' esperando tu aprobación':'Sin cambios pendientes')}
      ${item("goTo('historial')",'ti-timeline','var(--bl)','var(--b)','Ver historial','Todo lo que hizo el encargado hoy')}
      ${item("goTo('ajustes')",'ti-settings','var(--gray)','var(--txm)','Ajustes','Tasas, datos de cobro, proveedores…')}
    </div>`;
}
function renderNomina(){
  const cont=document.getElementById('nom-c'); if(!cont) return;
  const m=hoy().slice(0,7);
  const pagosMes=(transacciones||[]).filter(t=>t.tipo==='gasto'&&t.canal==='Sueldos'&&String(t.fecha||'').slice(0,7)===m);
  const totMes=pagosMes.reduce((s,t)=>s+(t.imp||0),0);
  const pend=nominaPendientes();
  cont.innerHTML=`
    <button onclick="goTo('home')" style="background:var(--gray);border:none;border-radius:9px;padding:7px 12px;cursor:pointer;font-size:13px;font-weight:700;color:var(--tx);display:flex;align-items:center;gap:5px;margin-bottom:12px"><i class="ti ti-arrow-left"></i> Volver</button>
    <div style="font-size:19px;font-weight:800;margin-bottom:3px">Personal y nómina</div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:14px">Tu equipo y sus pagos</div>
    ${pend.length?`<div class="abox abox-a" style="cursor:pointer;margin-bottom:14px" onclick="abrirNomina()"><i class="ti ti-alarm"></i><div><div class="abox-title">Toca pagar a ${pend.length} trabajador${pend.length>1?'es':''}</div><div class="abox-sub">${pend.map(x=>`${x.p.nombre} · ${x.dias}d (${x.p.frecuencia})`).join(' · ')}</div></div><i class="ti ti-chevron-right" style="color:var(--a);margin-left:auto;font-size:20px"></i></div>`:''}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px">
      <div class="mc mc-r"><div class="mcl">Pagado este mes</div><div class="mcv">${fmt(totMes)}</div></div>
      <div class="mc mc-b"><div class="mcl">Pagos</div><div class="mcv">${pagosMes.length}</div></div>
    </div>
    <button class="abtn abtn-g" onclick="abrirNomina()" style="margin-bottom:18px"><i class="ti ti-cash"></i> Pagar al personal</button>
    <div class="stitle">Personal</div>
    <div class="card">
      <div style="font-size:12.5px;color:var(--txm);margin-bottom:12px">Registra a tu equipo. Al pagarles, el sueldo entra solo como gasto operativo.</div>
      <div id="cfg-personal"></div>
      <div class="frow" style="margin-top:6px">
        <div style="flex:2"><label class="fl" style="margin-top:0">Nombre</label><input class="fi" id="cfg-nuevo-emp-nombre" maxlength="30" placeholder="Ej: Juan"></div>
        <div style="flex:1"><label class="fl" style="margin-top:0">Sueldo ($)</label><input class="fi" id="cfg-nuevo-emp-sueldo" type="number" min="0" step="0.01" placeholder="Opcional"></div>
      </div>
      <label class="fl">Cargo (opcional)</label><input class="fi" id="cfg-nuevo-emp-cargo" maxlength="24" placeholder="Ej: Vendedor">
      <label class="fl">Frecuencia de pago</label>
      <select class="fi" id="cfg-nuevo-emp-frec"><option value="semanal">Semanal</option><option value="quincenal" selected>Quincenal</option><option value="mensual">Mensual</option></select>
      <button class="abtn abtn-gray" id="btn-guardar-emp" onclick="agregarPersonal()" style="margin-top:8px"><i class="ti ti-user-plus"></i> Agregar trabajador</button>
      <button class="abtn abtn-gray" id="btn-cancelar-emp" onclick="cancelarEdicionPersonal()" style="margin-top:8px;display:none"><i class="ti ti-x"></i> Cancelar edición</button>
    </div>`;
  renderPersonal();
}
function exportarClientes(){
  const lista=clientesAgregados();
  if(!lista.length){ toast('No hay clientes para exportar'); return; }
  try{
    const filas=[['Nombre','Cédula','Teléfono','Compras','Total gastado ($)','Última compra','Lo que compra']]
      .concat(lista.map(c=>[c.nombre, c.cedula||'', c.telefono||'', c.compras, +(+c.total).toFixed(2), c.ultima||'', c.prendas.slice(0,5).join(' · ')]));
    const ws=XLSX.utils.aoa_to_sheet(filas);
    ws['!cols']=[{wch:22},{wch:14},{wch:16},{wch:9},{wch:16},{wch:13},{wch:42}];
    const wb=XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb,ws,'Clientes');
    XLSX.writeFile(wb,`clientes_futbol-emotion_${hoy()}.xlsx`);
    toast('Clientes exportados ✓');
  }catch(e){ toast('No se pudo exportar'); }
}
function renderClientes(){
  const cont=document.getElementById('cli-c'); if(!cont) return;
  const todos=clientesAgregados();
  const facturado=todos.reduce((s,c)=>s+c.total,0);
  cont.innerHTML=`
    <button onclick="goTo('home')" style="background:var(--gray);border:none;border-radius:9px;padding:7px 12px;cursor:pointer;font-size:13px;font-weight:700;color:var(--tx);display:flex;align-items:center;gap:5px;margin-bottom:12px"><i class="ti ti-arrow-left"></i> Volver</button>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px"><div style="font-size:19px;font-weight:800">Clientes</div><button onclick="exportarClientes()" style="background:none;border:none;cursor:pointer;color:var(--g);font-size:13px;font-weight:700"><i class="ti ti-download"></i> Exportar</button></div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px">
      <div class="mc mc-b"><div class="mcl">Clientes</div><div class="mcv">${todos.length}</div></div>
      <div class="mc mc-g"><div class="mcl">Facturado</div><div class="mcv">${fmt(facturado)}</div></div>
    </div>
    <div class="swrap" style="margin-bottom:12px"><i class="ti ti-search"></i><input class="sinput" id="cli-search" placeholder="Buscar cliente…" oninput="cliQuery=this.value;renderClientesList()" value="${(cliQuery||'').replace(/"/g,'&quot;')}"></div>
    <div id="cli-list"></div>`;
  renderClientesList();
}
function renderClientesList(){
  const cont=document.getElementById('cli-list'); if(!cont) return;
  const q=normalizarTxt(cliQuery);
  let lista=clientesAgregados();
  if(q) lista=lista.filter(c=>normalizarTxt(c.nombre).includes(q));
  if(!lista.length){ cont.innerHTML=`<div class="empty"><i class="ti ti-users"></i><p>${cliQuery?'Sin resultados':'Aún no hay clientes con nombre registrado'}</p></div>`; return; }
  cont.innerHTML=lista.map(c=>`
    <div class="li" style="cursor:pointer" onclick="abrirCliente('${encodeURIComponent(c.key)}')">
      <div class="liico ig"><i class="ti ti-user"></i></div>
      <div class="libody"><div class="liname">${c.nombre}</div><div class="lisub">${c.compras} compra${c.compras!==1?'s':''} · últ. ${c.ultima||'—'}${c.telefono?' · '+c.telefono:''}</div></div>
      <div class="liright" style="font-weight:800">${fmt(c.total)}</div>
    </div>`).join('');
}
function abrirCliente(keyEnc){
  const key=decodeURIComponent(keyEnc);
  const c=clientesAgregados().find(x=>x.key===key);
  if(!c) return;
  const nombre=c.nombre;
  const envs=clienteEnvios(nombre), devs=clienteDevoluciones(nombre);
  document.getElementById('cli-ficha-nom').textContent=c.nombre;
  const prendasTop=c.prendas.slice(0,6);
  document.getElementById('cli-ficha-body').innerHTML=`
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:14px">
      <div class="mc mc-g"><div class="mcl">Total</div><div class="mcv" style="font-size:15px">${fmt(c.total)}</div></div>
      <div class="mc mc-b"><div class="mcl">Compras</div><div class="mcv" style="font-size:15px">${c.compras}</div></div>
      <div class="mc"><div class="mcl">Última</div><div class="mcv" style="font-size:12px">${c.ultima||'—'}</div></div>
    </div>
    ${(c.cedula||c.telefono)?`<div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:10px">${c.cedula?`<span style="background:var(--gray);border-radius:8px;padding:5px 11px;font-size:12px;font-weight:600"><i class="ti ti-id"></i> ${c.cedula}</span>`:''}${c.telefono?`<span style="background:var(--gray);border-radius:8px;padding:5px 11px;font-size:12px;font-weight:600"><i class="ti ti-phone"></i> ${c.telefono}</span>`:''}</div>`:''}
    ${c.telefono?`<button class="abtn abtn-g" onclick="abrirWhatsCliente('${encodeURIComponent(c.telefono)}')" style="margin-bottom:12px"><i class="ti ti-brand-whatsapp"></i> Escribir por WhatsApp</button>`:''}
    ${prendasTop.length?`<label class="fl" style="margin-top:0">Lo que compra</label><div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px">${prendasTop.map(p=>`<span style="background:var(--gray);border-radius:8px;padding:4px 9px;font-size:12px;font-weight:600">${p}</span>`).join('')}</div>`:''}
    <label class="fl">Historial de compras</label>
    <div class="card" style="padding:4px 0;margin-bottom:${(envs.length||devs.length)?'12':'0'}px">
      ${c.detalle.slice(0,40).map(d=>`<div class="li"><div class="libody"><div class="liname" style="font-size:13px">${d.prod||'Venta'}</div><div class="lisub">${d.canal||''}${d.fecha?' · '+d.fecha:''}</div></div><div class="liright" style="font-weight:800">${fmt(d.imp)}</div></div>`).join('')}
    </div>
    ${envs.length?`<label class="fl">Envíos (${envs.length})</label><div style="font-size:12.5px;color:var(--txm);line-height:1.7;margin-bottom:10px">${envs.map(e=>`${e.prods} · ${e.estado}`).join('<br>')}</div>`:''}
    ${devs.length?`<label class="fl">Cambios / devoluciones (${devs.length})</label><div style="font-size:12.5px;color:var(--txm);line-height:1.7">${devs.map(d=>`${d.dev} → ${d.sol} · ${d.estado}`).join('<br>')}</div>`:''}`;
  openM('m-cliente');
}
function renderVerStock(){
  const cont=document.getElementById('vs-c');
  const criticos=camisetas.filter(c=>stockStatus(c)!=='ok');
  cont.innerHTML=`
    ${criticos.length?`<div class="abox abox-a" style="margin-bottom:12px"><i class="ti ti-alert-circle"></i><div><div class="abox-title">Necesitan reposición</div><div class="abox-sub">${criticos.map(c=>nombreProducto(c)).join(' · ')}</div></div></div>`:''}
    <div class="stock-grid">${camisetas.map(c=>{
      const s=stockStatus(c);
      const clr=s==='ok'?'var(--g)':s==='bajo'?'var(--a)':'var(--r)';
      const total=Object.values(c.tallas).reduce((a,b)=>a+b,0);
      return `<div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:9px">
          <div><div style="font-size:16px;font-weight:800">${c.equipo}</div><div style="font-size:12px;color:var(--txm)">${c.tipo} · ${c.temp} · ${nombreProv(c.prov)}</div></div>
          <div style="font-size:22px;font-weight:800;color:${clr}">${total} <span style="font-size:12px;opacity:.7">UND</span></div>
        </div>
        <div class="tgrid">
          ${tallasDe(c).map(t=>`<div class="tbox"><div class="tbox-lab">${t==='U'?'Única':t}</div><div class="tbox-val" style="color:${(c.tallas[t]||0)<c.min?'var(--r)':'var(--tx)'}">${c.tallas[t]||0}</div><div class="tbox-und">UND</div></div>`).join('')}
        </div>
      </div>`;
    }).join('')}</div>`;
}

// ── FINANZAS (dueño) ──────────────────────────────────────────────────────────
function renderFin(){
  const cont=document.getElementById('fin-c');
  const ing=transacciones.filter(t=>t.tipo==='ingreso').reduce((s,t)=>s+t.imp,0);
  const gas=transacciones.filter(t=>t.tipo==='gasto').reduce((s,t)=>s+t.imp,0);
  const neto=ing-gas;
  const margen=ing>0?Math.round(neto/ing*100):0;

  // Por canal
  const canales=['Tienda física','Instagram','WhatsApp','Web'];
  const canalData=canales.map(c=>({canal:c,total:transacciones.filter(t=>t.tipo==='ingreso'&&t.canal===c).reduce((s,t)=>s+t.imp,0)})).filter(c=>c.total>0);
  const maxCanal=Math.max(...canalData.map(c=>c.total),1);

  // Por semana (últimas 4 semanas)
  const ventasSem=ventas.reduce((acc,v)=>{acc[v.fecha]=(acc[v.fecha]||0)+v.imp;return acc},{});

  cont.innerHTML=`
    <div class="mgrid">
      <div class="mc mc-g"><i class="ti ti-trending-up mc-ico"></i><div class="mcl">Ingresos</div><div class="mcv">${fmt(ing)}</div></div>
      <div class="mc mc-r"><i class="ti ti-trending-down mc-ico"></i><div class="mcl">Gastos</div><div class="mcv">${fmt(gas)}</div></div>
      <div class="mc"><div class="mcl">Beneficio neto</div><div class="mcv" style="color:var(--p)">${fmt(neto)}</div></div>
      <div class="mc"><div class="mcl">Margen</div><div class="mcv">${margen}%</div></div>
    </div>
    <div class="stitle">Ventas por canal</div>
    <div class="card">
      ${canalData.length?canalData.map(c=>`
        <div style="margin-bottom:11px">
          <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:4px">
            <span style="display:flex;align-items:center;gap:5px"><i class="ti ${origenIco(c.canal)}" style="font-size:14px;color:var(--txm)"></i>${c.canal}</span>
            <span style="font-weight:800">${fmt(c.total)}</span>
          </div>
          <div class="pbar"><div class="pfill" style="width:${Math.round(c.total/maxCanal*100)}%;background:var(--gm)"></div></div>
        </div>`).join(''):'<div style="font-size:13px;color:var(--txm)">Sin datos aún</div>'}
    </div>
    <div class="stitle">Top camisetas vendidas</div>
    <div class="card">
      ${Object.entries(ventas.reduce((acc,v)=>{acc[v.equipo]=(acc[v.equipo]||0)+v.imp;return acc},{})).sort((a,b)=>b[1]-a[1]).slice(0,5).map(([eq,v],i)=>`
        <div class="li">
          <div class="liico ${['ig','ia','igr','igr','igr'][i]}" style="font-weight:800;font-size:14px">${i+1}</div>
          <div class="libody"><div class="liname">${eq}</div></div>
          <div class="liright" style="font-weight:800;color:var(--g)">${fmt(v)}</div>
        </div>`).join('')||'<div style="font-size:13px;color:var(--txm)">Sin ventas registradas</div>'}
    </div>
    <div class="stitle">Movimientos</div>
    <div class="card">
      ${[...transacciones].reverse().slice(0,10).map(t=>`
        <div class="li">
          <div class="liico ${t.tipo==='ingreso'?'ig':'ir'}"><i class="ti ${t.tipo==='ingreso'?'ti-arrow-up':'ti-arrow-down'}"></i></div>
          <div class="libody"><div class="liname">${t.desc}</div><div class="lisub">${t.canal} · ${t.fecha}</div></div>
          <div class="liright" style="font-weight:800;color:${t.tipo==='ingreso'?'var(--g)':'var(--r)'}">${t.tipo==='ingreso'?'+':'-'}${fmt(t.imp)}</div>
        </div>`).join('')}
    </div>
    <button class="abtn abtn-g" onclick="abrirTx('gasto')"><i class="ti ti-plus"></i> Registrar movimiento</button>`;
}
function abrirTx(modo='gasto'){
  document.getElementById('tx-desc').value='';
  document.getElementById('tx-imp').value='';
  document.getElementById('tx-tipo').value='gasto';
  document.getElementById('tx-tipo-wrap').style.display='none';
  txModoInversion=(modo==='inversion');
  document.getElementById('tx-title').textContent=txModoInversion?'Registrar inversión':'Registrar gasto';
  document.getElementById('tx-canal-wrap').style.display='none';
  document.getElementById('tx-cat-wrap').style.display=txModoInversion?'none':'block';
  document.getElementById('tx-desc').placeholder=txModoInversion?'Ej: Compra de camisetas, mercancía nueva…':'Ej: Pago de luz, sueldo del personal…';
  openM('m-tx');
}
function toggleTxTipo(){
  const tipo=document.getElementById('tx-tipo').value;
  document.getElementById('tx-title').textContent=tipo==='gasto'?'Registrar gasto':'Registrar ingreso';
  document.getElementById('tx-cat-wrap').style.display=tipo==='gasto'?'block':'none';
  document.getElementById('tx-canal-wrap').style.display=tipo==='gasto'?'none':'block';
}
let txModoInversion=false;
let txGuardando=false;
async function saveTx(){
  if(txGuardando) return;
  const desc=document.getElementById('tx-desc').value.trim();
  const imp=+document.getElementById('tx-imp').value;
  const tipo=document.getElementById('tx-tipo').value;
  if(!desc){toast('Escribe una descripción');return}
  if(!(imp>0)){toast('⚠️ El importe debe ser mayor que 0');return}
  const canal=txModoInversion?'Inversión (mercancía)':document.getElementById('tx-cat').value;
  txGuardando=true;
  try{
    if(MODO_SERVIDOR){
      const r=await apiCall('POST','/transacciones',{tipo,descripcion:desc,importe:imp,canal});
      transacciones.push({id:r.id,tipo,desc,imp,canal,fecha:r.fecha,venta_id:null});
    }else{
      transacciones.push({id:ids.tx++,tipo,desc,imp,canal,fecha:hoy(),venta_id:null});
      sd('transacciones',transacciones);
    }
    registrarActividad('caja',`${tipo==='gasto'?'Gasto':'Ingreso'}: ${desc} [${canal}]`,`${tipo==='gasto'?'-':'+'}$${imp.toFixed(2)}`);
    closeM('m-tx');toast(tipo==='gasto'?'Gasto registrado ✓':'Ingreso registrado ✓');
    if(curPage==='caja') renderCaja();
  }catch(e){/* apiCall ya mostró el error */}
  txGuardando=false;
}
async function eliminarTx(id){
  const t=transacciones.find(x=>x.id===id);if(!t)return;
  if(!confirm(`¿Eliminar "${t.desc}" (${t.tipo==='ingreso'?'+':'-'}${fmt(t.imp)})?`))return;
  try{
    if(MODO_SERVIDOR) await apiCall('DELETE','/transacciones/'+id);
    const i=transacciones.findIndex(x=>x.id===id);
    if(i>=0){transacciones.splice(i,1); if(!MODO_SERVIDOR) sd('transacciones',transacciones);}
    registrarActividad('caja',`Movimiento eliminado: ${t.desc}`,`${t.tipo==='ingreso'?'+':'-'}$${t.imp.toFixed(2)}`);
    toast('Movimiento eliminado ✓');
    if(curPage==='caja') renderCaja();
  }catch(e){/* apiCall ya mostró el error */}
}

// ── CIERRE DE CAJA ────────────────────────────────────────────────────────────
function renderCaja(){
  const cont=document.getElementById('caja-c');
  const ahora=new Date();
  const hoyStr=hoy();

  // Calcular inicio de semana (lunes)
  const diasSemana=ahora.getDay()===0?6:ahora.getDay()-1;
  const inicioSem=new Date(ahora); inicioSem.setDate(ahora.getDate()-diasSemana);
  const inicioSemStr=fechaISO(inicioSem);

  // Calcular inicio de mes
  const inicioMesStr=`${ahora.getFullYear()}-${String(ahora.getMonth()+1).padStart(2,'0')}-01`;

  function calcPeriodo(desde,hasta){
    const txs=transacciones.filter(t=>t.fecha>=desde&&t.fecha<=(hasta||hoyStr));
    const ing=txs.filter(t=>t.tipo==='ingreso').reduce((s,t)=>s+t.imp,0);
    const gas=txs.filter(t=>t.tipo==='gasto').reduce((s,t)=>s+t.imp,0);
    const vFis=ventas.filter(v=>v.fecha>=desde&&v.fecha<=(hasta||hoyStr)&&v.canal==='Tienda física');
    const vOnl=ventas.filter(v=>v.fecha>=desde&&v.fecha<=(hasta||hoyStr)&&v.canal!=='Tienda física');
    const envs=envios.filter(e=>e.fecha>=desde&&e.fecha<=(hasta||hoyStr));
    return {ing,gas,neto:ing-gas,vFis,vOnl,envs,txs};
  }

  const dia=calcPeriodo(hoyStr);
  const sem=calcPeriodo(inicioSemStr);
  const mes=calcPeriodo(inicioMesStr);

  function bloqueResumen(titulo,icono,color,data,periodo,clave){
    const margen=data.ing>0?Math.round((data.neto/data.ing)*100):0;
    return `
      <div class="card" style="border-left:4px solid ${color};margin-bottom:14px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
          <div style="display:flex;align-items:center;gap:9px">
            <div style="width:38px;height:38px;border-radius:10px;background:${color}22;display:flex;align-items:center;justify-content:center;font-size:20px;color:${color}"><i class="ti ${icono}"></i></div>
            <div><div style="font-size:16px;font-weight:800">${titulo}</div><div style="font-size:12px;color:var(--txm)">${periodo}</div></div>
          </div>
          <button onclick="abrirExport('${clave}')" style="background:var(--gray);border:none;border-radius:9px;padding:7px 11px;cursor:pointer;font-size:12px;font-weight:700;color:var(--txm);display:${role==='owner'?'flex':'none'};align-items:center;gap:5px"><i class="ti ti-download" style="font-size:15px"></i> Exportar</button>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:12px">
          <div style="background:var(--gl);border-radius:10px;padding:11px 13px">
            <div style="font-size:11px;font-weight:700;color:var(--txm);text-transform:uppercase;margin-bottom:3px">Ingresos</div>
            <div style="font-size:20px;font-weight:800;color:var(--g)">${fmt(data.ing)}</div>
          </div>
          <div style="background:var(--rl);border-radius:10px;padding:11px 13px">
            <div style="font-size:11px;font-weight:700;color:var(--txm);text-transform:uppercase;margin-bottom:3px">${data.inv>0?'Gastos oper.':'Gastos'}</div>
            <div style="font-size:20px;font-weight:800;color:var(--r)">${fmt(data.inv>0?data.gas-data.inv:data.gas)}</div>
          </div>
          ${data.inv>0?`<div style="background:var(--al);border-radius:10px;padding:11px 13px">
            <div style="font-size:11px;font-weight:700;color:var(--txm);text-transform:uppercase;margin-bottom:3px">Inversión</div>
            <div style="font-size:20px;font-weight:800;color:var(--ad)">${fmt(data.inv)}</div>
          </div>`:''}
          <div style="background:var(--pl);border-radius:10px;padding:11px 13px">
            <div style="font-size:11px;font-weight:700;color:var(--txm);text-transform:uppercase;margin-bottom:3px">Beneficio</div>
            <div style="font-size:20px;font-weight:800;color:var(--p)">${fmt(data.neto)}</div>
          </div>
          <div style="background:var(--gray);border-radius:10px;padding:11px 13px">
            <div style="font-size:11px;font-weight:700;color:var(--txm);text-transform:uppercase;margin-bottom:3px">Margen</div>
            <div style="font-size:20px;font-weight:800;color:var(--tx)">${margen}%</div>
          </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:12px">
          <div style="background:var(--gray);border-radius:10px;padding:10px;text-align:center">
            <div style="font-size:11px;color:var(--txm);font-weight:700;margin-bottom:3px">Ventas físicas</div>
            <div style="font-size:18px;font-weight:800;color:var(--g)">${data.vFis.length}</div>
            <div style="font-size:11px;color:var(--txh)">${fmt(data.vFis.reduce((s,v)=>s+v.imp,0))}</div>
          </div>
          <div style="background:var(--gray);border-radius:10px;padding:10px;text-align:center">
            <div style="font-size:11px;color:var(--txm);font-weight:700;margin-bottom:3px">Ventas online</div>
            <div style="font-size:18px;font-weight:800;color:var(--b)">${data.vOnl.length}</div>
            <div style="font-size:11px;color:var(--txh)">${fmt(data.vOnl.reduce((s,v)=>s+v.imp,0))}</div>
          </div>
          <div style="background:var(--gray);border-radius:10px;padding:10px;text-align:center">
            <div style="font-size:11px;color:var(--txm);font-weight:700;margin-bottom:3px">Envíos</div>
            <div style="font-size:18px;font-weight:800;color:var(--a)">${data.envs.length}</div>
            <div style="font-size:11px;color:var(--txh)">en período</div>
          </div>
        </div>
        ${data.txs.length?`
        <div style="font-size:11px;font-weight:700;color:var(--txm);text-transform:uppercase;letter-spacing:.4px;margin-bottom:8px">Movimientos del período</div>
        ${data.txs.slice(-6).reverse().map(t=>`
          <div style="display:flex;align-items:center;justify-content:space-between;padding:7px 0;border-bottom:1px solid var(--gray);font-size:13px">
            <div style="display:flex;align-items:center;gap:8px">
              <div style="width:28px;height:28px;border-radius:8px;background:${t.tipo==='ingreso'?'var(--gl)':'var(--rl)'};display:flex;align-items:center;justify-content:center;font-size:14px;color:${t.tipo==='ingreso'?'var(--g)':'var(--r)'}"><i class="ti ${t.tipo==='ingreso'?'ti-arrow-up':'ti-arrow-down'}"></i></div>
              <span style="color:var(--txm)">${t.desc}</span>
            </div>
            <span style="font-weight:800;color:${t.tipo==='ingreso'?'var(--g)':'var(--r)'}">${t.tipo==='ingreso'?'+':'-'}${fmt(t.imp)}</span>
          </div>`).join('')}
        `:'<div style="font-size:13px;color:var(--txh);text-align:center;padding:10px">Sin movimientos</div>'}
      </div>`;
  }

  cont.innerHTML=`
    <div style="font-size:19px;font-weight:800;margin-bottom:4px">Cierre de caja</div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:14px">Hoy: ${hoyStr}</div>
    ${(()=>{ if(role!=='owner') return ''; const pend=nominaPendientes(); if(!pend.length) return ''; const txt=pend.map(x=>`${x.p.nombre} · ${x.dias}d (${x.p.frecuencia})`).join(' · '); return `<div class="abox abox-a" style="cursor:pointer;margin-bottom:14px" onclick="abrirNomina()"><i class="ti ti-alarm"></i><div><div class="abox-title">Toca pagar a ${pend.length} trabajador${pend.length>1?'es':''}</div><div class="abox-sub">${txt}</div></div><i class="ti ti-chevron-right" style="color:var(--a);margin-left:auto;font-size:20px"></i></div>`; })()}
    <div style="display:grid;grid-template-columns:${role==='owner'?'1fr 1fr':'1fr'};gap:10px;margin-bottom:18px">
      <button onclick="abrirTx('gasto')" style="padding:18px 12px;border-radius:14px;border:2px solid var(--rd);background:var(--rl);cursor:pointer;display:flex;flex-direction:column;align-items:center;gap:6px;box-shadow:var(--shadow)">
        <i class="ti ti-receipt-2" style="font-size:30px;color:var(--rd)"></i>
        <span style="font-size:15px;font-weight:800;color:var(--rd)">Gastos de la empresa</span>
        <span style="font-size:11px;font-weight:600;color:var(--rd);opacity:.75">Sueldos, servicios, transporte…</span>
      </button>
      ${role==='owner'?`<button onclick="abrirTx('inversion')" style="padding:18px 12px;border-radius:14px;border:2px solid var(--gd);background:var(--gl);cursor:pointer;display:flex;flex-direction:column;align-items:center;gap:6px;box-shadow:var(--shadow)">
        <i class="ti ti-building-store" style="font-size:30px;color:var(--gd)"></i>
        <span style="font-size:15px;font-weight:800;color:var(--gd)">Inversión de la empresa</span>
        <span style="font-size:11px;font-weight:600;color:var(--gd);opacity:.75">Compra de mercancía / stock</span>
      </button>`:''}
    </div>
    ${role==='owner'?`<button class="abtn abtn-gray" onclick="abrirNomina()" style="margin-bottom:10px"><i class="ti ti-users"></i> Pagar al personal</button>`:''}
    <button class="abtn abtn-gray" onclick="abrirCalcBs()" style="margin-bottom:18px"><i class="ti ti-calculator"></i> Calculadora de bolívares</button>
    ${(role==='owner'&&!historialCompleto)?`<div class="card" style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:14px;background:var(--gl)"><div style="font-size:12.5px;color:var(--txm);line-height:1.4"><i class="ti ti-clock-hour-4"></i> Mostrando los últimos ${MESES_CARGA_INICIAL} meses. Los reportes de meses viejos se cargan solos al exportar.</div><button onclick="cargarHistorialCompletoUI()" style="flex:none;background:#334155;color:#fff;border:none;border-radius:9px;padding:8px 12px;cursor:pointer;font-size:12px;font-weight:700;white-space:nowrap">Cargar todo</button></div>`:''}
    ${bloqueResumen('Cierre del día','ti-sun','var(--g)',dia,hoyStr,'dia')}
    ${bloqueResumen('Cierre de la semana','ti-calendar-week','var(--b)',sem,`${inicioSemStr} → ${hoyStr}`,'sem')}
    ${bloqueResumen('Cierre del mes','ti-calendar-month','var(--p)',mes,inicioMesStr.slice(0,7),'mes')}
    <div class="stitle">Movimientos recientes</div>
    <div class="card">
      ${[...transacciones].sort((a,b)=>(b.fecha+String(b.id).padStart(9,'0')).localeCompare(a.fecha+String(a.id).padStart(9,'0'))).slice(0,12).map(t=>`
        <div class="li">
          <div class="liico ${t.tipo==='ingreso'?'ig':'ir'}"><i class="ti ${t.tipo==='ingreso'?'ti-arrow-up':'ti-arrow-down'}"></i></div>
          <div class="libody"><div class="liname">${t.desc}</div><div class="lisub">${t.canal} · ${t.fecha}</div></div>
          <div class="liright" style="display:flex;align-items:center;gap:8px">
            <span style="font-weight:800;color:${t.tipo==='ingreso'?'var(--g)':'var(--r)'}">${t.tipo==='ingreso'?'+':'-'}${fmt(t.imp)}</span>
            ${role==='owner'&&!t.venta_id?`<button onclick="eliminarTx(${t.id})" style="background:none;border:none;cursor:pointer;color:var(--txh);font-size:16px;padding:4px"><i class="ti ti-x"></i></button>`:''}
          </div>
        </div>`).join('')||'<div style="font-size:13px;color:var(--txm);text-align:center;padding:10px">Sin movimientos aún</div>'}
    </div>

    <button class="abtn abtn-g" onclick="abrirCierreCaja()" style="margin-top:16px;background:#334155"><i class="ti ti-lock-check"></i> Cerrar caja del día</button>
    ${cierresMensuales.length?`<div class="stitle">Meses cerrados</div><div class="card">${cierresMensuales.slice(0,12).map(m=>{
      const [a,me]=m.mes.split('-');
      const meses=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
      return `<div class="li">
        <div class="liico ip"><i class="ti ti-calendar-stats"></i></div>
        <div class="libody"><div class="liname">${meses[+me]} ${a}</div><div class="lisub">${m.num_ventas} ventas · Benef. ${fmt(parseFloat(m.beneficio))}</div></div>
        <div class="liright" style="font-weight:800;color:var(--gd);font-size:12px;text-align:right">$${parseFloat(m.total_divisas||0).toFixed(0)}<br><span style="font-size:10px;color:var(--txm)">${fmtBs(parseFloat(m.total_bs||0))}</span></div>
      </div>`;
    }).join('')}</div>`:''}
    ${cierresCaja.length?`<div class="stitle" style="display:flex;justify-content:space-between;align-items:center">Cierres recientes ${role==='owner'?`<button onclick="exportarCierres()" style="background:none;border:none;cursor:pointer;color:var(--g);font-size:13px;font-weight:700"><i class="ti ti-download"></i> Exportar</button>`:''}</div><div class="card">${cierresCaja.slice(0,15).map(c=>`
      <div class="li">
        <div class="liico ig"><i class="ti ti-receipt"></i></div>
        <div class="libody"><div class="liname">Cierre ${c.fecha}</div><div class="lisub">${nombreRol(c.cerrado_por)} · ${c.num_ventas} ventas · Benef. ${fmt(parseFloat(c.beneficio))}</div></div>
        <div class="liright" style="display:flex;align-items:center;gap:8px">
          <div style="font-weight:800;color:var(--gd);font-size:12px;text-align:right">$${parseFloat(c.total_divisas||0).toFixed(0)}<br><span style="font-size:10px;color:var(--txm)">${fmtBs(parseFloat(c.total_bs||0))}</span></div>
          ${role==='owner'?`<button onclick="anularCierre(${c.id},'${c.fecha}')" style="background:none;border:none;cursor:pointer;color:var(--txh);font-size:16px;padding:2px"><i class="ti ti-trash"></i></button>`:''}
        </div>
      </div>`).join('')}</div>`:''}
  `;
}

// ── ANULAR Y EXPORTAR CIERRES ─────────────────────────────────────────────────
async function anularCierre(id,fecha){
  if(CONFIG.clave_cierre_activa!=='1'){toast('No hay clave de cierre configurada');return}
  const clave=prompt(`Para anular el cierre del ${fecha}, escribe la clave de cierre:`);
  if(clave===null) return;
  if(!clave.trim()){toast('Clave vacía');return}
  try{
    await apiCall('DELETE','/cierres/'+id,{clave:clave.trim()});
    cierresCaja=cierresCaja.filter(c=>c.id!==id);
    toast('Cierre anulado ✓');
    registrarActividad('caja',`Cierre anulado: ${fecha}`,'');
    // Ese día vuelve a estar "sin cerrar": recalcular el aviso
    try{ const est=await apiCall('GET','/cierres/estado'); cajaPendiente=est.caja_pendiente||null; mostrarAvisoCajaPendiente(); }catch(e){}
    if(curPage==='caja') renderCaja();
  }catch(e){ toast(e.message||'No se pudo anular'); }
}

function exportarCierres(){
  if(!cierresCaja.length){toast('No hay cierres para exportar');return}
  try{
    const wb=XLSX.utils.book_new();
    // Hoja 1: Cierres diarios
    const filas=[['Fecha','Cerró','Ingresos','Gastos','Beneficio','Ventas','Cobrado $','Cobrado Bs']]
      .concat(cierresCaja.map(c=>[c.fecha,nombreRol(c.cerrado_por),parseFloat(c.ingresos),parseFloat(c.gastos),parseFloat(c.beneficio),c.num_ventas,parseFloat(c.total_divisas||0),parseFloat(c.total_bs||0)]));
    const ws1=XLSX.utils.aoa_to_sheet(filas);
    ws1['!cols']=[{wch:12},{wch:14},{wch:11},{wch:11},{wch:11},{wch:8},{wch:12},{wch:14}];
    XLSX.utils.book_append_sheet(wb,ws1,'Cierres diarios');
    // Hoja 2: Cierres mensuales (si hay)
    if(cierresMensuales.length){
      const meses=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
      const fm=[['Mes','Ingresos','Gastos','Beneficio','Ventas','Cobrado $','Cobrado Bs']]
        .concat(cierresMensuales.map(m=>{const[a,me]=m.mes.split('-');return[`${meses[+me]} ${a}`,parseFloat(m.ingresos),parseFloat(m.gastos),parseFloat(m.beneficio),m.num_ventas,parseFloat(m.total_divisas||0),parseFloat(m.total_bs||0)]}));
      const ws2=XLSX.utils.aoa_to_sheet(fm);
      ws2['!cols']=[{wch:18},{wch:11},{wch:11},{wch:11},{wch:8},{wch:12},{wch:14}];
      XLSX.utils.book_append_sheet(wb,ws2,'Cierres mensuales');
    }
    XLSX.writeFile(wb,`cierres_futbol-emotion_${hoy()}.xlsx`);
    toast('Cierres exportados ✓');
  }catch(e){ toast('No se pudo exportar'); }
}

// ── AVISO DE CAJA PENDIENTE ───────────────────────────────────────────────────
function mostrarAvisoCajaPendiente(){
  const prev=document.getElementById('aviso-caja');
  if(prev) prev.remove();
  if(!cajaPendiente) return;
  const div=document.createElement('div');
  div.id='aviso-caja';
  div.style.cssText='position:fixed;top:0;left:0;right:0;z-index:200;background:var(--ad);color:#fff;padding:11px 14px;display:flex;align-items:center;gap:10px;box-shadow:0 2px 10px rgba(0,0,0,.2);font-size:13px;font-weight:700';
  div.innerHTML=`<i class="ti ti-alert-triangle" style="font-size:20px"></i>
    <div style="flex:1">Tienes la caja del ${cajaPendiente} sin cerrar</div>
    <button onclick="cerrarCajaPendiente()" style="background:var(--card);color:var(--ad);border:none;border-radius:8px;padding:7px 12px;font-weight:800;font-size:12px;cursor:pointer;white-space:nowrap">Cerrar ahora</button>`;
  document.body.appendChild(div);
}
async function cerrarCajaPendiente(){
  if(CONFIG.clave_cierre_activa!=='1'){ toast('El dueño debe crear la clave de cierre primero'); goTo('ajustes'); return; }
  // Traer el resumen de ese día del servidor
  let resumen;
  try{ resumen=await apiCall('GET','/cierres/dia/'+cajaPendiente); }
  catch(e){ toast('No se pudo cargar el resumen del día'); return; }
  document.getElementById('cierre-resumen').innerHTML=`
    <div style="font-size:13px;color:var(--txm);margin-bottom:8px">Caja atrasada · ${cajaPendiente}</div>
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Ingresos</span><b style="color:var(--gd)">${fmt(resumen.ingresos)}</b></div>
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Gastos</span><b style="color:var(--rd)">${fmt(resumen.gastos)}</b></div>
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Beneficio</span><b>${fmt(resumen.ingresos-resumen.gastos)}</b></div>
    <div style="display:flex;justify-content:space-between"><span>Ventas</span><b>${resumen.num_ventas}</b></div>`;
  document.getElementById('cierre-clave').value='';
  document.getElementById('cierre-err').textContent='';
  // Guardar el día pendiente para que confirmarCierre lo use
  cierreFechaObjetivo=cajaPendiente;
  cierreResumenObjetivo=resumen;
  openM('m-cierre');
}

// ── CALCULADORA DE BOLÍVARES ──────────────────────────────────────────────────
let calcTasa='bcv';
function abrirCalcBs(){
  // Si la tasa elegida no existe, usar la primera disponible
  if(tasaValor(calcTasa)<=0) calcTasa=['bcv','euro','binance'].find(k=>tasaValor(k)>0)||'bcv';
  document.getElementById('calc-usd').value='';
  renderCalcTasas();
  calcularBs();
  openM('m-calc');
  setTimeout(()=>document.getElementById('calc-usd').focus(),200);
}
function renderCalcTasas(){
  const cont=document.getElementById('calc-tasas');
  const ops=tasasDisponibles();
  cont.innerHTML=ops.map(o=>{
    const val=tasaValor(o.k), act=calcTasa===o.k, dis=val<=0;
    return `<button type="button" ${dis?'disabled':''} onclick="setCalcTasa('${o.k}')" style="flex:1;padding:8px 4px;border-radius:9px;cursor:${dis?'not-allowed':'pointer'};font-size:11px;font-weight:800;border:2px solid ${act?'var(--gd)':'var(--gm)'};background:${act?'var(--gd)':'#fff'};color:${act?'#fff':(dis?'var(--txh)':'var(--gd)')};opacity:${dis?.5:1}">${o.label}<br><span style="font-size:9px;font-weight:600">${val>0?val.toLocaleString('es-VE',{minimumFractionDigits:2}):'—'}</span></button>`;
  }).join('');
}
function setCalcTasa(k){
  if(tasaValor(k)<=0){toast('Esa tasa no está configurada');return}
  calcTasa=k; renderCalcTasas(); calcularBs();
}
function calcularBs(){
  const usd=+document.getElementById('calc-usd').value||0;
  const tasa=tasaValor(calcTasa);
  const bs=usd*tasa;
  document.getElementById('calc-bs').textContent=fmtBs(bs);
  document.getElementById('calc-tasa-info').textContent=tasa>0
    ? `${tasaNombre(calcTasa)}: ${tasa.toLocaleString('es-VE',{minimumFractionDigits:2})} Bs/$`
    : 'Sin tasa configurada (Ajustes)';
}

// ── CALCULADORA (general) ─────────────────────────────────
let calcExpr='';
function abrirCalc(){ calcExpr=''; calcRenderKeys(); calcRender(); openM('m-calcgen'); }
function calcRender(){ const d=document.getElementById('calc-display'); if(d) d.textContent = calcExpr || '0'; }
function calcRenderKeys(){
  const op={c:'var(--bd)',bg:'var(--bl)'};
  const keys=[
    {t:'C',a:"calcClear()",c:'var(--rd)',bg:'var(--rl)'},
    {t:'⌫',a:"calcBack()",c:'var(--ad)',bg:'var(--al)'},
    {t:'%',a:"calcPct()",c:'var(--pd)',bg:'var(--pl)'},
    {t:'÷',a:"calcOp('÷')",...op},
    {t:'7',a:"calcNum('7')"},{t:'8',a:"calcNum('8')"},{t:'9',a:"calcNum('9')"},{t:'×',a:"calcOp('×')",...op},
    {t:'4',a:"calcNum('4')"},{t:'5',a:"calcNum('5')"},{t:'6',a:"calcNum('6')"},{t:'−',a:"calcOp('-')",...op},
    {t:'1',a:"calcNum('1')"},{t:'2',a:"calcNum('2')"},{t:'3',a:"calcNum('3')"},{t:'+',a:"calcOp('+')",...op},
    {t:'0',a:"calcNum('0')",span:'col'},{t:'.',a:"calcNum('.')"},{t:'=',a:"calcEval()",c:'#fff',bg:'var(--g)'}
  ];
  document.getElementById('calc-keys').innerHTML=keys.map(k=>{
    const sp = k.span==='row' ? 'grid-row:span 2;' : (k.span==='col' ? 'grid-column:span 2;' : '');
    const bg = k.bg||'var(--gray)', col = k.c||'var(--tx)';
    return `<button type="button" onclick="${k.a}" style="${sp}padding:16px 0;border-radius:12px;border:none;background:${bg};color:${col};font-size:22px;font-weight:800;cursor:pointer">${k.t}</button>`;
  }).join('');
}
function calcNum(ch){
  if(ch==='.'){
    const seg=calcExpr.split(/[+\-×÷]/).pop();
    if(seg.includes('.')) return;
    if(seg==='') calcExpr+='0';
  }
  calcExpr+=ch; calcRender();
}
function calcOp(ch){
  const ops='+-×÷';
  if(calcExpr===''){ if(ch==='-'){ calcExpr='-'; calcRender(); } return; }
  const last=calcExpr.slice(-1);
  if(ops.includes(last)) calcExpr=calcExpr.slice(0,-1);
  calcExpr+=ch; calcRender();
}
function calcClear(){ calcExpr=''; calcRender(); }
function calcBack(){ calcExpr=calcExpr.slice(0,-1); calcRender(); }
function calcSafeEval(str){
  const limpio=(str==null?'':String(str)).replace(/×/g,'*').replace(/÷/g,'/');
  if(!limpio || !/^[-0-9+*/. ]+$/.test(limpio)) return null;
  try{ const r=Function('"use strict";return ('+limpio+')')(); return isFinite(r)?r:null; }catch(e){ return null; }
}
function calcPct(){
  // Porcentaje contextual (tipo calculadora de teléfono). Ej: 22 - 15% = 18.70
  const m = calcExpr.match(/^(.*?)([+\-−×÷])([0-9.]+)$/);
  if(m){
    const base=m[1], op=m[2], num=parseFloat(m[3]);
    if(!isNaN(num)){
      let val;
      if(op==='+'||op==='-'||op==='−'){ const bv=calcSafeEval(base); if(bv==null) return; val=bv*num/100; }
      else { val=num/100; }
      val=Math.round((val+Number.EPSILON)*100)/100;
      calcExpr=base+op+val; calcRender(); return;
    }
  }
  if(/^[0-9.]+$/.test(calcExpr)){
    const n=parseFloat(calcExpr);
    if(!isNaN(n)){ calcExpr=String(Math.round((n/100+Number.EPSILON)*100)/100); calcRender(); }
  }
}
function calcEval(){
  if(!calcExpr) return;
  const r=calcSafeEval(calcExpr);
  if(r==null){ document.getElementById('calc-display').textContent='Error'; calcExpr=''; return; }
  calcExpr=String(Math.round((r+Number.EPSILON)*100)/100); calcRender();
}

// ── CERRAR CAJA ───────────────────────────────────────────────────────────────
function abrirCierreCaja(){
  if(CONFIG.clave_cierre_activa!=='1'){
    toast('Primero el dueño debe crear la clave de cierre en Ajustes');
    return;
  }
  cierreFechaObjetivo=null; cierreResumenObjetivo=null;
  const d=datosPeriodo('dia');
  const money=ventasHoyPorMoneda();
  document.getElementById('cierre-resumen').innerHTML=`
    <div style="font-size:13px;color:var(--txm);margin-bottom:8px">Resumen de hoy · ${hoy()}</div>
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Ingresos</span><b style="color:var(--gd)">${fmt(d.ing)}</b></div>
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>${d.inv>0?'Gastos oper.':'Gastos'}</span><b style="color:var(--rd)">${fmt(d.inv>0?d.gas-d.inv:d.gas)}</b></div>${d.inv>0?`<div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Inversión</span><b style="color:var(--ad)">${fmt(d.inv)}</b></div>`:''}
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Beneficio</span><b>${fmt(d.neto)}</b></div>
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Ventas</span><b>${d.vts.length}</b></div>
    <hr style="border:none;border-top:1px solid var(--grayb);margin:8px 0">
    <div style="display:flex;justify-content:space-between;margin-bottom:4px"><span>Cobrado en $</span><b style="color:var(--gd)">${fmt(money.divisas)}</b></div>
    <div style="display:flex;justify-content:space-between"><span>Cobrado en Bs</span><b style="color:var(--gd)">${fmtBs(money.bs)}</b></div>
    ${d.vts.length===0&&d.ing===0&&d.gas===0?`<div style="background:var(--al);border-radius:9px;padding:9px;margin-top:10px;font-size:12px;color:var(--ad);font-weight:700"><i class="ti ti-alert-circle"></i> Día sin movimientos. Si vendiste algo, regístralo antes de cerrar.</div>`:''}`;
  document.getElementById('cierre-clave').value='';
  document.getElementById('cierre-err').textContent='';
  openM('m-cierre');
}

let cerrando=false;
let cierreFechaObjetivo=null;   // null = cierre de hoy; fecha = día atrasado
let cierreResumenObjetivo=null;
async function confirmarCierre(){
  if(cerrando) return;
  const clave=document.getElementById('cierre-clave').value.trim();
  if(!clave){document.getElementById('cierre-err').textContent='Escribe la clave de cierre';return}
  // Datos: de hoy o del día atrasado
  let ing,gas,nv,divisas,bs,neto;
  if(cierreFechaObjetivo && cierreResumenObjetivo){
    const r=cierreResumenObjetivo;
    ing=r.ingresos; gas=r.gastos; nv=r.num_ventas; divisas=r.total_divisas; bs=r.total_bs; neto=ing-gas;
  }else{
    const d=datosPeriodo('dia'); const money=ventasHoyPorMoneda();
    ing=d.ing; gas=d.gas; nv=d.vts.length; divisas=money.divisas; bs=money.bs; neto=d.neto;
  }
  // Advertir si el día está en 0 (sin ventas ni movimientos)
  if(nv===0 && ing===0 && gas===0){
    if(!confirm('⚠️ Este día no tiene ventas ni movimientos registrados.\n\n¿Seguro que quieres cerrar la caja en 0? Si vendiste algo, cancela y regístralo primero.')){
      return;
    }
  }
  cerrando=true;
  document.getElementById('cierre-btn').disabled=true;
  try{
    const r=await apiCall('POST','/cierres',{
      clave, ingresos:ing, gastos:gas, num_ventas:nv,
      total_divisas:divisas, total_bs:bs,
      fecha:cierreFechaObjetivo||undefined,
    });
    cierresCaja.unshift({id:r.id,fecha:cierreFechaObjetivo||hoy(),cerrado_por:role,ingresos:ing,gastos:gas,beneficio:neto,num_ventas:nv,total_divisas:divisas,total_bs:bs});
    closeM('m-cierre');
    toast('Caja cerrada ✓');
    registrarActividad('caja',`Cierre de caja · ${nv} ventas · Beneficio ${fmt(neto)}`,'');
    // Si era la caja pendiente, quitar el aviso
    if(cierreFechaObjetivo){ cajaPendiente=null; mostrarAvisoCajaPendiente(); }
    cierreFechaObjetivo=null; cierreResumenObjetivo=null;
    if(curPage==='caja') renderCaja();
  }catch(e){
    document.getElementById('cierre-err').textContent=e.message||'No se pudo cerrar la caja';
  }
  cerrando=false;
  document.getElementById('cierre-btn').disabled=false;
}

// ── EXPORTAR REPORTES (PDF / Excel) ──────────────────────────────────────────
let exportPeriodo=null;
let cierresCaja=[];
let cierresMensuales=[];
let cajaPendiente=null;

// Calcula rango y datos del período (independiente de renderCaja)
function esInversion(t){ return t && t.tipo==='gasto' && (t.canal==='Inversión (mercancía)' || t.canal==='Mercancía' || t.canal==='Inversión'); }
function datosPeriodo(clave){
  const ahora=new Date(), hoyStr=hoy();
  const diasSemana=ahora.getDay()===0?6:ahora.getDay()-1;
  const inicioSem=new Date(ahora); inicioSem.setDate(ahora.getDate()-diasSemana);
  const rangos={
    dia:{desde:hoyStr,titulo:'Cierre del día',etiqueta:hoyStr},
    sem:{desde:fechaISO(inicioSem),titulo:'Cierre de la semana',etiqueta:fechaISO(inicioSem)+' al '+hoyStr},
    mes:{desde:ahora.getFullYear()+'-'+String(ahora.getMonth()+1).padStart(2,'0')+'-01',titulo:'Cierre del mes',etiqueta:hoyStr.slice(0,7)},
  };
  const r=rangos[clave];
  const txs=transacciones.filter(t=>t.fecha>=r.desde&&t.fecha<=hoyStr);
  const vts=ventas.filter(v=>v.fecha>=r.desde&&v.fecha<=hoyStr);
  const ing=txs.filter(t=>t.tipo==='ingreso').reduce((s,t)=>s+t.imp,0);
  const gas=txs.filter(t=>t.tipo==='gasto').reduce((s,t)=>s+t.imp,0);
  const inv=txs.filter(esInversion).reduce((s,t)=>s+t.imp,0);
  return {...r,txs,vts,ing,gas,inv,neto:ing-gas,margen:ing>0?Math.round((ing-gas)/ing*100):0};
}

function abrirExport(clave){
  exportPeriodo=clave;
  const d=datosPeriodo(clave);
  document.getElementById('ex-sub').textContent=d.titulo+' · '+d.etiqueta+' · '+d.vts.length+' ventas, '+d.txs.length+' movimientos';
  openM('m-export');
}

async function exportarReporte(formato){
  let d=datosPeriodo(exportPeriodo);
  // Si el período pedido empieza antes de lo que está cargado, traemos el histórico completo primero
  if(!historialCompleto && d.desde < cutoffCarga){
    const ok=await cargarHistorialCompleto();
    if(!ok) return;
    d=datosPeriodo(exportPeriodo);
  }
  const nombre='futbol-emotion_'+exportPeriodo+'_'+hoy();
  try{
    if(formato==='pdf') generarPDF(d,nombre);
    else generarExcel(d,nombre);
    closeM('m-export');
    toast('Reporte descargado ✓');
  }catch(e){
    toast('Error al generar el reporte — revisa tu conexión');
  }
}

function generarPDF(d,nombre){
  const { jsPDF }=window.jspdf;
  const doc=new jsPDF();
  const verde=[22,163,74];

  doc.setFillColor(verde[0],verde[1],verde[2]); doc.rect(0,0,210,26,'F');
  doc.setTextColor(255,255,255); doc.setFontSize(16); doc.setFont(undefined,'bold');
  doc.text('FÚTBOL EMOTION',14,11);
  doc.setFontSize(11); doc.setFont(undefined,'normal');
  doc.text(d.titulo+' — '+d.etiqueta,14,19);
  doc.setTextColor(120,120,120); doc.setFontSize(8);
  doc.text('Generado: '+new Date().toLocaleString('es'),14,32);

  doc.autoTable({
    startY:36,
    head:[['Concepto','Valor']],
    body:[
      ['Ingresos','$'+d.ing.toFixed(2)],
      ['Gastos operativos','$'+(d.gas-(d.inv||0)).toFixed(2)],
      ['Inversión','$'+(d.inv||0).toFixed(2)],
      ['Beneficio neto','$'+d.neto.toFixed(2)],
      ['Margen',d.margen+'%'],
      ['Ventas del período',''+d.vts.length],
    ],
    theme:'grid', headStyles:{fillColor:verde}, styles:{fontSize:9},
    columnStyles:{1:{halign:'right',fontStyle:'bold'}},
  });

  if(d.vts.length){
    doc.autoTable({
      startY:doc.lastAutoTable.finalY+8,
      head:[['Fecha','Producto','Talla','Cant.','Cliente','Pago','Ref.','Importe']],
      body:d.vts.map(v=>{
        const p=(v.pagos&&v.pagos[0])||null;
        const met=p?(METODOS_PAGO[p.metodo]?.label||p.metodo):'—';
        const ref=p?(p.referencia||p.confirmacion||p.id_orden||p.ref_receptor||''):'';
        const bs=(p&&p.moneda==='VES')?`\n${fmtBs(parseFloat(p.monto))}`:'';
        return [v.fecha,v.equipo,v.talla||'—',v.cant,v.cliente||'—',met+bs,ref,'$'+v.imp.toFixed(2)];
      }),
      foot:[['','','','','','','TOTAL','$'+d.vts.reduce((s,v)=>s+v.imp,0).toFixed(2)]],
      theme:'striped', headStyles:{fillColor:verde}, footStyles:{fillColor:[240,240,240],textColor:[0,0,0],fontStyle:'bold'},
      styles:{fontSize:7.5}, columnStyles:{7:{halign:'right'}},
    });

    // Resumen por método de pago
    const porMetodo={};
    d.vts.forEach(v=>{
      const p=(v.pagos&&v.pagos[0])||null;
      const k=p?(METODOS_PAGO[p.metodo]?.label||p.metodo):'Sin registrar';
      if(!porMetodo[k]) porMetodo[k]={n:0,usd:0,bs:0};
      porMetodo[k].n++; porMetodo[k].usd+=v.imp;
      if(p&&p.moneda==='VES') porMetodo[k].bs+=parseFloat(p.monto)||0;
    });
    doc.autoTable({
      startY:doc.lastAutoTable.finalY+8,
      head:[['Método de pago','Ventas','Total $','Total Bs']],
      body:Object.entries(porMetodo).map(([k,v])=>[k,v.n,'$'+v.usd.toFixed(2),v.bs?fmtBs(v.bs):'—']),
      theme:'grid', headStyles:{fillColor:verde}, styles:{fontSize:8},
      columnStyles:{2:{halign:'right'},3:{halign:'right'}},
    });
  }

  if(d.txs.length){
    doc.autoTable({
      startY:doc.lastAutoTable.finalY+8,
      head:[['Fecha','Tipo','Descripción','Canal','Importe']],
      body:d.txs.map(t=>[t.fecha,t.tipo==='ingreso'?'Ingreso':'Gasto',t.desc,t.canal,(t.tipo==='ingreso'?'+':'-')+'$'+t.imp.toFixed(2)]),
      theme:'striped', headStyles:{fillColor:verde},
      styles:{fontSize:8}, columnStyles:{4:{halign:'right'}},
    });
  }

  doc.save(nombre+'.pdf');
}

function generarExcel(d,nombre){
  const wb=XLSX.utils.book_new();

  const resumen=[
    ['FÚTBOL EMOTION — '+d.titulo],
    ['Período',d.etiqueta],
    ['Generado',new Date().toLocaleString('es')],
    [],
    ['Concepto','Valor'],
    ['Ingresos',d.ing],
    ['Gastos operativos',d.gas-(d.inv||0)],
    ['Inversión',d.inv||0],
    ['Beneficio neto',d.neto],
    ['Margen (%)',d.margen],
    ['Ventas del período',d.vts.length],
  ];
  const ws1=XLSX.utils.aoa_to_sheet(resumen);
  ws1['!cols']=[{wch:22},{wch:16}];
  XLSX.utils.book_append_sheet(wb,ws1,'Resumen');

  const ventasFilas=[['Fecha','Producto','Talla','Cantidad','Canal','Cliente','Método de pago','Moneda','Monto pagado','Tasa','Referencia','Banco receptor','Importe ($)']]
    .concat(d.vts.map(v=>{
      const p=(v.pagos&&v.pagos[0])||null;
      return [v.fecha,v.equipo,v.talla||'—',v.cant,v.canal,v.cliente||'—',
        p?(METODOS_PAGO[p.metodo]?.label||p.metodo):'',
        p?p.moneda:'', p?parseFloat(p.monto):'', (p&&p.tasa)?parseFloat(p.tasa):'',
        p?(p.referencia||p.confirmacion||p.id_orden||p.ref_receptor||''):'',
        p?(p.banco_receptor||''):'', v.imp];
    }));
  ventasFilas.push([]);
  ventasFilas.push(['','','','','','','','','','','','TOTAL',d.vts.reduce((s,v)=>s+v.imp,0)]);
  const ws2=XLSX.utils.aoa_to_sheet(ventasFilas);
  ws2['!cols']=[{wch:11},{wch:26},{wch:6},{wch:9},{wch:13},{wch:16},{wch:15},{wch:8},{wch:14},{wch:10},{wch:16},{wch:20},{wch:11}];
  XLSX.utils.book_append_sheet(wb,ws2,'Ventas');

  const movFilas=[['Fecha','Tipo','Descripción','Canal','Importe']]
    .concat(d.txs.map(t=>[t.fecha,t.tipo==='ingreso'?'Ingreso':'Gasto',t.desc,t.canal,t.tipo==='ingreso'?t.imp:-t.imp]));
  const ws3=XLSX.utils.aoa_to_sheet(movFilas);
  ws3['!cols']=[{wch:11},{wch:9},{wch:38},{wch:14},{wch:10}];
  XLSX.utils.book_append_sheet(wb,ws3,'Movimientos');

  XLSX.writeFile(wb,nombre+'.xlsx');
}

// ── AJUSTES ───────────────────────────────────────────────────────────────────
function renderAjustes(){
  const cont=document.getElementById('aj2-c');
  cont.innerHTML=`
    <div style="font-size:19px;font-weight:800;margin-bottom:4px">Ajustes</div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:20px">Gestión de datos de la app</div>

    <div class="stitle">Nombres</div>
    <div class="card">
      <div style="font-size:13px;color:var(--txm);margin-bottom:12px">Aparecen en el historial y las notificaciones en vez de "Dueño" / "Encargado".</div>
      <label class="fl" style="margin-top:0">Tu nombre (dueño)</label>
      <input class="fi" id="cfg-nombre-owner" value="${(CONFIG.nombre_owner||'').replace(/"/g,'&quot;')}" placeholder="Ej: Haifeé" maxlength="40">
      <label class="fl">Nombre del encargado</label>
      <input class="fi" id="cfg-nombre-manager" value="${(CONFIG.nombre_manager||'').replace(/"/g,'&quot;')}" placeholder="Ej: María" maxlength="40">
      <button class="abtn abtn-g" onclick="guardarNombres()"><i class="ti ti-check"></i> Guardar nombres</button>
    </div>

    <div class="stitle">Clave de cierre de caja</div>
    <div class="card">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
        <div style="width:42px;height:42px;border-radius:11px;background:${CONFIG.clave_cierre_activa==='1'?'var(--gl)':'var(--gray)'};display:flex;align-items:center;justify-content:center;font-size:22px;color:${CONFIG.clave_cierre_activa==='1'?'var(--gd)':'var(--txm)'}"><i class="ti ti-lock-check"></i></div>
        <div><div style="font-size:15px;font-weight:800;color:${CONFIG.clave_cierre_activa==='1'?'var(--gd)':'var(--txm)'}">${CONFIG.clave_cierre_activa==='1'?'Clave configurada':'Sin clave todavía'}</div><div style="font-size:12px;color:var(--txm)">Distinta a los PINs de acceso</div></div>
      </div>
      <label class="fl" style="margin-top:0">${CONFIG.clave_cierre_activa==='1'?'Cambiar la clave':'Crear clave de cierre'}</label>
      <input class="fi" id="cfg-clave-cierre" type="password" inputmode="numeric" placeholder="Ej: 4 a 8 dígitos" maxlength="12" autocomplete="off">
      <button class="abtn abtn-g" onclick="guardarClaveCierre()"><i class="ti ti-check"></i> Guardar clave</button>
    </div>

    <div class="stitle">Notificaciones push</div>
    <div class="card" id="push-estado">Cargando…</div>

    <div class="stitle">Tasas del día (Bs)</div>
    <div class="card">
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:14px">
        <div style="text-align:center;padding:12px 6px;border-radius:11px;background:var(--gl)">
          <div style="font-size:11px;font-weight:700;color:var(--gd)">💵 Dólar BCV</div>
          <div style="font-size:18px;font-weight:800;color:var(--gd);margin-top:3px">${(parseFloat(CONFIG.tasa_bcv)||0).toLocaleString('es-VE',{minimumFractionDigits:2})}</div>
        </div>
        <div style="text-align:center;padding:12px 6px;border-radius:11px;background:var(--bl)">
          <div style="font-size:11px;font-weight:700;color:var(--bd)">💶 Euro BCV</div>
          <div style="font-size:18px;font-weight:800;color:var(--bd);margin-top:3px">${(parseFloat(CONFIG.tasa_euro)||0).toLocaleString('es-VE',{minimumFractionDigits:2})}</div>
        </div>
        <div style="text-align:center;padding:12px 6px;border-radius:11px;background:var(--al)">
          <div style="font-size:11px;font-weight:700;color:var(--ad)">🅱️ Binance</div>
          <div style="font-size:18px;font-weight:800;color:var(--ad);margin-top:3px">${(parseFloat(CONFIG.tasa_binance)||0).toLocaleString('es-VE',{minimumFractionDigits:2})}</div>
        </div>
      </div>
      <div style="font-size:12px;color:var(--txm);text-align:center;margin-bottom:10px">${CONFIG.tasa_fecha?`Actualizado: ${CONFIG.tasa_fecha} (${CONFIG.tasa_origen||'manual'})`:'Sin configurar todavía'}</div>
      <button class="abtn abtn-g" onclick="traerTasaBcv()" style="margin-top:0;margin-bottom:12px"><i class="ti ti-refresh"></i> Traer las 3 tasas automáticamente</button>

      <label class="fl" style="margin-top:0">Dólar BCV (la que se usa al cobrar en Bs)</label>
      <div style="display:flex;gap:8px;align-items:flex-end">
        <input class="fi" id="cfg-tasa" type="number" min="0" step="0.0001" value="${parseFloat(CONFIG.tasa_bcv)||''}" placeholder="Ej: 305.4200" style="flex:1">
        <button class="abtn abtn-gray" onclick="guardarTasaManual()" style="margin-top:0;width:auto;padding:13px 18px"><i class="ti ti-check"></i></button>
      </div>
      <div class="frow" style="margin-top:8px">
        <div><label class="fl">Euro BCV</label><input class="fi" id="cfg-euro" type="number" min="0" step="0.0001" value="${parseFloat(CONFIG.tasa_euro)||''}" placeholder="Manual"></div>
        <div><label class="fl">Binance</label><input class="fi" id="cfg-binance" type="number" min="0" step="0.0001" value="${parseFloat(CONFIG.tasa_binance)||''}" placeholder="Manual"></div>
      </div>
      <button class="abtn abtn-gray" onclick="guardarTasasManual()" style="margin-top:8px"><i class="ti ti-check"></i> Guardar euro y Binance</button>
      <div style="font-size:12px;color:var(--txm);margin-top:10px">Los precios siguen en dólares. Al cobrar en bolívares se usa la tasa del <b>dólar BCV</b>. Euro y Binance son de referencia.</div>
    </div>

    <div class="stitle">Tasas personalizadas</div>
    <div class="card">
      <div style="font-size:12.5px;color:var(--txm);margin-bottom:12px">Agrega tus propias tasas (ej. "Paralelo", "Efectivo"). Aparecen al cobrar en Bs y en la calculadora.</div>
      <div id="cfg-tasas-extra"></div>
      <div class="frow" style="margin-top:6px">
        <div style="flex:2"><label class="fl" style="margin-top:0">Nombre</label><input class="fi" id="cfg-nueva-tasa-nombre" maxlength="14" placeholder="Ej: Paralelo"></div>
        <div style="flex:1"><label class="fl" style="margin-top:0">Bs por $</label><input class="fi" id="cfg-nueva-tasa-valor" type="number" min="0" step="0.0001" placeholder="Ej: 900"></div>
      </div>
      <button class="abtn abtn-gray" onclick="agregarTasaExtra()" style="margin-top:8px"><i class="ti ti-plus"></i> Agregar tasa</button>
    </div>

    <div class="stitle">Datos para cobrar (pago móvil)</div>
    <div class="card">
      <div style="font-size:13px;color:var(--txm);margin-bottom:12px">Estos datos quedan puestos automáticamente al registrar un pago móvil o transferencia. El encargado solo agrega la referencia y el banco del cliente.</div>
      <label class="fl" style="margin-top:0">Tu banco (a dónde cae el dinero)</label>
      <select class="fi" id="cfg-banco-rec"><option value="">— Selecciona —</option>${BANCOS_VE.map(b=>`<option${b===(CONFIG.banco_receptor||'')?' selected':''}>${b}</option>`).join('')}</select>
      <label class="fl">Teléfono del pago móvil</label>
      <input class="fi" id="cfg-tel-pago" inputmode="tel" value="${CONFIG.telefono_pago||''}" placeholder="Ej: 0414 000 0000" maxlength="20">
      <label class="fl">Cédula o RIF</label>
      <input class="fi" id="cfg-ced-pago" value="${CONFIG.cedula_pago||''}" placeholder="Ej: V-12345678" maxlength="20">
      <label class="fl">Nombre del titular (opcional)</label>
      <input class="fi" id="cfg-tit-pago" value="${CONFIG.titular_pago||''}" placeholder="Ej: María Pérez" maxlength="60">
      <button class="abtn abtn-g" onclick="guardarDatosCobro()"><i class="ti ti-check"></i> Guardar datos de cobro</button>
    </div>

    <div class="stitle">Nombres de proveedores</div>
    <div class="card">
      <div style="font-size:14px;color:var(--txm);margin-bottom:12px">Solo tú ves los nombres. El encargado sigue viendo "Proveedor 1, 2, 3…".</div>
      ${[1,2,3,4].map(n=>`
        <label class="fl" style="margin-top:${n===1?0:10}px">Proveedor ${n}</label>
        <input class="fi" id="cfg-prov-${n}" value="${(CONFIG['proveedor_'+n]||'').replace(/"/g,'&quot;')}" placeholder="Ej: Distribuidora López" maxlength="60">
      `).join('')}
      <button class="abtn abtn-g" onclick="guardarProveedores()"><i class="ti ti-check"></i> Guardar nombres</button>
    </div>

    <div class="stitle">Acceso del encargado</div>
    <div class="card">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
        <div style="width:42px;height:42px;border-radius:11px;background:${CONFIG.manager_bloqueado==='1'?'var(--rl)':'var(--gl)'};display:flex;align-items:center;justify-content:center;font-size:22px;color:${CONFIG.manager_bloqueado==='1'?'var(--rd)':'var(--gd)'}">
          <i class="ti ${CONFIG.manager_bloqueado==='1'?'ti-lock':'ti-lock-open'}"></i>
        </div>
        <div>
          <div style="font-size:15px;font-weight:800;color:${CONFIG.manager_bloqueado==='1'?'var(--rd)':'var(--gd)'}">${CONFIG.manager_bloqueado==='1'?'Acceso bloqueado':'Acceso activo'}</div>
          <div style="font-size:12px;color:var(--txm)">${CONFIG.manager_bloqueado==='1'?'El encargado no puede entrar a la app':'El encargado puede entrar con su PIN'}</div>
        </div>
      </div>
      <button class="abtn ${CONFIG.manager_bloqueado==='1'?'abtn-g':'abtn-gray'}" onclick="toggleBloqueoManager()" style="margin-top:0">
        <i class="ti ${CONFIG.manager_bloqueado==='1'?'ti-lock-open':'ti-lock'}"></i> ${CONFIG.manager_bloqueado==='1'?'Reactivar acceso del encargado':'Bloquear acceso del encargado'}
      </button>
    </div>

    <div class="stitle">Guardar datos</div>
    <div class="card">
      <div style="font-size:14px;color:var(--txm);margin-bottom:14px">Exporta todos los datos de la app a un archivo de respaldo. Guárdalo en un lugar seguro.</div>
      <button class="abtn abtn-g" onclick="exportarTodo()" style="margin-top:0">
        <i class="ti ti-download"></i> Guardar copia de seguridad
      </button>
    </div>

    <div class="stitle">Restaurar datos</div>
    <div class="card">
      <div style="font-size:14px;color:var(--txm);margin-bottom:14px">Carga un archivo de respaldo previamente guardado para restaurar todos los datos.</div>
      <label style="display:flex;align-items:center;justify-content:center;gap:8px;padding:14px;background:var(--gray);border-radius:12px;cursor:pointer;font-size:14px;font-weight:700;color:var(--tx)">
        <i class="ti ti-upload" style="font-size:20px"></i> Cargar archivo de respaldo
        <input type="file" accept=".json" onchange="importarDatos(event)" style="display:none">
      </label>
    </div>

    <div class="stitle">Borrar datos</div>
    <div class="card">
      <div style="font-size:14px;color:var(--txm);margin-bottom:14px">Borra datos específicos o todo. <b style="color:var(--r)">No se puede deshacer.</b></div>
      <button class="abtn abtn-gray" onclick="confirmarBorrar('ventas')" style="margin-top:0;margin-bottom:8px">
        <i class="ti ti-trash"></i> Borrar historial de ventas
      </button>
      <button class="abtn abtn-gray" onclick="confirmarBorrar('envios')" style="margin-top:0;margin-bottom:8px">
        <i class="ti ti-trash"></i> Borrar historial de envíos
      </button>
      <button class="abtn abtn-gray" onclick="confirmarBorrar('transacciones')" style="margin-top:0;margin-bottom:8px">
        <i class="ti ti-trash"></i> Borrar movimientos financieros
      </button>
      <button class="abtn abtn-r" onclick="confirmarBorrar('todo')" style="margin-top:0">
        <i class="ti ti-trash"></i> Borrar TODO (reinicio total)
      </button>
    </div>

    <div class="stitle">Información</div>
    <div class="card">
      <div class="li">
        <div class="liico igr"><i class="ti ti-shirt"></i></div>
        <div class="libody"><div class="liname">Camisetas en catálogo</div></div>
        <div class="liright" style="font-weight:800">${camisetas.length}</div>
      </div>
      <div class="li">
        <div class="liico ig"><i class="ti ti-cash"></i></div>
        <div class="libody"><div class="liname">Ventas registradas</div></div>
        <div class="liright" style="font-weight:800">${ventas.length}</div>
      </div>
      <div class="li">
        <div class="liico ib"><i class="ti ti-map-pin"></i></div>
        <div class="libody"><div class="liname">Envíos registrados</div></div>
        <div class="liright" style="font-weight:800">${envios.length}</div>
      </div>
      <div class="li">
        <div class="liico ip"><i class="ti ti-clipboard-list"></i></div>
        <div class="libody"><div class="liname">Pedidos a proveedores</div></div>
        <div class="liright" style="font-weight:800">${pedidos.length}</div>
      </div>
      <div class="li">
        <div class="liico ia"><i class="ti ti-refresh"></i></div>
        <div class="libody"><div class="liname">Devoluciones</div></div>
        <div class="liright" style="font-weight:800">${devoluciones.length}</div>
      </div>
    </div>
  `;
  pintarEstadoPush();
  renderTasasExtra();
}

function renderTasasExtra(){
  const cont=document.getElementById('cfg-tasas-extra'); if(!cont) return;
  const lista=tasasExtra();
  cont.innerHTML = lista.length ? lista.map(t=>`<div style="display:flex;gap:8px;align-items:center;margin-bottom:8px;background:var(--gray);border-radius:10px;padding:8px 12px">
      <div style="flex:1"><div style="font-size:13px;font-weight:800">${t.nombre}</div><div style="font-size:11px;color:var(--txm)">${(parseFloat(String(t.valor).replace(',','.'))||0).toLocaleString('es-VE',{minimumFractionDigits:2})} Bs/$</div></div>
      <button onclick="borrarTasaExtra('${t.id}')" style="background:none;border:none;color:var(--r);cursor:pointer;font-size:18px"><i class="ti ti-trash"></i></button>
    </div>`).join('') : '<div style="font-size:12px;color:var(--txm);margin-bottom:6px">No tienes tasas personalizadas todav\u00eda.</div>';
}
async function agregarTasaExtra(){
  const nombre=(document.getElementById('cfg-nueva-tasa-nombre').value||'').trim();
  const valor=parseFloat((document.getElementById('cfg-nueva-tasa-valor').value||'').replace(',','.'))||0;
  if(!nombre){ toast('Ponle un nombre a la tasa'); return; }
  if(valor<=0){ toast('Pon un valor v\u00e1lido (Bs por $)'); return; }
  const lista=tasasExtra();
  if(lista.length>=4){ toast('M\u00e1ximo 4 tasas personalizadas'); return; }
  lista.push({id:'x'+Math.random().toString(36).slice(2,6), nombre:nombre.slice(0,14), valor:valor.toFixed(4)});
  await guardarTasasExtra(lista);
  document.getElementById('cfg-nueva-tasa-nombre').value='';
  document.getElementById('cfg-nueva-tasa-valor').value='';
}
async function borrarTasaExtra(id){
  const lista=tasasExtra().filter(t=>t.id!==id);
  if(tasaElegida===id) tasaElegida='bcv';
  if(typeof calcTasa!=='undefined' && calcTasa===id) calcTasa='bcv';
  await guardarTasasExtra(lista);
}
async function guardarTasasExtra(lista){
  const compact=lista.map(t=>({i:t.id, n:String(t.nombre).slice(0,14), v:t.valor}));
  const json=JSON.stringify(compact);
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',{tasas_extra:json});
    CONFIG.tasas_extra=json;
    toast('Tasas actualizadas \u2713');
    renderTasasExtra();
    registrarActividad('ajuste','Tasas personalizadas actualizadas','');
  }catch(e){ toast('No se pudo guardar'); }
}
let nominaEmpleadoSel='';
function abrirNomina(){
  const lista=personalLista();
  const cont=document.getElementById('nomina-body');
  if(!lista.length){
    cont.innerHTML=`<div style="text-align:center;padding:12px 4px">
      <i class="ti ti-users" style="font-size:40px;color:var(--txh)"></i>
      <p style="font-size:13.5px;color:var(--txm);margin:10px 0 14px">Todavía no tienes personal registrado. Agrégalo en Ajustes para poder pagarle.</p>
      <button class="abtn abtn-g" onclick="closeM('m-nomina');goTo('ajustes')"><i class="ti ti-settings"></i> Ir a Ajustes</button>
    </div>`;
    openM('m-nomina'); return;
  }
  nominaEmpleadoSel=lista[0].id;
  cont.innerHTML=`
    <label class="fl" style="margin-top:0">Trabajador</label>
    <select class="fi" id="nom-emp" onchange="nominaSelEmpleado()">${lista.map(p=>`<option value="${p.id}">${p.nombre}${p.cargo?' · '+p.cargo:''}</option>`).join('')}</select>
    <div id="nom-info" style="font-size:12px;color:var(--txm);margin:9px 0 2px"></div>
    <label class="fl">Monto a pagar ($)</label>
    <input class="fi" id="nom-monto" type="number" min="0" step="0.01" placeholder="0.00">
    <div style="font-size:11.5px;color:var(--txh);margin-top:4px">Puedes cambiar el monto si es un adelanto o pago parcial.</div>
    <button class="abtn abtn-g" onclick="pagarNomina()" id="nom-save-btn" style="margin-top:14px"><i class="ti ti-cash"></i> Registrar pago</button>`;
  nominaSelEmpleado();
  openM('m-nomina');
}
function nominaSelEmpleado(){
  const lista=personalLista();
  const id=document.getElementById('nom-emp').value;
  nominaEmpleadoSel=id;
  const p=lista.find(x=>x.id===id); if(!p) return;
  document.getElementById('nom-monto').value=p.sueldo>0?p.sueldo:'';
  const pagado=nominaPagadoMes(p.nombre);
  document.getElementById('nom-info').innerHTML=`Sueldo base: <b>${p.sueldo>0?fmt(p.sueldo):'—'}</b>${pagado>0?` · Este mes le has pagado <b>${fmt(pagado)}</b>`:''}`;
}
let nominaGuardando=false;
async function pagarNomina(){
  if(nominaGuardando) return;
  const lista=personalLista();
  const p=lista.find(x=>x.id===nominaEmpleadoSel);
  if(!p){ toast('Elige un trabajador'); return; }
  const imp=+document.getElementById('nom-monto').value;
  if(!(imp>0)){ toast('⚠️ El monto debe ser mayor que 0'); return; }
  const desc='Nómina: '+p.nombre+(p.cargo?' · '+p.cargo:'');
  const canal='Sueldos';
  nominaGuardando=true;
  try{
    if(MODO_SERVIDOR){
      const r=await apiCall('POST','/transacciones',{tipo:'gasto',descripcion:desc,importe:imp,canal});
      transacciones.push({id:r.id,tipo:'gasto',desc,imp,canal,fecha:r.fecha,venta_id:null});
    }else{
      transacciones.push({id:ids.tx++,tipo:'gasto',desc,imp,canal,fecha:hoy(),venta_id:null});
      sd('transacciones',transacciones);
    }
    registrarActividad('caja',`Pago de nómina: ${p.nombre}`,`-$${imp.toFixed(2)}`);
    toast('Pago registrado ✓');
    if(curPage==='caja') renderCaja();
    if(curPage==='nomina') renderNomina();
    nominaMostrarRecibo(p, imp);
  }catch(e){/* apiCall ya mostró el error */}
  nominaGuardando=false;
}
let ultimoRecibo='';
function nominaMostrarRecibo(p, imp){
  const fechaTxt=new Date().toLocaleDateString('es-VE');
  const reciboTxt=`🧾 RECIBO DE PAGO\n${MARCA.nombre}\n————————————\nTrabajador: ${p.nombre}${p.cargo?' · '+p.cargo:''}\nConcepto: Pago de nómina\nMonto: ${fmt(imp)}\nFecha: ${fechaTxt}\n————————————\n¡Gracias por tu trabajo!`;
  ultimoRecibo=reciboTxt;
  const cont=document.getElementById('nomina-body'); if(!cont) return;
  cont.innerHTML=`
    <div style="text-align:center;padding:4px 2px">
      <div style="width:56px;height:56px;border-radius:50%;background:var(--gl);display:flex;align-items:center;justify-content:center;margin:0 auto 10px"><i class="ti ti-check" style="font-size:30px;color:var(--gd)"></i></div>
      <div style="font-size:16px;font-weight:800;margin-bottom:2px">Pago registrado</div>
      <div style="font-size:13px;color:var(--txm);margin-bottom:14px">${p.nombre} · ${fmt(imp)}</div>
      <div style="background:var(--gray);border-radius:12px;padding:14px 16px;text-align:left;font-size:12.5px;line-height:1.75;white-space:pre-wrap;margin-bottom:14px">${reciboTxt.replace(/</g,'&lt;')}</div>
      <button class="abtn abtn-g" onclick="compartirTexto(ultimoRecibo)"><i class="ti ti-brand-whatsapp"></i> Compartir recibo</button>
      <button class="abtn abtn-gray" onclick="closeM('m-nomina')" style="margin-top:8px"><i class="ti ti-check"></i> Listo</button>
    </div>`;
}
async function compartirTexto(texto){
  try{ if(navigator.share){ await navigator.share({text:texto}); return; } }
  catch(e){ if(e&&e.name==='AbortError') return; }
  try{ window.open('https://wa.me/?text='+encodeURIComponent(texto),'_blank'); }catch(e){}
}
function renderPersonal(){
  const cont=document.getElementById('cfg-personal'); if(!cont) return;
  const lista=personalLista();
  cont.innerHTML = lista.length ? lista.map(p=>`<div style="display:flex;gap:8px;align-items:center;margin-bottom:8px;background:var(--gray);border-radius:10px;padding:8px 12px">
      <div style="flex:1"><div style="font-size:13px;font-weight:800">${p.nombre}${p.cargo?` <span style="font-weight:600;color:var(--txm)">· ${p.cargo}</span>`:''}</div><div style="font-size:11px;color:var(--txm)">${p.sueldo>0?'Sueldo: '+fmt(p.sueldo):'Sin sueldo fijo'} · ${({semanal:'Semanal',quincenal:'Quincenal',mensual:'Mensual'}[p.frecuencia]||'Quincenal')}</div></div>
      <button onclick="editarPersonal('${p.id}')" style="background:none;border:none;color:var(--bd);cursor:pointer;font-size:18px"><i class="ti ti-edit"></i></button>
      <button onclick="borrarPersonal('${p.id}')" style="background:none;border:none;color:var(--r);cursor:pointer;font-size:18px"><i class="ti ti-trash"></i></button>
    </div>`).join('') : '<div style="font-size:12px;color:var(--txm);margin-bottom:6px">Todavía no tienes personal registrado.</div>';
}
let editandoPersonalId='';
function editarPersonal(id){
  const p=personalLista().find(x=>x.id===id); if(!p) return;
  editandoPersonalId=id;
  document.getElementById('cfg-nuevo-emp-nombre').value=p.nombre;
  document.getElementById('cfg-nuevo-emp-cargo').value=p.cargo||'';
  document.getElementById('cfg-nuevo-emp-sueldo').value=p.sueldo>0?p.sueldo:'';
  const fs=document.getElementById('cfg-nuevo-emp-frec'); if(fs) fs.value=p.frecuencia||'quincenal';
  const b=document.getElementById('btn-guardar-emp'); if(b) b.innerHTML='<i class="ti ti-check"></i> Guardar cambios';
  const c=document.getElementById('btn-cancelar-emp'); if(c) c.style.display='';
  const n=document.getElementById('cfg-nuevo-emp-nombre'); if(n){ n.focus(); n.scrollIntoView({behavior:'smooth',block:'center'}); }
}
function cancelarEdicionPersonal(){
  editandoPersonalId='';
  const n=document.getElementById('cfg-nuevo-emp-nombre'); if(n) n.value='';
  const c1=document.getElementById('cfg-nuevo-emp-cargo'); if(c1) c1.value='';
  const su=document.getElementById('cfg-nuevo-emp-sueldo'); if(su) su.value='';
  const fs=document.getElementById('cfg-nuevo-emp-frec'); if(fs) fs.value='quincenal';
  const b=document.getElementById('btn-guardar-emp'); if(b) b.innerHTML='<i class="ti ti-user-plus"></i> Agregar trabajador';
  const c=document.getElementById('btn-cancelar-emp'); if(c) c.style.display='none';
}
async function agregarPersonal(){
  const nombre=(document.getElementById('cfg-nuevo-emp-nombre').value||'').trim();
  const cargo=(document.getElementById('cfg-nuevo-emp-cargo').value||'').trim();
  const sueldo=parseFloat((document.getElementById('cfg-nuevo-emp-sueldo').value||'').replace(',','.'))||0;
  const frec=((document.getElementById('cfg-nuevo-emp-frec')||{}).value)||'quincenal';
  if(!nombre){ toast('Ponle el nombre del trabajador'); return; }
  const lista=personalLista();
  if(editandoPersonalId){
    const p=lista.find(x=>x.id===editandoPersonalId);
    if(p){ p.nombre=nombre.slice(0,30); p.cargo=cargo.slice(0,24); p.sueldo=sueldo.toFixed(2); p.frecuencia=frec; }
    await guardarPersonal(lista);
  }else{
    if(lista.length>=20){ toast('Máximo 20 trabajadores'); return; }
    lista.push({id:'e'+Math.random().toString(36).slice(2,6), nombre:nombre.slice(0,30), cargo:cargo.slice(0,24), sueldo:sueldo.toFixed(2), frecuencia:frec, desde:hoy()});
    await guardarPersonal(lista);
  }
  cancelarEdicionPersonal();
}
async function borrarPersonal(id){
  const p=personalLista().find(x=>x.id===id);
  if(p && !confirm(`¿Eliminar a ${p.nombre} del personal? (no borra los pagos ya registrados)`)) return;
  const lista=personalLista().filter(x=>x.id!==id);
  await guardarPersonal(lista);
}
async function guardarPersonal(lista){
  const compact=lista.map(p=>({i:p.id, n:String(p.nombre).slice(0,30), c:String(p.cargo||'').slice(0,24), s:p.sueldo, f:p.frecuencia||'quincenal', d:p.desde||''}));
  const json=JSON.stringify(compact);
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',{personal:json});
    CONFIG.personal=json;
    toast('Personal actualizado ✓');
    renderPersonal();
    registrarActividad('ajuste','Personal / nómina actualizado','');
  }catch(e){ toast('No se pudo guardar'); }
}
function exportarTodo(){
  const datos={
    version:'1.0', fecha:hoy(),
    camisetas, proveedores:ld('proveedores',[]),
    pedidos, envios, devoluciones, ventas, transacciones,
  };
  const blob=new Blob([JSON.stringify(datos,null,2)],{type:'application/json'});
  const a=document.createElement('a');
  a.href=URL.createObjectURL(blob);
  a.download=`futbol-emotion-backup-${hoy()}.json`;
  a.click();
  toast('Copia de seguridad guardada ✓');
}

// ── NOTIFICACIONES PUSH ───────────────────────────────────────────────────────
function urlB64ToUint8Array(base64){
  const padding='='.repeat((4-base64.length%4)%4);
  const b64=(base64+padding).replace(/-/g,'+').replace(/_/g,'/');
  const raw=atob(b64); const arr=new Uint8Array(raw.length);
  for(let i=0;i<raw.length;i++) arr[i]=raw.charCodeAt(i);
  return arr;
}

function swReady(timeout=5000){
  // Espera al service worker pero nunca se cuelga: si no responde, rechaza
  if(!('serviceWorker' in navigator)) return Promise.reject(new Error('sin-sw'));
  return Promise.race([
    navigator.serviceWorker.ready,
    new Promise((_,rej)=>setTimeout(()=>rej(new Error('sw-timeout')), timeout))
  ]);
}
async function estadoPush(){
  if(!('serviceWorker' in navigator) || !('PushManager' in window)) return 'no-soportado';
  if(Notification.permission==='denied') return 'bloqueado';
  try{
    const reg=await swReady();
    const sub=await reg.pushManager.getSubscription();
    return sub ? 'activo' : 'inactivo';
  }catch(e){ return 'inactivo'; }
}

async function activarPush(){
  if(!('serviceWorker' in navigator) || !('PushManager' in window)){
    toast('Tu dispositivo no soporta notificaciones push'); return;
  }
  if(!MODO_SERVIDOR){ toast('Necesitas conexión con el servidor'); return; }
  try{
    const permiso=await Notification.requestPermission();
    if(permiso!=='granted'){ toast('No diste permiso de notificaciones'); return; }

    const {clave}=await apiCall('GET','/push/clave');
    if(!clave){ toast('El servidor aún no tiene configuradas las notificaciones'); return; }

    const reg=await swReady();
    let sub=await reg.pushManager.getSubscription();
    if(!sub){
      sub=await reg.pushManager.subscribe({
        userVisibleOnly:true,
        applicationServerKey:urlB64ToUint8Array(clave),
      });
    }
    const data=sub.toJSON();
    await apiCall('POST','/push/suscribir',{rol:role,endpoint:data.endpoint,keys:data.keys});
    toast('Notificaciones activadas 🔔');
    registrarActividad('ajuste','Notificaciones push activadas','');
    renderAjustes();
  }catch(e){ toast('No se pudieron activar las notificaciones'); }
}

async function desactivarPush(){
  try{
    const reg=await swReady();
    const sub=await reg.pushManager.getSubscription();
    if(sub){
      const ep=sub.toJSON().endpoint;
      await sub.unsubscribe();
      if(MODO_SERVIDOR) await apiCall('POST','/push/desuscribir',{endpoint:ep}).catch(()=>{});
    }
    toast('Notificaciones desactivadas');
    renderAjustes();
  }catch(e){ toast('No se pudo desactivar'); }
}

async function probarPush(){
  if(!MODO_SERVIDOR){ toast('Necesitas conexión'); return; }
  try{
    await apiCall('POST','/push/prueba',{rol:role});
    toast('Enviada — debería llegarte en unos segundos 🔔');
  }catch(e){ toast('No se pudo enviar la prueba'); }
}

function abrirPushModal(){
  openM('m-push');
  pintarEstadoPush('push-estado-mgr');
}
async function pintarEstadoPush(contId='push-estado'){
  const cont=document.getElementById(contId);
  if(!cont) return;
  const estado=await estadoPush();
  const mapa={
    'activo':{txt:'Activadas',col:'var(--gd)',bg:'var(--gl)',ico:'ti-bell-ringing',btn:`<button class="abtn abtn-gray" onclick="probarPush()" style="margin-top:0;margin-bottom:8px"><i class="ti ti-send"></i> Enviar prueba</button><button class="abtn abtn-gray" onclick="desactivarPush()" style="margin-top:0"><i class="ti ti-bell-off"></i> Desactivar</button>`},
    'inactivo':{txt:'Desactivadas',col:'var(--txm)',bg:'var(--gray)',ico:'ti-bell',btn:`<button class="abtn abtn-g" onclick="activarPush()" style="margin-top:0"><i class="ti ti-bell"></i> Activar notificaciones</button>`},
    'bloqueado':{txt:'Bloqueadas por el navegador',col:'var(--rd)',bg:'var(--rl)',ico:'ti-bell-x',btn:`<div style="font-size:12px;color:var(--txm)">Actívalas desde los ajustes del navegador o del teléfono para esta app.</div>`},
    'no-soportado':{txt:'No disponibles en este dispositivo',col:'var(--txm)',bg:'var(--gray)',ico:'ti-bell-x',btn:`<div style="font-size:12px;color:var(--txm)">En iPhone: agrega la app a la pantalla de inicio desde Safari para habilitarlas.</div>`},
  };
  const e=mapa[estado]||mapa['inactivo'];
  cont.innerHTML=`
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
      <div style="width:42px;height:42px;border-radius:11px;background:${e.bg};display:flex;align-items:center;justify-content:center;font-size:22px;color:${e.col}"><i class="ti ${e.ico}"></i></div>
      <div><div style="font-size:15px;font-weight:800;color:${e.col}">${e.txt}</div><div style="font-size:12px;color:var(--txm)">Ventas, gastos, stock crítico y más</div></div>
    </div>
    ${e.btn}`;
}

async function guardarNombres(){
  const datos={
    nombre_owner:document.getElementById('cfg-nombre-owner').value.trim(),
    nombre_manager:document.getElementById('cfg-nombre-manager').value.trim(),
  };
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',datos);
    CONFIG={...CONFIG, ...datos};
    document.getElementById('rchip').textContent=nombreRol();
    toast('Nombres guardados ✓');
    registrarActividad('ajuste','Nombres actualizados','');
    renderAjustes();
  }catch(e){/* apiCall ya avisó */}
}

async function guardarClaveCierre(){
  const clave=document.getElementById('cfg-clave-cierre').value.trim();
  if(clave.length<4){toast('La clave debe tener al menos 4 caracteres');return}
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',{clave_cierre:clave});
    CONFIG.clave_cierre_activa='1';
    toast('Clave de cierre guardada ✓');
    registrarActividad('seguridad','Clave de cierre de caja actualizada','');
    renderAjustes();
  }catch(e){/* apiCall ya avisó */}
}

async function guardarDatosCobro(){
  const datos={
    banco_receptor:document.getElementById('cfg-banco-rec').value,
    telefono_pago:document.getElementById('cfg-tel-pago').value.trim(),
    cedula_pago:document.getElementById('cfg-ced-pago').value.trim(),
    titular_pago:document.getElementById('cfg-tit-pago').value.trim(),
  };
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',datos);
    CONFIG={...CONFIG, ...datos};
    toast('Datos de cobro guardados ✓');
    registrarActividad('ajuste','Datos de cobro actualizados',datos.banco_receptor);
  }catch(e){/* apiCall ya avisó */}
}

async function traerTasaBcv(){
  if(!MODO_SERVIDOR){toast('Necesitas conexión con el servidor');return}
  toast('Consultando las tasas…');
  try{
    const r=await apiCall('POST','/config/tasa-bcv',{});
    const t=r.tasas||{};
    if(t.tasa_bcv!==undefined) CONFIG.tasa_bcv=t.tasa_bcv;
    if(t.tasa_euro!==undefined) CONFIG.tasa_euro=t.tasa_euro;
    if(t.tasa_binance!==undefined) CONFIG.tasa_binance=t.tasa_binance;
    CONFIG.tasa_fecha=r.fecha; CONFIG.tasa_origen='automática';
    const partes=[];
    if(t.tasa_bcv) partes.push('Dólar '+parseFloat(t.tasa_bcv).toFixed(2));
    if(t.tasa_euro) partes.push('Euro '+parseFloat(t.tasa_euro).toFixed(2));
    if(t.tasa_binance) partes.push('Binance '+parseFloat(t.tasa_binance).toFixed(2));
    toast('✓ '+partes.join(' · '));
    registrarActividad('ajuste','Tasas actualizadas automáticamente',partes.join(' · '));
    renderAjustes();
  }catch(e){/* apiCall ya mostró el motivo */}
}

async function guardarTasasManual(){
  const euro=+document.getElementById('cfg-euro').value||0;
  const binance=+document.getElementById('cfg-binance').value||0;
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',{tasa_euro:String(euro),tasa_binance:String(binance)});
    CONFIG.tasa_euro=String(euro); CONFIG.tasa_binance=String(binance);
    toast('Tasas guardadas ✓');
    renderAjustes();
  }catch(e){/* apiCall ya avisó */}
}

async function guardarTasaManual(){
  const val=+document.getElementById('cfg-tasa').value;
  if(!(val>0)){toast('⚠️ Escribe una tasa válida');return}
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',{tasa_bcv:String(val),tasa_fecha:hoy(),tasa_origen:'manual'});
    CONFIG.tasa_bcv=String(val); CONFIG.tasa_fecha=hoy(); CONFIG.tasa_origen='manual';
    toast('Tasa guardada ✓');
    registrarActividad('ajuste',`Tasa cambiada a mano: ${val} Bs/$`,'');
    renderAjustes();
  }catch(e){/* apiCall ya avisó */}
}

async function guardarProveedores(){
  const datos={};
  [1,2,3,4].forEach(n=>{datos['proveedor_'+n]=document.getElementById('cfg-prov-'+n).value.trim()});
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',datos);
    CONFIG={...CONFIG, ...datos};
    toast('Nombres guardados ✓');
    registrarActividad('ajuste','Nombres de proveedores actualizados','');
    renderAjustes();
  }catch(e){/* apiCall ya avisó */}
}

async function toggleBloqueoManager(){
  const bloqueadoAhora=CONFIG.manager_bloqueado==='1';
  const nuevo=bloqueadoAhora?'0':'1';
  const msg=bloqueadoAhora
    ? '¿Reactivar el acceso del encargado? Podrá entrar con su PIN de nuevo.'
    : '¿Bloquear el acceso del encargado? Su PIN dejará de funcionar hasta que lo reactives.';
  if(!confirm(msg)) return;
  try{
    if(MODO_SERVIDOR) await apiCall('POST','/config',{manager_bloqueado:nuevo});
    CONFIG.manager_bloqueado=nuevo;
    toast(nuevo==='1'?'Acceso del encargado bloqueado 🔒':'Acceso del encargado reactivado ✓');
    registrarActividad('seguridad',nuevo==='1'?'Acceso del encargado bloqueado':'Acceso del encargado reactivado','');
    renderAjustes();
  }catch(e){/* apiCall ya avisó */}
}

function importarDatos(e){
  const file=e.target.files[0]; if(!file) return;
  const reader=new FileReader();
  reader.onload=ev=>{
    try{
      const datos=JSON.parse(ev.target.result);
      if(!datos.camisetas){toast('Archivo no válido');return}
      if(!confirm('¿Seguro que quieres restaurar? Se reemplazarán todos los datos actuales.')) return;
      if(datos.camisetas) {camisetas=datos.camisetas; sd('camisetas',camisetas)}
      if(datos.pedidos) {pedidos=datos.pedidos; sd('pedidos',pedidos)}
      if(datos.envios) {envios=datos.envios; sd('envios',envios)}
      if(datos.devoluciones) {devoluciones=datos.devoluciones; sd('devoluciones',devoluciones)}
      if(datos.ventas) {ventas=datos.ventas; sd('ventas',ventas)}
      if(datos.transacciones) {transacciones=datos.transacciones; sd('transacciones',transacciones)}
      toast('Datos restaurados ✓'); renderAjustes();
    }catch{toast('Error al leer el archivo')}
  };
  reader.readAsText(file);
}

async function confirmarBorrar(tipo){
  const msgs={
    ventas:'¿Borrar todo el historial de ventas? No se puede deshacer.',
    envios:'¿Borrar todo el historial de envíos? No se puede deshacer.',
    transacciones:'¿Borrar todos los movimientos financieros? No se puede deshacer.',
    todo:'⚠️ ¿BORRAR ABSOLUTAMENTE TODO? Esto reinicia la app completamente (inventario, ventas, caja, historial). No se puede deshacer.',
  };
  if(!confirm(msgs[tipo]||'¿Seguro?')) return;

  // Reinicio total: doble seguro — escribir BORRAR + respaldo automático antes
  if(tipo==='todo'){
    const escrito=prompt('Para confirmar el reinicio total, escribe la palabra:\n\nBORRAR');
    if(escrito===null) return; // canceló
    if(escrito.trim().toUpperCase()!=='BORRAR'){toast('Confirmación incorrecta — no se borró nada');return}
    exportarTodo(); // descarga una copia de seguridad automática antes de borrar
  }

  if(MODO_SERVIDOR){
    // Borrar en el servidor y recargar los datos reales
    try{
      await apiCall('POST','/datos/borrar',{tipo});
    }catch(e){ return; /* apiCall ya mostró el error */ }
    await cargarDatosServidor();
    toast('Datos borrados del servidor ✓');
    renderAjustes();
    return;
  }

  // Modo local (sin servidor): borrar del navegador
  if(tipo==='ventas'||tipo==='todo'){ventas=[];sd('ventas',ventas)}
  if(tipo==='envios'||tipo==='todo'){envios=[];sd('envios',envios)}
  if(tipo==='transacciones'||tipo==='todo'){transacciones=[];sd('transacciones',transacciones)}
  if(tipo==='todo'){
    pedidos=[];devoluciones=[];actividad=[];notifsVistas=[];
    sd('pedidos',pedidos);sd('devoluciones',devoluciones);sd('actividad',actividad);sd('notifsVistas',notifsVistas);
    camisetas=[];sd('camisetas',camisetas);
  }
  toast('Datos borrados ✓'); renderAjustes();
}
const hoy=()=>fechaISO();
function renderVentas(){ renderMisVentas(); }

// ── SISTEMA DE ACTIVIDAD / HISTORIAL / NOTIFICACIONES ─────────────────────────
let actividad = ld('actividad', []);
let notifsVistas = ld('notifsVistas', []);

function registrarActividad(tipo, descripcion, extra=''){
  const evento = {
    id: Date.now(),
    tipo,        // 'venta','pedido','envio','devolucion','stock','aprobacion','rechazo'
    desc: descripcion,
    extra,
    rol: role,
    quien: nombreRol(),
    fecha: hoy(),
    hora: new Date().toLocaleTimeString('es-ES',{hour:'2-digit',minute:'2-digit'}),
    visto: false,
  };
  if(MODO_SERVIDOR){
    apiCall('POST','/actividad',{tipo,descripcion,extra,rol:role}).catch(()=>{});
  }
  actividad.unshift(evento);
  if(actividad.length>200) actividad=actividad.slice(0,200); // máximo 200 registros
  if(!MODO_SERVIDOR) sd('actividad', actividad);
  actualizarBadgeNotif();
}

function actualizarBadgeNotif(){
  // Contar eventos no vistos del otro rol
  const sinVer = actividad.filter(a=>a.rol!==role && !notifsVistas.includes(a.id));
  const destino = document.getElementById('ni-historial') || document.getElementById('hdr-hist');
  if(destino){
    const old = destino.querySelector('.nbadge');
    if(old) old.remove();
    if(sinVer.length>0) destino.innerHTML += `<span class="nbadge">${sinVer.length>9?'9+':sinVer.length}</span>`;
  }
}

function marcarNotifsVistas(){
  const nuevos = actividad.filter(a=>a.rol!==role && !notifsVistas.includes(a.id)).map(a=>a.id);
  notifsVistas = [...notifsVistas, ...nuevos];
  if(notifsVistas.length>500) notifsVistas=notifsVistas.slice(-500);
  if(MODO_SERVIDOR) apiCall('POST','/actividad/vistas',{rol:role}).catch(()=>{});
  else sd('notifsVistas', notifsVistas);
  actualizarBadgeNotif();
}

function renderHistorial(){
  marcarNotifsVistas();
  const cont = document.getElementById('hist-c');
  const tipos = {
    venta:      {icon:'ti-shopping-cart', cls:'ig', label:'Venta'},
    pedido:     {icon:'ti-clipboard-list', cls:'ip', label:'Pedido'},
    envio:      {icon:'ti-map-pin', cls:'ib', label:'Envío'},
    devolucion: {icon:'ti-refresh', cls:'ia', label:'Cambio'},
    stock:      {icon:'ti-shirt', cls:'igr', label:'Stock'},
    aprobacion: {icon:'ti-check', cls:'ig', label:'Aprobado'},
    rechazo:    {icon:'ti-x', cls:'ir', label:'Rechazado'},
    estado:     {icon:'ti-truck', cls:'ia', label:'Envío'},
    caja:       {icon:'ti-receipt', cls:'ip', label:'Caja'},
    ajuste:     {icon:'ti-settings', cls:'igr', label:'Ajuste'},
    seguridad:  {icon:'ti-shield-lock', cls:'ir', label:'Seguridad'},
  };

  // Agrupar por fecha
  const porFecha = {};
  actividad.forEach(a=>{
    if(!porFecha[a.fecha]) porFecha[a.fecha]=[];
    porFecha[a.fecha].push(a);
  });

  if(!actividad.length){
    cont.innerHTML=`<div class="empty"><i class="ti ti-timeline"></i><p>Sin actividad registrada todavía</p></div>`;
    return;
  }

  cont.innerHTML=`
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px">
      <div style="font-size:19px;font-weight:800">Historial</div>
      ${role==='owner'?`<button class="abtn abtn-gray abtn-sm" style="margin-top:0;padding:7px 13px;font-size:12px;color:var(--r);flex:0 0 auto" onclick="limpiarHistorial()"><i class="ti ti-trash"></i> Limpiar todo</button>`:''}
    </div>
    <div style="font-size:13px;color:var(--txm);margin-bottom:16px">Registro de toda la actividad</div>
    ${Object.entries(porFecha).map(([fecha,eventos])=>`
      <div class="stitle">${fecha===hoy()?'Hoy':fecha}</div>
      <div class="card">
        ${eventos.map(a=>{
          const t=tipos[a.tipo]||{icon:'ti-point',cls:'igr',label:'Actividad'};
          const esNuevo=a.rol!==role&&!notifsVistas.includes(a.id);
          return `<div class="li">
            <div class="liico ${t.cls}"><i class="ti ${t.icon}"></i></div>
            <div class="libody">
              <div class="liname" style="display:flex;align-items:center;gap:6px">
                ${a.desc}
                ${esNuevo?`<span style="background:var(--r);color:#fff;font-size:9px;font-weight:800;padding:2px 6px;border-radius:10px">NUEVO</span>`:''}
              </div>
              <div class="lisub">${a.quien} · ${a.hora}${a.extra?` · ${a.extra}`:''}</div>
            </div>
            ${role==='owner'?`<button onclick="eliminarActividad(${a.id})" style="background:none;border:none;cursor:pointer;color:var(--txh);font-size:16px;padding:6px;flex:0 0 auto" title="Eliminar del historial"><i class="ti ti-x"></i></button>`:''}
          </div>`;
        }).join('')}
      </div>`).join('')}`;
}

// Notificación visual en pantalla (banner flotante)
function mostrarNotif(msg, tipo='g'){
  const colores={g:'var(--g)',r:'var(--r)',a:'var(--a)',p:'var(--p)',b:'var(--b)'};
  const notif=document.createElement('div');
  notif.style.cssText=`position:fixed;top:70px;left:50%;transform:translateX(-50%) translateY(-10px);background:${colores[tipo]||colores.g};color:#fff;padding:11px 20px;border-radius:20px;font-size:13px;font-weight:700;z-index:998;white-space:nowrap;box-shadow:0 4px 14px rgba(0,0,0,.2);opacity:0;transition:opacity .3s,transform .3s;pointer-events:none`;
  notif.textContent=msg;
  document.body.appendChild(notif);
  setTimeout(()=>{notif.style.opacity='1';notif.style.transform='translateX(-50%) translateY(0)'},50);
  setTimeout(()=>{notif.style.opacity='0';setTimeout(()=>notif.remove(),400)},3500);
}
// 1. Memoria segura del mes (usamos window para evitar que rompa el inicio de sesión)
window.mesSeleccionado = window.mesSeleccionado || ""; 

// 2. Función para actualizar la vista cuando cambies de mes
function cambiarMesVentas(nuevoMes) {
  window.mesSeleccionado = nuevoMes;
  renderMisVentas(); 
}

// 3. Tu función actualizada con el buscador integrado
function renderMisVentas(){
  const cont=document.getElementById('mv-c');
  
  // Usamos el mes elegido en el buscador de forma segura
  const mesActual = window.mesSeleccionado || hoy().slice(0, 7);
  const ventasDelMes = ventas.filter(v => (v.fecha || '').startsWith(mesActual));

  const fisicas=ventasDelMes.filter(v=>v.canal==='Tienda física').reverse();
  const online=ventasDelMes.filter(v=>v.canal!=='Tienda física').reverse();
  
  const totalFis=fisicas.reduce((s,v)=>s+v.imp,0);
  const totalOnl=online.reduce((s,v)=>s+v.imp,0);

  const ventaCard=(v)=>{
    const esFisica=v.canal==='Tienda física';
    return `<div class="li" style="flex-direction:column;align-items:stretch">
      <div style="display:flex;align-items:center;gap:11px">
        <div class="liico ${esFisica?'ig':'ib'}">
          <i class="ti ${esFisica?'ti-building-store':origenIco(v.canal)}"></i>
        </div>
        <div class="libody">
          <div class="liname">${esFisica?(v.cliente||'Venta tienda'):v.cliente||v.canal}</div>
          <div class="lisub">${v.equipo} · Talla ${v.talla} · ${v.cant} UND</div>
          ${(v.pagos&&v.pagos.length)?`<div style="font-size:11.5px;font-weight:700;color:var(--gd);margin-top:2px"><i class="ti ti-wallet" style="font-size:12px"></i> ${resumenPago(v.pagos[0])}</div>`:''}
        </div>
        <div class="liright">
          <div style="font-weight:800;font-size:15px;color:var(--g)">${fmt(v.imp)}</div>
          <div style="font-size:11px;color:var(--txh);margin-top:2px">${v.fecha}</div>
        </div>
      </div>
      <div style="display:flex;gap:7px;margin-top:9px;justify-content:flex-end">
        <button class="abtn abtn-gray abtn-sm" style="font-size:12px;margin-top:0;padding:7px 14px;flex:0 0 auto;width:auto" onclick="abrirEditarVenta(${v.id})"><i class="ti ti-edit"></i> Editar</button>
        <button class="abtn abtn-gray abtn-sm" style="font-size:12px;margin-top:0;padding:7px 14px;flex:0 0 auto;width:auto;color:var(--r)" onclick="eliminarVenta(${v.id})"><i class="ti ti-trash"></i> Eliminar</button>
      </div>
    </div>`;
  };

  cont.innerHTML=`
    <!-- AQUÍ ESTÁ EL NUEVO BUSCADOR DE MESES -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 16px;">
      <div class="stitle" style="margin:0;">Historial de Ventas</div>
      <input type="month" value="${mesActual}" onchange="cambiarMesVentas(this.value)" 
             style="padding: 6px 12px; border-radius: 8px; border: 1px solid var(--border, #ccc); font-family: inherit; font-size: 14px; outline: none; cursor: pointer;">
    </div>

    <!-- RESUMEN -->
    <div class="mgrid" style="margin-bottom:16px">
      <div class="mc" style="border-left:4px solid var(--g);background:var(--card)">
        <div class="mcl" style="color:var(--txm)">Ventas físicas</div>
        <div class="mcv" style="color:var(--g)">${fmt(totalFis)}</div>
        <div class="mcs" style="color:var(--txm)">${fisicas.length} ventas</div>
      </div>
      <div class="mc" style="border-left:4px solid var(--b);background:var(--card)">
        <div class="mcl" style="color:var(--txm)">Ventas online</div>
        <div class="mcv" style="color:var(--b)">${fmt(totalOnl)}</div>
        <div class="mcs" style="color:var(--txm)">${online.length} ventas</div>
      </div>
    </div>

    <!-- VENTAS DE HOY POR MONEDA -->
    <div class="stitle" style="margin-top:0">Cobrado hoy</div>
    <div class="mgrid" style="margin-bottom:16px">
      <div class="mc mc-g"><i class="ti ti-cash mc-ico"></i><div class="mcl">En divisas ($)</div><div class="mcv">${fmt(ventasHoyPorMoneda().divisas)}</div><div class="mcs">efectivo $, Zelle, Binance…</div></div>
      <div class="mc mc-cyan"><i class="ti ti-businessplan mc-ico"></i><div class="mcl">En bolívares</div><div class="mcv" style="font-size:19px">${fmtBs(ventasHoyPorMoneda().bs)}</div><div class="mcs">pago móvil, PDV, efectivo Bs</div></div>
    </div>

    <!-- BOTÓN NUEVA VENTA (todo por carrito) -->
    <button class="abtn abtn-g" onclick="abrirCarrito()" style="margin-top:0;margin-bottom:16px">
      <i class="ti ti-plus"></i> Registrar venta
    </button>

    <!-- FÍSICAS -->
    <div class="stitle">Tienda física</div>
    ${fisicas.length
      ? `<div class="card ventas-lista">${fisicas.map(v=>ventaCard(v)).join('')}</div>`
      : `<div class="card"><div class="empty" style="padding:20px"><i class="ti ti-building-store"></i><p>Sin ventas físicas en este mes</p></div></div>`}

    <!-- ONLINE -->
    <div class="stitle">Online (Instagram · WhatsApp · Web)</div>
    ${online.length
      ? `<div class="card ventas-lista">${online.map(v=>ventaCard(v)).join('')}</div>`
      : `<div class="card"><div class="empty" style="padding:20px"><i class="ti ti-device-mobile"></i><p>Sin ventas online en este mes</p></div></div>`}
  `;
}
</script>
</body>
</html>
