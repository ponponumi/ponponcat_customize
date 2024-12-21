<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAdd
{
    private object $wpCustom;
    private string $panelName;
    private int $sectionPriority = 1;
    private int $settingPriority = 1;

    public function __construct(object $wpCustom)
    {
        $this->wpCustom = $wpCustom;
    }

    public function panelSet(string $panelName,array $option)
    {
        $this->panelName = $panelName;
        $this->wpCustom->add_panel($panelName, $option);
    }

    public function sectionSet(string $sectionName,array $option)
    {
        $option["panel"] = $this->panelName;
        $option["priority"] = $this->sectionPriority;

        $this->sectionPriority++;
        $this->settingPriority = 1;

        $this->wpCustom->add_section($sectionName, $option);
    }
}
