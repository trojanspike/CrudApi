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
echo $MSQL_ROOT_PASS;

#http://stackoverflow.com/questions/7739645/install-mysql-on-ubuntu-without-password-prompt
# http://phpdox.de/getting-started.html
# http://www.dev-metal.com/install-setup-php-5-6-ubuntu-14-04-lts/
sudo add-apt-repository ppa:ondrej/php5-5.6 <<EFO

EFO

sudo apt-get update && sudo apt-get upgrade -y && \
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $MSQL_ROOT_PASS"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $MSQL_ROOT_PASS"
sudo apt-get install php5 php5-cli php5-curl php5-xsl php5-mcrypt apache2 mysql-server redis-server php5-mysql php5-redis -yy && \
sudo php5enmod mcrypt curl

mysql -u root -ppassword -e "CREATE DATABASE CrudApi_database;" && \
sudo cp $BASE/Provision/000-default.conf /etc/apache2/sites-enabled/ && service apache2 reload

curl -sS https://getcomposer.org/installer | php &&
mv composer.phar /usr/local/bin/composer && \
#
cd /var/www/CrudApi/ && composer install && \
wget https://phar.phpunit.de/phpunit.phar && \
chmod +x phpunit.phar && \
sudo mv phpunit.phar /usr/local/bin/phpunit && \
wget http://phpdox.de/releases/phpdox.phar && sudo chmod +x phpdox.phar && \
sudo mv phpdox.phar /usr/local/bin/phpdox