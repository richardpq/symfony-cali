#!/bin/sh
#this fix some errors that could appear when the host machine is in a different language than English.
export LC_ALL="en_US.UTF-8"
export LANGUAGE="en_US.UTF-8"
export LANG="en_US.UTF-8"
sudo sed -i -e '$a LC_ALL="en_US.UTF-8"' /etc/environment
sudo sed -i -e '$a LANG="en_US.UTF-8"' /etc/default/locale
sudo sed -i -e '$a LANGUAGE="en_US.UTF-8"' /etc/default/locale
#to update and upgrade repositories 
apt-get update -y && apt-get upgrade -y && \
apt-get install git -y && \
#to have add-apt-repository binary
apt-get install python-software-properties -y && \
echo | add-apt-repository ppa:ondrej/php && \
apt-get update -y && \
apt-get install apache2 -y && \
apt-get install php7.1 php7.1-curl php7.1-mysql php7.1-intl php7.1-dev php7.1-mcrypt php7.1-mbstring php7.1-gd php7.1-xml php7.1-zip memcached php-memcached -y && \
echo mysql-server mysql-server/root_password password root | sudo debconf-set-selections && \
echo mysql-server mysql-server/root_password_again password root | sudo debconf-set-selections && \
apt-get install mysql-server -y && \
sudo sed -i '/ServerRoot "\/etc\/apache2"/a ServerName localhost:80' /etc/apache2/apache2.conf && \
sudo sed -i "s/memory_limit = 128M/memory_limit = 1024M/g" /etc/php/7.1/apache2/php.ini && \
sudo sed -i "s/memory_limit = 128M/memory_limit = 1024M/g" /etc/php/7.1/cli/php.ini && \
sudo sed -i "s/;date.timezone =/date.timezone = Europe\/London/g" /etc/php/7.1/cli/php.ini && \
sudo sed -i "s/;date.timezone =/date.timezone = Europe\/London/g" /etc/php/7.1/apache2/php.ini && \
sudo truncate -s 0 /etc/apache2/sites-available/000-default.conf && \
echo "\n<FilesMatch \\.php$>\n\tSetHandler application/x-httpd-php\n</FilesMatch>" | sudo tee -a /etc/apache2/apache2.conf  && \
echo "<VirtualHost *:80>\n\n\tServerAdmin webmaster@localhost\n\tDocumentRoot /home/vagrant/project/web\n\n\t<Directory /home/vagrant/project/web>\n\t\tOptions FollowSymlinks\n\t\tAllowOverride all\n\t\tRequire all granted\n\t</Directory>\n\n\tErrorLog \${APACHE_LOG_DIR}/error.log\n\tCustomLog \${APACHE_LOG_DIR}/access.log combined\n</VirtualHost>" | sudo tee -a /etc/apache2/sites-available/000-default.conf && \
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer.phar && \
sudo a2enmod rewrite