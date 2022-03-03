System requirements
===================

* docker
* docker-compose
* sqlite client (optional)

Environment setup
=============

You will need to install Docker and Docker compose in your system.

    https://docs.docker.com/get-docker/
    https://docs.docker.com/compose/install/
    
Environment stack is: php + nginx + sqlite

To execute queries in DB you can either use a sqlite client or use Symfony Doctrine commands.

Alternatively, you can use your own environment setup with PHP + SQL, as long as you send all files needed to run it.

Start environment using Docker compose
-----------------
    
1. Run docker with

    docker-compose up -d
    
2. Run composer with

    docker-compose exec php php composer.phar install

3. To access the server go to the url:

    http://localhost:32777/
    
If everything is fine you'll see the Symfony welcome page.

TIP: To execute Symfony Console you can do it with
    docker-compose exec php bin/console `arguments` 

Stop environment
----------------

    docker-compose down

What do we need?
========

Our company is processing product reviews. 
The volume has been increased recently, so we want to store this reviews into a database.

We will need:
 - A page to list all the reviews
 - A page with a form to create a review.

Each review in our system has three important data to take care of:
 - A user name (the reviewer).
 - A text reviewing the product.
 - Review creation date.
 - 4 aspects to rate from 1 to 5. (Price, Quality, Delivery time and Worthy)
 
 
What do you have to do?
-----------------------
We provide you 2 templates:
    - The Reviews list: templates/reviews/reviews_list.html.twig
    - The form to create a review: templates/reviews/review_form.html.twig

You have to implement the backend to process the form and save data in the database.
Once saved, it must redirect to the review list where all reviews are shown.

The list will show for every review:
 - User name.
 - Text.
 - Date.
 - Average rating of all 4 rated aspects.

To achieve this yo will have to:
 - Create tables in database.
 - Create controllers and routes.

Notes
-----
- Feel free to configure the framework at your convenience.
- Testing will be valuable.
- Use of DDD will be valuable.


- If you execute queries, attach them into a file.

Delivery
--------

Send the code in a zip file avoiding the vendor folder. 
You can use the following command to generate the ZIP.

`docker-compose exec php php composer.phar archive --file name --format zip`


DAVID's Notes
-----

In order to create DB, I run, after create the whole DB mapping:

`bin/console doctrine:schema:create`

Regarding to routing, I have created 2 controllers, placed at (App\Api\Controller):
* MainApiController redirects Api to 'backoffice_review_list' route: "/api/backoffice/review/list".
* ReviewApiController: Is the controller for the whole Review actions.
* Our Application have 2 Use cases: List and create. You can found them at: "App\Application\UseCase".
* The application has been developed following DDD and Hexagonal Architecture principles. You can find some Ifaces (ports) and its implementations (adapters) according to applications needs.
* 
