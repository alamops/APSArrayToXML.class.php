<?php

class APSArrayToXML {
    
    public $arrayToXML;
    private $xmlStringFinal;
    private $converted;
    private $xmlFinal;
    private $lastKey;
    
    /**
     * CONSTRUCTOR
     * @param array $arrayToXML
     */
    function __construct($arrayToXML = null) {
        if ($arrayToXML) {
            $this->arrayToXML = $arrayToXML;
        }
    }
    
    /**
     * SET ARRAY TO XML
     * @param array $arrayToXML
     */
    public function setArrayToXML ($arrayToXML) {
        $this->arrayToXML = $arrayToXML;
        $this->converted = false;
    }
    
    /**
     * GET XML STRING
     * @return string
     */
    public function getXMLString () {
        if ($this->converted) {
            return $this->xmlStringFinal;
        }
        else {
            // clean xmlFinal
            $this->xmlStringFinal = '';
            $this->xmlStringFinal = $this->_convertToString($this->arrayToXML);
            
            $this->converted = true;

            return $this->xmlStringFinal;
        }
    }
    
    /**
     * GET XML
     * @return XML
     */
    public function getXML () {
        if ($this->converted && $this->xmlFinal) {
            return $this->xmlFinal;
        }
        else if ($this->converted && !$this->xmlFinal) {
            // convert string to xml
            $this->xmlFinal = simplexml_load_string($this->xmlStringFinal);
            
            return $this->xmlFinal;
        }
        else {
            // get XML String
            $this->getXMLString();
            
            // convert string to xml
            $this->xmlFinal = simplexml_load_string($this->xmlStringFinal);
            
            return $this->xmlFinal;
        }
    }
    
    /**
     * CONVERT ARRAY TO XML
     * @param array $array
     * @return string
     */
    private function _convertToString ($array) {
        $xmlString = '';
        
        foreach ($array as $key => $value) {
            if (!is_numeric($value) && (!isset($value) || $value == NULL)) {
                // create key name
                if ($key != NULL) {
                    $xmlString .= '<' . $key . '/>';
                }
            }
            else {
                // create key name
                if ($key != NULL) {
                    if (!is_numeric($key)) {
                        $xmlString .= '<' . $key . '>';
                    }
                    else {
                        $xmlString .= '</' . $this->lastKey . '>';
                        $xmlString .= '<' . $this->lastKey . '>';
                    }
                }
                
                // get xml
                if (is_array($value)) {
                    // recursive
                    if (!is_numeric($key)) {
                        $this->lastKey = $key;
                    }
                    $xmlString .= $this->_convertToString($value);
                }
                else {
                    if ($key != NULL) {
                        $xmlString .= '' . $value;
                    }
                    else {
                        $xmlString .= '<' . $value . '/>';
                    }
                }
                
                // finish key
                if ($key != NULL && !is_numeric($key)) {
                    $keyArray = explode(' ', $key);
                    $xmlString .= '</' . $keyArray[0] . '>';
                }
            }
        }
        
        return $xmlString;
    }
    
}
