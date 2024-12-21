<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAdd
{
    private object $wpCustom;
    private string $panelName;
    private string $sectionName;
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

        $this->sectionName = $sectionName;

        $this->wpCustom->add_section($sectionName, $option);
    }

    public function settingSet(string $settingName, array $controlOption, array $settingOption=[])
    {
        $controlOption["section"] = $this->sectionName;
        $controlOption["settings"] = $settingName;
        $controlOption["priority"] = $this->settingPriority;

        $this->settingPriority++;

        $this->wpCustom->add_setting($settingName, $settingOption);

        $this->wpCustom->add_control(
            new \WP_Customize_Control(
                $this->wpCustom,
                $settingName,
                $controlOption
            )
        );
    }
}
