#!/usr/bin/env bash

IP=192.168.33.18
REST=Default
VERSION=v1

BASE=$(dirname $0)
BASE=$( cd "$BASE/../" && pwd )

for i in $( ls "$BASE/Application/rest/$REST/$VERSION/api/" );
do
    if [ -f "$BASE/Application/rest/$REST/$VERSION/api/$i" ];then
        curl $( echo 192.168.33.18/$VERSION/$i | sed -e "s/.php$//" ) -X GET && sleep 2 && \
        curl $( echo 192.168.33.18/$VERSION/$i | sed -e "s/.php$//" ) -X POST && sleep 2 && \
        curl $( echo 192.168.33.18/$VERSION/$i | sed -e "s/.php$//" ) -X PUT && sleep 2 && \
        curl $( echo 192.168.33.18/$VERSION/$i | sed -e "s/.php$//" ) -X DELETE && sleep 2
    else
        echo "dir"
    fi
done