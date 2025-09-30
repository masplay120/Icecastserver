FROM debian:stable-slim

# Instalar Icecast + Apache + PHP
RUN apt-get update && \
    apt-get install -y icecast2 apache2 php libapache2-mod-php && \
    rm -rf /var/lib/apt/lists/*

# Copiar config de Icecast
COPY icecast.xml /etc/icecast2/icecast.xml

# Copiar archivos del panel y frontend
COPY . /var/www/html/

# Exponer puertos
EXPOSE 8000 80

CMD service icecast2 start && apache2ctl -D FOREGROUND
