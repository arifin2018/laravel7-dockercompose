<p align="center"><img src="https://instagram.fcgk28-1.fna.fbcdn.net/v/t51.2885-19/178103679_129768889205408_5633537790076949461_n.jpg?stp=dst-jpg_s150x150&_nc_ht=instagram.fcgk28-1.fna.fbcdn.net&_nc_cat=108&_nc_ohc=rq3GjHLG-e8AX_908ih&edm=ABmJApABAAAA&ccb=7-5&oh=00_AT-6lXOSKu3Z8AmlfErR6FDuSV1vkb1-9e5ppccu6iUT5A&oe=635D33BC&_nc_sid=6136e7" width="400"></p>

## How to running my docker?

**don't forget to adding etc/hosts**

-   127.0.0.1 backend.test

---

1. docker-compose up -d --build
2. docker exec -it backend bash
3. cp .env.example .env
4. php artisan migrate
5. php artisan migrate --class=RoleSeeder
6. php artisan migrate --class=PermissionSeeder
7. php artisan migrate --class=RolepermissionSeeder
8. php artisan passport:install

# test and running Postman

-   http://backend.test:8080
