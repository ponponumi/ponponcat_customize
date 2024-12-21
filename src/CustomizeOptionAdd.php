<?php

namespace Ponponumi\PonponcatCustomize;

class CustomizeOptionAdd
{
    private object $wpCustom;
    private string $panelName = "";
    private string $sectionName = "";
    private int $sectionPriority = 1;
    private int $settingPriority = 1;
    private bool $colorLoaded = false;

    /**
     * インスタンスを作成します。
     *
     * @param object $wpCustom ここには、WordPressテーマカスタマイザーの、インスタンスを渡して下さい。
     */
    public function __construct(object $wpCustom)
    {
        $this->wpCustom = $wpCustom;
    }

    public function colorPickerLoad()
    {
        if($this->colorLoaded){
            return;
        }

        $this->colorLoaded = true;

        $style = wp_style_is("wp-color-picker");
        $script = wp_script_is("wp-color-picker");
        $inline = wp_script_is("custom-color-picker-inline");

        if(!$style || !$script || !$inline){
            add_action("customize_controls_enqueue_scripts", function() use ($style, $script, $inline){
                if(!$style){
                    wp_enqueue_style('wp-color-picker');
                }

                if(!$script){
                    wp_enqueue_script('wp-color-picker');
                }

                if (!$inline) {
                    wp_add_inline_script(
                        "wp-color-picker",
                        '(function($){$(".color-picker").wpColorPicker();})(jQuery);',
                        "after"
                    );
                    wp_register_script("custom-color-picker-inline", "");
                    wp_enqueue_script("custom-color-picker-inline");
                }
            });
        }
    }

    /**
     * テーマカスタマイザーのパネルを追加します。
     *
     * @param string $panelName ここには、パネル名を入れてください。
     * @param array $option ここには、オプションを入れてください。
     * @return void
     */
    public function panelSet(string $panelName,array $option)
    {
        $this->propertyReset();
        $this->panelName = $panelName;
        $this->wpCustom->add_panel($panelName, $option);
    }

    /**
     * テーマカスタマイザーのセクションを追加します。
     *
     * @param string $sectionName ここには、セクション名を入れてください。
     * @param array $option ここには、オプションを入れてください。priority、連携するpanelは、自動入力されます。
     * @return void
     */
    public function sectionSet(string $sectionName,array $option)
    {
        $this->panelNoSetError();

        $option["panel"] = $this->panelName;
        $option["priority"] = $this->sectionPriority;

        $this->propertyReset(true);

        $this->sectionPriority++;

        $this->sectionName = $sectionName;

        $this->wpCustom->add_section($sectionName, $option);
    }

    private function settingSetCore(callable $addControl, string $settingName, array $controlOption, array $settingOption=[])
    {
        $this->panelAndSectionNoSetError();

        $controlOption["section"] = $this->sectionName;
        $controlOption["settings"] = $settingName;
        $controlOption["priority"] = $this->settingPriority;

        $this->settingPriority++;

        $this->wpCustom->add_setting($settingName, $settingOption);

        $addControl($settingName, $controlOption);
    }

    /**
     * テーマカスタマイザーのセッティングとコントロールを追加します。
     *
     * @param string $settingName ここには、セッティング名を入力してください。これは、カスタマイザーの設定を取得する時に使います。
     * @param array $controlOption ここには、コントロールのオプションを入力してください。priority、連携するpanelとsectionは、自動入力されます。
     * @param array $settingOption ここには、セッティングのオプションを入力してください。省略した場合は空の配列となります。
     * @return void
     */
    public function settingSet(string $settingName, array $controlOption, array $settingOption=[])
    {
        $type = $controlOption["type"] ?? "";

        if($type === "color"){
            $this->colorPickerLoad();
        }

        $this->settingSetCore(function ($settingName, $controlOption) {
            $this->wpCustom->add_control(
                new \WP_Customize_Control(
                    $this->wpCustom,
                    $settingName,
                    $controlOption
                )
            );
        }, $settingName, $controlOption , $settingOption);
    }


    /**
     * テーマカスタマイザーの、画像タイプのセッティングとコントロールを追加します。
     *
     * @param string $settingName ここには、セッティング名を入力してください。これは、カスタマイザーの設定を取得する時に使います。
     * @param array $controlOption ここには、コントロールのオプションを入力してください。priority、連携するpanelとsectionは、自動入力されます。
     * @param array $settingOption ここには、セッティングのオプションを入力してください。省略した場合は空の配列となります。
     * @return void
     */
    public function settingImageSet(string $settingName, array $controlOption, array $settingOption=[])
    {
        $this->settingSetCore(function ($settingName, $controlOption) {
            $this->wpCustom->add_control(
                new \WP_Customize_Image_Control(
                    $this->wpCustom,
                    $settingName,
                    $controlOption
                )
            );
        }, $settingName, $controlOption , $settingOption);
    }

    public function propertyReset($sectionMode=false)
    {
        $this->sectionName = "";
        $this->settingPriority = 1;

        if(!$sectionMode){
            $this->panelName = "";
            $this->sectionPriority = 1;
        }
    }

    public function panelNameGet(): string
    {
        return $this->panelName;
    }

    public function sectionNameGet(): string
    {
        return $this->sectionName;
    }

    private function panelNoSetError()
    {
        if($this->panelName === ""){
            throw new \Exception("パネルが設定されていませんので、設定してください。");
        }
    }

    private function sectionNoSetError()
    {
        if($this->sectionName === ""){
            throw new \Exception("セクションが設定されていませんので、設定してください。");
        }
    }

    private function panelAndSectionNoSetError()
    {
        $this->panelNoSetError();
        $this->sectionNoSetError();
    }
}
