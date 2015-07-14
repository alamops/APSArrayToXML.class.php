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
        ),
        'teste9' => array(
            array(
                'key' => 'asasd',
                'value' => 'asdasd'
            ),
            array(
                'key' => 'asdasd',
                'value' => 'asdasd'
            ),
            array(
                'key' => 'asdasd',
                'value' => 'asdasd'
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
