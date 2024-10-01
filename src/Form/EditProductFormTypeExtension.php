<?php declare(strict_types=1);

namespace PrestaShop\Module\ProductOrderHistory\Form;

use PrestaShop\Module\ProductOrderHistory\Service\OrderEntityService;
use PrestaShopBundle\Form\Admin\Sell\Product\EditProductFormType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EditProductFormTypeExtension
 *
 * This class is responsible for extending the EditProductFormType in PrestaShop's admin panel.
 * It adds a new 'order_history' field to the form, which displays product order history data.
 * The changeTabPossition method is used to reposition the 'order_history' field in the form.
 *
 * @package PrestaShop\Module\ProductOrderHistory\Form
 */
class EditProductFormTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = OrderEntityService::getProductOrdersById($options["product_id"]);

        $builder->add('order_history', OrderHistoryType::class, [
            "data" => $data
        ]);
        $this->changeTabPossition($builder, "seo", "order_history");
    }

    public static function getExtendedTypes(): iterable
    {
        return [EditProductFormType::class];
    }

    /**
     * Changes the position of a field in the form.
     *
     * @param FormBuilderInterface $builder
     * @param string $keyBefore
     * @param string $itemKey
     */
    private function changeTabPossition(FormBuilderInterface $builder, string $keyBefore, string $itemKey)
    {
        $copyOfBuilderCollection = $builder->all();
        $insertItem = $builder->get($itemKey);

        foreach ($copyOfBuilderCollection as $key => $value) {
            $builder->remove($key);
        }

        foreach ($copyOfBuilderCollection as $key => $value) {
            if ($key == $itemKey)
                continue;

            if ($key == $keyBefore)
                $builder->add($itemKey, ($insertItem->getType()->getInnerType())::class, $insertItem->getOptions());

            $builder->add($key, ($value->getType()->getInnerType())::class, $value->getOptions());
        }
    }
}