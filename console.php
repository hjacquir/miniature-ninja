<?php

use \Hj\Explore;
use \Hj\String;
use \Hj\TimeExecution;
use \Symfony\Component\Console\Application;

require_once './vendor/autoload.php';

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 * Date: 21 déc. 2013
 * Time: 14:34:15
 */
$app    = new Application();
$string = new String();
$executionTime = new TimeExecution();

$app->add(new Explore(null, $string, $executionTime));
$app->run();