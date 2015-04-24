<?php

class Meanbee_OSD_Helper_Config extends Mage_Core_Helper_Abstract
{

    const XML_PATH_MODULE_ENABLED = "meanbee_osd/general/enabled";

    const XML_PATH_ORGANISATION_URL  = "meanbee_osd/organisation/url";
    const XML_PATH_ORGANISATION_LOGO = "meanbee_osd/organisation/logo";

    const XML_PATH_CONTACTS_CUSTOMER_SUPPORT = "meanbee_osd/contacts/customer_support";
    const XML_PATH_CONTACTS_SALES            = "meanbee_osd/contacts/sales";

    const XML_PATH_SOCIAL_FACEBOOK   = "meanbee_osd/social/facebook";
    const XML_PATH_SOCIAL_TWITTER    = "meanbee_osd/social/twitter";
    const XML_PATH_SOCIAL_GOOGLEPLUS = "meanbee_osd/social/google_plus";
    const XML_PATH_SOCIAL_INSTAGRAM  = "meanbee_osd/social/instagram";
    const XML_PATH_SOCIAL_PINTEREST  = "meanbee_osd/social/pinterest";
    const XML_PATH_SOCIAL_YOUTUBE    = "meanbee_osd/social/youtube";
    const XML_PATH_SOCIAL_LINKEDIN   = "meanbee_osd/social/linkedin";
    const XML_PATH_SOCIAL_MYSPACE    = "meanbee_osd/social/myspace";
    const XML_PATH_SOCIAL_OTHER      = "meanbee_osd/social/other";

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

    /**
     * Get organisation Facebook profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getFacebookUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_FACEBOOK, $store);
    }

    /**
     * Get organisation Twitter profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getTwitterUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_TWITTER, $store);
    }

    /**
     * Get organisation Google+ profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getGooglePlusUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_GOOGLEPLUS, $store);
    }

    /**
     * Get organisation Instagram profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getInstagramUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_INSTAGRAM, $store);
    }

    /**
     * Get organisation Pinterest profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getPinterestUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_PINTEREST, $store);
    }

    /**
     * Get organisation YouTube profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getYouTubeUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_YOUTUBE, $store);
    }

    /**
     * Get organisation LinkedIn profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getLinkedInUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_LINKEDIN, $store);
    }

    /**
     * Get organisation Myspace profile URL from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getMyspaceUrl($store = null)
    {
        return Mage::getStoreConfig(static::XML_PATH_SOCIAL_MYSPACE, $store);
    }

    /**
     * Get the list of other social profile URLs from system configuration.
     *
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return array
     */
    public function getOtherSocialUrls($store = null)
    {
        $urls = unserialize(Mage::getStoreConfig(static::XML_PATH_SOCIAL_OTHER, $store));

        return (is_array($urls)) ? $urls : array();
    }

    /**
     * Get an organisation social profile URL by name form the list of
     * other social profile URLs in system configuration.
     *
     * @param string                         $name
     * @param Mage_Core_Model_Store|int|null $store
     *
     * @return string
     */
    public function getOtherSocialUrl($name, $store = null)
    {
        $urls = $this->getOtherSocialUrls($store);

        foreach ($urls as $url) {
            if ($url["name"] == $name) {
                return $url["url"];
            }
        }

        return "";
    }

}
