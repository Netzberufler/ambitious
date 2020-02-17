var postcss = require('postcss');
var parseSides = require('parse-css-sides');
var rtlcss = require('rtlcss');
var duplicates = require( 'postcss-discard-duplicates' );

module.exports = postcss.plugin('postcss-wprtl', function (opts) {

	opts = opts || {};

	return function (css, result) {

		// RTL relevant declarations.
		var rtlprops = [
			'background-position',
			'background-position-x',
			'border-left',
			'border-left-color',
			'border-left-style',
			'border-left-width',
			'border-top-left-radius',
			'border-bottom-left-radius',
			'border-right',
			'border-right-color',
			'border-right-style',
			'border-right-width',
			'border-top-right-radius',
			'border-bottom-right-radius',
			'clear',
			'float',
			'margin',
			'margin-left',
			'margin-right',
			'padding',
			'padding-left',
			'padding-right',
			'text-align',
			'text-indent',
			'left',
			'right',
			'transform'
		];

		css.walkRules(function(rule) {

			var emptyRule = true;
			var resetRule = false;

			rule.walkDecls(function(decl, i) {

				var prop = decl.prop;
				var val = decl.value;

				// Remove declarations which are not relevant for RTL.
				if (rtlprops.indexOf(prop) === -1) {

					decl.remove();
					return;

				}

				var declRemoved = false;

				// Check margin and padding declarations.
				if( prop === 'margin' || prop === 'padding' ) {

					var sides = parseSides(val);

					// Remove spacing declarations when no difference between left and right spacing.
					if( sides.left === sides.right ) {

						decl.remove();
						declRemoved = true;
						return;

					}

				}

				// Check float declarations.
				if( prop === 'float' && val === 'none' ) {

					decl.remove();
					declRemoved = true;
					return;

				}

				// Check clear declarations.
				if( prop === 'clear' && val === 'both' ) {

					decl.remove();
					declRemoved = true;
					return;

				}

				// Check text align declarations.
				if( prop === 'text-align' && val === 'center' ) {

					decl.remove();
					declRemoved = true;
					return;

				}

				// Check if rule is empty.
				if( ! declRemoved ) {
					emptyRule = false;
				}

				// Create Reset Declarations.
				if( prop === 'margin-left' ) {
					rule.prepend( postcss.decl({ prop: 'margin-right', value: '0' }) );
				}
				if( prop === 'margin-right' ) {
					rule.prepend( postcss.decl({ prop: 'margin-left', value: '0' }) );
				}
				if( prop === 'padding-left' ) {
					rule.prepend( postcss.decl({ prop: 'padding-right', value: '0' }) );
				}
				if( prop === 'padding-right' ) {
					rule.prepend( postcss.decl({ prop: 'padding-left', value: '0' }) );
				}
				if( prop === 'border-left' ) {
					rule.prepend( postcss.decl({ prop: 'border-right', value: 'none' }) );
				}
				if( prop === 'border-right' ) {
					rule.prepend( postcss.decl({ prop: 'border-left', value: 'none' }) );
				}
				if( prop === 'left' ) {
					rule.prepend( postcss.decl({ prop: 'right', value: 'auto' }) );
				}
				if( prop === 'right' ) {
					rule.prepend( postcss.decl({ prop: 'left', value: 'auto' }) );
				}

			});

			// Remove empty rules.
			if ( emptyRule ) {
				rule.remove();
			}

			// Clean up line breaks.
			rule = cleanLineBreaks(rule);

		});

		// Clean up duplicated declarations.
		css = postcss([duplicates]).process(css).root;

		// Run RTLCSS to switch CSS declaration.
		css = postcss([rtlcss]).process(css).root;

		// Remove Comments.
		css.walkComments(comment => {
			comment.remove();
		});

		// Clean up media queries.
		css.walkAtRules('media', function (rule) {
			if (!rule.nodes.length) {
				rule.remove();
			}
			rule = cleanLineBreaks(rule);
		});

		// Create RTL Header.
		var body = postcss.rule({ selector: 'body' });
		var direction = postcss.decl({ prop: 'direction', value: 'rtl' });
		var unicode = postcss.decl({ prop: 'unicode-bidi', value: 'embed' });

		// Add RTL Header.
		body.prepend(direction, unicode);
		css.prepend(body);

	};

});

// Create Line Breaks
function cleanLineBreaks(node) {

	// Remove multiple line breaks.
	if (node.raws.before) {
		node.raws.before = node.raws.before.replace(/\r\n\s*\r\n/g, '\r\n').replace(/\n\s*\n/g, '\n');
	}

	// Add one single line break.
	var linebreak = new Array(2).join('\n');
	node.raws.before = linebreak + node.raws.before;

	return node;
}
