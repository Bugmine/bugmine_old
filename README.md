Bugmine
=======

Bugmine is an open source issue tracking software written in PHP.

It is using [CodeIgniter](http://www.codeigniter.com/) for providing useful features such as MVC, routing, form validation, etc.

Requirements
=======
* PHP version 5.2.4 or newer
* Apache mod_rewrite enabled

Installation
=======

1. Upload the source files to your web folder.
2. Edit the database settings located in /application/config/database.config matching your database server information
3. **IMPORTANT** Change $config['encryption_key'] in /application/config/config.php (you can use http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/ for generation an encryption key)
4. Open Bugmine in your browser to start the migration process. (This will automatically create your database schema)

Demo
=======
We have installed a [Demo](http://bugminedemo.stefan-schmid.com/) page which gets updated from time to time.

It runs on a Ubuntu 14.04 server with Apache 2.4.7 and PHP 5.5.9
