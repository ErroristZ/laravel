FROM hyperf/hyperf:8.1-alpine-v3.15-swoole

RUN apk add --no-cache --repository http://mirrors.aliyun.com/alpine/edge/community gnu-libiconv

COPY . /laravel

WORKDIR /laravel

RUN composer install --no-dev