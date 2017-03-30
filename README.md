# Simple Tomb Locator

Simple implementation of Tomb Locator. This web base system allows user to map out a tomb in a map . 

Feature List  :
  - Manage Tomb Location
  - Search available tomb
  - Manage Tomb Occupants
  - Search Tomb Occupants

Requirement
* Make sure you install php 5.6  - Install WAMP or XAMP
* Make sure php.exe is added to your path - if you are using windows click here on how to do that - http://stackoverflow.com/questions/7307548/how-to-access-php-with-the-command-line-on-windows. 
* Install Composer in your machine . https://getcomposer.org/Composer-Setup.exe. After installing this you should execute commands such as `composer self-update`


Installation Process : 
1. Download the project  - https://github.com/kevindaus/tomblocator
2. Extract the project anywhere you like.
3. Open command prompt and go to that path where you extracted the file. e.g `C:\wamp\www\tomblocator`
4. Now go to protected folder by executing `cd protected` then download the required library by executing `composer self-update && composer update`
5. Now execute command `cd ..` then execute `mkdir assets`
6. Now execute command `cd protected` then execute command `notepad main.php`. Notepad should open then paste this configuration code
```php
<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '[Change This to Your Likings]',
    'theme' => 'hebo',
    // preloading 'log' component
    'preload' => array('log'),
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'bootstrap.helpers.TbHtml',
        'bootstrap.helpers.TbArray',
        'bootstrap.behaviors.TbWidget',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
    ),
    'modules' => array(
        'user'=>array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            'hash' => 'md5',
            'sendActivationMail' => true,
            'loginNotActiv' => false,
            'activeAfterRegister' => false,
            'autoLogin' => true,
            'registrationUrl' => array('/user/registration'),
            'recoveryUrl' => array('/user/recovery'),
            'loginUrl' => array('/user/login'),
            'returnUrl' => array('/home'),
            'returnLogoutUrl' => array('/user/login'),
        ),
        'rights'=>array(
           'superuserName'=>'admin',
           'authenticatedName'=>'Authenticated',
           'userIdColumn'=>'id',
           'userNameColumn'=>'username',
           'enableBizRule'=>true, 
           'enableBizRuleData'=>true, 
           'displayDescription'=>true, 
           'flashSuccessKey'=>'RightsSuccess',
           'flashErrorKey'=>'RightsError',
           'baseUrl'=>'/rights',
           'layout'=>'rights.views.layouts.main',
           'appLayout'=>'application.views.layouts.main',
           'cssFile'=>'rights.css',
           'install'=>false,
           'debug'=>false, 
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user'=>array(
                'class'=>'RWebUser',
                'rightsReturnUrl'=>array('authItem/roles'),
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                'defaultRoles'=>array('Authenticated', 'Guest'),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'yiiwheels' => array(
            'class' => 'ext.yiiwheels.YiiWheels',
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '/home'=>'site/index',
                '/gallery'=>'site/gallery',
                '/contact'=>'site/contact',
                '/login'=>'user/login',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=CHANGE_THIS_TO_DATABASENAME',
            'emulatePrepare' => true,
            'username' => 'CHANGE_THIS_TO_DATABASE_USERNAME',
            'password' => 'CHANGE_THIS_TO_DATABASE_PASSWORD',
            'charset' => 'utf8',  
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    // 'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
              array(
              'class'=>'CEmailLogRoute',
              'levels'=>'error',
              'emails'=>'hellsing357@gmail.com',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);

```
Save the file by pressing `ctrl + s` . Now close the file. 
7. Execute `notepad console.php` , notepad should open then paste this configuration code
```php
<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'CHANGE THIS TO YOUR LIKINGS',
	'import' => array(
		'ext.YiiMailer.YiiMailer',
	),
	// application components
	'components' => array(
		// uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=DATABASE',
            'emulatePrepare' => true,
            'username' => 'DB_USERNAME_CHANGE_THIS',
            'password' => 'DB_PASSWORD_CHANGE_THIS',
            'charset' => 'utf8',  
        ),
	),
	'modules'=>array(
        'user'=>array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
        ),
	)
);

```
Save that and close the file.
8. The rest of installation should be smooth by clicking `installUserAndRightsModule.bat`. If prompted for confirmation just press `y` then enter . If prompted to set admin account , specify username and password you can use fake email for email admin  . 
9. Now go to the project and look for start.bat . Double click that to start the mini web server. 
10. Open your browser and type `localhost:8000`

Tip and info : 
* Make sure WAMP or XAMP is turned on
* Make sure to remember your username/password after executing installUserAndRightsModule.bat . If you cant remember your account just delete the whole database and double click `installUserAndRightsModule.bat`



---
<h1> If you found any error (Im sure there are plenty) , Feel free to create an issue here https://github.com/kevindaus/tomblocator/issues together with the screenshot of the error. 
</h1>

---

V1.0.0 - First release
* Base feature is added
