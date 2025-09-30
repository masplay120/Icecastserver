#!/bin/bash
# Iniciar Icecast en segundo plano
icecast2 -c /etc/icecast2/icecast.xml -n &

# Iniciar Apache en primer plano
apache2ctl -D FOREGROUND

