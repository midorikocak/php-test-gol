# game-of-life

[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require midorikocak/game-of-life
```

## Usage

Using a random array generated using size:
``` sh
$ php life.php -r -s 40 -i 1024 -sp 1 -v
```

Using a file:

``` sh
$ php life.php -v -f data/glider_gun.xml
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email midori@mynameismidori.com instead of using the issue tracker.

## Credits

- [Midori Kocak][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/midorikocak/game-of-life.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/midorikocak/game-of-life/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/midorikocak/game-of-life.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/midorikocak/game-of-life.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/midorikocak/game-of-life.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/midorikocak/game-of-life
[link-travis]: https://travis-ci.org/midorikocak/game-of-life
[link-scrutinizer]: https://scrutinizer-ci.com/g/midorikocak/game-of-life/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/midorikocak/game-of-life
[link-downloads]: https://packagist.org/packages/midorikocak/game-of-life
[link-author]: https://github.com/midorikocak
[link-contributors]: ../../contributors
