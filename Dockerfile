# PHP 8.2 और Apache बेस्ड official image का उपयोग करें
FROM php:8.2-apache

# कंटेनर के अंदर वर्किंग डायरेक्टरी सेट करें
WORKDIR /var/www/html

# Composer इंस्टॉल करें (official Composer image से)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# पूरी Laravel प्रोजेक्ट कंटेनर में कॉपी करें
COPY . .

# जरूरी PHP एक्सटेंशन्स और पैकेज इंस्टॉल करें
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd && \
    a2enmod rewrite

# Composer dependencies इंस्टॉल करें (vendor फोल्डर बन जाएगा)
RUN composer install --no-dev --optimize-autoloader

# storage, bootstrap/cache और public फोल्डर के परमिशन सही करें
RUN chown -R www-data:www-data storage bootstrap/cache public

# Apache DocumentRoot को Laravel के public फोल्डर पर सेट करें
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Apache के लिए पोर्ट खोलें
EXPOSE 80

# Apache को फोरग्राउंड में चलाएं ताकि कंटेनर चलता रहे
CMD ["apache2-foreground"]
