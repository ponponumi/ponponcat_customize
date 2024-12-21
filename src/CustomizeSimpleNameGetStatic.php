<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeSimpleNameGetStatic
{
    public static function get(string $themeName, string $panelName, string $sectionName = "", string $settingName = ""): string
    {
        $result = $themeName . "_" . $panelName;

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
