# sliminit

[![Author](http://img.shields.io/badge/author-@dieg0v-blue.svg?style=flat-square)](https://twitter.com/dieg0v)
[![Latest Version](https://img.shields.io/github/release/dieg0v/sliminit.svg?style=flat-square)](https://github.com/dieg0v/sliminit/releases)
[![Packagist Version](https://img.shields.io/packagist/v/dieg0v/sliminit.svg?style=flat-square)](https://packagist.org/packages/dieg0v/sliminit)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Simple [slim](https://github.com/slimphp/Slim) app for rapid propotype with:

- [Normalize.css](https://github.com/necolas/normalize.css)
- [Modernizr](https://github.com/Modernizr/Modernizr)
- [jQuery](https://github.com/jquery/jquery)
- [illuminate/database](https://github.com/illuminate/database) for DB connections
- [gulp](https://github.com/gulpjs/gulp) for manage js and css files


## Requirements

* php >=5.4.0
* composer
* gulp
* bower
* npm

## Install and run

Via Composer

``` bash
$ composer create-project dieg0v/sliminit --prefer-dist
$ php -S localhost:8889 -t sliminit/public
```

Done... go to [http://localhost:8889](http://localhost:8889)

For **use gulp**, install dependencies via bower and npm modules on sliminit folder:

``` bash
$ bower install
$ npm install
```

Js and Css on **public/static/js/site.js** and **public/static/css/site.css** are automatically recompressed with:

``` bash
$ gulp watch
```

Manage your views on **app/views** and routes on **app/routes.php**

## Contributing

Please see [CONTRIBUTING](https://github.com/dieg0v/sliminit/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Diego Vilariño](https://github.com/dieg0v)
- [All Contributors](https://github.com/dieg0v/sliminit/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/dieg0v/sliminit/blob/master/LICENSE.md) for more information.