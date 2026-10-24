FROM --platform=linux/arm64 php:8.5.12-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_24.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN echo 'expose_php = Off' > /usr/local/etc/php/conf.d/zz-security.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.* ./
RUN composer install --no-dev --no-scripts --no-autoloader

COPY package*.json ./
RUN npm ci --include=dev

COPY . .

RUN composer dump-autoload --optimize --no-dev \
    && npm run build

EXPOSE 9000
