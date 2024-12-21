<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAddSimple
{
    public object $customAdd;
    public string $themeName = "ponponcat";
    public string $panelName = "";
    public string $sectionName = "";

    public function __construct(object $wpCustom)
    {
        $this->customAdd = new CustomizeOptionAdd($wpCustom);
    }

    public function themeNameChange(string $themeName="ponponcat")
    {
        $this->themeName = $themeName;
    }

    public function panelSet(string $panelName,array $option)
    {
        $this->panelName = $panelName;
        $panelName = $this->themeName . "_" . $panelName;

        $this->customAdd->panelSet($panelName, $option);
    }

    public function sectionSet(string $sectionName,array $option)
    {
        $this->sectionName = $sectionName;
        $sectionName = $this->themeName . "_" . $this->panelName . "_" . $sectionName;

        $this->customAdd->sectionSet($sectionName, $option);
    }
}
