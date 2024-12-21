<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeSimpleNameGet
{
    public string $themeName = "ponponcat";

    public function __construct(string $themeName = "ponponcat")
    {
        $this->themeName = $themeName;
    }
}
