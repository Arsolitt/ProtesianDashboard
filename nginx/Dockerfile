FROM nginx:1.25.3-alpine3.18

ARG UID
ARG GID

RUN addgroup -g $GID dashboard \
	&& adduser -u $UID -G dashboard -s /bin/sh -D dashboard

COPY nginx/nginx.conf /etc/nginx/
COPY nginx/default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/laravel

RUN chown -R $UID:$GID /var/www/laravel \
    && chmod -R 755 /var/www/laravel
