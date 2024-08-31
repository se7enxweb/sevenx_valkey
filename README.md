## 7x Valkey Solution for eZ Publish

sevenx_valkey is an extension that allows the integration of the Redis Compabible Databases like Valkey, Redis, DragonflyDB to be accessed in your eZ Publish Templates and Modules.

Version: 1.0.0

## About Valkey

Valkey is an open source key-value data store that supports a variety of workloads such as caching, and message queues. Valkey GLIDE is one of the official client libraries for Valkey and it supports all Valkey commands. GLIDE supports Valkey 7.2 and above, and Redis open source 6.2, 7.0, and 7.2.

From: [https://valkey.io/](https://valkey.io/)

## php-redis php extension

A PHP extension for Redis and other compatible key / value store databases.

This software is required and must be installed before using this solution.

From: [https://github.com/phpredis/phpredis](https://github.com/phpredis/phpredis)

## Installation

Follow these steps to add the sevenx_valkey template operator extension to your eZ publish installation:

  1) Extract the archive into the extension/ directory

  2) Edit site.ini.append.php in settings/override/. Add the following to the file:

       [ExtensionSettings]
       ActiveExtensions[]=sevenx_valkey

     If you already have the [ExtensionSettings] block, just add the second line.

  3) Edit extension/settings/valkey.ini.append.php and edit the default host IP Address and Port only if needed.

  4) Use the valkey operator in your eZ Publish Templates to get and set database stored values.

  5) Clear Cache

## Usage

To use, simply add the valkey operator to your templates as needed to get and set data into the valkey / redis database.

{valkey('set', array( 'testkey', 'Greetings from 7x Valkey!' ))}

{valkey('get', array( 'testkey' ))|attribute(show,1)}

## License

This file may be distributed and/or modified under the terms of the "GNU
General Public License" version 2 as published by the Free Software Foundation

This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING THE
WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.

The "GNU General Public License" (GPL) is available at
[http://www.gnu.org/copyleft/gpl.html](http://www.gnu.org/copyleft/gpl.html).
