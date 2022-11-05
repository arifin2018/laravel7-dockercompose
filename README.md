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

<p align="center"><img src="https://drive.google.com/file/d/1gwolBbkzE934CRFNHkw0zS0btAgZMl5S/view?usp=share_link" width="400"></p>
