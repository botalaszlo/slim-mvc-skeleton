<?php

/**
 * This file is part of the Slim Skeleton application.
 */

namespace app\controllers;

/**
 * Description of HomeController
 *
 * Managing the site.
 * 
 * @author Bóta László <bota.laszlo.dev@outlook.com>
 * @version 1.0
 * @see BaseController
 */
class SiteController extends BaseController {

    public function index() {
        echo $this->render('site/index.php');
    }

    public function documentation() {
        echo $this->render('site/doc.php');
    }

}
