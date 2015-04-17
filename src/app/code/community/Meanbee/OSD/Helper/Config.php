<?php

class Meanbee_OSD_Helper_Config extends Mage_Core_Helper_Abstract
{

    const XML_PATH_MODULE_ENABLED = "meanbee_osd/general/enabled";

    /**
     * Check if the module is enabled in system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return bool
     */
    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(static::XML_PATH_MODULE_ENABLED, $store);
    }

}
