FROM php:8.2-fpm
RUN apt-get update \
    && apt-get install -y ghostscript curl libzip-dev zlib1g-dev unzip libpng-dev libjpeg-dev libfreetype6-dev git mariadb-client libmagickwand-dev openssh-client mupdf-tools nfs-client --no-install-recommends
RUN docker-php-ext-install pdo_mysql zip \
    && pecl install imagick \
    && pecl install redis \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable intl \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache \
    && curl -sS https://getcomposer.org/installer \
                 | php -- --install-dir=/usr/local/bin --filename=composer

