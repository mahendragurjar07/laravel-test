## Instalation 
```php
Install dependency run below command
composer install
```

### Import Database
```php
Import mysql-dump.sql file in your database.
```

### Change variable in .env file
```
Change database details
DB_DATABASE=gyrix_db
DB_USERNAME=root
DB_PASSWORD=
```

### Run Project
```
Get all data
http://localhost/laraveltest/public/api/explorer

Get filter data
http://localhost/laraveltest/public/api/explorer?client_id[]=1&client_id[]=2&project_id[]=32&project_id[]=16
```