<?php

require_once __DIR__ . "/vendor/autoload.php";

use Ponponumi\PonponcatCustomize\CustomizeOptionAdd;
use Ponponumi\PonponcatCustomize\CustomizeOptionAddSimple;

function test_theme_custom_add($wpCustom){
    $custom = new CustomizeOptionAdd($wpCustom);

    // カラー
    $custom->panelSet("test_theme_color", [
        'title' => 'test_theme カラー設定',
        'priority' => 153,
    ]);

    // var_dump($custom->panelNameGet());
    // var_dump($custom->sectionNameGet());

    // メインカラー
    $custom->sectionSet("test_theme_color_main", [
        'title' => 'メインカラー設定',
    ]);

    // var_dump($custom->panelNameGet());
    // var_dump($custom->sectionNameGet());

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

    // var_dump($custom->panelNameGet());
    // var_dump($custom->sectionNameGet());

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

    $custom->panelSet("test_theme_javascript", [
        'title' => 'test_theme JavaScript設定',
        'priority' => 155,
    ]);

    $custom->sectionSet("test_theme_javascript_progress", [
        'title' => '進捗バーの設定',
    ]);

    $custom->settingSet("test_theme_javascript_progress_view", [
        'label' => '進捗バーの表示の設定',
        'type' => 'radio',
        'choices' => [
            'on' => '表示する',
            'off' => '表示しない',
        ]
    ], [
        'default' => 'on',
        'transport' => 'refresh',
    ]);

    // var_dump($custom->panelNameGet());
    // var_dump($custom->sectionNameGet());
}
add_action('customize_register', 'test_theme_custom_add');

function test_theme_custom_simple_add($wpCustom){
    $custom = new CustomizeOptionAddSimple($wpCustom);
    $custom->themeNameChange("test_theme");
    $custom->settingNameEcho = true;

    // ヘッダー
    $custom->panelSet("header", [
        'title' => 'test_theme ヘッダー設定',
        'priority' => 154,
    ]);

    // ロゴ
    $custom->sectionSet("logo", [
        'title' => 'ロゴ設定',
    ]);

    var_dump($custom->customAdd->panelNameGet());
    var_dump($custom->customAdd->sectionNameGet());

    $custom->settingImageSet("image", [
        'label' => 'ヘッダーロゴの設定',
    ]);

    $custom->settingSet("alt", [
        'label' => 'ロゴのalt設定',
    ]);

    $custom->sectionSet("nav", [
        'title' => 'ナビゲーション設定',
    ]);

    $custom->settingSet("list", [
        'label' => 'リストのタグ設定',
        'type' => 'radio',
        'choices' => [
            'ul' => 'ulを使う',
            'ol' => 'olを使う',
            'div' => 'divを使う',
        ],
    ],[
        'default' => 'ul',
    ]);
}
add_action('customize_register', 'test_theme_custom_simple_add');

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
