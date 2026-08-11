#!/bin/sh
# Jika konfigurasi belum ada, copy default dari image
if [ ! -f /etc/freeradius/radiusd.conf ]; then
    echo "Copying default FreeRADIUS configuration..."
    cp -r /etc/freeradius.default/* /etc/freeradius/
fi

# Jalankan FreeRADIUS
exec freeradius -f -X
