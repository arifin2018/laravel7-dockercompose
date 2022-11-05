<p align="center"><img src="https://avatars.githubusercontent.com/u/59710027?v=4" width="400"></p>

## How to running my docker?

**don't forget to adding etc/hosts**

-   127.0.0.1 backend.test

---

1. docker-compose up -d --build
2. docker exec -it backend bash
3. cp .env.example .env
4. composer install
5. php artisan migrate
6. php artisan db:seed
7. php artisan db:seed --class=PermissionSeeder
8. php artisan db:seed --class=RolePermissionSeeder
9. php artisan passport:install

# test and running Postman

-   http://backend.test:8080

## if you want connect to dbeaver

<p align="center"><img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgyasqdwA25XWQDnWKmeQ5fM3ihd5H5CrovcQYA8Ism8NM3KWGMPYmTqSOFjPr8fc7z82BLf-SIeC5nwTFJdHEoVn3Ouu6VtnzF44esIdA2omIRh4xfF3u8mqtdbunwFHiM1m45ljaZIpqW6Sz4s2BZV8nudaNEwBy8mE8mScpWtUY8hFQOmQPQTWPeOQ/w653-h572/Screen%20Shot%202022-11-06%20at%2001.02.24.png" width="400"></p>
