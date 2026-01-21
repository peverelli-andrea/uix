<?php

namespace PeverelliAndrea\Uix\molecules\button;

use PeverelliAndrea\Uix\Component;
use PeverelliAndrea\Uix\Render;
use PeverelliAndrea\Uix\TypographyRole;
use PeverelliAndrea\Uix\PaletteColor;
use PeverelliAndrea\Uix\CssProperty;
use PeverelliAndrea\Uix\atoms\span\Span;
use PeverelliAndrea\Uix\atoms\icon\Icon;
use PeverelliAndrea\Uix\atoms\icon\IconVariant;
use PeverelliAndrea\Uix\atoms\icon\IconSize;

final class ElevatedButton extends Component
{
	final public static function render(
		string $label,
		?IconVariant $icon = null,
		ButtonSize $size = ButtonSize::S,
	): Render
	{
		if($size === ButtonSize::S) {
			$height = "40px";
			$label_role = TypographyRole::LABEL_LARGE;
			$icon_size = IconSize::M;
			$horizontal_padding = "16px";
			$gap = "8px";
		}

		$icon_render = new Render();
		if($icon !== null) {
			$icon_render = Icon::render(
				variant: $icon,
				size: $icon_size,
				color: PaletteColor::PRIMARY,
			);
		}

		$span_render = Span::render(
			content: $label,
			color: PaletteColor::PRIMARY,
			role: $label_role,
		);

		return new Render(
			css: [
				...$icon_render->css,
				...$span_render->css,
				<<<CSS
				.uix-molecule-elevated-button {
					display: flex;
					flex-direction: row;
					align-items: center;
					border: none;
					padding-left: {$horizontal_padding};
					padding-right: {$horizontal_padding};
					gap: {$gap};
					height: {$height};
				}
				CSS,
				self::getColorCss(color: PaletteColor::SURFACE_CONTAINER_LOW, css_property: CssProperty::BACKGROUND_COLOR, media_query: ".uix-molecule-elevated-button"),
				self::getColorCss(color: PaletteColor::PRIMARY, css_property: CssProperty::BACKGROUND_COLOR, media_query: ".uix-molecule-elevated-button:hover"),
				self::getColorCss(color: PaletteColor::ON_PRIMARY, css_property: CssProperty::COLOR, media_query: ".uix-molecule-elevated-button:hover .uix-atom-icon, .uix-molecule-elevated-button:hover .uix-atom-span"),
			],
			html: <<<HTML
			<button class="uix-molecule-elevated-button uix-palette-surface-container-low-background-color">
				{$icon_render->html}
				{$span_render->html}
			</button>
			HTML,
		);
	}
}
