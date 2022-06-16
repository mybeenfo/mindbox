FROM php:7.4-fpm-alpine

ENV FPM_INI_FILE /usr/local/etc/php-fpm.d/www.conf

RUN apk add --no-cache --update --virtual .build-deps $PHPIZE_DEPS \
    git \
    curl \
    imagemagick \
    imagemagick-libs \
    imagemagick-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    vips-tools \
    vips-dev \
    fftw-dev \
    glib-dev \
    autoconf \
	g++ \
	libtool \
	make \
    icu-dev \
#MYSQL
&& docker-php-ext-install -j$(nproc) pdo_mysql mysqli zip \
#base config php.ini
&& ln -sf "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
&& sed -i 's/short_open_tag = Off/short_open_tag = On/g' ${PHP_INI_DIR}/php.ini  \
&& sed -i -e "s/\;opcache.enable=1/opcache.enable=1/g" ${PHP_INI_DIR}/php.ini \
&& sed -i -e "s/\;opcache.enable_cli=0/opcache.enable_cli=1/g" ${PHP_INI_DIR}/php.ini \
#base fpm.ini
&& sed -i -e "s/\;env\[/env\[/g" ${FPM_INI_FILE} \
#remove trash files
&& rm -rf /var/cache/apk/* \
&& rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#ADD .docker/images/php/php.ini /usr/local/etc/php/conf.d/40-custom.ini

COPY . ./

RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]