FROM php:8.1-apache

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Install required PHP extensions including intl
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install mysqli intl pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy everything
COPY . /var/www/html

# Give Apache permission to use the files
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80
