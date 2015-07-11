yii2-settings
=============
[![Latest Stable Version](https://poser.pugx.org/johnitvn/yii2-settings/v/stable)](https://packagist.org/packages/johnitvn/yii2-settings)
[![License](https://poser.pugx.org/johnitvn/yii2-settings/license)](https://packagist.org/packages/johnitvn/yii2-settings)
[![Total Downloads](https://poser.pugx.org/johnitvn/yii2-settings/downloads)](https://packagist.org/packages/johnitvn/yii2-settings)
[![Monthly Downloads](https://poser.pugx.org/johnitvn/yii2-settings/d/monthly)](https://packagist.org/packages/johnitvn/yii2-settings)
[![Daily Downloads](https://poser.pugx.org/johnitvn/yii2-settings/d/daily)](https://packagist.org/packages/johnitvn/yii2-settings)

Yii2 settings with database module with GUI manager supported



![yii2-settings](https://c1.staticflickr.com/1/491/18760365473_d5aed4619d_z.jpg "yii2-settings")


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist johnitvn/yii2-settings "*"
```

or add

```
"johnitvn/yii2-settings": "*"
```

to the require section of your `composer.json` file.


Usage
-----

####Add settings into component config: 

````php
'components' => [        
    'settings'=>[
        'class'=>'johnitvn\settings\Settings'
    ],
],
````

####Ok let see this codesnipet to use:

````php
$settings = Yii::$app->settings;

$value = $settings->get('section,'key');

$settings->set('section','key', 'value', 'integer');

$settings->delete('section,'key');

$settings->deleteAll('section,'key');

$settings->clearCache(); // automatic call when use set()

````

####Look at line:
````php
$settings->set($section,$key,$value,$type);
````
You can use $section for distribute setting such as system,user...
And the $type will be use for get settings. This extension have used [settype](http://php.net/manual/en/function.settype.php) for set the type of a setting when you get it



####If you want to manager setting with GUI then add settings into module config:
````php
'modules' => [
    'settings' =>  [
        'class'=>'johnitvn\settings\Module',
    ]       
]
````

And go to localhost/index.php?r=settings/manager/index.php
