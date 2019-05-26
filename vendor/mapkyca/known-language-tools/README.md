# Known i18n language tools

This contains development tools for creating .pot files.

## Usage

* In your plugin, require this dependency: ``` composer require mapkyca/known-language-tools --dev ```
* Copy and rename ```vendor/mapkyca/known-language-tools/Sample.Gruntfile.js``` to ``` ./Gruntfile.js ```
* Copy and rename ```vendor/mapkyca/known-language-tools/Sample.package.json``` to ``` ./package.json ``` and edit accordingly
* Make a ``` ./languages ``` directory in your project
* Install grunt, and its dependencies (usually ``` npm install --only=dev ```)
* ``` grunt build-lang ```

## See

* Author: Marcus Povey <https://www.marcus-povey.co.uk>
* Blog post <https://www.marcus-povey.co.uk/2019/04/04/improved-known-i18n-development-tools/>
