FROM php:8.1.27-cli-bullseye

ARG UID
ARG GID

RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y \
    libicu-dev \
    libzip-dev
RUN docker-php-ext-install intl pdo_mysql pdo mysqli zip

RUN groupadd --gid $GID dashboard \
	&& useradd --uid $UID --gid dashboard --shell /bin/bash --create-home dashboard

USER $UID

COPY --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer

WORKDIR /home/app
COPY laravel/composer* .

CMD composer install --optimize-autoloader
