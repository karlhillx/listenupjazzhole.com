#!/usr/bin/env bash
# Creates the Hetzner DNS zone + A records for listenupjazzhole.com.
# Run on a machine with hcloud authenticated (same pattern as drinkdrystandard.com).
set -euo pipefail

DOMAIN=listenupjazzhole.com
ZONE_NAME=$DOMAIN
SERVER_IP="${SERVER_IP:-}"

if ! hcloud context active >/dev/null 2>&1; then
  echo "No active hcloud context. Run: hcloud context create && hcloud context use <name>"
  exit 1
fi

if [ -z "$SERVER_IP" ]; then
  echo "→ Looking up primary server IPv4"
  SERVER_IP="$(hcloud server list -o noheader -o columns=ipv4 | head -1 | tr -d ' ')"
fi

if [ -z "$SERVER_IP" ]; then
  echo "Set SERVER_IP=x.x.x.x or ensure hcloud server list returns an address"
  exit 1
fi
echo "  Using $SERVER_IP"

if hcloud zone describe "$ZONE_NAME" >/dev/null 2>&1; then
  echo "→ Zone $ZONE_NAME already exists"
else
  echo "→ Creating zone $ZONE_NAME"
  hcloud zone create --name "$ZONE_NAME" --mode primary
fi

echo "→ Setting apex A"
hcloud zone rrset set-records "$ZONE_NAME" "@" A --record "$SERVER_IP" || \
  hcloud zone rrset add-records "$ZONE_NAME" "@" A --record "$SERVER_IP"

echo "→ Setting www A"
hcloud zone rrset set-records "$ZONE_NAME" "www" A --record "$SERVER_IP" || \
  hcloud zone rrset add-records "$ZONE_NAME" "www" A --record "$SERVER_IP"

echo
echo "Nameservers (registrar should already point here):"
hcloud zone describe "$ZONE_NAME" -o format='{{.NameServers}}' 2>/dev/null || hcloud zone describe "$ZONE_NAME"

echo
cat <<EOF
Host steps (SSH as karl@${SERVER_IP}):

1. Ensure /home/karl/listenupjazzhole.com exists and compose service is added
   (image karlhill, container karl-listenupjazzhole-1 on karl_internal).

2. Merge docker/nginx/listenupjazzhole.conf into
   /home/karl/data/nginx/default.conf and add domains to the :80 server_name list.

3. Issue cert:
   docker exec karl-certbot-1 certbot certonly --webroot -w /var/www/html \\
     -d listenupjazzhole.com -d www.listenupjazzhole.com

4. docker exec karl-nginx-1 nginx -t && docker exec karl-nginx-1 nginx -s reload
EOF
