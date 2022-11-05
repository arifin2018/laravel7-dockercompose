FROM php:7.4-fpm
WORKDIR /var/www/html/backend

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mbstring

# Add user for laravel application
# RUN groupadd -g 1000 www-data
# RUN useradd -u 1000 -ms /bin/bash -g www-data www-data

# WORKDIR /var/www/html/backend
COPY . /var/www/html/backend
RUN composer install

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html/backend
RUN chown -R www-data:www-data /var/www/html/backend

# Change current user to www
USER www-data

# CMD php artisan serve --host=0.0.0.0
EXPOSE 9000                     
CMD ["php-fpm"]
