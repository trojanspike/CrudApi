FROM php:5.6-apache

ENV COMPOSER_HOME=/var/www/CrudApi/
ENV DEBIAN_FRONTEND noninteractive
ENV DOCKER=true

RUN apt-get update --fix-missing

RUN apt-get install php5-curl php5-mcrypt php5-mysql php5-redis git vim -y
# https://github.com/docker-library/php/issues/77
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

RUN docker-php-ext-install pdo_mysql && docker-php-ext-install pdo

RUN curl -sS https://getcomposer.org/installer | php && \
mv composer.phar /usr/local/bin/composer

ADD ./Provision/apache2.conf /etc/apache2/apache2.conf
ADD ./Provision/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-#default.conf

ADD . /var/www/CrudApi/
RUN cd /var/www/CrudApi/ && composer install --prefer-source

RUN chown -R www-data:www-data /var/www/CrudApi/Application/www/ && \
chown -R root:www-data /var/www/CrudApi/Application/core/Storage/ && \
chmod -R 770 /var/www/CrudApi/Application/core/Storage/

WORKDIR /var/www/CrudApi/

# RUN echo 'kernel/mm/transparent_hugepage/enabled = never' >> /etc/sysfs.conf
# RUN echo 'echo never > /sys/kernel/mm/transparent_hugepage/enabled' >> /etc/rc.local

ADD Provision/docker/start.sh /start
ADD Provision/index.php /var/www/html/index.php
RUN chmod +x /start
EXPOSE 80

CMD ["/bin/bash", "/start"]
