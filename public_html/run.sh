boot2docker start;

export DOCKER_HOST=tcp://192.168.59.103:2376;
export DOCKER_CERT_PATH=/Users/nathan/.boot2docker/certs/boot2docker-vm;
export DOCKER_TLS_VERIFY=1;

docker rm -f thedb;
docker run -d -p 3001:80 -v /Users/nathan/Sites/SimpleSlim/mysql:/var/lib/mysql --name thedb wnameless/mysql-phpmyadmin;

docker rm -f theweb;
docker run -i -t -p 3000:80 -v /Users/nathan/Sites/SimpleSlim:/var/app --name theweb --link thedb:thedb php:5.6.1-apache /bin/bash;
#docker exec web apache2;
