FROM php:8.1.27-fpm-bookworm

ARG UID
ARG GID

RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y \
    libicu-dev \
    libzip-dev
RUN docker-php-ext-install intl pdo_mysql pdo mysqli zip

COPY ./php/www.conf /usr/local/etc/php-fpm.d/

RUN mkdir -p /var/www/laravel

RUN groupadd --gid $GID laravel \
	&& useradd --uid $UID --gid laravel --shell /bin/bash --create-home laravel
RUN chown -R $UID:$GID /var/www/laravel \
    && chmod -R 755 /var/www/laravel

WORKDIR /var/www/laravel

USER $UID

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
