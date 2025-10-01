FROM debian:bullseye-slim

# Instalar Icecast2
RUN apt-get update && \
    apt-get install -y icecast2 && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar configuración
COPY icecast.xml /etc/icecast2/icecast.xml

# Exponer puerto 8000
EXPOSE 8000

# Ejecutar Icecast
CMD ["icecast2", "-c", "/etc/icecast2/icecast.xml", "-n"]
