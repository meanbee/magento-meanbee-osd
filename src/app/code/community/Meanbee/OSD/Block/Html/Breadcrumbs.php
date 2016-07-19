<?php

class Meanbee_OSD_Block_Html_Breadcrumbs extends Mage_Page_Block_Html_Breadcrumbs
{
    /**
     * Get the breadcrumbs currently assigned to the block.
     *
     * @return array
     */
    public function getCrumbs()
    {
        return $this->_crumbs;
    }
}
