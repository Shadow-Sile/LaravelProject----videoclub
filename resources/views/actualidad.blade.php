<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Actualidad — NBA / EuroLeague / B.League | Copero NBA</title>
<meta name="description" content="Últimas noticias de la NBA, EuroLeague y B.League. Rosteres reales, resultados y análisis para jugadores que buscan ganar anillos.">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
  body{background:#0b0c0e;color:#f4f5f7;font-family:system-ui,Arial,sans-serif}
  .card{background:#15181d;border:1px solid #262b34;border-radius:14px;padding:1.2rem;transition:.2s}
  .card:hover{border-color:#ff6b1a;transform:translateY(-3px)}
  .badge-cat{font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;padding:3px 8px;border-radius:999px;font-weight:700}
  .badge-nba{background:#ff6b1a;color:#fff}
  .badge-eu{background:#b30000;color:#fff}
  .badge-b{background:#0022a7;color:#fff}
</style>
</head>
<body>
<div class="container py-5">
  <h1 class="h2 mb-1" style="font-family:Barlow Condensed,sans-serif;letter-spacing:-.02em">Actualidad</h1>
  <p class="text-secondary mb-4">NBA · EuroLeague · B.League — actualizado <strong>{{ $lastUpdated }}</strong>. Datos reales; sin inventar.</p>

  <div class="row g-3">
    @forelse($items as $item)
      <div class="col-12 col-md-6 col-lg-4">
        <a href="{{ $item['url'] }}" target="_blank" rel="noopener" class="text-decoration-none">
          <div class="card h-100 text-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="badge-cat badge-{{ strtolower(str_replace(' ','-',$item['category'])) }}">{{ $item['category'] }}</span>
              <small class="text-secondary">{{ $item['date'] }}</small>
            </div>
            <h5 class="h6 mb-2" style="line-height:1.25">{{ $item['title'] }}</h5>
            <p class="small text-secondary mb-0">{{ $item['summary'] }}</p>
            <div class="mt-2 text-white-50 small">{{ parse_url($item['url'], PHP_URL_HOST) }}</div>
          </div>
        </a>
      </div>
    @empty
      <div class="col-12"><p class="text-secondary">No hay datos disponibles. Reintentar el script de actualización.</p></div>
    @endforelse
  </div>

  <hr class="border-secondary my-5">
  <div class="row text-secondary small">
    <div class="col-md-8">
      <strong>Nota:</strong> El contenido se recopila automáticamente de fuentes oficiales
      (NBA.com, EuroLeague Basket, B.League). No almacenamos artículos completos; solo títulos,
      enlaces y resúmenes. Si un enlace deja de funcionar, se reemplaza en la siguiente actualización.
    </div>
  </div>
  <div class="mt-4">
    <a href="/" class="btn btn-sm btn-outline-light">← Volver al simulador</a>
  </div>
</div>
</body>
</html>
