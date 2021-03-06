<?php

namespace Kodbruket\VsfKco\Block\Adminhtml\Event;

use Kodbruket\VsfKco\Helper\Data as VsfKcoHelper;
use Magento\Backend\Block\Template;
use Magento\Framework\Registry;

class Detail extends Template
{
    const URL_PATH_DETAILS = 'vsfkco/event/detail';
    const URL_PATH_LIST = 'vsfkco/event/index';

    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @var VsfKcoHelper
     */
    private $helper;

    /**
     * Detail constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        VsfKcoHelper $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->coreRegistry = $registry;
        $this->helper = $helper;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->coreRegistry->registry('vsf_current_event');
    }

    /**
     * @param null $date
     * @param int $format
     * @param bool $showTime
     * @param null $timezone
     * @return string
     */
    public function formatDate($date = null, $format = \IntlDateFormatter::FULL, $showTime = false, $timezone = null)
    {
        return parent::formatDate($date, $format, $showTime, $timezone); // TODO: Change the autogenerated stub
    }

    /**
     * Get url to the event list
     * @return string
     */
    public function getListUrl()
    {
        return $this->_urlBuilder->getUrl(self::URL_PATH_LIST);
    }

    /**
     * Get url of the previous event
     * @return bool|string
     */
    public function getPrevEventUrl()
    {
        $event = $this->helper->getPrevEvent($this->getEvent());
        if ($event && $eventId = $event->getId()) {
            return $this->_urlBuilder->getUrl(self::URL_PATH_DETAILS, ['id' => $eventId]);
        }
        return false;
    }

    /**
     * Get url of the next event
     * @return bool|string
     */
    public function getNextEventUrl()
    {
        $event = $this->helper->getNextEvent($this->getEvent());
        if ($event && $eventId = $event->getId()) {
            return $this->_urlBuilder->getUrl(self::URL_PATH_DETAILS, ['id' => $eventId]);
        }
        return false;
    }
}
