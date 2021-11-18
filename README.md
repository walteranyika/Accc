

## Setup Instructions
* Clone the repo from github and composer install command
* Copy ```.env.example```  file to ```.env```
* Create an account on https://mailtrap.io/
* Update the following parameters to match your local values
  * ```DB_DATABASE=```
  * ```DB_USERNAME=```
  * ```DB_PASSWORD=```
* Use values from mailtrap for this
  * ```MAIL_USERNAME=```
  * ```MAIL_PASSWORD=```

* Run ```php artisan migrate --seed``` command to create a few entries in the DB
* Run your application via ```php artisan serve```
* Run the background queue vai ```php artisan queue:work```
* Post an article via postman to ```/api/post``` route
* Run the command ```php artisan send:emails```
* Check if the email has been sent on mailtrap inbox

## end points
To create a new post, you need to send a POST request to this endpoint with title and body parameters. 
* ```/api/post```

To create a new subscription, you need to send a POST request to this endpoint with user_id and website_id parameters
* ```/api/subscribe```



