# Dockerfile
FROM almalinux:8

# Instalar EPEL y Remi repositories
RUN dnf install -y epel-release && \
    dnf install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm

# Habilitar módulo PHP 7.4
RUN dnf module reset php -y && \
    dnf module enable php:remi-7.4 -y

# Instalar Apache y PHP 7.4 con extensiones comunes
RUN dnf install -y \
    httpd \
    php \
    php-cli \
    php-common \
    php-curl \
    php-gd \
    php-json \
    php-mbstring \
    php-mysql \
    php-xml \
    php-zip \
    php-opcache \
    && dnf clean all

# Configurar Apache
COPY apache-config.conf /etc/httpd/conf.d/custom.conf
RUN sed -i 's/#ServerName www.example.com:80/ServerName localhost/' /etc/httpd/conf/httpd.conf && \
    sed -i 's/Listen 80/Listen 0.0.0.0:80/' /etc/httpd/conf/httpd.conf

# Crear directorio para webimagenes y establecer permisos
RUN mkdir -p /var/www/html/webimagenes && \
    chown -R apache:apache /var/www/html && \
    chmod -R 755 /var/www/html

# Exponer puerto 80
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]