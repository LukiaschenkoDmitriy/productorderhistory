<?php declare(strict_types=1);

namespace PrestaShop\Module\ProductOrderHistory\Data;

/**
 * Class ProductOrderData
 *
 * This class is responsible for holding and managing data related to a product's order history.
 * It contains properties for order ID, quantity, price, order date, product link, and product variant name.
 * The class also includes a constructor to initialize these properties and two setter methods to update the product link and variant name.
 *
 * @package PrestaShop\Module\ProductOrderHistory\Data
 */
class ProductOrderData
{
    public string $order_id;
    public string $quantity;
    public string $price;
    public string $order_date;
    public string $link;
    public string $name_variant;

    /**
     * ProductOrderData constructor.
     *
     * Initializes a new instance of the ProductOrderData class with the provided order ID, quantity, price, and order date.
     *
     * @param string $order_id
     * @param string $quantity
     * @param string $price
     * @param string $order_date
     */
    public function __construct(string $order_id, string $quantity, string $price, string $order_date)
    {
        $this->order_id = $order_id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->order_date = $order_date;
    }

    /**
     * Sets the product link for the order.
     *
     * @param string $link
     * @return $this
     */
    public function setLink(string $link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Sets the product variant name for the order.
     *
     * @param string $name_variant
     * @return $this
     */
    public function setNameVariant(string $name_variant)
    {
        $this->name_variant = $name_variant;
        return $this;
    }
}