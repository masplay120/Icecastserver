FROM debian:bullseye-slim

# Instalar Icecast2
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y icecast2 && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Crear usuario icecast
RUN addgroup --system icecast && adduser --system --ingroup icecast icecast

# Copiar configuración
COPY icecast.xml /etc/icecast2/icecast.xml

# Cambiar propietario de la configuración
RUN chown -R icecast:icecast /etc/icecast2

# Exponer puerto interno
EXPOSE 8000

# Ejecutar Icecast como usuario icecast
USER icecast

CMD ["icecast2", "-c", "/etc/icecast2/icecast.xml", "-n"]
