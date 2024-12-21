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
function custom_color_add($wp_custom){
    $custom = new CustomizeOptionAdd($wp_custom);

    // カラーのパネルを追加
    $custom->panelSet("test_theme_color", [
        'title' => 'test_theme カラー設定',
        'priority' => 151,
    ]);

    // メインカラーのセクションを追加
    $custom->sectionSet("test_theme_color_main", [
        'title' => 'メインカラー設定',
    ]);

    // テーマカラーのセッティングを追加
    $custom->settingSet("test_theme_color_main_themecolor", [
        'label' => 'テーマカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#68c2fe',
        'transport' => 'refresh',
    ]);

    // テキストカラーのセクションを追加
    $custom->sectionSet("test_theme_color_text", [
        'title' => 'テキストカラー設定',
    ]);

    // 本文のカラーのセッティングを追加
    $custom->settingSet("test_theme_color_text_body", [
        'label' => '本文のカラーの設定',
        'type' => 'color'
    ], [
        'default' => '#444444',
        'transport' => 'refresh',
    ]);

    // 見出しテキストのカラーのセッティングを追加
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

## ライセンスについて

このパッケージは、GPL 2.0 (GNU GENERAL PUBLIC LICENSE 2.0)として作成されています。

このパッケージを使い、商用利用、再配布、改変は可能ですが、ソースコードを非公開のまま配布したり、互換性のないライセンス(MITなど)を適用させたりすることはできません。
