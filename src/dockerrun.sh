#!/bin/sh
docker run -it -p 8000:80 -v /var/www/vendor -v $PWD:/var/www/ lbaw2135/lbaw2135
