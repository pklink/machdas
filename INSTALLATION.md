# Installation

## Pre-Built (downloaded from SourceForge)

* import `setup/install.sql`
* copy `config.sample.php` to `config.php`
* edit `config.php`
* chmod `tmp/cache` to `777`

## Build your own release (clone from GitHub)

### Requirements

* [Git](http://git-scm.com/)
* [Composer](http://getcomposer.org/)

### Instructions

* `mkdir dingbat`
* `cd dingbat/`
* `git clone https://github.com/pklink/Dingbat.git .`
* _Optional:_ switch to a specified version/tag `git checkout tags/<name of tag>`; for example: `git checkout tags/0.4.0`
* `php composer.phar install`
* see the installation instructions of the pre-built version above


## Upgrade

### to 0.5.0

* execute `setup/update-to-0.5.0.sql`

### to 0.4.1

* add key/config `name` to your `config.php` (default value is `Dingbat`)