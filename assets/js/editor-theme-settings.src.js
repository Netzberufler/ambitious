/**
 * Editor Theme Settings
 * 
 * @package Ambitious
 */

/**
 * WordPress dependencies
 */
const { registerPlugin } = wp.plugins;
const { PluginSidebar, PluginSidebarMoreMenuItem } = wp.editPost;
const { Fragment, Component } = wp.element;
const { compose } = wp.compose;
const { withSelect, withDispatch } = wp.data;
const { PanelBody, SelectControl, ToggleControl } = wp.components;

/**
 * Theme Settings Editor Plugin
 */
class ThemeSettings extends Component {
	componentDidUpdate( prevProps ) {
		const {
			meta: {
				gt_hide_page_title: hideTitle,
				gt_page_layout: pageLayout,
			} = {},
			postType,
		} = this.props;

		// Return early if post type is not a static page.
		if ( ! postType || 'page' !== postType.slug ) {
			return null;
		}

		if ( hideTitle !== prevProps.meta.gt_hide_page_title ) {
			this.updateTitleBodyClass( hideTitle );
		}

		if ( pageLayout !== prevProps.meta.gt_page_layout ) {
			this.updatePageLayoutBodyClass( pageLayout );
		}
	}

	updateTitleBodyClass( title ) {
		if ( title ) {
			document.body.classList.add( 'gt-page-title-hidden' );
		} else {
			document.body.classList.remove( 'gt-page-title-hidden' );
		}
	}

	updatePageLayoutBodyClass( layout ) {
		if ( 'fullwidth' === layout ) {
			document.body.classList.add( 'gt-fullwidth-page-layout' );
		} else {
			document.body.classList.remove( 'gt-fullwidth-page-layout' );
		}
	}

	render() {
		const {
			meta: {
				gt_hide_page_title: hideTitle,
				gt_page_layout: pageLayout,
			} = {},
			postType,
			updateMeta,
		} = this.props;

		// Return early if post type is not a static page.
		if ( ! postType || 'page' !== postType.slug ) {
			return null;
		}

		return (
			<Fragment>

				<PluginSidebarMoreMenuItem
					target="gt-theme-settings-sidebar"
				>
					{ gtThemeSettingsL10n.plugin_title }
				</PluginSidebarMoreMenuItem>

				<PluginSidebar
					name="gt-theme-settings-sidebar"
					title={ gtThemeSettingsL10n.plugin_title }
				>

					<PanelBody title={ gtThemeSettingsL10n.page_options } initialOpen={ true }>

						<SelectControl
							label={ gtThemeSettingsL10n.page_layout }
							value={ pageLayout }
							onChange={ ( newLayout ) => updateMeta( { gt_page_layout: newLayout || '' } ) }
							options={ [
								{ value: '', label: gtThemeSettingsL10n.default_layout },
								{ value: 'fullwidth', label: gtThemeSettingsL10n.full_layout },
							] }
						/>

						<ToggleControl
							label={ gtThemeSettingsL10n.hide_title }
							checked={ !! hideTitle }
							onChange={ () => updateMeta( { gt_hide_page_title: ! hideTitle } ) }
						/>

					</PanelBody>

				</PluginSidebar>

			</Fragment>
		);
	}
}

const plugin = compose(
	withSelect( ( select ) => {
		const { getEditedPostAttribute } = select( 'core/editor' );
		const { getPostType } = select( 'core' );

		return {
			meta: getEditedPostAttribute( 'meta' ),
			postType: getPostType( getEditedPostAttribute( 'type' ) ),
		};
	} ),
	withDispatch( ( dispatch, { meta } ) => ( {
		updateMeta( newMeta ) {
			dispatch( 'core/editor' ).editPost( { meta: { ...meta, ...newMeta } } );
		},
	} ) ),
)( ThemeSettings );

/**
 * Register plugin in Editor
 */
registerPlugin( 'gt-theme-settings', {
	icon: 'admin-tools',
	render: plugin,
} );
