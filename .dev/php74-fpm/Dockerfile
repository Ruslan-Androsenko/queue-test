FROM phpdockerio/php74-fpm:latest

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php7.4-memcached \
    php7.4-memcache \
    php7.4-mbstring \
    php7.4-mysql \
    php7.4-redis \
    php7.4-bcmath \
    php7.4-intl \
    php7.4-xdebug \
    php7.4-interbase \
    php7.4-soap \
    php7.4-gd \
    php7.4-imagick \
    php7.4-opcache \
    php7.4-zip \
    libmcrypt-dev gcc make autoconf libc-dev pkg-config

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php-pear php7.4-dev \
    && pecl install mcrypt-1.0.3 \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ADD php74-fpm/php.ini /etc/php/7.4/fpm/conf.d/90-php.ini
ADD php74-fpm/php.ini /etc/php/7.4/cli/conf.d/90-php.ini

RUN usermod -u 1000 www-data

WORKDIR "/app"

EXPOSE 9000