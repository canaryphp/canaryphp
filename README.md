# CanaryPHP Framework
Build Fast your project
# Classes Feuture
- Classes for stability
## How to Install
1. Availlable only with Composer :
Command :
```
composer require canaryphp/canaryphp
```
composer.json
```json
{
    "require":{
        "canaryphp/canaryphp"
    }
}
```
- After install read :
``CanaryPHP START.md``: [START.md](https://github.com/canaryphp/canaryphp/blob/master/START.md)
### Examples
- Create Your first page :
1. Create secondpage.php in : ``` ./example/webroot/secondpage.php ```
```php
<?php
require dirname(__DIR__).DIRECTORY_SEPARATOR.'index.php';
CanaryPHP\Load::content();
```
2. Create secondpageController.php in : ``` ./example/controller/secondpageController.php ```
```php
<?php
function sayhello(){
    return 'Hello World !';
}
pass('message',sayhello());
```
3. Create view for secondpage.php in : ``` ./example/template/default/view/secondpage.php ```
```php
<h1>get('message')</h1>
```
- Edit home page Content :
1. Edit file in : ``` ./example/controller/indexController.php ```
2. Edit view file in : ``` ./example/template/default/view/index.php ```
4. show page content in : ``` localhost/example/secondpage.php ```
# NOTICE
- `vendor` folder and the `vendor/autoload.php` script are generated by composer ,there are not part from CanaryPHP
