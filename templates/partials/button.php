<?php 
    $function = ( $button['function'] == 'external' ? $button['external'] : 
                ( $button['function'] == 'internal' ? $button['internal'] : 
                ( $button['function'] == 'anchor' ? "#".$button['anchor_name'] : 
                ( $button['function'] == 'email' ? "mailto:".$button[$button['function']] : 
                $button['document']['file']['url'] ) ) ) );
?>
	<a 
       href="<?php echo $function; ?>" 
       target="<?php echo ($button['function'] == 'external' ? '_blank' : ''); ?>" 
       class="btn btn-<?php echo $button['style']['color']; ?>" <?php echo ($button['function'] == 'document' && $button['document']['download'] == 1 ? 'download' : ''); ?>
    >
		<span><?php echo $button['label']; ?></span>
	</a>
