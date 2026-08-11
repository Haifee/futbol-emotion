
:root{
  --g:#16a34a;--gl:#dcfce7;--gm:#22c55e;--gd:#15803d;--gx:#bbf7d0;
  --r:#ef4444;--rl:#fee2e2;--rd:#dc2626;
  --a:#f59e0b;--al:#fef3c7;--ad:#d97706;
  --p:#8b5cf6;--pl:#ede9fe;--pd:#7c3aed;
  --b:#3b82f6;--bl:#dbeafe;--bd:#2563eb;
  --gray:#f8fafc;--grayb:#e2e8f0;
  --tx:#0f172a;--txm:#64748b;--txh:#94a3b8;
  --shadow:0 2px 12px rgba(0,0,0,.07);
  --shadow-lg:0 8px 30px rgba(0,0,0,.13);
}
*{box-sizing:border-box;margin:0;padding:0;-webkit-tap-highlight-color:transparent}
html,body{height:100%;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:var(--tx)}

/* LOGIN */
#ls{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:100vh;padding:24px;background:#071810}
.llogo{font-size:32px;font-weight:800;color:#fff;margin-bottom:6px;letter-spacing:-1px;display:flex;align-items:center;gap:10px}
.llogo-ico{display:none}
.llogo span{color:#22c55e}
.lsub{color:rgba(255,255,255,.4);font-size:11px;margin-bottom:28px;letter-spacing:1.5px;text-transform:uppercase}
.lcard{background:#fff;border-radius:28px;padding:30px 24px;width:100%;max-width:380px;box-shadow:0 20px 60px rgba(0,0,0,.3)}
.lroles{display:flex;flex-direction:column;gap:10px;margin-bottom:22px}
.lrole{padding:16px 18px;border-radius:16px;border:2px solid #e2e8f0;cursor:pointer;display:flex;align-items:center;gap:14px;transition:all .2s;background:#fff}
.lrole:active{transform:scale(.98)}
.lrole.sel{border-color:#22c55e;background:#f0fdf4;box-shadow:0 0 0 3px rgba(34,197,94,.12)}
.lrico{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.ico-m{background:#dcfce7;color:#15803d}
.ico-o{background:#ede9fe;color:#7c3aed}
.lrname{font-size:16px;font-weight:700;color:#0f172a}
.lrdesc{font-size:12px;color:#64748b;margin-top:2px}
.lpilab{font-size:11px;font-weight:700;color:#64748b;margin-bottom:8px;display:block;text-transform:uppercase;letter-spacing:.6px}
.lpi{width:100%;padding:16px;font-size:28px;letter-spacing:12px;border:2px solid #e2e8f0;border-radius:16px;text-align:center;outline:none;color:#0f172a;background:#f8fafc;transition:all .2s}
.lpi:focus{border-color:#22c55e;background:#fff;box-shadow:0 0 0 4px rgba(34,197,94,.1)}
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
.pages{flex:1;overflow-y:auto;background:#f1f5f9}
.page{display:none;padding:16px}.page.active{display:block}

/* NAV */
.bnav{display:flex;border-top:1px solid #e2e8f0;background:#fff;flex-shrink:0;padding-bottom:env(safe-area-inset-bottom,0);box-shadow:0 -4px 16px rgba(0,0,0,.06)}
.ni{flex:1;display:flex;flex-direction:column;align-items:center;padding:10px 2px 8px;cursor:pointer;color:#94a3b8;font-size:10px;font-weight:600;gap:3px;border:none;background:none;position:relative;transition:all .2s}
.ni i{font-size:22px;transition:all .2s}
.ni.active{color:#16a34a}.ni.active i{color:#16a34a;transform:scale(1.12)}
.ni.active::after{content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:28px;height:3px;background:#16a34a;border-radius:3px 3px 0 0}
.nbadge{position:absolute;top:7px;right:calc(50% - 20px);background:#ef4444;color:#fff;font-size:9px;font-weight:800;min-width:16px;height:16px;border-radius:8px;display:flex;align-items:center;justify-content:center;padding:0 3px;box-shadow:0 2px 6px rgba(239,68,68,.5)}

/* CARDS */
.card{background:#fff;border-radius:20px;padding:16px;margin-bottom:12px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 4px 16px rgba(0,0,0,.04)}

/* METRIC GRID */
.mgrid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px}
.mc{border-radius:18px;padding:16px;position:relative;overflow:hidden;min-height:90px}

.mcl{font-size:10px;color:rgba(255,255,255,.75);margin-bottom:8px;font-weight:700;text-transform:uppercase;letter-spacing:.7px}
.mcv{font-size:22px;font-weight:800;line-height:1;color:#fff}
.mcs{font-size:11px;color:rgba(255,255,255,.55);margin-top:4px}
.mc-ico{position:absolute;bottom:10px;right:12px;font-size:32px;opacity:.15;color:#fff}

/* BIG BUTTONS */
.bigbtn{display:flex;align-items:center;gap:14px;padding:18px;background:#fff;border:none;border-radius:18px;margin-bottom:10px;cursor:pointer;width:100%;text-align:left;box-shadow:0 1px 4px rgba(0,0,0,.06),0 4px 16px rgba(0,0,0,.04);transition:all .2s}
.bigbtn:active{background:#f8fafc;transform:scale(.99)}
.bbico{width:52px;height:52px;border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0}
.bbtitle{font-size:16px;font-weight:700;color:#0f172a}.bbsub{font-size:12px;color:#64748b;margin-top:3px}

/* PILLS */
.pill{font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px;white-space:nowrap}
.pok{background:#dcfce7;color:#15803d}.pwarn{background:#fef3c7;color:#d97706}
.pbad{background:#fee2e2;color:#dc2626}.ppurp{background:#ede9fe;color:#7c3aed}
.pgray{background:#f8fafc;color:#64748b}.pblue{background:#dbeafe;color:#2563eb}

/* BUTTONS */
.abtn{padding:15px;border-radius:14px;font-size:15px;font-weight:700;cursor:pointer;border:none;display:flex;align-items:center;justify-content:center;gap:8px;width:100%;margin-top:10px;letter-spacing:.1px;transition:all .2s}
.abtn:active{opacity:.88;transform:scale(.98)}
.abtn-g{background:#16a34a;color:#fff;box-shadow:0 4px 14px rgba(22,163,74,.35)}
.abtn-r{background:#fee2e2;color:#dc2626}
.abtn-a{background:#dcfce7;color:#15803d;border:1.5px solid #22c55e}
.abtn-gray{background:#f8fafc;color:#0f172a;border:1.5px solid #e2e8f0}
.abtn-sm{padding:9px 14px;font-size:13px;margin-top:8px;border-radius:10px}
.abtn-blue{background:#2563eb;color:#fff;box-shadow:0 4px 14px rgba(37,99,235,.35)}

/* FORMS */
.fl{display:block;font-size:11px;font-weight:700;color:#64748b;margin-bottom:6px;margin-top:14px;text-transform:uppercase;letter-spacing:.5px}
.fl:first-of-type{margin-top:0}
.fi{width:100%;padding:13px 14px;border:1.5px solid #e2e8f0;border-radius:12px;font-size:15px;color:#0f172a;background:#f8fafc;outline:none;appearance:none;transition:all .2s}
.fi:focus{border-color:#22c55e;background:#fff;box-shadow:0 0 0 3px rgba(34,197,94,.1)}
.frow{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.stitle{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.6px;margin:18px 0 9px;display:flex;align-items:center;gap:7px}
.stitle:first-child{margin-top:0}
.stitle::after{content:'';flex:1;height:1px;background:#e2e8f0}

/* PROV GRID */
.prov-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px}
.prov-card{padding:22px 12px;border:2px solid #e2e8f0;border-radius:18px;cursor:pointer;text-align:center;background:#fff;transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.prov-card:active{transform:scale(.96)}
.prov-card.sel{border-color:#22c55e;background:#f0fdf4;box-shadow:0 0 0 3px rgba(34,197,94,.12)}
.prov-num{font-size:40px;font-weight:800;color:#16a34a;line-height:1}
.prov-lbl{font-size:12px;color:#64748b;margin-top:4px;font-weight:600}

/* TALLAS */
.trow{display:flex;align-items:center;gap:10px;padding:12px 0;border-bottom:1px solid #f8fafc}
.trow:last-child{border-bottom:none}
.tlab{font-size:16px;font-weight:700;width:80px;flex-shrink:0}
.tlab-und{font-size:11px;color:#64748b;font-weight:600}
.tcant{display:flex;align-items:center;gap:12px;flex-shrink:0;margin-left:auto}
.cbtn{width:42px;height:42px;border-radius:12px;border:1.5px solid #e2e8f0;background:#f8fafc;font-size:24px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#0f172a;transition:all .15s}
.cbtn:active{background:#dcfce7;border-color:#22c55e;transform:scale(.92)}
.cval{font-size:22px;font-weight:800;min-width:36px;text-align:center}
.cval.pos{color:#16a34a}

/* STOCK TALLAS */
.tgrid{display:grid;grid-template-columns:repeat(5,1fr);gap:7px;margin-top:10px}
.tbox{background:#f8fafc;border-radius:12px;padding:9px 4px;text-align:center;border:1px solid #e2e8f0}
.tbox-lab{font-size:11px;color:#64748b;font-weight:700;margin-bottom:2px}
.tbox-und{font-size:9px;color:#94a3b8;font-weight:600;margin-top:1px}
.tbox-val{font-size:20px;font-weight:800}

/* LIST ITEMS */
.li{display:flex;align-items:flex-start;gap:12px;padding:12px 0;border-bottom:1px solid #f8fafc}
.li:last-child{border-bottom:none;padding-bottom:0}.li:first-child{padding-top:0}
.liico{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0}
.ig{background:#dcfce7;color:#16a34a}.ia{background:#fef3c7;color:#d97706}
.ir{background:#fee2e2;color:#dc2626}.ip{background:#ede9fe;color:#7c3aed}
.ib{background:#dbeafe;color:#2563eb}.igr{background:#f8fafc;color:#64748b}
.libody{flex:1;min-width:0}
.liname{font-size:14px;font-weight:700;color:#0f172a}
.lisub{font-size:12px;color:#64748b;margin-top:2px;line-height:1.4}
.liright{text-align:right;flex-shrink:0}

/* MODAL */
.mbg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:100;align-items:flex-end;justify-content:center;backdrop-filter:blur(4px)}
#m-scan{z-index:120}
#m-scan-add,#m-scan-asociar{z-index:110}
.mbg.open{display:flex}
.modal{background:#fff;border-radius:28px 28px 0 0;padding:22px 20px 36px;width:100%;max-width:520px;max-height:92vh;overflow-y:auto}
.modal-handle{width:40px;height:4px;background:#e2e8f0;border-radius:2px;margin:0 auto 18px}
.mtitle{font-size:18px;font-weight:800;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between}
.mclose{background:#f8fafc;border:none;font-size:20px;color:#64748b;cursor:pointer;display:flex;align-items:center;padding:7px;border-radius:10px}
.mclose:active{background:#e2e8f0}

/* ALERT BOX */
.abox{border-radius:16px;padding:14px 16px;margin-bottom:10px;display:flex;align-items:center;gap:13px}
.abox-r{background:#fee2e2}.abox-a{background:#fef3c7}.abox-g{background:#dcfce7}.abox-p{background:#ede9fe}
.abox i{font-size:24px;flex-shrink:0}
.abox-r i{color:#dc2626}.abox-a i{color:#d97706}.abox-g i{color:#16a34a}.abox-p i{color:#7c3aed}
.abox-title{font-size:14px;font-weight:700}
.abox-r .abox-title{color:#dc2626}.abox-a .abox-title{color:#d97706}.abox-g .abox-title{color:#16a34a}.abox-p .abox-title{color:#7c3aed}
.abox-sub{font-size:12px;opacity:.75;margin-top:2px}

/* SEARCH */
.swrap{position:relative;margin-bottom:12px}
.swrap i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:17px}
.sinput{width:100%;padding:12px 14px 12px 40px;border:1.5px solid #e2e8f0;border-radius:14px;font-size:14px;color:#0f172a;background:#fff;outline:none;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.sinput:focus{border-color:#22c55e}

/* FBAR */
.fbar{display:flex;gap:8px;margin-bottom:14px;overflow-x:auto;padding-bottom:4px}
.fbar::-webkit-scrollbar{display:none}
.ftag{padding:8px 16px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;border:none;white-space:nowrap;background:#fff;color:#64748b;flex-shrink:0;box-shadow:0 1px 4px rgba(0,0,0,.08)}
.ftag.on{background:#16a34a;color:#fff}

/* PROGRESS */
.pbar{height:7px;background:#e2e8f0;border-radius:4px;overflow:hidden;margin-top:6px}
.pfill{height:100%;border-radius:4px}

/* TOAST */
#toast{position:fixed;bottom:88px;left:50%;transform:translateX(-50%) translateY(14px);background:#0f172a;color:#fff;padding:11px 22px;border-radius:22px;font-size:13px;font-weight:600;opacity:0;transition:opacity .25s,transform .25s;z-index:999;white-space:nowrap;pointer-events:none;box-shadow:0 8px 24px rgba(0,0,0,.2)}
#toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.empty{text-align:center;padding:44px 20px;color:#64748b}
.empty i{font-size:44px;margin-bottom:12px;display:block;color:#94a3b8}
.empty p{font-size:14px;font-weight:500}
.sep{height:1px;background:#f8fafc;margin:8px 0}

/* UND BADGE */
.und{font-size:10px;font-weight:700;color:#94a3b8;letter-spacing:.3px}

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
    border-left:1px solid #e2e8f0;
    border-right:1px solid #e2e8f0;
  }
  .topbar{grid-area:top}
  .pages{grid-area:main;min-height:0;overflow-x:hidden}
  .bnav{
    grid-area:nav;
    flex-direction:column;
    align-items:stretch;
    justify-content:flex-start;
    border-top:none;
    border-right:1px solid #e2e8f0;
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
  .ventas-lista{display:grid;grid-template-columns:repeat(auto-fit,minmax(360px,1fr));gap:10px;padding:10px}
  .ventas-lista .li{border-bottom:none;background:var(--gray);border-radius:12px;padding:12px}
}
