Starting with Collections
=========================

* `Installation`_
* `Collections`_

Installation
------------

Requires the library installation using composer.

.. code-block:: bash

    $ composer require "cct-marketing/collections":"~1.0"

Composer will install the library in the ``**vendor/cct-marketing/collections**`` directory.

Collections
-----------

Currently, there are three types of collection:

1. `Collection`_
2. `ParameterCollection`_
3. `ArrayCollection`_

Collection
``````````

The `Collection` is an immutable class implementing the `CollectionInterface`, which means you cannot change the state of the object.

.. raw:: html

    <div style="text-align: center;"><img src="images/collection.png" width="70%" /></div>


ParameterCollection
```````````````````

The `ParameterCollection` class is focused mostly to handle the collection by the keys.
This class extends from the `Collection`_ class.

.. raw:: html

    <div style="text-align: center;"><img src="images/parameter-collection.png" width="70%" /></div>


ArrayCollection
```````````````

The `ArrayCollection` extends from the `Collection`_ class, and also implements all the methods contained on `ParameterCollection`_ class.
It is the most complete collection handler, which allows you to execute some internal array functions, also including actions most focused on the elements.

.. raw:: html

    <div style="text-align: center;"><img src="images/array-collection.png" width="70%" /></div>
