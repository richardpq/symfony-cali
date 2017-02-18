#!/bin/sh
wget -P /tmp/ http://xdebug.org/files/xdebug-2.5.0.tgz && tar -xvzf /tmp/xdebug-2.5.0.tgz -C /tmp/ && \
cd /tmp/xdebug-2.5.0 && \
phpize && ./configure && make && \
sudo cp modules/xdebug.so /usr/lib/php/20160303 && \
echo "[xdebug]\nzend_extension=/usr/lib/php/20160303/xdebug.so\nxdebug.remote_enable=1\nxdebug.remote_connect_back = on\nxdebug.remote_port=9000\nxdebug.remote_autostart=1\nxdebug.idekey="PHPStorm"\nxdebug.max_nesting_level = 400\nxdebug.remote_host=192.168.2.192\nxdebug.remote_handler=dbgp" | sudo tee -a /etc/php/7.1/cli/php.ini && \
echo "[xdebug]\nzend_extension=/usr/lib/php/20160303/xdebug.so\nxdebug.remote_enable=1\nxdebug.remote_connect_back = on\nxdebug.remote_port=9000\nxdebug.remote_autostart=1\nxdebug.idekey="PHPStorm"\nxdebug.max_nesting_level = 400\nxdebug.remote_host=192.168.2.192\nxdebug.remote_handler=dbgp" | sudo tee -a /etc/php/7.1/apache2/php.ini
