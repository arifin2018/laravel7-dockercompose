<p align="center"><img src="https://avatars.githubusercontent.com/u/59710027?v=4" width="400"></p>

## How to running my docker?

**don't forget to adding etc/hosts**

-   127.0.0.1 backend.test

---

1. docker-compose up -d --build
2. docker exec -it backend bash
3. cp .env.example .env
4. php artisan migrate
5. php artisan db:seed
6. php artisan db:seed --class=PermissionSeeder
7. php artisan db:seed --class=RolePermissionSeeder
8. php artisan passport:install

# test and running Postman

-   http://backend.test:8080
