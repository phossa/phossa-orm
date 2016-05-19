# phossa-orm
[![Build Status](https://travis-ci.org/phossa/phossa-orm.svg?branch=master)](https://travis-ci.org/phossa/phossa-orm)
[![HHVM](https://img.shields.io/hhvm/phossa/phossa-orm.svg?style=flat)](http://hhvm.h4cc.de/package/phossa/phossa-orm)
[![Latest Stable Version](https://img.shields.io/packagist/vpre/phossa/phossa-orm.svg?style=flat)](https://packagist.org/packages/phossa/phossa-orm)
[![License](https://poser.pugx.org/phossa/phossa-orm/license)](http://mit-license.org/)

**phossa-orm** is an ORM library for PHP.

It requires PHP 5.4 and supports PHP 7.0+, HHVM. It is compliant with
[PSR-1][PSR-1], [PSR-2][PSR-2], [PSR-4][PSR-4].

[PSR-1]: http://www.php-fig.org/psr/psr-1/ "PSR-1: Basic Coding Standard"
[PSR-2]: http://www.php-fig.org/psr/psr-2/ "PSR-2: Coding Style Guide"
[PSR-4]: http://www.php-fig.org/psr/psr-4/ "PSR-4: Autoloader"

Features
--

Installation
---

Install via the [`composer`](https://getcomposer.org/) utility.

```
composer require "phossa/phossa-orm=1.*"
```

or add the following lines to your `composer.json`

```json
{
    "require": {
        "phossa/phossa-orm": "^1.0.0"
    }
}
```

Features
---

- Use either INT, BIGINT or UUID for primary key

- Model name can be different from table name.

  - tableNameType: sameAsModel, camelCase or snake_case

  - tableNamePrefix: added a prefix 'tbl_' etc.

  - tableName: exact table name


- Property name can be different from column name.

- Create table if not exists or force drop & create

- autoColumns like createTime, updateTime, deleteTime etc.

- auto validation & conversion of data on saving().

- setter & getter

- getter methods.

  ```php
  class Users extends Model
  {
      getterMethods = [
        'fullName' => function() {
            return $this.firstName . ' ' . $this.lastName;
        },
      ];
  }
  ```

Usage
---

- <a name="start"></a>Getting started

Advanced topics
---

Dependencies
---

- PHP >= 5.4.0

- phossa/phossa-query 1.*

- phossa/phossa-db 1.*

License
---

[MIT License](http://mit-license.org/)
