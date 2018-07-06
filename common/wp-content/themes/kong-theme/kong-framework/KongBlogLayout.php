<?php

class KongBlogLayout extends KongPageLayout{
	protected function blank_render()
	{
		echo $this->options['content'];
	}
}