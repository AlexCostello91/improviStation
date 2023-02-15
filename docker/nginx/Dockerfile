FROM nginx:1.23.3-alpine
COPY default.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
COPY ./ssl/nginx.crt /etc/nginx/.ssl/nginx.crt
COPY ./ssl/nginx.key /etc/nginx/.ssl/nginx.key