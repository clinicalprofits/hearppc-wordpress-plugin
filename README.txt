=== Plugin Name ===
Tags: hearppc
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin sets up the HearPPC landing page, call tracking, and script dependencies for a WordPress installation.

== Description ==

Use this plugin to easily integrate HearPPC with your WordPress installation.

The plugin does the following actions:

* Creates a new page that will serve as the landing page for ads that are clicked
* Installs the HearPPC Landing Page script into the newly created page so the appropriate content is displayed
* Adds a nofollow/noindex meta tag into the header of the landing page so search engines don't try to follow/index it (the content is dynamic, and shouldn't be indexed)
* Includes the call tracking script in the footer of your site

== Installation ==

Via WordPress Admin:
1. Go to Plugins -> Add New -> Upload Plugin and browse for the plugin .zip file
2. Activate the plugin on the resulting page

Manually:
1. Upload `hearppc-integration` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Configuration ==

In order for the plugin to function properly it needs to be configured.

1. Go to WordPress Admin -> Settings -> HearPPC Integration
2. For basic functionality, fill in Access Key and Practice Description with the provided information
3. For call tracking, fill in the Call Tracking Id and Call Tracking Key with the provided information
4. Save your changes

== Testing ==

To test the landing page:

1. Go to Pages and view "Hearing Aids PPC"
2. The landing page requires an Ad Group to be passed through the URL. Append ?ag=Test (or &ag=Test if '?' is already present) to the end of the URL and hit enter
3. You should see "Congratulations" displayed, if you do not, please contact us at clinicalprofits@gmail.com

== Frequently Asked Questions ==

= It doesn't work. What should I do? =

Please contact us at clinicalprofits@gmail.com

= My call tracking isn't working. What gives? =

This is probably due to the call tracking id or key being incorrect. Please confirm that you copied the correct values into the form.
If it still isn't working please contact us at clinicalprofits@gmail.com

= What does "Invalid account. Aborting." mean? =

This means that the domain in our database doesn't match the domain of your landing page. Please contact us at clinicalprofits@gmail.com to fix the issue.