# PHP 8.2 और Apache बेस्ड official image का उपयोग करें
FROM php:8.2-apache

# कंटेनर के अंदर वर्किंग डिरेक्टरी सेट करें
WORKDIR /var/www/html

# जरूरी dependencies और PHP एक्सटेंशन्स इंस्टॉल करें
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd && \
    a2enmod rewrite

# Apache DocumentRoot को Laravel के public फोल्डर पर सेट करें
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Composer इंस्टॉल करें (official Composer image से)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# पहले composer.json और composer.lock कॉपी करें, फिर dependencies इंस्टॉल करें (कैशिंग के लिए)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# बाकि सारे प्रोजेक्ट फाइल कॉपी करें
COPY . .

# storage, bootstrap/cache और public फोल्डर के परमिशन सही तरीके से सेट करें
RUN chown -R www-data:www-data storage bootstrap/cache public

# Apache के लिए पोर्ट एक्सपोज़ करें
EXPOSE 80

# Apache को फ़ॉरग्राउंड में चलाएं ताकि कंटेनर रनिंग रहे
CMD ["apache2-foreground"]
