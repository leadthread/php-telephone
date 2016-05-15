# php-telephone
[![Latest Version](https://img.shields.io/github/release/zenapply/php-telephone.svg?style=flat-square)](https://github.com/zenapply/php-telephone/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/zenapply/php-telephone.svg?branch=master)](https://travis-ci.org/zenapply/php-telephone)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zenapply/php-telephone/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zenapply/php-telephone/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/zenapply/php-telephone/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zenapply/php-telephone/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187/badge.svg?style=flat)](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187)
[![Total Downloads](https://img.shields.io/packagist/dt/zenapply/php-telephone.svg?style=flat-square)](https://packagist.org/packages/zenapply/php-telephone)

This package aims at providing an easy to use telephone data-type class.

## Installation

Install via [composer](https://getcomposer.org/) - In the terminal:
```bash
composer require zenapply/php-telephone
```

## Usage

```php
use Zenapply\DataTypes\Telephone;

$phone = new Telephone('+1 (230) 555-3333', 'US'); // The second parameter (region) is optional and defaults to 'US'.

echo $phone . PHP_EOL;                      // +12305553333
echo $phone->getE164() . PHP_EOL;           // +12305553333
echo $phone->getRFC3966() . PHP_EOL;        // tel:+1-230-555-3333
echo $phone->getNational() . PHP_EOL;       // (230) 555-3333
echo $phone->getInternational() . PHP_EOL;  // +1 230-555-3333
echo $phone->getOriginal() . PHP_EOL;       // +1 (230) 555-3333
echo $phone->getAreaCode() . PHP_EOL;       // 230
echo $phone->getCountryCode() . PHP_EOL;    // 1
echo $phone->getSubscriberCode() . PHP_EOL; // 5553333
echo $phone->isValid() . PHP_EOL;           // true
```

## Contributing

Contributions are always welcome!