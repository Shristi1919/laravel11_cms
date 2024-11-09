# Build and start the containers:
docker-compose up -d --build

# Install PHP dependencies:
docker-compose exec app composer install

# Run database migrations and seeders:
docker-compose exec app php artisan migrate:fresh --seed

# API Path of Gallery
http://localhost/api/galleries


# Screenshot of Gallery API 
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/galleriesapi.PNG) 

# API Path of Pages 
http://localhost/api/pages

# Screenshot of Pages API
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/pagesapi.PNG)

# Screenshot of Home Page
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/homepage.PNG)

# Screenshot of CMS Login
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/cmslogin.PNG)

# Screenshot of CMS Dashboard
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/cmsdashboard.PNG)

# Screenshot of Gallery List
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/gallerieslist.PNG)

# Screenshot of Pages List
![Screenshot](https://github.com/Shristi1919/laravel11_cms/blob/master/public/img/app_screenshot/pageslist.PNG)
