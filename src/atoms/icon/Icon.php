<?php

namespace PeverelliAndrea\Uix\atoms\icon;

use PeverelliAndrea\Uix\Component;
use PeverelliAndrea\Uix\Render;
use PeverelliAndrea\Uix\PaletteColor;
use PeverelliAndrea\Uix\CssProperty;

final class Icon extends Component
{
	final public static function render(
		IconVariant $variant,
		PaletteColor $color = PaletteColor::ON_SURFACE,
		IconSize $size = IconSize::M,
	): Render
	{
		return new Render(
			css: [
				<<<CSS
				.uix-atom-icon-{$variant->value} {
					font-family: "uix-atom-icon-{$variant->value}";
				}
				CSS,
				<<<CSS
				.uix-atom-icon-{$size->value} {
					font-size: {$size->value};
				}
				CSS,
				<<<CSS
				.uix-atom-icon {
					font-style: normal;
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
			<span class="uix-atom-icon uix-atom-icon-{$variant->value} uix-atom-icon-{$size->value} uix-palette-{$color->value}-color">{$variant->getName()}</span>
			HTML,
		);
	}
}
