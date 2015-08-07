<?php defined('ABSPATH') or die;
	/* @var array $families */
 ?>
<script src="//ajax.googleapis.com/ajax/libs/webfont/1.5.3/webfont.js"></script>
<script type="text/javascript">
	window.WebFontConfig = {
		listeners: [],
		active: function() {
			this.called_ready = true;
			for(var i = 0; i < this.listeners.length; i++) {
				this.listeners[i]();
			}
		},
		ready: function(callback) {
			if (this.called_ready) {
				callback();
			} else {
				this.listeners.push(callback);
			}
		}
	};
</script>