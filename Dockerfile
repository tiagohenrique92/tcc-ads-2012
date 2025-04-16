FROM bitnami/nginx:latest

WORKDIR /opt/bitnami/nginx/conf/server_blocks/
COPY pearsoft.com.conf .

WORKDIR /app

