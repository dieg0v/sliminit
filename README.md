# sliminit

[![Author](http://img.shields.io/badge/author-@dieg0v-blue.svg?style=flat-square)](https://twitter.com/dieg0v)
[![Latest Version](https://img.shields.io/github/release/dieg0v/sliminit.svg?style=flat-square)](https://github.com/dieg0v/sliminit/releases)
[![Packagist Version](https://img.shields.io/packagist/v/dieg0v/sliminit.svg?style=flat-square)](https://packagist.org/packages/dieg0v/sliminit)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/dieg0v/sliminit/master.svg?style=flat-square)](https://travis-ci.org/dieg0v/sliminit)

Simple [slim](https://github.com/slimphp/Slim) app for rapid prototype with:

- [Normalize.css](https://github.com/necolas/normalize.css)
- [Modernizr](https://github.com/Modernizr/Modernizr)
- [jQuery](https://github.com/jquery/jquery)
- [illuminate/database](https://github.com/illuminate/database)
- [gulp](https://github.com/gulpjs/gulp)
- [postcss](https://github.com/postcss/postcss)
- [lost](https://github.com/corysimmons/lost)
- [browsersync](http://www.browsersync.io)

## Requirements

* php >=5.4.0
* composer
* gulp
* bower
* npm

The following versions of PHP are supported by this version.

* PHP 5.4
* PHP 5.5
* PHP 5.6

## Install and run

Via Composer

``` bash
$ composer create-project dieg0v/sliminit --prefer-dist
$ php -S 0.0.0.0:8889 -t sliminit/public
```

Done... go to [http://localhost:8889](http://localhost:8889)

For **use gulp**, install dependencies via bower and npm modules on sliminit folder:

``` bash
$ bower install
$ npm install
```

Js and Css on **public/static/js/site.js** and **public/static/css/main.css** are automatically recompressed with:

``` bash
$ gulp watch
```

If you want run php built-in server, browsersync and watch js/css/mustache files changes, use default gulp task:

``` bash
$ gulp
```

## Howto

Manage your pages on **app/config/pages.php**

## Testing

``` bash
$ php vendor/bin/codecept run
```

## Contributing

Please see [CONTRIBUTING](https://github.com/dieg0v/sliminit/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Diego Vilariño](https://github.com/dieg0v)
- [All Contributors](https://github.com/dieg0v/sliminit/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/dieg0v/sliminit/blob/master/LICENSE.md) for more information.