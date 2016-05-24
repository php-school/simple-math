Write a program that accepts the name of database and a Couch DB document ID. You should load this document using the
provided ID from the provided database. In the document will be a key named `numbers`. You should add them all up
and add the total to the document under the key `total`. You should save the document and finally output the total to
the console.

You must have Couch DB installed before you run this exercise, you can get it here:
  [http://couchdb.apache.org/#download]()

----------------------------------------------------------------------
## HINTS

You could use a third party library to communicate with the Couch DB instance, see this doctrine library:
  [https://github.com/doctrine/couchdb-client]()

Or you could interact with it using a HTTP client such as Guzzle:
  [https://github.com/guzzle/guzzle]()

Or you could simply use `curl`.

Check out how to interact with Couch DB documents here:
  [http://docs.couchdb.org/en/1.6.1/intro/api.html#documents]()

You will need to do this via PHP.

You specifically need the `GET` and `PUT` methods, or if you are using a library abstraction, you will need to
`find` and `update` the document.


You can use the doctrine library like so:

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\CouchDB\CouchDBClient;
$client = CouchDBClient::create(['dbname' => $dbName]);

//get doc
$doc = $client->findDocument($docId);

//update doc
$client->putDocument($updatedDoc, $docId, $docRevision);
```

`{appname}` will be supplying arguments to your program when you run `{appname} verify program.php` so you don't need to supply them yourself. To test your program without verifying it, you can invoke it with `{appname} run program.php`. When you use `run`, you are invoking the test environment that `{appname}` sets up for each exercise.

----------------------------------------------------------------------
