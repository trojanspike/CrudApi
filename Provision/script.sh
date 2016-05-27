#!/usr/bin/env bash

if [ ! -f /var/www/CrudApi/composer.json ];then
    echo "/var/www/CrudApi not found"
    exit 1
fi
BASE=$( dirname $0 )
BASE=$( cd "$BASE/../" && pwd )

MSQL_ROOT_PASS=password

if [ ! -z $1 ];then
    MSQL_ROOT_PASS=$1
fi

#http://stackoverflow.com/questions/7739645/install-mysql-on-ubuntu-without-password-prompt
# http://phpdox.de/getting-started.html
# http://www.dev-metal.com/install-setup-php-5-6-ubuntu-14-04-lts/
rm -Rf $BASE/Application/vendor && rm -Rf $BASE/composer.lock && \
apt-get update && apt-get install python-software-properties -y && \
add-apt-repository ppa:ondrej/php5-5.6 <<EFO

EFO

apt-get update && apt-get upgrade -y && \
debconf-set-selections <<< "mysql-server mysql-server/root_password password $MSQL_ROOT_PASS"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $MSQL_ROOT_PASS"
apt-get install php5 php5-cli php5-curl php5-xsl php5-mcrypt apache2 mysql-server redis-server php5-mysql php5-redis -yy && \
php5enmod mcrypt curl && \
mysql -u root -p$MSQL_ROOT_PASS -e "CREATE DATABASE CrudApi_database;" && \
rsync $BASE/Provision/000-default.conf /etc/apache2/sites-enabled/ && service apache2 reload && \
curl -sS https://getcomposer.org/installer | php &&
mv composer.phar /usr/local/bin/composer && \
# https://getcomposer.org/doc/articles/troubleshooting.md#proc-open-fork-failed-errors
#/bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024 && /sbin/mkswap /var/swap.1 && /sbin/swapon /var/swap.1 && \
cd /var/www/CrudApi/ && composer install && \
wget https://phar.phpunit.de/phpunit.phar && \
chmod +x phpunit.phar && \
mv phpunit.phar /usr/local/bin/phpunit && \
wget http://phpdox.de/releases/phpdox.phar && chmod +x phpdox.phar && \
mv phpdox.phar /usr/local/bin/phpdox && chown -R www-data:www-data $BASE/Application/www/ && \
chown -R root:www-data $BASE/Application/core/Storage/ && chmod -R 770 $BASE/Application/core/Storage/ && \
$BASE/Application/bin/schema up
