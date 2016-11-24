<?php

/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */

namespace Magebuzz\Timecountdown\Block;

class Carousel extends \Magento\Catalog\Block\Product\AbstractProduct {
    const XML_PATH_TIMER_STYLE = 'timecountdown/style/style_select';

    protected $scopeConfig;
    protected $_productCollectionFactory;
    protected $urlHelper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context, 
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, 
        \Magento\Framework\Url\Helper\Data $urlHelper, 
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->urlHelper = $urlHelper;
        parent::__construct($context, $data);
    }

    /**
     * get banner collection of slider.
     *
     * @return \Magebuzz\Bannermanager\Model\ResourceModel\Banner\Collection
     */
    public function getProductCollection() {
        $nowTime = date('Y-m-d H:i:s', time());
        $collection = $this->_productCollectionFactory->create()
                ->addAttributeToFilter('is_show_countdown', ['=' => 1])
                ->addAttributeToFilter('is_show_homepage', ['=' => 1])
                ->setOrder('sort_order', 'ASC');

        return $collection;
    }

    public function getAddToCartPostParams(\Magento\Catalog\Model\Product $product) {
        $url = $this->getAddToCartUrl($product);

        return [
            'action' => $url,
            'data' => [
                'product' => $product->getEntityId(),
                \Magento\Framework\App\ActionInterface::PARAM_NAME_URL_ENCODED =>
                $this->urlHelper->getEncodedUrl($url),
            ]
        ];
    }
    
    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        $style = $this->scopeConfig->getValue(self::XML_PATH_TIMER_STYLE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $result = parent::getProductPrice($product);
        $toDate = $product->getSpecialToDate() ? strtotime($product->getSpecialToDate()) : '';
        $result .= '
        <div class="mb-timecountdown-container timer-homepage timer-'.$style.'" data-todate="' . $toDate . '" data-prd_id="' . $product->getId() . '">
            <div class="timer-heading">PRICE COUNTDOWN: </div>
            <div class="timer-countbox" id="price-countdown-'.$product->getId().'"></div>
        </div>
        ';
        return $result;
    }

}
