FROM webdevops/php-nginx:8.2

COPY . /app

RUN /bin/bash -c 'cp /app/nginx.conf /opt/docker/etc/nginx/vhost.conf'
RUN /bin/bash -c 'chmod 777 -R /app/storage'
