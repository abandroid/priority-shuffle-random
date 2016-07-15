Priority Shuffle Random
=======================

*By [endroid](http://endroid.nl/)*

[![Latest Stable Version](http://img.shields.io/packagist/v/endroid/priority-shuffle-random.svg)](https://packagist.org/packages/endroid/priority-shuffle-random)
[![Build Status](http://img.shields.io/travis/endroid/PriorityShuffleRandom.svg)](http://travis-ci.org/endroid/PriorityShuffleRandom)
[![Total Downloads](http://img.shields.io/packagist/dt/endroid/priority-shuffle-random.svg)](https://packagist.org/packages/endroid/priority-shuffle-random)
[![Monthly Downloads](http://img.shields.io/packagist/dm/endroid/priority-shuffle-random.svg)](https://packagist.org/packages/endroid/priority-shuffle-random)
[![License](http://img.shields.io/packagist/l/endroid/priority-shuffle-random.svg)](https://packagist.org/packages/endroid/priority-shuffle-random)

This library extends the basic random functionality by ensuring that the
appearance of items is evenly distributed while respecting their priority.
Items with priority 3 will be shown three times as often as items with priority
1, while the shuffle algorithm ensures that the values are spreaded nicely.

## Installation

Use [Composer](https://getcomposer.org/) to install the library.

``` bash
$ composer require endroid/priority-shuffle-random
```

## Usage

```php
<?php

use Endroid\PriorityShuffleRandom;

$random = new PriorityShuffleRandom();
$random->add('A', 1);
$random->add('B', 2); // Show B two times as often as the other items
$random->add('C', 1);
$random->add('D', 1);

for ($i = 0; $i < 12; $i++) {
    echo $random->next();
}

// Example output: CABDBDBACBAC
```

## Versioning

Version numbers follow the MAJOR.MINOR.PATCH scheme. Backwards compatibility
breaking changes will be kept to a minimum but be aware that these can occur.
Lock your dependencies for production and test your code when upgrading.

## License

This bundle is under the MIT license. For the full copyright and license
information please view the LICENSE file that was distributed with this source code.
