<?php

require_once 'APSArrayToXML.class.php';

$arrayToXML = new APSArrayToXML();

$arrayToXML->setArrayToXML(array(
    'head' => array(
        'test1' => null,
        'test2',
        'test3' => array(
            'test4' => array(
                'test5' => 'test6',
                'teste7' => 0,
                'teste8' => '0'
            )
        )
    )
));

echo '<pre>';

echo '<h1>XML STRING</h1>';
print_r($arrayToXML->getXMLString());

echo '<br><br>';

echo '<h1>XML</h1>';
print_r($arrayToXML->getXML());

echo '</pre>';

die;
