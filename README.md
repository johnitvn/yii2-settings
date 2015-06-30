yii2-settings
=============

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

Add settings into component config: 

````php
'components' => [        
    'settings'=>[
        'class'=>'johnitvn\settings\Settings'
    ],
],
````

Ok let see this codesnipet to use:

````php
$settings = Yii::$app->settings;

$value = $settings->get('section,'key');

$settings->set('section','key', 'value', 'integer');

````

If you want to manager setting with GUI then add settings into module config:
````php
'modules' => [
    'settings' =>  [
        'class'=>'johnitvn\settings\Module',
    ]       
]
````

And go to localhost/index.php?r=settings/manager/index.php