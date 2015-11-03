#!/usr/bin/env bash

if [ "$USER" != "root" ];then
    echo "Please run script with root permissions"
    exit 1
fi

echo -n "Please enter a password for mysql server's root account : "
read pwd

apt-get update && apt-get install git -y && \
mkdir -p /var/www && cd $_ && \
git clone https://github.com/trojanspike/CrudApi.git && \
/var/www/CrudApi/Provision/script.sh "$pwd"