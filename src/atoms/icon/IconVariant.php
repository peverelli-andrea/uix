<?php

namespace PeverelliAndrea\Uix\atoms\icon;

enum IconVariant: string
{
	case PLAY_CIRCLE = "play-circle";
	case SHOPPING_BAG = "shopping-bag";

	final public function getName(): string
	{
		return match($this) {
			self::PLAY_CIRCLE => "play_circle",
			self::SHOPPING_BAG => "shopping_bag",
		};
	}
}
