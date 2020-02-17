# PostCSS-WPRTL

[PostCSS](https://github.com/postcss/postcss) plugin for WordPress theme developers to transform style.css into rtl.css. Powered by [rtlcss](https://github.com/MohammadYounes/rtlcss).

By default, WordPress themes load both rtl.css and style.css stylesheets. Therefore rtl.css should only include flipped CSS rules, nothing else.

#### Features
* Removes all CSS declarations that are unimportant for RTL
* Generates reset values for margins, paddings and borders
* Flips CSS rules from LTR to RTL by using [rtlcss](https://github.com/MohammadYounes/rtlcss)

## Install

Install the [npm package](https://www.npmjs.com/package/postcss-wprtl):

```ssh
$ npm install postcss-wprtl --save-dev
```

## Usage
```javascript
postcss([ require('postcss-wprtl') ])
```

See [PostCSS](https://github.com/postcss/postcss#usage) docs to setup with Gulp, Grunt or Webpack.

## Examples

```css
/* style.css */
.site-branding {
	float: left;
	margin-right: 2em;
	padding: 0;
	max-width: 100%;
}
```

```css
/* rtl.css */
.site-branding {
	float: right;
	margin-right: 0;
	margin-left: 2em;
}
```