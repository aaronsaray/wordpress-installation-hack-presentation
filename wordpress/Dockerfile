FROM aaronsaray/lamp-testbed

## wget just makes it easier
RUN pacman -S --noprogressbar --noconfirm --needed wget

## get file
RUN wget -O /tmp/wordpress.tar.gz https://wordpress.org/wordpress-4.8.1.tar.gz

## untar it at our public - so it's ready to go
RUN tar -xf /tmp/wordpress.tar.gz -C /srv/http/public --strip 1

## Set permission properly 
RUN chown -R http:http /srv/http/public

## Create wordpress database
COPY database-init.sh /tmp/database-init.sh
RUN chmod +x /tmp/database-init.sh
RUN /tmp/database-init.sh