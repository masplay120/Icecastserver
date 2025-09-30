FROM debian:stable-slim

RUN apt-get update && \
    apt-get install -y icecast2 apache2 php libapache2-mod-php && \
    rm -rf /var/lib/apt/lists/*

# Activar PHP en Apache
RUN a2enmod php8.2 || true

# Eliminar página default de Apache
RUN rm -f /var/www/html/index.html

# Copiar configuración de Icecast
COPY icecast.xml /etc/icecast2/icecast.xml

# Copiar panel y scripts
COPY . /var/www/html/

# Script de arranque
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8000 80

CMD ["/start.sh"]
