<?php

namespace PeverelliAndrea\Uix;

final class Component
{
	final private function __construct() {}

	final static protected function getColorCss(PaletteColor $color, CssProperty $css_property): string
	{
		return <<<CSS
		{$css_property->value}: var(--palette-light-default-{$color->value});

		@media (prefers-contrast: less) {
			{$css_property->value}: var(--palette-light-less-{$color->value});
		}

		@media (prefers-contrast: more) {
			{$css_property->value}: var(--palette-light-more-{$color->value});
		}
		
		@media (color-scheme: dark) {
			{$css_property->value}: var(--palette-dark-default-{$color->value});
		}

		@media (color-scheme: dark) and (prefers-contrast: less) {
			{$css_property->value}: var(--palette-dark-less-{$color->value});
		}

		@media (color-scheme: dark) and (prefers-contrast: more) {
			{$css_property->value}: var(--palette-dark-more-{$color->value});
		}
		CSS;
	}
}
