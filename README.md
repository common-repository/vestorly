# Vestorly Plugin for Wordpress

*** NO LONGER SUPPORTED ***

Integrate Vestorly content with Wordpress: embed your content libraries in pages, posts and sidebars.

## Description
Vestorly is a content marketing platform to display unlimited free web content and track the identity of your viewers. With Vestorly you can automatically curate content libraries for unlimited individuals and groups, while accessing new data on their interaction with your digital content. You can use the widget to place the content of a Vestorly library anywhere a sidebar appears, or embed them in a page or post using a shortcode or the Vestorly button on the Visual Editor's toolbar.

## Installation
1. Unzip all files to the /wp-content/plugins/ directory
1. Log into Wordpress admin and Activate the 'Vestorly' plugin through the 'Plugins' menu
1. Once the plugin has been installed and activated, bind the plugin to a Vestorly advisor account by entering the advisor email and password. The password will be discarded once a valid connection is established with Vestorly.

## Frequently Asked Questions

#### How to register as Advisor?
If you don't have a ready Vestorly advisor account:

1. Register a Vestorly advisor account at https://www.vestorly.com/product/#apply
2. Note your Vestorly email and password
3. Populate the advisor library so the widget can have something to display

#### How to embed Vestorly content in a sidebar?
Once you have authenticated with Vestorly, you can configure the widget as follows:

1. Log into Wordpress admin and go to Appearance > Widgets
2. Drag 'Vestorly' from 'Available widgets' to where you want it. e.g. Main Sidebar
3. Optionally configure the height or width of the widget, limit the number of items to display, skip to the first item to display, and/or select the display mode you fancy: 'basic', 'carousel' or 'vertical'

#### How to embed Vestorly content with shortcode?

To display the widget in a post or page, type the following code:

`[vestorly]`

To configure, just add the options you require:

`[vestorly skip=0 limit=10 display=carousel]`

## Changelog

* **1.3.6**: Fix broken anonymous setting
* **1.3.5**: Fix display issues
* **1.3.4**: Fix broken login
* **1.3.3**: Fix login issues
* **1.3.1**: Fix the widget options.
* **1.3**: Update to use the latest login endpoint.
* **1.2**: Add another option for the embed.
* **1.1**: Updated to be more in line with best PHP practices. You may need to login or reauthenticate.
* **1.0**: Initial release.
