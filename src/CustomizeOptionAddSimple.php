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
}
