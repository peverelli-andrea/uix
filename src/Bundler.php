<?php

namespace PeverelliAndrea\Uix;

final class Bundler
{
	final private function __construct() {}

	final public static function make(
		string $custom_css = "",
		array $css_variables = [],
		array $renders = [],
	): Bundle
	{
		$css = [];
		$bundle = new Bundle();

		$css_variables_css = ":root {\n";
		foreach($css_variables as $name => $value) {
			$css_variables_css .= "--{$name}: {$value};\n";
		}
		$css_variables_css .= "}";
		array_push($css, $css_variables_css, $custom_css);

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
}
