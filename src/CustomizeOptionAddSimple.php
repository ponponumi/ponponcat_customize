<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAddSimple
{
    public object $customAdd;
    public object $nameGet;
    public string $themeName = "ponponcat";
    public string $panelName = "";
    public string $sectionName = "";
    public bool $settingNameEcho = false;

    public function __construct(object $wpCustom)
    {
        $this->customAdd = new CustomizeOptionAdd($wpCustom);
        $this->nameGet = new CustomizeSimpleNameGet();
    }

    public function themeNameChange(string $themeName="ponponcat")
    {
        $this->nameGet->themeNameChange($themeName);
    }

    public function panelSet(string $panelName,array $option)
    {
        $this->panelName = $panelName;
        $panelName = $this->nameGet->get($panelName);

        $this->customAdd->panelSet($panelName, $option);
    }

    public function sectionSet(string $sectionName,array $option)
    {
        $this->sectionName = $sectionName;
        $sectionName = $this->nameGet->get($this->panelName, $sectionName);

        $this->customAdd->sectionSet($sectionName, $option);
    }

    private function settingNameAdd($controlOption,$settingName): array
    {
        if($this->settingNameEcho){
            $controlOption["description"] = $controlOption["description"] ?? "";
            $controlOption["description"] = "設定名は、'" . $settingName . "'です。<br>" . $controlOption["description"];
        }

        return $controlOption;
    }

    public function settingSet(string $settingName,array $controlOption, array $settingOption=[])
    {
        $settingName = $this->nameGet->get($this->panelName, $this->sectionName, $settingName);

        if($this->settingNameEcho){
            $controlOption["description"] = $controlOption["description"] ?? "";
            $controlOption["description"] = "設定名は、'" . $settingName . "'です。<br>" . $controlOption["description"];
        }

        $this->customAdd->settingSet($settingName, $controlOption, $settingOption);
    }

    public function settingImageSet(string $settingName,array $controlOption, array $settingOption=[])
    {
        $settingName = $this->nameGet->get($this->panelName, $this->sectionName, $settingName);

        if($this->settingNameEcho){
            $controlOption["description"] = $controlOption["description"] ?? "";
            $controlOption["description"] = "設定名は、'" . $settingName . "'です。<br>" . $controlOption["description"];
        }

        $this->customAdd->settingImageSet($settingName, $controlOption, $settingOption);
    }
}
