# Understrap Themer

## A WordPress Plugin

**Understrap Themer** is a plugin to download a custom understrap-based theme from a
repository and customize the theme name and information.

## Installing The Plugin

The plugin is stored in the build folder.

[build/understrap-themer.zip](build/understrap-themer.zip)

1. Upload the plugin files to the `/wp-content/plugins/understrap-themer` directory, or install the plugin through 
the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Understrap Themer screen to configure the plugin.

## Settings

The plugin adds a menu item to the Settings menu. It is advisable to review and, if desired, update 
these settings after activating the plugin.

## Using This Plugin

This plugin requires a valid url to download the theme from.

## Contributing

Please review the [CONTRIBUTING.md](CONTRIBUTING.md) file if you are interested in helping develop or 
maintain this plugin. Also, please be aware that contributors are expected to adhere to the 
[CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) and use the [PULL_REQUEST_TEMPLATE.md](PULL_REQUEST_TEMPLATE.md) 
when submitting code.

## Development

You will need npm and phpcs to get started. Use `npm install` to install gulp and other libraries 
required to help package the plugin for publishing. Source files are in the `source` folder. The 
code style is defined in the `phpcs.xml` file and requires `phpcs` to validate the code.

## About This Plugin

This plugin was created by Noah J. Stewart to help with rapid development of Bootstrap-based 
WordPress themes. I was going to build something very to *understrap* but was happy to find that 
a lot of the hard work has already been done. This plugin is to help customize the child
theme.

## License

The WordPress plugin **Understrap Themer** is open-sourced software licensed under the ISC license.
