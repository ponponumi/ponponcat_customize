<?php

require_once __DIR__ . "/vendor/autoload.php";

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

function enqueue_customizer_inline_script() {
    // カラーピッカーのスクリプトとスタイルを読み込む
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');

    // インラインスクリプトを追加
    $inline_script = <<<EOD
    (function($) {
        $(document).ready(function() {
            $('.color-picker').wpColorPicker();
        });
    })(jQuery);
    EOD;

    wp_add_inline_script('wp-color-picker', $inline_script);
}
add_action('customize_controls_enqueue_scripts', 'enqueue_customizer_inline_script');
