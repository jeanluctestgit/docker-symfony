FROM php:8.0.6-fpm-alpine

RUN apk add --update --virtual .build-dependencies $PHPIZE_DEPS libzip-dev curl-dev && \
    docker-php-ext-install curl pdo_mysql && \
    apk del gcc g++ && \
    rm -rf /var/cache/apk/*

RUN pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl clear-cache \
    && apk del .build-dependencies

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/api

COPY ../../api/composer.json .


EXPOSE 9000
CMD ["php-fpm"]