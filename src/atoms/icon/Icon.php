<?php

namespace PeverelliAndrea\Uix\atoms\icon;

use PeverelliAndrea\Uix\Component;
use PeverelliAndrea\Uix\Render;
use PeverelliAndrea\Uix\PaletteColor;
use PeverelliAndrea\Uix\CssProperty;

final class Icon extends Component
{
	final private function __construct() {}

	final public static function render(
		PaletteColor $color = PaletteColor::ON_SURFACE,
		IconSize $size = IconRole::M,
		IconVariant $icon,
	): Render
	{
		return new Render(
			css: [
				<<<CSS
				@font-face {				
					font-family: "uix-atom-icon-{$icon->value}";
					font-style: normal;
					font-weight: {$icon->getWeights()};
					src: url("/assets/icons/{$icon->value}.woff2") formal("woff2");
				}

				.uix-atom-icon-{$icon->value} {
					font-family: "uix-atom-icon-{$icon->value}";
				}
				CSS,
				<<<CSS
				.uix-atom-icon {
					font-style: normal;
					font-size: {$size->value};
					line-height: 1;
					letter-spacing: normal;
					text-transform: none;
					display: inline-block;
					white-space: nowrap;
					word-wrap: normal;
					direction: ltr;
					--webkit-font-feature-settings: "liga";
					--webkit-font-smoothing: antialiased;
				}
				CSS,
				self::getColorCss(color: $color, css_property: CssProperty::COLOR),
			],
			html: <<<HTML
			<span class="uix-atom-icon uix-atom-icon-{$icon->value} uix-palette-{$color->value}-color">{$icon-value}</span>
			HTML;
		);
	}
}
