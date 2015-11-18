# wp-query-builder

[![Build Status](https://img.shields.io/travis/panvagenas/wp-query-builder/master.svg?style=flat-square)](http://travis-ci.org/panvagenas/wp-query-builder)
[![Codacy](https://api.codacy.com/project/badge/41a8805d26f24a488fb70cd6cf5f23f3)](https://www.codacy.com/app/pan-vagenas/wp-query-builder)
[![Coveralls](https://img.shields.io/coveralls/panvagenas/wp-query-builder.svg?style=flat-square)](https://coveralls.io/github/panvagenas/wp-query-builder)
[![Latest Stable Version](https://img.shields.io/packagist/v/panvagenas/wp-query-builder.svg?style=flat-square)](https://packagist.org/packages/panvagenas/wp-query-builder)
[![License](https://img.shields.io/packagist/l/panvagenas/wp-query-builder.svg?style=flat-square)](https://packagist.org/packages/panvagenas/wp-query-builder)
[![Total Downloads](https://img.shields.io/packagist/dt/panvagenas/wp-query-builder.svg?style=flat-square)](https://packagist.org/packages/panvagenas/wp-query-builder)

A library for building WordPress queries the easy way

## Getting started

### Instalation

First you must include the library in your project. The suggested method is using composer:

```json
{
    "require": {
        "panvagenas/wp-query-builder": "*"
    }
}
```

or run 

```sh
~$ composer require panvagenas/wp-query-builder
```

### Basic Usage

First you should create a builder

```php
<?php
use Pan\QueryBuilder\Builder;

$builder = new Builder();
```

Then create some constraints and define their attributes

```php
<?php
use Pan\QueryBuilder\Constraints\Author;
use Pan\QueryBuilder\Constraints\Category;

$author = new Author();
$category = new Category();

$author->setAuthor(1);
$category->setCategoryName('my-fancy-category');
```

Next we add the constraints to the builder

```php
<?php
$builder->addConstraint( $author )
        ->addConstraint( $category );
```

You can now get an arguments array to pass to `WP_Query::__construct()` anytime by using the
`Builder::getQueryArgsArray()` method. Recommended way though is to use `Pan\QueryBuilder\Query` class

```php
<?php
use Pan\QueryBuilder\Query;

$query = new Query($builder);

$wpQueryResult = $query->getResult();
```

## How it Works

In short it's like 1, 2, 3:

1. `Query` uses the `Builder` to get a valid set of `WP_Query` arguments
2. `Builder` uses `Constraints` to form a valid set of `WP_Query` arguments
3. `Constraints` define a valid set of arguments to use

So you basically the workflow is as follows:

1. Use `Constraints` to define limitation for `WP_Query` result set
2. Pass them to `Builder` in order to get the arguments array
3. Use the `Query` or `WP_Query` to get results

## Why Bother?

Because I really have a hard time to remember exact naming for `WP_Query` arguments. Let the IDE remember, that's why
we have code completion.

## Licence

Copyright (C) 2015 Panagiotis Vagenas <pan.vagenas@gmail.com>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/

## Changelog

### 1.0.0

* Initial release