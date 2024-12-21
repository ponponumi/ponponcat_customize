<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeSimpleNameGet
{
    public string $themeName;

    public function __construct(string $themeName = "ponponcat")
    {
        $this->themeName = $themeName;
    }

    public function themeNameChange(string $themeName = "ponponcat")
    {
        $this->themeName = $themeName;
    }

    public function get(string $panelName, string $sectionName="", string $settingName=""): string
    {
        $result = $this->themeName . "_" . $panelName;

        if($sectionName === ""){
            return $result;
        }

        $result .= "_" . $sectionName;

        if($settingName === ""){
            return $result;
        }

        return $result . "_" . $settingName;
    }
}
