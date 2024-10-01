<?php declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}

class ProductOrderHistory extends Module
{
    public function __construct()
    {
        $this->name = 'productorderhistory';
        $this->tab = 'administration';
        $this->author = 'Dmytrii Lukiashchenko';
        $this->version = '1.0.0';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->trans('Product Order History', [], 'Modules.ProductOrderHisotry.Admin');
        $this->description = $this->trans(
            'Module that displays the entire order history in the admin panel product.',
            [],
            'Modules.ProductOrderHistory.Admin'
        );

        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => '8.99.99'];
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }
}