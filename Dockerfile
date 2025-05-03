# Use official PHP image with Apache as base
FROM php:8.1-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmagickwand-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \  # Required for intl extension
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli zip \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install intl \  # Install the intl extension
    && apt-get clean

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory in the container
WORKDIR /var/www/html

# Copy your PHP application code into the container
COPY . /var/www/html/

# Set proper permissions for the application folder
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80 to access the web server
EXPOSE 80

# Start Apache in the foreground (this is the default behavior of the image)
CMD ["apache2-foreground"]
