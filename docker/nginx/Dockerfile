FROM nginx:1.23.3
RUN apt-get update \
    && apt-get install -y vim
COPY default.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
COPY ./ssl/nginx.crt /etc/nginx/.ssl/nginx.crt
COPY ./ssl/nginx.key /etc/nginx/.ssl/nginx.key