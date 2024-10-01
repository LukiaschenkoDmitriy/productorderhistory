<?php declare(strict_types=1);

namespace PrestaShop\Module\ProductOrderHistory\Service;

use PrestaShop\Module\ProductOrderHistory\Data\ProductOrderData;

/**
 * Class OrderEntityService
 *
 * This class is responsible for retrieving and processing order data from the PrestaShop database.
 * It provides methods to retrieve product order history by product ID, as well as to generate links to view order details in the admin panel.
 *
 * @package PrestaShop\Module\ProductOrderHistory\Service
 */

final class OrderEntityService
{
    /**
     * Retrieves product order history by product ID.
     *
     * This function retrieves order data from the PrestaShop database and filters the results based on the provided product ID.
     * It then constructs an array of ProductOrderData objects, each representing a single product order.
     *
     * @param int $productId The ID of the product for which to retrieve order history.
     *
     * @return array An array of ProductOrderData objects, representing product order history for the specified product.
     */
    public static function getProductOrdersById(int $productId)
    {
        $orders = \Order::getOrdersWithInformations();
        $fullOrders = static::getFullOrdersByIds(static::getOrdersIds($orders));

        $productOrders = [];

        foreach ($fullOrders as $order) {
            foreach ($order->getCartProducts() as $product) {
                if ($productId == $product["id_product"]) {
                    $productOrders[] = (new ProductOrderData(
                        (string) $order->id,
                        $product["product_quantity"],
                        $product["unit_price_tax_incl"],
                        $order->date_add
                    ))
                        ->setLink(static::getOrderLinkById($order->id))
                        ->setNameVariant($product["product_name"]);
                }
            }
        }

        return $productOrders;
    }

    /**
     * Retrieves the admin panel link for a specific order.
     *
     * This function generates a link to view the order details in the admin panel for a given order ID.
     * It uses the PrestaShop Context and Link classes to construct the URL.
     *
     * @param int $orderId The ID of the order for which to retrieve the admin panel link.
     *
     * @return string The admin panel link for the specified order.
     */
    public static function getOrderLinkById(int $orderId)
    {
        $link = \Context::getContext()->link;
        $link = $link->getAdminLink("AdminOrders", true, [], [
            "orderId" => $orderId,
            "vieworder" => 1
        ]);

        return $link;
    }


    /**
     * Retrieves full Order objects based on their IDs.
     *
     * @param array $ids An array of order IDs.
     *
     * @return array An array of Order objects. Each Order object is fully loaded with its associated data.
     */
    public static function getFullOrdersByIds(array $ids): array
    {
        $orders = [];

        foreach ($ids as $id) {
            $orders[] = new \Order($id);
        }

        return $orders;
    }

    /**
     * Retrieves an array of order IDs from the provided array of order data.
     *
     * This function iterates through the given array of order data, extracts the 'id_order' from each order,
     * and returns an array of these IDs. This is useful for batch operations on orders, such as loading full Order objects.
     *
     * @param array $orders An array of associative arrays, each representing an order. Each order array should contain an 'id_order' key.
     *
     * @return array An array of order IDs.
     */
    public static function getOrdersIds(array $orders): array
    {
        $ids = [];

        foreach ($orders as $order) {
            $ids[] = $order["id_order"];
        }

        return $ids;
    }
}