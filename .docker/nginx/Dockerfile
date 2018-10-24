FROM nginx:latest

LABEL maintainer="Acho Arnold"

RUN rm /etc/nginx/conf.d/default.conf

COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .docker/nginx/conf.d/*.conf /etc/nginx/conf.d/
COPY public/ /srv/app/public