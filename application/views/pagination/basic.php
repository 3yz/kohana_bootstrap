<div class="pagination">
	<ul>
		<li>
			<a href="<?php echo ($first_page !== FALSE) ?  HTML::chars($page->url($first_page)) : '#' ?>" rel="first"><?php echo __('<<') ?></a>
		</li>
		<li>
			<a href="<?php echo ($previous_page !== FALSE) ? HTML::chars($page->url($previous_page)) : '#' ?>" rel="prev"><?php echo __('<') ?></a>
		</li>
		<?php for ($i = 1; $i <= $total_pages; $i++): ?>
		<li class="<?php echo ($i == $current_page) ? 'active' : '' ?>">
			<a href="<?php echo ($i == $current_page) ? '#' : 	HTML::chars($page->url($i)) ?>"><?php echo $i ?></a>
		</li>
		<?php endfor ?>
		<li>
			<a href="<?php echo ($next_page !== FALSE) ?  HTML::chars($page->url($next_page)) : '#' ?>" rel="next"><?php echo __('>') ?></a>
		</li>
		<li>
			<a href="<?php echo ($last_page !== FALSE) ? HTML::chars($page->url($last_page)) : '#' ?>" rel="last"><?php echo __('>') ?></a>
		</li>
	</ul>
</div>