##Configuration

* Install composer dependencies
```
composer install
```

* Create database.sqlite in /database directory.

* Create DB schema with doctrine.

```
vendor/bin/doctrine orm:schema-tool:create
```

* Update DB schema with doctrine.

```
vendor/bin/doctrine orm:schema-tool:update --force
```