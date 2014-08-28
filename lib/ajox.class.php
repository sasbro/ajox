<?php

/**
 * @author Sascha Bröning <sascha.broening@gmail.com>
 * @license LGPL-3.0
 * @copyright (c) 2014, Sascha Bröning
 * @version v 1.0 2014-08-28
 * @todo too much :)
 */
const LB = '<br>';

class AJOX
{

    /**
     *
     * @method Conversion to XML
     * @param array $array            
     * @param xml $xml            
     */
    private function to_xml($array, &$xml)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (! is_int($key)) {
                    $subnode = $xml->addChild($key);
                    self::to_xml($value, $subnode);
                } else {
                    $subnode = $xml->addChild("item" . $key);
                    self::to_xml($value, $subnode);
                }
            } else {
                (! is_int($key)) ? $xml->addChild($key, htmlspecialchars($value)) : $xml->addChild("item" . $key, htmlspecialchars($value));
            }
        }
    }

    /**
     *
     * @method Content to UTF-8
     * @param mixed $res            
     * @param string $type            
     * @return mixed $res
     */
    private function to_utf8($res, $type)
    {
        if ($type === 'array') {
            array_walk_recursive($res, function (&$value, $key)
            {
                if (is_string($value)) {
                    $value = iconv(mb_detect_encoding($value, mb_detect_order(), true), 'UTF-8', $value);
                }
            });
            return $res;
        } elseif ($type === 'json') {
            $res = json_decode(json_encode(iconv(mb_detect_encoding($res, mb_detect_order(), true), 'UTF-8', $res)), true);
            return $res;
        }
    }

    /**
     *
     * @method Get XML Content From File
     * @param string $url            
     */
    private function get_content($url)
    {
        $file_content = file_get_contents($url);
        $file_content = str_replace(array(
            "\n",
            "\r",
            "\t"
        ), '', $file_content);
        return trim(str_replace('"', "'", $file_content));
    }

    /**
     *
     * @method Check valid Array/JSON/Object
     * @param mixed $content            
     * @param string $type            
     */
    private function check_valid($content, $type)
    {
        if ($type === 'array' && ! is_array($content)) {
            throw new Exception('Given Array is not valid!', 10);
        } elseif ($type === 'object' && ! is_object($content)) {
            throw new Exception('Given Object is not valid!', 10);
        } elseif ($type === 'json') {
            $json = json_decode(self::to_utf8($content, 'json'), true);
            if (! json_last_error() == JSON_ERROR_NONE) {
                throw new Exception('Given JSON is not valid!', 10);
            }
        }
    }

    /**
     *
     * @method Array To XML
     * @param array $array            
     * @param string $path            
     */
    public function array2xml($array, $path = false)
    {
        self::check_valid($array, 'array');
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><root></root>");
        self::to_xml(self::to_utf8($array, 'array'), $xml);
        if ($path) {
            $xml->asXML($path);
        } else {
            return $xml->asXML();
        }
    }

    /**
     *
     * @method JSON To XML
     * @param json $json            
     * @param string $path            
     */
    public function json2xml($json, $path = false)
    {
        self::check_valid($json, 'json');
        $json = json_decode(self::to_utf8($json, 'json'), true);
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><root></root>");
        self::to_xml($json, $xml);
        if ($path) {
            $xml->asXML($path);
        } else {
            return $xml->asXML();
        }
    }

    /**
     *
     * @method Object To XML
     * @param object $obj            
     * @param string $path            
     */
    public function obj2xml($obj, $path = false)
    {
        self::check_valid($obj, 'object');
        $obj = get_object_vars(self::to_utf8($obj, 'array'));
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><root></root>");
        self::to_xml($obj, $xml);
        if ($path) {
            $xml->asXML($path);
        } else {
            return $xml->asXML();
        }
    }

    /**
     *
     * @method Array To JSON
     * @param array $array            
     */
    public function array2json($array)
    {
        self::check_valid($array, 'array');
        $ret_arr = self::to_utf8($array, 'array');
        return json_encode($ret_arr, JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     * @method Object To JSON
     * @param object $object            
     */
    public function object2json($object)
    {
        self::check_valid($object, 'object');
        $ret_obj = self::to_utf8($object, 'array');
        return json_encode((array) $ret_obj, JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     * @method XML To JSON
     * @param string $url            
     */
    public function xml2json($url)
    {
        $file_content = self::get_content($url);
        $simple_xml = simplexml_load_string($file_content);
        return json_encode($simple_xml, JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     * @method JSON To Array
     * @param json $json            
     */
    public function json2array($json)
    {
        self::check_valid($json, 'json');
        $json = self::to_utf8($json, 'json');
        return json_decode($json, true);
    }

    /**
     *
     * @method Object To Array
     * @param object $object            
     * @return array $object
     */
    public function object2array($object)
    {
        self::check_valid($object, 'object');
        $object = self::to_utf8($object, 'array');
        return (array) $object;
    }

    /**
     *
     * @method XML To Array
     * @param string $url            
     */
    public function xml2array($url)
    {
        $file_content = self::get_content($url);
        return json_decode(json_encode(simplexml_load_string($file_content)), true);
    }

    /**
     *
     * @method Array To Object
     * @param array $array            
     */
    public function array2object($array)
    {
        self::check_valid($array, 'array');
        $ret_arr = self::to_utf8($array, 'array');
        return json_decode(json_encode($ret_arr), FALSE);
    }

    /**
     *
     * @method JSON To Object
     * @param json $json            
     */
    public function json2object($json)
    {
        self::check_valid($json, 'json');
        $json = self::to_utf8($json, 'json');
        return json_decode($json);
    }

    /**
     *
     * @method XML To Object
     * @param string $url            
     */
    public function xml2object($url)
    {
        $file_content = self::get_content($url);
        return simplexml_load_string($file_content);
    }
}

/**
 * @function Custom Exception Handler
 * 
 * @param object $e            
 */
function exception_handler($e)
{
    echo 'Code: ' . $e->getCode() . LB;
    echo 'Error: ' . $e->getMessage() . LB;
    echo 'File: ' . $e->getFile() . LB;
    echo 'Line: ' . $e->getLine() . LB;
    echo 'Trace: ' . $e->getTraceAsString() . LB;
}

set_exception_handler('exception_handler');














