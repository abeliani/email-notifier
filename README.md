# Email-notifier

### A simple email notification service

The service isn't used any external libraries

```
structure/
│
├── config/
│   └── config.php
│
├── console/
│   ├── script.php
│   └── validate.php
│
├── database/
│   ├── db.php
│   └── migrations/
│       └── ...
│
├── docker/
│   ├── crontab
│   └── Dockerfile
│
├── src/
│   ├── emails/
│   ├── file_system/
│   ├── init/
│   ├── logging/
│   ├── migrations/
│   ├── templates/
│   └── users/
│
├── templates/
│   └── ...
│
├── tests/
│   ├── test.php
│   └── test_email.php
│
├─ templ/
│    └── cronjobs.txt
│
├── bootstrap.php
├── docker-compose.yml
└── init.php
```

### Docker
PHP8.1 and Postgresql13 (the script wrote using php7.4 syntax)
```shell
$ docker-compose up -d
```

### init
It will commit migrations and log directory
```shell
$ php init.php
```

### Email validate
The command run by cron every night each minute
```shell
$ php console/validate.php
```

### Email notify
The command run by cron every day each minute
```shell
$ php console/script.php
```

### Tests
```shell
$ php tests/test.php
```

Each run of the script receives N (config.emailer.batch) records from the database, 
for each of them the processing_at flag is set, the next run of the script will take other records.

This way you can manage the load on the server and control the number of sent emails per day.
The default (config.emailer.batch) is 1000 it will allow you to process more than a million records per day.

### see
```text
src/users/db_users.php
```
