<?php
$appMiddleWare = new \App\MiddleWare\AppMiddleWare($app->getContainer());
$app->add($appMiddleWare);