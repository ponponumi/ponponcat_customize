<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAdd
{
    private object $wpCustom;

    public function __construct(object $wpCustom)
    {
        $this->wpCustom = $wpCustom;
    }
}
