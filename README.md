PHP - AJOX - Array/ JSON/ Object/ XML conversion
------------------------------------------------
Umlauts will be considered

### Content  

**First Steps**

* [Instantiate the Converter](https://github.com/sasbro/ajox_conv#instantiate-the-converter "jump!")  
* [Create some stuff for testing](https://github.com/sasbro/ajox_conv#create-some-stuff-for-testing "jump!")   

**Usage - toArray**

* [json2array](https://github.com/sasbro/ajox_conv#json2array "jump!")  
* [object2array](https://github.com/sasbro/ajox_conv#object2array "jump!")  
* [xml2array](https://github.com/sasbro/ajox_conv#xml2array "jump!")  

**Usage - toJSON**

* [array2json](https://github.com/sasbro/ajox_conv#array2json "jump!")  
* [object2json](https://github.com/sasbro/ajox_conv#object2json "jump!")  
* [xml2json](https://github.com/sasbro/ajox_conv#xml2json "jump!")  

**Usage - toObject**

* [array2object](https://github.com/sasbro/ajox_conv#array2object "jump!")  
* [json2object](https://github.com/sasbro/ajox_conv#json2object "jump!")  
* [xml2object](https://github.com/sasbro/ajox_conv#xml2object "jump!")  

**Usage - toXML**

* [array2xml](https://github.com/sasbro/ajox_conv#array2xml "jump!")  
* [json2xml](https://github.com/sasbro/ajox_conv#json2xml "jump!")  
* [object2xml](https://github.com/sasbro/ajox_conv#object2xml "jump!")  


> #### Instantiate the Converter 

```php

	require_once 'lib/ajox.class.php';
	
	$AJOX = new AJOX();
```

> #### Create some stuff for testing

#### Simple Array

```php

	$array = array(
    "a",
    "b",
    "c",
    "aou" => "הצü",
	    array(
	        "aa" => 2,
	        "bb" => 4
	    ),
		    array(
		        array(
		            1,
		            "2",
		            "three" => "4"
		        )
	    )
	);
```

#### Simple JSON

```php

	$json = '{"a":1,"b":2,"c":3,"d":"4","e":"ה"}';
```

#### Simple Object

```php

	$object = new stdClass();
	$object->title = "Some Book Title";
	$object->author = "Author Name";
	$object->publication = 1978;
	$object->umlauts = "הצü";
```

#### Simple XML (File - 'lib/data.xml')

```xml

	<?xml version="1.0" encoding="UTF-8"?>
	<root>
	     <title>Some Title</title>
	     <entry>
	          <catchword>Munich</catchword>
	          <text>Some text about Munich</text>
	     </entry>
	     <entry>
	          <catchword>Cologne</catchword>
	          <text>Some text about Cologne</text>
	     </entry>
	</root>
```

Usage - toArray
-------------------

> ### json2array

```php

	print_r($AJOX->json2array($json));
```

> #### Result

![screen_1](/readme/json2array.jpg)

> ### object2array

```php

	print_r($AJOX->object2array($object));
```

> #### Result

![screen_1](/readme/object2array.jpg)

> ### xml2array

```php

	print_r($AJOX->xml2array('lib/data.xml'));
```

> #### Result

![screen_1](/readme/xml2array.jpg)

Usage - toJSON
------------------

> ### array2json

```php

	echo $AJOX->array2json($array);
```

> #### Result

![screen_1](/readme/array2json.jpg)

> ### object2json

```php

	echo $AJOX->object2json($object);
```

> #### Result

![screen_1](/readme/object2json.jpg)

> ### xml2json

```php

	echo $AJOX->xml2json('lib/data.xml');
```

> #### Result

![screen_1](/readme/xml2json.jpg)

Usage - toObject
--------------------

> ### array2object

```php

	print_r($AJOX->array2object($array));
```

> #### Result

![screen_1](/readme/array2object.jpg)

> ### json2object

```php

	print_r($AJOX->json2object($json));
```

> #### Result

![screen_1](/readme/json2object.jpg)

> ### xml2object

```php

	print_r($AJOX->xml2object('lib/data.xml'));
```

> #### Result

![screen_1](/readme/xml2object.jpg)

Usage - toXML
--------------------

A 2nd parameter will save the result in a path-specific file.  
For example:  
```php

	$AJOX->array2xml($array, 'path/to/file.xml');
```

> ### array2xml

```php

	echo $AJOX->array2xml($array);
```

> #### Result

![screen_1](/readme/array2xml.jpg)

> ### json2xml

```php

	echo $AJOX->json2xml($json);
```

> #### Result

![screen_1](/readme/json2xml.jpg)

> ### object2xml

```php

	echo $AJOX->obj2xml($object);
```

> #### Result

![screen_1](/readme/object2xml.jpg)



