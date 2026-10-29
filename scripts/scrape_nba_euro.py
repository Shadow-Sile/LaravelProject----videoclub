#!/usr/bin/env python3
"""
Scrape diario: NBA + EuroLeague + B.League. Escribe public/data/actualidad.json.
No requiere API key: usa feeds RSS públicos o páginas oficiales.
Si falla un feed, salta al siguiente; nunca deja el archivo vacío.
"""
import json, time, urllib.request, urllib.parse, sys, os, xml.etree.ElementTree as ET
from datetime import datetime

def fetch_text(url, ua="CoperoNBA/1.0 (cron actualidad)"):
    try:
        req = urllib.request.Request(url, headers={"User-Agent": ua, "Accept": "application/rss+xml,application/xml,text/xml"})
        with urllib.request.urlopen(req, timeout=15) as r:
            data = r.read()
            # Algunos feeds vienen comprimidos (nba.com)
            if data[:2] == b"\x1f\x8b":
                import gzip
                data = gzip.decompress(data)
            return data.decode("utf-8", "replace")
    except Exception as e:
        return ""

def extract_rss_items(text, source_name, category):
    items = []
    try:
        root = ET.fromstring(text)
        for entry in root.iter("item"):
            title = entry.findtext("title") or "Noticia de " + source_name
            link = entry.findtext("link") or ""
            desc = entry.findtext("description") or ""
            # Limpiar HTML básico del resumen
            desc = desc.replace("&quot;", '"').replace("&apos;", "'").replace("&amp;", "&")
            if len(desc) > 320:
                desc = desc[:317] + "..."
            # Solo fuentes confiables
            items.append({
                "source": source_name,
                "category": category,
                "title": title[:120],
                "url": link,
                "date": datetime.now().strftime("%Y-%m-%d"),
                "summary": desc,
            })
            if len(items) >= 5:
                break
    except Exception:
        pass
    return items

OUT = os.path.join(os.path.dirname(__file__), "..", "public", "data", "actualidad.json")
os.makedirs(os.path.dirname(OUT), exist_ok=True)

all_items = []
# NBA
all_items += extract_rss_items(fetch_text("https://www.nba.com/news/feed/"), "NBA.com", "NBA")
# EuroLeague (feed oficial)
all_items += extract_rss_items(fetch_text("https://www.euroleaguebasketball.net/news/feed/"), "EuroLeague", "EU")
# B.League (feed de la liga japonesa; a veces bloqueado: usar el portal como respaldo)
bl_text = fetch_text("https://www.bleague.jp/news/en/")
if bl_text:
    # Scraping mínimo del HTML del portal de noticias
    import re
    for m in re.finditer(r'<a[^>]+href="([^"]+)"[^>]*>([^<]{10,120})</a>', bl_text):
        url, title = m.group(1), m.group(2)
        # Filtrar solo enlaces internos de noticia
        if "/news/" in url and title not in ["Next", "Previous"]:
            all_items.append({
                "source": "B.League",
                "category": "B.League",
                "title": title.strip()[:120],
                "url": url if url.startswith("http") else "https://www.bleague.jp" + url,
                "date": datetime.now().strftime("%Y-%m-%d"),
                "summary": "Noticias de la B.League de Japón — resultados, fichajes y análisis.",
            })
            if len([i for i in all_items if i["source"] == "B.League"]) >= 3:
                break

# Si algo falló, conservar el archivo anterior como respaldo (nunca vacío)
existing = []
try:
    with open(OUT, "r", encoding="utf-8") as f:
        existing = json.load(f)
except Exception:
    pass

final_items = all_items if all_items else existing
# Deduplicar por URL
seen = set()
deduped = []
for item in final_items:
    if item["url"] not in seen:
        seen.add(item["url"])
        deduped.append(item)

with open(OUT, "w", encoding="utf-8") as f:
    json.dump(deduped[:12], f, indent=2, ensure_ascii=False)

print(f"Actualizado: {len(deduped)} noticias guardadas en {OUT}")
