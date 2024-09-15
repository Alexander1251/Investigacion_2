# Usar una imagen base de PHP con Apache
FROM php:8.3-apache

# Instalar extensiones requeridas por Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Copiar los archivos de Laravel dentro del contenedor
COPY torneo-api /var/www/html

COPY .env /var/www/html





# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ejecutar Composer install
RUN composer install

# Dar permisos a la carpeta de almacenamiento y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Cambia el directorio raíz de Apache a /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Configura Apache para permitir .htaccess
RUN echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' >> /etc/apache2/apache2.conf

# Copiar los archivos de Laravel dentro del contenedor
COPY . /var/www/html

# Exponer el puerto 80 para el servidor Apache
EXPOSE 80

