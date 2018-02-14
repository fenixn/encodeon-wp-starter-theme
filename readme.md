# Encodeon WordPress Starter Theme

Setup a blank WordPress theme with tools ready for fast development.

## Features
1. The functions.php file is enclosed in a class to help prevent function name overlap.
2. $development_mode variable in functions.php that when set to true will cause theme to always enqueue the latest css and js. This will prevent caching issues during development.
3. WordPress Appearances menu controls for changing the theme logo and favicon is prebuilt into theme.
4. Bootstrap css and js is pre-installed into theme.
5. Automation of css and js files and live autoreload with Grunt.
6. Remove WordPress logos and links.

## Installation
1. Clone to the themes directory
```shell
git clone https://github.com/fenixn/encodeon-wp-starter-theme.git
```
2. Run the following command to install dependencies:
```shell
npm install
```
3. The gruntfile is set to automate the concatenation and minify of CSS and JS files in the src directory. It will run the tasks and reload the page when the files are edited. It will also watch the theme PHP files and reload on change.
```shell
grunt watch
```
4. Start developing
