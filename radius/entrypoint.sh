#!/bin/sh
if [ ! -f /etc/freeradius/radiusd.conf ]; then
    echo "Copying default FreeRADIUS configuration..."
    cp -r /etc/freeradius.default/* /etc/freeradius/
fi

exec freeradius -f -X
