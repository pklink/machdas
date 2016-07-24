FROM php:7.0-apache
MAINTAINER Pierre Klink <dev@klink.xyz>

ENV MD_MYSQL_HOST mysql
ENV MD_MYSQL_USERNAME root
ENV MD_MYSQL_PASSWORD password
ENV MD_MYSQL_DATABASE machdas

COPY ./ /var/www/

RUN curl -sL https://deb.nodesource.com/setup_4.x | bash - \
    && apt-get install -y nodejs build-essential git unzip zlib1g-dev \
    && docker-php-ext-install zip mbstring pdo pdo_mysql \
    && php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www
RUN composer install --no-dev \
    && npm install \
    && npm run build \
    && rm -rf node_modules/ html/ \
    && mv public/ html

RUN cp config.sample.php config.php \
    && sed -i "s/'127.0.0.1'/getenv('MD_MYSQL_HOST')/g" config.php \
    && sed -i "s/'root'/getenv('MD_MYSQL_USERNAME')/g" config.php \
    && sed -i "s/'secret'/getenv('MD_MYSQL_PASSWORD')/g" config.php \
    && sed -i "s/'machdas'/getenv('MD_MYSQL_DATABASE')/g" config.php \
    && apt-get remove -y nodejs build-essential git unzip \
    && apt-get clean

EXPOSE 80

CMD ["/bin/bash", "docker-cmd.sh"]