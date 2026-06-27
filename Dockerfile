# Use official PHP with Apache
FROM php:8.1-apache

# Enable mysqli extension (needed for MySQL connection)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all project files into Apache's web root
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
