couchCache
==========

Dec 2011
Ronaldo Barbachano
www.doinglines.com

Simple php5 class for storing and retrieving objects with support for APC and memcached.

Eventually will support each function for APC (bin functions) and memcached, and perhaps varnish.


Usage
=====

Simply create a new couchCache, or extend another class (giving that class a parent::__construct call);
More examples/notes in code.

        <?php

        myClass extends couchCache{
          function __construct(){
          // set if you need to connect to memcached servers or have anything
          // in the construct method.
        	parent::__construct();
          }
        }

        $new = myClass();
        $new->store('message','Hello World');
                
				// Store to defined couch database (otherwise reverts to defined)
        // $new->store('message','Hello World','couchDB');

        $new->retrieve('message');

        // get message from couchDB, but dont load into memcached
        // $new->retrieve('message',false,'couchDB');

        // get message and load into memcached
        // $new->retrieve('message',true);