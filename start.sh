#!/bin/bash
# Arrancar icecast en background
icecast2 -c /etc/icecast2/icecast.xml -n &

# Arrancar apache en foreground
apache2ctl -D FOREGROUND
