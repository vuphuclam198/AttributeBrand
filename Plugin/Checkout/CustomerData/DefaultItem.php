<?php
namespace AHT\AttributeBrand\Plugin\Checkout\CustomerData;

class DefaultItem
{
    public function aroundGetItemData($subject, 
    \Closure $proceed, 
    \Magento\Quote\Model\Quote\Item $item
    )
    {
        $data = $proceed($item);
        $product = $item->getProduct();

        $attributes = $product->getAttributes();

        $atts = [
            "brand_value" => $attributes['brand']->getFrontend()->getValue($product),
            "brand_label" => $attributes['brand']->getFrontend()->getLabel($product)
        ];

        return array_merge($data, $atts);
    }
}