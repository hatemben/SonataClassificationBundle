Sonata Classification Bundle for MongoDB
========================================

Installation using composer
---------------------------

Add the repository to your composer :

    # composer.json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/hatemben/SonataClassificationBundle"
        }
    ],
    "require": {
        "sonata-project/classification-mongodb-bundle": "3.x-dev",

Then simply run composer update. Make sure you set version 3.x-dev, the only working branch until now.
Don't follow official documentation and use easy-extend as it will create lots of useless code.
Copy the Application/ Folder under doc under your application src/
Then add to your config/bundles.php :

    # config/bundles.php
        Sonata\ClassificationBundle\SonataClassificationBundle::class => ['all' => true],
        App\Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle::class => ['all' => true],
    ];

Now you can create default context manually or with command line :

    ./bin/console sonata:classification:fix-context

Notice that Sonata\DoctrineMongoDBAdminBundle\Filter\

And your app is ready to go !