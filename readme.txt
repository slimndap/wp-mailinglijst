=== Mailinglijst ===
Contributors: slimndap
Tags: email, mailinglijst, marketing, newsletter, plugin, signup, shortcode
Requires at least: 2.8
Tested up to: 3.8
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Mailinglijst plugin allows you to add a signup form for your Mailinglijst. 

== Description ==

The Mailinglijst plugin allows you to add a signup form for your Mailinglijst list. 

After installation you can enter your mailinglijst 'lijstnummer' on the setup page. The plugin supports popup, iframe and FAST versions of the sign-up form.

Mailinglijst is an email marketing solution provided by EM-Cultuur (http://www.em-cultuur.nl/producten/mailinglijst/).

== Installation ==

This section describes how to install the plugin and get it working.


1. Add the `mailinglijst` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Enter your 'lijstnummer' in the settings page under 'Setting/Mailinglijst'

__Shortcode__

You can add a `[mailinglijst]` shortcode inside your posts.

If you are using the popup version then you also have to provide a text for the link:

`[mailinglijst]Subscribe to our newsletter[/mailinglijst]

__Widget__

If your theme support widgets then you can also choose to use the Mailinglijst widget.

__Contributors Welcome__

* Submit a [pull request on Github](https://github.com/slimndap/wp-mailinglijst)

__Author__

* [Jeroen Schmit, Slim & Dapper](http://slimndap.com)

== Changelog ==

= 0.3 =
* Added some error checking. 

= 0.2 =
* Added some CSS. Can be disabled in settings.

= 0.1 =
* Basic version of the plugin.
