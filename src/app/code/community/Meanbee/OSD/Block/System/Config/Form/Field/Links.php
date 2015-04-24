<?php

class Meanbee_OSD_Block_System_Config_Form_Field_Links extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{

    protected function _prepareToRender()
    {
        $this->addColumn("name", array(
            "label" => $this->getModuleHelper()->__("Name"),
            "style" => "width:120px"
        ));

        $this->addColumn("url", array(
            "label" => $this->getModuleHelper()->__("URL")
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = $this->getModuleHelper()->__("Add Link");
    }

    /**
     * Get the module helper.
     *
     * @return Meanbee_OSD_Helper_Data
     */
    protected function getModuleHelper()
    {
        return Mage::helper("meanbee_osd");
    }
}
