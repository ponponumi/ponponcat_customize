# ponponcat_customize

このパッケージは、WordPressのテーマカスタマイザーの項目を追加する、ライブラリです。

このパッケージは、ponponcat向けに制作されたものですが、ponponcat以外のテーマでも使用可能です。

## Composerでのインストールについて

次のコマンドを実行する事で、インストール可能です。

```bash
composer require ponponumi/ponponcat_customize
```

## 読み込み方法について

functions.phpに、次のように入力してください。(autoload.phpへのパスは、必要に応じて修正してください)

```php
require_once __DIR__ . "/vendor/autoload.php";

use Ponponumi\PonponcatCustomize\CustomizeOptionAdd;
```

## 追加方法について

次のようにして、項目を追加できます。

```php
require_once __DIR__ . "/vendor/autoload.php";

use Ponponumi\PonponcatCustomize\CustomizeOptionAdd;

function custom_color_add($wp_custom){
    $custom = new CustomizeOptionAdd($wp_custom);

    // カラーのパネルを追加
    $custom->panelSet("test_theme_color", [
        'title' => 'test_theme カラー設定',
        'priority' => 151,
    ]);

    // メインカラーのセクションを追加
    // この場合、test_theme_colorというパネルと連携されます。
    $custom->sectionSet("test_theme_color_main", [
        'title' => 'メインカラー設定',
    ]);

    // テーマカラーのセッティングを追加
    // この場合、test_theme_colorというパネルと、test_theme_color_mainというセクションと連携されます。
    $custom->settingSet("test_theme_color_main_themecolor", [
        'label' => 'テーマカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#68c2fe',
        'transport' => 'refresh',
    ]);

    // テキストカラーのセクションを追加
    // この場合、test_theme_colorというパネルと連携されます。
    $custom->sectionSet("test_theme_color_text", [
        'title' => 'テキストカラー設定',
    ]);

    // 本文のカラーのセッティングを追加
    // この場合、test_theme_colorというパネルと、test_theme_color_textというセクションと連携されます。
    $custom->settingSet("test_theme_color_text_body", [
        'label' => '本文のカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#444444',
        'transport' => 'refresh',
    ]);

    // 見出しテキストのカラーのセッティングを追加
    // この場合、test_theme_colorというパネルと、test_theme_color_textというセクションと連携されます。
    $custom->settingSet("test_theme_color_text_hedding", [
        'label' => '見出しテキストのカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#222222',
        'transport' => 'refresh',
    ]);
}
add_action('customize_register', 'custom_color_add');
```

## シンプル用のクラスについて

上記のコードと、全く同じ動きを、次のコードで実現できます。

```php
require_once __DIR__ . "/vendor/autoload.php";

use Ponponumi\PonponcatCustomize\CustomizeOptionAddSimple;

function custom_color_add($wp_custom){
    $custom = new CustomizeOptionAddSimple($wp_custom);

    // この場合、テーマ名を「test_theme」に変更します。
    // このコードを記述しない場合、テーマ名は「ponponcat」になります。
    $custom->themeNameChange("test_theme");

    // カラーのパネルを追加
    // パネル名は「${themeName}_${panelName}」となります。
    // この場合は「test_theme_color」になります。
    $custom->panelSet("color", [
        'title' => 'test_theme カラー設定',
        'priority' => 151,
    ]);

    // メインカラーのセクションを追加
    // この場合、test_theme_colorというパネルと連携されます。
    // セクション名は「${themeName}_${panelName}_${sectionName}」となります。
    // この場合は「test_theme_color_main」になります。
    $custom->sectionSet("main", [
        'title' => 'メインカラー設定',
    ]);

    // テーマカラーのセッティングを追加
    // この場合、test_theme_colorというパネルと、test_theme_color_mainというセクションと連携されます。
    // 設定名は「${themeName}_${panelName}_${sectionName}_${setting}」となります。
    // この場合は「test_theme_color_main_themecolor」になります。
    $custom->settingSet("themecolor", [
        'label' => 'テーマカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#68c2fe',
        'transport' => 'refresh',
    ]);

    // テキストカラーのセクションを追加
    // この場合、test_theme_colorというパネルと連携されます。
    // セクション名は「${themeName}_${panelName}_${sectionName}」となります。
    // この場合は「test_theme_color_text」になります。
    $custom->sectionSet("text", [
        'title' => 'テキストカラー設定',
    ]);

    // 本文のカラーのセッティングを追加
    // この場合、test_theme_colorというパネルと、test_theme_color_textというセクションと連携されます。
    // 設定名は「${themeName}_${panelName}_${sectionName}_${setting}」となります。
    // この場合は「test_theme_color_text_body」になります。
    $custom->settingSet("body", [
        'label' => '本文のカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#444444',
        'transport' => 'refresh',
    ]);

    // 見出しテキストのカラーのセッティングを追加
    // この場合、test_theme_colorというパネルと、test_theme_color_textというセクションと連携されます。
    // 設定名は「${themeName}_${panelName}_${sectionName}_${setting}」となります。
    // この場合は「test_theme_color_text_hedding」になります。
    $custom->settingSet("hedding", [
        'label' => '見出しテキストのカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#222222',
        'transport' => 'refresh',
    ]);
}
add_action('customize_register', 'custom_color_add');
```

## CustomizeOptionAddクラス、CustomizeOptionAddSimpleクラスの実行の注意点

必ず、次の順で実行してください。

1. themeNameChangeメソッドを実行(CustomizeOptionAddSimpleクラスのみ)
1. panelSetメソッドを実行
1. sectionSetメソッドを実行
1. settingSetメソッドを実行

* 上記の順で実行しないと、エラーが起こります。
* セッティングを追加後、同じセクションに再度セッティングを追加したい場合、そのままsettingSetメソッドを実行してください。
* セッティングを追加後、同じパネルに再度セクションを追加したい場合、そのままsectionSetメソッドを実行してください。

## ライセンスについて

このパッケージは、GPL 2.0 (GNU GENERAL PUBLIC LICENSE 2.0)として作成されています。

このパッケージを使い、商用利用、再配布、改変は可能ですが、ソースコードを非公開のまま配布したり、互換性のないライセンス(MITなど)を適用させたりすることはできません。
