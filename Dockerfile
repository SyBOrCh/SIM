FROM jeroeng/alpine-artisan:web7.3

RUN apk -U upgrade && apk add --no-cache \
    bash \
    g++ \
    make \
    zlib-dev \
    libpng-dev \
    nodejs \
    npm \
    && rm -rf /var/cache/apk/* /etc/nginx/http.d/* /etc/php82/conf.d/* /etc/php82/php-fpm.d/*

COPY --chown=php:nginx . /www

COPY --chown=php:nginx binaries /usr/local/bin

RUN composer update && composer install

RUN npm install && && npm run prod && rm -rf node_modules
