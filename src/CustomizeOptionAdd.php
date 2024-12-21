<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAdd
{
    private object $wpCustom;
    private string $panelName;

    public function __construct(object $wpCustom)
    {
        $this->wpCustom = $wpCustom;
    }

    public function panelSet(string $panelName,array $option)
    {
        $this->panelName = $panelName;
        $this->wpCustom->add_panel($panelName, $option);
    }
}
