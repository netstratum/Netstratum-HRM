# netstratum-HRM

Recommended version of mysql- 5.6 or lower

Please follow these steps
.........................

1.Download & extract the project.

2.Move the files hrm & yii to your server root.

3.Create a new database and name it hrm.

4.Import the hrmupdated.sql file from the extracted folder to your database.

5.Open hrm/protected/config/main.php file in your server root and make the following changes.

	5.1.Go to line-115 in the code and create your database username & password.
	
	5.2.Go to line-54 in the code and give host,username,password and port number for smtp mail configuration.

6.Grant permission 777 to protected/runtime in your server root using command prompt.

7.Finally, open the project in localhost. 
