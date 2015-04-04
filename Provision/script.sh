#!/usr/bin/env bash
#http://stackoverflow.com/questions/7739645/install-mysql-on-ubuntu-without-password-prompt
sudo apt-get update && sudo apt-get upgrade -y &&

sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
sudo apt-get install php5 php5-cli php5-curl php5-mcrypt apache2 mysql-server redis-server php5-mysql php5-redis -yy &&

sudo php5enmod mcrypt curl

mysql -u root -ppassword -e "CREATE DATABASE root_database;" &&
sudo cp /vagrant/Provision/000-default.conf /etc/apache2/sites-enabled/ && service apache2 reload

curl -sS https://getcomposer.org/installer | php &&
mv composer.phar /usr/local/bin/composer && \

cd /var/www/crud_api/ && composer install && \
wget https://phar.phpunit.de/phpunit.phar && \
chmod +x phpunit.phar && \
sudo mv phpunit.phar /usr/local/bin/phpunit
