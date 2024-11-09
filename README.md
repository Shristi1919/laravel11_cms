# Build and start the containers:
docker-compose up -d --build

# Install PHP dependencies:
docker-compose exec app composer install

# Run database migrations and seeders:
docker-compose exec app php artisan migrate:fresh --seed

# API Path
http://localhost/api/galleries
http://localhost/api/pages

# Screenshot of Gallery API 
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/galleriesapi.PNG) 

Page API
