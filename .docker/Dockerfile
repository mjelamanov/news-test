FROM php:7.4-fpm-alpine

ARG userId
ARG groupId
ARG username=devuser

RUN addgroup -S -g ${groupId} ${username} \
    && adduser -SD -u ${userId} -G ${username} -g '' ${username} \
    && apk add --update --no-cache autoconf g++ make\
    && apk add composer \
    && apk add npm \
    && pecl install redis \
    && pecl install xdebug \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable redis xdebug \
    && apk del autoconf g++ make

USER ${username}
WORKDIR /var/www

RUN composer global require hirak/prestissimo --no-suggest

CMD php-fpm
