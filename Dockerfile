FROM debian:stable-slim

RUN apt-get update && \
    apt-get install -y icecast2 apache2 php libapache2-mod-php && \
    rm -rf /var/lib/apt/lists/*

# Asegurar que PHP esté activo en Apache
RUN a2enmod php7.4 || a2enmod php8.2 || true

# Eliminar página default de Apache
RUN rm -f /var/www/html/index.html

# Copiar configuración de Icecast
COPY icecast.xml /etc/icecast2/icecast.xml

# Copiar archivos del panel y frontend
COPY . /var/www/html/

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8000 80

CMD ["/start.sh"]
