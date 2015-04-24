<?php

class Meanbee_OSD_Helper_Config extends Mage_Core_Helper_Abstract
{

    const XML_PATH_MODULE_ENABLED = "meanbee_osd/general/enabled";

    const XML_PATH_ORGANISATION_URL  = "meanbee_osd/organisation/url";
    const XML_PATH_ORGANISATION_LOGO = "meanbee_osd/organisation/logo";

    const XML_PATH_CONTACTS_CUSTOMER_SUPPORT = "meanbee_osd/contacts/customer_support";
    const XML_PATH_CONTACTS_SALES            = "meanbee_osd/contacts/sales";

    const LOGO_UPLOAD_DIR = "osd/logo";

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

    /**
     * Get the organisation URL, either from system configuration
     * or from the given store.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     *
     * @throws Mage_Core_Exception
     */
    public function getOrganisationUrl($store = null)
    {
        $url = Mage::getStoreConfig(static::XML_PATH_ORGANISATION_URL, $store);

        if (empty($url)) {
            $url = Mage::app()->getStore($store)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
        }

        return $url;
    }

    /**
     * Get the organisation logo image URL.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return null|string
     *
     * @throws Mage_Core_Exception
     */
    public function getOrganisationLogoUrl($store = null)
    {
        $store = Mage::app()->getStore($store);

        if ($logo = Mage::getStoreConfig(static::XML_PATH_ORGANISATION_LOGO, $store)) {
            return implode("/", array(
                $store->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA),
                static::LOGO_UPLOAD_DIR,
                $logo
            ));
        } else {
            return null;
        }
    }

    /**
     * Get the customer support contact information from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getCustomerSupportContact($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_CONTACTS_CUSTOMER_SUPPORT, $store);
    }

    /**
     * Get the sales contact information from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getSalesContact($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_CONTACTS_SALES, $store);
    }

}
