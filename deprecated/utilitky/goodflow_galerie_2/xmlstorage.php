<?php
/*
 *      xmlstorage.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class XmlStorage {

    public static function getAutoPath($dir, $class) {
      return sprintf('%s/.%s', $dir, $class);
    }

    public static function getData($path, $existexception = true) {
      try {

        $result = array();
        $file = sprintf('%s.xml',$path);
        if (file_exists($file))
        {
          $xml = simplexml_load_file($file);

          $result = self::recursiveToArray($xml);

        } else {
          if ($existexception) {
            throw new ExceptionXmlStorage;
          }
        }

      } catch (ExceptionXmlStorage $e) {
        echo 'xml soubor neexistuje';
      }

      return $result;
    }

    protected static function recursiveToArray($xml) {

      $result = array();
      foreach ($xml as $value) {
        $atr = $value->attributes();
        $key = (string) $atr->name;

        switch ($atr->type) {
          case 'array':
            $result[$key] = self::recursiveToArray($value);
          break;

          case 'string':
            $result[$key] = base64_decode($value);
          break;

          case 'boolean':
            $result[$key] = ($value == 1);
          break;

          case 'integer':
            $result[$key] = (integer) $value;
          break;

          case 'double':
            $result[$key] = (float) $value;
          break;

          case 'NULL':
          break;
        }
      }

      return $result;
    }

    protected static function recursiveToXml($data, $xml = NULL) {

      if ($xml == NULL) {
        $xml = new SimpleXMLElement('<xmlstorage></xmlstorage>');
      }

      foreach ($data as $key => $value) {
        $type = gettype($value);

        switch ($type) {
          case 'array':
            $node = $xml->addChild('key');
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
            self::recursiveToXml($value, $node);
          break;

          case 'string':
            $node = $xml->addChild('key', base64_encode($value));
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
          break;

          case 'boolean':
            $node = $xml->addChild('key', ($value ? 1 : 0));
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
          break;

          case 'integer':
          case 'double':
            $node = $xml->addChild('key', $value);
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
          break;

          case 'NULL':
            //slouzi pro mazani
          break;

          default:
            echo sprintf('neznami typ %s!', $type);
          break;
        }
      }

      return $xml;
    }

    public static function setData($path, array $data) {
      try {

        $result = false;
        if (!empty($path)) {

          $xml = self::recursiveToXml($data);

        } else { throw new ExceptionXmlStorage(NULL, 100); }

        if (!$result = $xml->asXML(sprintf('%s.xml', $path))) {
          throw new ExceptionXmlStorage(NULL, 101);
        }

      } catch (ExceptionXmlStorage $e) {
        switch ($e->getCode()) {
          case 100:
            echo 'Path nesmi byt prazdny!';
          break;

          case 101:
            echo 'xml se nepodarilo zapsat!';
          break;
        }
      }

      return $result;
    }
  }

  class ExceptionXmlStorage extends Exception {}

?>
