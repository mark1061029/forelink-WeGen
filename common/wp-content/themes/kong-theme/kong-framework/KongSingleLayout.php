<?php

class KongSingleLayout extends KongPageLayout{
	protected function fullwidth_render()
	{
		echo $this->options['content'];
	}
}