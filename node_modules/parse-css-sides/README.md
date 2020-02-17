# parse-css-sides

[![NPM version](http://img.shields.io/npm/v/parse-css-sides.svg?style=flat)](https://www.npmjs.org/package/parse-css-sides)
[![npm license](http://img.shields.io/npm/l/parse-css-sides.svg?style=flat-square)](https://www.npmjs.org/package/parse-css-sides)
[![Travis Build Status](https://img.shields.io/travis/jedmao/parse-css-sides.svg?label=unix)](https://travis-ci.org/jedmao/parse-css-sides)

[![npm](https://nodei.co/npm/parse-css-sides.svg?downloads=true)](https://nodei.co/npm/parse-css-sides/)

Font helpers for [PostCSS](https://github.com/postcss/postcss).

## Installation

```
$ npm install parse-css-sides [--save[-dev]]
```

## Usage

```js
var parseSides = require('parse-css-sides');
parseSides('0 5% 10px'); // { top: '0', right: '5%', bottom: '10px', left: '5%' }
```

All 4 sides are always returned and are always strings.

## Testing

```
$ npm test
```

This will run tests and generate a code coverage report. Anything less than 100% coverage will throw an error.
