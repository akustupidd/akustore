FROM php:8.2-fpm-alpine

# Install required packages
RUN apk add --no-cache \
    composer \
    openssl \
    pcre \
    zlib \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    gd \
    curl \
    make \
    git

# Set working directory
WORKDIR /app

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader

# Create a network for the container
RUN docker network create mysqldb-network

# Copy the rest of the application code
COPY . .

# Expose the container port
EXPOSE 80

# Start the web server
CMD ["docker run --network mysqldb-network --name devit-phone-shop --link 127.0.0.1:mysql php artisan serve"]
