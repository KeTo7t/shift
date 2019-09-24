FROM centos:latest

# Install & Add repo
RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

# Install PHP7.1 & Apache
RUN yum --enablerepo=remi-php72 install php php-devel php-common php-pdo php-fpm php-mbstring php-mysqlnd php-ldap php-mysql php-gd php-pear php-pecl-apc-devel php-xml php-mcrypt php-pecl-zip php-tokenizer php-json php-pear zlib-devel php-intl -y

#
COPY ./php.ini /etc
COPY ./httpd.conf /etc/httpd/conf/httpd.conf

# install mysql client
RUN yum install -y http://dev.mysql.com/get/mysql-community-release-el7-5.noarch.rpm
RUN yum install -y mysql-community-client

# install nodejs
RUN yum remove -y nodejs npm
RUN yum clean all
RUN yum install -y https://rpm.nodesource.com/pub_6.x/el/7/x86_64/nodesource-release-el7-1.noarch.rpm
RUN yum install -y nodejs


# Clear yum cache
RUN yum clean all



# for web
EXPOSE 80
EXPOSE 4434
EXPOSE 8080

CMD /usr/sbin/httpd -DFOREGROUND



# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN ln -nfs /var/www/source/public /var/www/html/
