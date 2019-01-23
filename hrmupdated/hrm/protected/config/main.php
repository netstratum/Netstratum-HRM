<?php
error_reporting(0);
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

 

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'hrmnetstratum',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'imagemod'=>array(
                    
                    'class' => 'application.extensions.imagemodifier.CImageModifier',
                ),
                'red'=>array(
                     'class' => 'application.extensions.Redirect.redirect',
                ),
                'menu'=>array(
                     'class' => 'application.extensions.menu.menu',
                ),
                 'Smtpmail'=>array(
                    'class'=>'application.extensions.smtpmail.PHPMailer',
                    //'Host'=>"smtp.sendgrid.net",
                    'Host'=>"smtp-relay.gmail.com",
                    //'Username'=>'info@netstratum.com',
                    //'Username'=>'jackson_kj2000',
                    //'Password'=>'Appro%!@#123',
		    //'Password'=>'qwerty1234',
                    'Mailer'=>'smtp',
                    //'Port'=>25,
		   'Port'=>587,
                    //'SMTPAuth'=>true, 
		    'SMTPSecure'=>'tls'
                ),
		
		'apns' => array(
                            'class' => 'application.extensions.apns-gcm.YiiApns',
                            'environment' => 'sandbox',
                            'pemFile' => dirname(__FILE__).'/apnssert/apns-dev.pem',
                            'dryRun' => false, // setting true will just do nothing when sending push notification
                            // 'retryTimes' => 3,
                            'options' => array(
                                     'sendRetryTimes' => 5
                            ),
                    ),
                     'gcm' => array(
                            'class' => 'application.extensions.apns-gcm.YiiGcm',
                            'apiKey' => 'AIzaSyA6h-4Ts5i9ZgX4w7x30sSL5RMqIfcVp3Y'
                    ),
                     // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
                    'apnsGcm' => array(
        			'class' => 'application.extensions.apns-gcm.YiiApnsGcm',
       				 // custom name for the component, by default we will use 'gcm' and 'apns'
        			//'gcm' => 'gcm',
        			//'apns' => 'apns',
                                ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
                
                /*'session'=> array (
                    'sessionName' => 'Site Session',
                    'class'=>'CHttpSession',
                    'userTransparentSessionID'=>($_POST['PHPSESSID']) ? true : false,
                    'autoStart'=>'true',
                    'cookieMode'=>'only',
                    'savePath' => '/path/to/new/directory',
                    'timeout'=> 300
                    ),
            */
            
					            
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=netstratum_hrm',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'tr1vandrum',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
                                     
					'levels'=>'error, warning',
                                      
				),
                            array(
					
                                        'class'=>'CWebLogRoute',
					'categories'=>'system.db.CDbCommand',
                                        'showInFireBug'=>true,
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'encrptpass'=>'af%&*!77'
	),
);
