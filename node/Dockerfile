FROM node:21

ARG UID
ARG GID

RUN apt-get update -y && apt-get install -y

RUN usermod -u $UID node \
  && groupmod -g $GID node

USER $UID

WORKDIR /home/app
COPY laravel/package*.json .

ENTRYPOINT ["npm", "run", "docker_dev"]
