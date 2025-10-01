FROM debian:bullseye-slim

# Instalar Icecast2 y limpiar cache
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y icecast2 && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar configuración
COPY icecast.xml /etc/icecast2/icecast.xml

# Exponer puerto interno
EXPOSE 8000

# Ejecutar Icecast
CMD ["icecast2", "-c", "/etc/icecast2/icecast.xml", "-n"]
