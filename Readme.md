# Known IPFS Support (experimental)

This plugin adds IPFS file support to Known.

## Installation

Step Zero: Install an IPFS server. This is a little bit out of scope, but I used [go-ipfsp](https://docs.ipfs.io/introduction/install/) during development.

Once you've done that:

* Download the latest version of Known. I recommend that you either use the [GitHub](https://github.com/idno/known) version or the [Unofficial packages](https://www.marcus-povey.co.uk/known) available from my website.
* Copy the **IPFS** directory into your ```IdnoPlugins``` directory.
* Activate it from the Admin panel.

## Configuration

The IPFS plugin will default to using ```localhost:8080```. If you want to change this, you will need to modify your ```config.ini``` as follows:

```
[IPFS]
host = 'servername'
port = 1234
apiport = 5678
```

Replace the values accordingly, but make sure you keep the ```[IPFS]``` section header.

## Known Issues

This software is very much experimental at the moment, but feel free to issues in github. 

That said, I know about:

### Don't run composer

The plugin makes use of the [php-ipfs-api](https://github.com/cloutier/php-ipfs-api) library. 

Unfortunately, the version that is currently available via composer has a small bug that corrupts uploaded data, and so I had to fix the error in place. 

I have [filed an issue](https://github.com/cloutier/php-ipfs-api/issues/12) with the author, but the composer package is updated to what's currently on github, running a ```composer install``` will likely break the plugin.

## Still to do

This plugin functionally does not change how files are actually stored - a local object is still created , although the data itself is stored elsewhere. 

Could this be done more efficiently? For example, could a direct link be provided? Likely this would require some core hooks - for example a getFileURL() on file objects.

## See

* Author: [Marcus Povey](https://www.marcus-povey.co.uk)