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
}
