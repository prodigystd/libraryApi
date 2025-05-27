FROM nginx

COPY nginx.conf /etc/nginx/
COPY app.conf /etc/nginx/conf.d/default.conf

RUN echo "upstream php-upstream { server library_api_php_fpm_image:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
EXPOSE 443
