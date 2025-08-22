# PHP 8.2 और Apache बेस्ड इमेज का उपयोग करें
FROM php:8.2-apache

# काम करने वाली डिरेक्टरी सेट करें
WORKDIR /var/www/html

# सिस्टम पैकेज और PHP एक्सटेंशन्स इंस्टॉल करें
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

# Apache की डिफ़ॉल्ट root डायरेक्टरी को Laravel के public फोल्डर पर सेट करें
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Composer को कॉपी करें (Composer का ऑफिसियल इमेज से)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# आपकी प्रोजेक्ट की सारी फाइलें कंटेनर में कॉपी करें
COPY . .

# storage और bootstrap/cache फोल्डर के परमिशन्स सेट करें ताकि Laravel सही चले
RUN chown -R www-data:www-data storage bootstrap/cache public

# Apache सर्वर के लिए पोर्ट खोलें
EXPOSE 80

# Apache को फ़ॉरग्राउंड में चलाएं ताकि कंटेनर हमेशा रन रहे
CMD ["apache2-foreground"]
