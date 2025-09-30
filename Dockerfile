FROM debian:stable-slim

RUN apt-get update && \
    apt-get install -y icecast2 apache2 php libapache2-mod-php && \
    rm -rf /var/lib/apt/lists/*

# Copiar config de Icecast
COPY icecast.xml /etc/icecast2/icecast.xml

# Copiar archivos web
COPY . /var/www/html/

# Copiar script de arranque
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8000 80

CMD ["/start.sh"]

RUN rm -f /var/www/html/index.html
