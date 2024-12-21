<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeSimpleNameGet
{
    public string $themeName;

    public function __construct(string $themeName = "ponponcat")
    {
        $this->themeNameChange($themeName);
    }

    public function themeNameChange(string $themeName = "ponponcat")
    {
        $this->themeName = $themeName;
    }

    public function get(string $panelName, string $sectionName="", string $settingName=""): string
    {
        return CustomizeSimpleNameGetStatic::get($this->themeName, $panelName, $sectionName, $settingName);
    }
}
