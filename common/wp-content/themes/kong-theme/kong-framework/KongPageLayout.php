<?php

class KongPageLayout{
	function __construct(array $options)
	{
		$this->options = $options;

		if(!empty($this->options['content_class'])){
			$this->options['content_class'] = ' '.$this->options['content_class'];
		}else{
			$this->options['content_class'] = '';
		}

		if(!empty($this->options['wrap_class'])){
			$this->options['wrap_class'] = ' '.$this->options['wrap_class'];
		}else{
			$this->options['wrap_class'] = '';
		}

		if(empty($this->options['has_border'])){
			$this->options['has_border'] = false;
		}

	}

	public function render(){
		switch ($this->options['type']) {
			case 'fullwidth':
				$this->fullwidth_render();
				break;
			case 'sidebar-left':
				$this->sidebar_left_render();
				break;
			case 'sidebar-right':
				$this->sidebar_right_render();
				break;
			default:
				$this->blank_render();
				break;
		}
	}

	protected function blank_render(){
		echo '<div class="kong-page'.$this->options['content_class'].'">'.$this->options['content'].'</div>';
	}

	protected function fullwidth_render(){
		?>
		<div class="kong-page kong-page--fullwidth <?php echo $this->options['wrap_class']; ?>">
			<div class="kong-container">
				<div class="kong-row">
					<div class="kong-page__content kong-page__column<?php echo $this->options['content_class']; ?>">
						<?php echo $this->options['content']; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function sidebar_left_render(){
		?>
		<div class="kong-page kong-page--sidebarLeft kong-page--singleSidebar kong-page--hasSidebar<?php echo $this->options['wrap_class']; ?> <?php if ($this->options['has_border']) echo 'kong-page--hasBorder' ?>">
			<div class="kong-container">
				<div class="kong-row">
					<div class="kong-page__content kong-page__column">
						<div class="kong-page__content--paddingLeft<?php echo $this->options['content_class']; ?>"><?php echo $this->options['content']; ?></div>
					</div>
					<div class="kong-page__sidebar kong-page__column">
						<?php if (!empty($this->options['sidebar']) && is_active_sidebar('kong-sidebar-' . $this->options['sidebar'])): ?>
							<aside class="kong-page__sidebar--paddingRight"><?php dynamic_sidebar('kong-sidebar-' . $this->options['sidebar']); ?></aside>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function sidebar_right_render(){
		?>
		<div class="kong-page kong-page--sidebarRight kong-page--singleSidebar kong-page--hasSidebar<?php echo $this->options['wrap_class']; ?> <?php if ($this->options['has_border']) echo 'kong-page--hasBorder' ?>">
			<div class="kong-container">
				<div class="kong-row">
					<div class="kong-page__content kong-page__column">
						<div class="kong-page__content--paddingRight<?php echo $this->options['content_class']; ?>"><?php echo $this->options['content']; ?></div>
					</div>
					<div class="kong-page__sidebar kong-page__column">
						<?php if (!empty($this->options['sidebar']) && is_active_sidebar('kong-sidebar-' . $this->options['sidebar'])): ?>
							<aside class="kong-page__sidebar--paddingLeft"><?php dynamic_sidebar('kong-sidebar-' . $this->options['sidebar']); ?></aside>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}