<?php

require_once __DIR__ . "/vendor/autload.php";

use Ponponumi\PonponcatCustomize\CustomizeOptionAdd;

function test_theme_custom_add($wpCustom){
    $custom = new CustomizeOptionAdd($wpCustom);

    // カラー
    $custom->panelSet("test_theme_color", [
        'title' => 'test_theme カラー設定',
        'priority' => 153,
    ]);

    // メインカラー
    $custom->sectionSet("test_theme_color_main", [
        'title' => 'メインカラー設定',
    ]);

    $custom->settingSet("test_theme_color_main_themecolor", [
        'label' => 'テーマカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#68c2fe',
        'transport' => 'refresh',
    ]);

    // テキストカラー
    $custom->sectionSet("test_theme_color_text", [
        'title' => 'テキストカラー設定',
    ]);

    $custom->settingSet("test_theme_color_text_body", [
        'label' => '本文のカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#444444',
        'transport' => 'refresh',
    ]);

    $custom->settingSet("test_theme_color_text_hedding", [
        'label' => '見出しテキストのカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#222222',
        'transport' => 'refresh',
    ]);
}
add_action('customize_register', 'test_theme_custom_add');
