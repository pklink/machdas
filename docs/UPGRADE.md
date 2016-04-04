# Upgrade

## to 0.6.0

* execute `setup/update-to-0.6.0.sql`

## to 0.5.1

* change the following keys in your `config.php`
    * `database` to `db`
    * `db.name` to `db.database`
* add the following keys and values to your `config.php`
    * key: `driver` value: `'mysql'`
    * key: `charset` value: `'utf8'`
    * key: `collation` value: `'utf8_unicode_ci'`
    * key: `prefix` value: `''`
* execute `setup/update-to-0.5.1.sql`

## to 0.4.2

* write down your set priorities
* execute `setup/update-to-0.4.2.sql`
* set your priorities again - sorry

## to 0.4.1

* add key/config `name` to your `config.php` (default value is `Dingbat`)

## to 0.3.0

* execute `setup/update-to-0.3.0.sql`

## to 0.2.0

* execute `setup/update-to-0.2.0.sql`