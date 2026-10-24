# listenupjazzhole.com

Basic Laravel 13 site for Listen Up Jazz Hole, dockerized and hosted on Hetzner
alongside karlhill.com / drinkdrystandard.com.

## Stack

- Laravel 13 + Vite + Tailwind v4
- PHP-FPM container on the shared `karlhill` image
- nginx + Let's Encrypt on the Hetzner host (`188.245.55.156`)
- DNS via Hetzner DNS (`hcloud zone`)

## Local

```bash
composer install
cp .env.example .env && php artisan key:generate
npm install && npm run build
php artisan serve
```

## Production

DNS: `scripts/infra/setup-hetzner-dns.sh`

Host layout mirrors drinkdrystandard.com — app directory under `/home/karl/listenupjazzhole.com`,
service in `/home/karl/compose.yml`, nginx block in `/home/karl/data/nginx/default.conf`.

Pushes to `main` deploy via GitHub Actions (environment `production`). Required secrets:

| Secret | Value |
|--------|-------|
| `DEPLOY_HOST` | `188.245.55.156` (or `listenupjazzhole.com`) |
| `DEPLOY_USER` | `karl` |
| `DEPLOY_SSH_KEY` | private SSH key with access to the server |
| `DEPLOY_CONTAINER` | `karl-listenupjazzhole-1` (optional) |
