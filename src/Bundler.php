<?php

namespace PeverelliAndrea\Uix;

final class Bundler
{
	final public function __construct() {}

	final public static function make(
		array $settings,
		array $fonts = [],
		array $icons = [],
		array $palette = [],
		array $renders = [],
	): Bundle
	{
		$css = [];
		$css_variables_css = ":root {\n";

		foreach($fonts as $font) {
			array_push($css, self::makeFontFace(name: $font, font: $settings["font"][$font]));

			foreach($settings["font"][$font]["variables"] as $name => $value) {
				$css_variables_css .= "--typography-{$font}-{$name}: {$value};\n";
			}
		}

		foreach($palette as $color) {
			$css_variables_css .= <<<CSS
			--palette-light-less-{$color}: {$settings["palette"][$color]["light-less"]};
			--palette-light-default-{$color}: {$settings["palette"][$color]["light-default"]};
			--palette-light-more-{$color}: {$settings["palette"][$color]["light-more"]};
			--palette-dark-less-{$color}: {$settings["palette"][$color]["dark-less"]};
			--palette-dark-default-{$color}: {$settings["palette"][$color]["dark-default"]};
			--palette-dark-more-{$color}: {$settings["palette"][$color]["dark-more"]};
			CSS;
		}

		foreach($icons as $icon) {
			array_push($css, <<<CSS
			@font-face {
				font-family: "uix-atom-icon-{$icon}";
				src: url("/assets/icons/{$icon}.woff2") format("woff2");
			}
			CSS);
		}

		$css_variables_css .= "}";
		array_push($css, $css_variables_css);

		$bundle = new Bundle();

		foreach($renders as $render_id => $render) {
			if($render->css !== null) {
				array_push($css, ...$render->css);
			}

			$bundle->html[$render_id] = $render->html;
		}

		$css = array_unique($css);

		$bundle->css = implode("\n\n", $css);

		return $bundle;
	}

	private static function makeFontFace(string $name, array $font): string
	{
		if($font["variables"]["font-weight"] === "100") {
			$weight = "thin";
		} else if($font["variables"]["font-weight"] === "200") {
			$weight = "extralight";
		} else if($font["variables"]["font-weight"] === "300") {
			$weight = "light";
		} else if($font["variables"]["font-weight"] === "400") {
			$weight = "regular";
		} else if($font["variables"]["font-weight"] === "500") {
			$weight = "medium";
		} else if($font["variables"]["font-weight"] === "600") {
			$weight = "semibold";
		} else if($font["variables"]["font-weight"] === "700") {
			$weight = "bold";
		} else if($font["variables"]["font-weight"] === "800") {
			$weight = "extrabold";
		} else {
			$weight = "black";
		}

		$css = <<<CSS
		@font-face {
			font-family: "{$name}";
			font-style: normal;
			font-weight: {$font["variables"]["font-weight"]};
			src: url("/assets/fonts/{$font["name"]}-{$weight}.ttf") format("truetype");
		}

		CSS;

		if($font["italic"]) {
			$css .= <<<CSS
			@font-face {
				font-family: "{$name}";
				font-style: italic;
				font-weight: {$font["variables"]["font-weight"]};
				src: url("/assets/fonts/{$font["name"]}-{$weight}-italic.ttf") format("truetype");
			}
			CSS;
		}

		if($font["bold"]) {
			$css .= <<<CSS
			@font-face {
				font-family: "{$name}";
				font-style: normal;
				font-weight: 700;
				src: url("/assets/fonts/{$font["name"]}-bold.ttf") format("truetype");
			}
			CSS;

			if($font["italic"]) {
				$css .= <<<CSS
				@font-face {
					font-family: "{$name}";
					font-style: italic;
					font-weight: 700;
					src: url("/assets/fonts/{$font["name"]}-bold-italic.ttf") format("truetype");
				}
				CSS;
			}
		}

		return $css;
	}
}
