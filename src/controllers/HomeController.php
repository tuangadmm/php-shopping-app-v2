<?php

namespace Src\controllers;

use Src\services\ProductServices;
use Src\services\UserServices;

class HomeController
{
    private $productService;
    private $userService;

    public function __construct(
        UserServices $userService,
        ProductServices $productService,
    )
    {
        $this->userService      = $userService;
        $this->productService   = $productService;
    }

    public function index(): void
    {

        require './src/views/layouts/common.php';
    }

}