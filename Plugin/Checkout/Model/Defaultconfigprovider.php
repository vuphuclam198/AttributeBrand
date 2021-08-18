<?php
namespace AHT\AttributeBrand\Plugin\Checkout\Model;
use Magento\Checkout\Model\Session as CheckoutSession;
 
class Defaultconfigprovider
 
{
    /**
 
     * @var CheckoutSession
 
     */
 
    protected $checkoutSession;
 
    /**
 
     * Constructor
 
     *
 
     * @param CheckoutSession $checkoutSession
 
     */
 
    public function __construct(
        CheckoutSession $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }
 
    public function afterGetConfig(
        \Magento\Checkout\Model\DefaultConfigProvider $subject,
        array $result
 
    ) {
        $items = $result['totalsData']['items'];
 
        foreach ($items as $index => $item) {
            $quoteItem = $this->checkoutSession->getQuote()->getItemById($item['item_id']);
            $result['quoteItemData'][$index]['brand_value'] = $quoteItem->getProduct()->getResource()->getAttribute('brand')->getFrontend()->getValue($quoteItem->getProduct());
            $result['quoteItemData'][$index]['brand_label'] = $quoteItem->getProduct()->getResource()->getAttribute('brand')->getFrontend()->getLabel($quoteItem->getProduct());
        }

        return $result;
 
    }
 
}