<?php

/**
 * Class Meanbee_OSD_Block_Breadcrumbs
 *
 * @method $this setBreadcrumbsData($data)
 */
class Meanbee_OSD_Block_Breadcrumbs extends Mage_Core_Block_Abstract
{

    /**
     * Check if the block is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->getConfig()->isEnabled() && $this->getConfig()->isBreadcrumbsEnabled();
    }

    /**
     * Get the config helper.
     *
     * @return Meanbee_OSD_Helper_Config
     */
    public function getConfig()
    {
        return Mage::helper("meanbee_osd/config");
    }

    /**
     * Get the breadcrumbs block from layout.
     *
     * @return Meanbee_OSD_Block_Html_Breadcrumbs
     */
    public function getBreadcrumbsBlock()
    {
        return $this->getLayout()->getBlock("breadcrumbs");
    }

    /**
     * Get the breadcrumbs structured data.
     *
     * @return array|null
     */
    public function getBreadcrumbsData()
    {
        if (!$this->hasData("breadcrumbs_data")) {
            $this->buildBreadcrumbsData();
        }

        return $this->getData("breadcrumbs_data");
    }

    /**
     * Get the breadcrumbs structured data as a JSON string.
     *
     * @return string
     */
    public function getBreadcrumbsDataAsJson()
    {
        return ($data = $this->getBreadcrumbsData()) ? Mage::helper("core")->jsonEncode($data) : "";
    }

    /**
     * Build the breadcrumbs structured data, replacing any existing data that
     * has been set on the block.
     *
     * @return $this
     */
    protected function buildBreadcrumbsData()
    {
        $breadcrumbs = null;

        if ($block = $this->getBreadcrumbsBlock()) {
            $crumbs = $block->getCrumbs();
            if (is_array($crumbs)) {
                $breadcrumbs = array(
                    "@context"        => "http://schema.org",
                    "@type"           => "BreadcrumbList",
                    "itemListElement" => array(),
                );

                $position = 1;
                foreach ($crumbs as $crumb) {
                    if ($crumb["link"]) {
                        $breadcrumbs["itemListElement"][] = array(
                            "@type"    => "ListItem",
                            "position" => $position++,
                            "item"     => array(
                                "@id"  => $crumb["link"],
                                "name" => $crumb["label"],
                            ),
                        );
                    }
                }
            }
        }

        Mage::dispatchEvent("meanbee_osd_after_build_breadcrumbs_data", array(
            "breadcrumbs_data" => $breadcrumbs,
        ));

        $this->setBreadcrumbsData($breadcrumbs);

        return $this;
    }

    protected function _toHtml()
    {
        if ($this->isEnabled() && $data = $this->getBreadcrumbsDataAsJson()) {
            return sprintf(Meanbee_OSD_Helper_Data::LD_JSON_TEMPLATE, $data);
        }

        return "";
    }
}
