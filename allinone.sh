#!/bin/bash

#################################################
#################################################
## This script is only recommended for on-the-fly
## installation. DO NOT USE IT for a production
## environment 
#################################################
#################################################


apache=`eval which apache2ctl`;
php=`eval which php`;
java=`eval which java`;
mongo=`eval which mongo`;

if [ "`lsb_release -is`" == "Ubuntu" ] || [ "`lsb_release -is`" == "Debian" ]
then

if [ "${apache}" == "" ]; 

         then
              sudo apt-get -y install apache2;
          else
              echo Apache is already installed ;
fi


if [ "${java}" == "" ];

         then
              sudo apt-get install default-jre;
              sudo apt-get install default-jdk;
         else
              echo Java is already installed ;
fi

if [ "${mongo}" == "" ];

         then
              sudo apt-get install -y mongodb;
              
          else
              echo Mongo is already installed ;
fi


if [ "${php}" == "" ];

         then
              sudo apt-get -y install php5 libapache2-mod-php5 php5-mongo php-pear php5-dev;
              sudo pecl install mongo;
              sudo echo "extension=mongo.so" >> /etc/php5/apache2/php.ini
          else
              echo Php is already installed ;
fi

       sudo chmod 777 -R /var/www/;
       sudo printf "<?php\nphpinfo();\n?>" > /var/www/info.php;
       sudo service apache2 restart;

currentdir=${PWD};
sefaradrouteabs="${currentdir}/fuseki"
cd   $sefaradrouteabs;

nohup java -jar fuseki-server.jar --update --config=config.ttl /geo &

cd  $currentdir;

echo  Fuseki is currently running;


cp -rv "${currentdir}/smartopendata" /var/www/

echo '#########################################################################'


echo  SmartOpenData demo is  ready to be accesed, please check:

echo  http://localhost/smartopendata/index.html#/sparql/slovakiaPolygonsDemo 

echo '########################################################################'



else
    echo "Unsupported Operating System, we are currently supporting Linux Operating System";
fi

