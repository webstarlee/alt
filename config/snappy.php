<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => dirname(dirname(__FILE__)).'/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => dirname(dirname(__FILE__)).'vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
