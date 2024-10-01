<?php declare(strict_types=1);

namespace PrestaShop\Module\ProductOrderHistory\Form;

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class OrderHistoryType
 *
 * This class is responsible for creating and configuring the form used to display and manage product order history in the PrestaShop admin panel.
 * It extends the TranslatorAwareType class and implements the buildForm and configureOptions methods.
 *
 * @package PrestaShop\Module\ProductOrderHistory\Form
 */
class OrderHistoryType extends TranslatorAwareType
{
    public function __construct(
        TranslatorInterface $translator,
        array $locales,
    ) {
        parent::__construct($translator, $locales);
    }

    /**
     * Builds the form.
     *
     * Adds a 'orders' field of type CollectionType to the form builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('orders', CollectionType::class, [
            "data" => $options["data"]
        ]);
    }

    /**
     * Configures the options for the form.
     *
     * Sets the default label for the form and specifies the form theme to be used.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'label' => $this->trans('Order History', 'Modules.ProductOrderHisotry.Admin'),
            "form_theme" => "@Modules/productorderhistory/views/template/admin/product/form_template/order_history.html.twig"
        ]);
    }
}