# StringContainer

[![Build Status](https://travis-ci.org/AndyDune/StringContainer.svg?branch=master)](https://travis-ci.org/AndyDune/StringContainer)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/andydune/string-container.svg?style=flat-square)](https://packagist.org/packages/andydune/string-container)
[![Total Downloads](https://img.shields.io/packagist/dt/andydune/string-container.svg?style=flat-square)](https://packagist.org/packages/andydune/string-container)


Collection of functions fo string modification. Collection is composed as strategy pattern with simple extension.

## Actions with string

### Remove duplicate space symbols

It replaces spaces, tabs and so on for regular `\s` with only one space symbol.

```php
use AndyDune\StringContainer\StringContainer;

$container = new StringContainer('Very    
cool.');
'Very cool' == $container->removeDuplicateSpaces()->getString();
```

### Remove duplicate words

It replaces words, if there are more then one in a string.

```php
use AndyDune\StringContainer\StringContainer;

$container = new StringContainer('Very very cool cooly.');
'Very  cool cooly.' == $container->removeDuplicateWords()->getString();
```
