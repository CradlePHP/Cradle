# All the Back End You'll Ever Need

**Cradle** is a feature rich, modern Content Management System. Build apps faster. Developer friendly. Open Source.

![Demo](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/showntell.png)

## Features

We compiled a list of feature requirements based on over 10 years of backend system development.

### Objects and Relations

[![Objects and Relations](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-7.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-7.png)

Most, if not all, applications deal with objects and relations to other objects. If you can't find an out of box solution for what you want to build, ususally these things need to be custom developed. The time it takes to develop depends on how many objects and relations you have. It's really this gray area without proper planning can fail. At its core, Cradle provides a way to create, manage and dynamically generate an admin for all of your objects and relations.

### Fields as a Playground

[![Fields as a Playground](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-8.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-8.png)

Create fields on the fly, make mistakes and change fields, re-order fields; Skies are the limits! Clone objects to make creating objects even faster. Relate objects in one-to-zero, one-to-one, one-to-many and many-to-many. You can even relate external tables not defined in our system.

### Validations and Output Formats

[![Validations and Output Formats](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-6.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-6.png)

On top of form submissions, we need to also consider field validation and final output formats. Cradle supports any kind of validation (required, empty, less, greater, regexp, etc.) and output formats (capital, lower, date, relative, link, email, image, formulas, etc.). Activate searchable, filter and sortable features per field and it will be dynamically rendered in your admin.

### Database Translations

[![Database Translations](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-10.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-10.png)

We compared against many popular CMS libraries to determine a proper database structure and concluded that none fit what we wanted in terms of raw flexibility. Our fields translates into proper SQL-3NF and ElasticSearch schemas without any fuss. You can create, update, sort fields even after creating an object. Just turn on Redis to take advantage of data caching and RabbitMQ to take advantage of queues.

### Dynamic Search Pages

[![Dynamic Search Pages](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-3.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-3.png)

Developers usually miss out on some of the basic features of a general search because it is just so tedious to build out all the time. Cradle takes care of these for you. Featuring search queries, dynamic filters, relations, bulk actions, importing and exporting. Define searchable, filterable and sortable fields in your schema and watch the search page match your specifications.

### Dynamic Forms

[![Dynamic Forms](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-4.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-4.png)

Developing form submissions is a very tedious process starting from creating the front end form and validating fields to creating or updating into the database, provide a success message and redirect to another page. With Cradle, no more! Forms are dynamically created, validated and processed based on your defined objects and relations.

### Relational Actions and Filters

[![Relational Actions and Filters](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-5.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-5.png)

Easy navigation to object relations and do further filters, bulk actions, importing and exporting. Create objects and have it automatically linked to its parent. Link existing objects together easily.

### Menu Builder

[![Menu Builder](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-2.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-2.png)

Create menu items on the fly. Create menu groups and drag items and groups in any order you want. Choose any icon from the FontAwesome 5 library or none at all. Use any link you want, even not in the system. Menu items automatically will show on relative active pages and show counts on schema search menu items.

### Lots of Fields

[![Lots of Fields](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-1.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-1.png)

Supporting all HTML5 fields, mask, WYSIWYG, Markdown, Code Editors, Date Fields, Range Sliders, Switches, Dials & Knobs, Files & Images Tag and Meta fields. All fields accept an arbitrary amount of HTML attributes incase you want to add a placeholder or number min-max for example. You can also free add your own custom fields, use any JavaScript and CSS. Anything you like.

### Fully Templated

[![Fully Templated](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/preview-9.png)](https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/full-9.png)

We considered all UI elements in our admin to be flexible and usable anywhere including the front end. Built on top of jQuery, Bootstrap 4, and Font Awesome 5 and Handlebars to reduce the learning curve and for easier manipulation.

#### More Features

 - Import/Export
 - 4 Themes
 - Roles and Permissions
 - Package Management with Packagist
 - Dynamic OAuth 2, REST and Webhooks
 - Multi Language Support (i18n)
 - Admin Action Logs

## Our Technology Stack

Carefully chosen agnostic technologies that can be used with any major server stack.

[<img alt="PHP 7" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/php.png" width="100" height="100" />](http://php.net/archive/2018.php#id2018-03-02-1)
[<img alt="MySQL 5.7" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/mysql.png" width="100" height="100" />](https://dev.mysql.com/doc/relnotes/mysql/5.7/en/)
[<img alt="ELK Stack" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/elastic.png" width="100" height="100" />](https://www.elastic.co/)
[<img alt="Redis" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/redis.png" width="100" height="100" />](https://redis.io/)
[<img alt="RabbitMQ" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/rabbit.png" width="100" height="100" />](https://www.rabbitmq.com/)
[<img alt="Bootstrap 4" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/bootstrap.png" width="100" height="100" />](https://getbootstrap.com/)
[<img alt="jQuery" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/jquery.png" width="100" height="100" />](https://jquery.com/)
[<img alt="Font Awesome 5" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/fontawesome.png" width="100" height="100" />](https://fontawesome.com/)
[<img alt="Yarn" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/yarn.png" width="100" height="100" />](https://yarnpkg.com/en/)
[<img alt="Handlebars" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/handlebars.png" width="100" height="100" />](https://handlebarsjs.com/)
[<img alt="Travis CI" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/travis.png" width="100" height="100" />](https://travis-ci.org/)
[<img alt="Codeception" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/codecept.png" width="100" height="100" />](https://codeception.com/)
[<img alt="Docker" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/docker.png" width="100" height="100" />](https://www.docker.com/)
[<img alt="AWS S3" src="https://raw.githubusercontent.com/CradlePHP/cradlephp.github.io/master/images/s3.png" width="100" height="100" />](https://aws.amazon.com/s3/)

### Other Libraries We Used

- [Ace Editor](https://ace.c9.io)
- [Simplemde](https://simplemde.com/)
- [Moment.js](http://momentjs.com/)
- [Flatpickr](https://flatpickr.js.org/)
- [Ion.RangeSlider](http://ionden.com/a/plugins/ion.rangeSlider/en.html)
- [Toastr](https://codeseven.github.io/toastr/)
- [Papa Parse](https://www.papaparse.com/)
- [Doon](https://github.com/cblanquera/doon)
- [WYSIHTML](http://wysihtml.com/)
- [Acquire](https://github.com/cblanquera/acquire)

<a name="#contribute"></a>
## Contributing to Cradle

Thank you for considering to contribute to Cradle. Before contributing, please [read the CradlePHP docs](https://cradle.github.io).

Bug fixes will be reviewed as soon as possible. Minor features will also be considered, but give me time to review it and get back to you. Major features will **only** be considered on the `master` branch.

1. Fork the Repository.
2. Fire up your local terminal and switch to the version you would like to
contribute to.
3. Make your changes.
4. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")

## Making pull requests

1. Please ensure to run [phpunit](https://phpunit.de/) and
[phpcs](https://github.com/squizlabs/PHP_CodeSniffer) before making a pull request.
2. Push your code to your remote forked version.
3. Go back to your forked version on GitHub and submit a pull request.
4. All pull requests will be passed to [Travis CI](https://travis-ci.org/CradlePHP/framework) to be tested. Also note that [Coveralls](https://coveralls.io/github/CradlePHP/framework) is also used to analyze the coverage of your contribution.
