(function($){
	$.fn.styledCheckbox = function(options){

		// Default On / Off labels:

		options = $.extend({
			labels : ['ON','OFF'],
			colors : ['',''],
			speed  : 'fast',
			content_width  : '4em',
			handle_width   : '1em',
			handle_color   : '#bfbfbf',
			height: '1.5em'
		},options);

		return this.each(function(){
			var originalCheckBox = $(this),
				labels = [];

			// Checking for the data-on / data-off HTML5 data attributes:
			if(originalCheckBox.data('on')){
				labels[0] = originalCheckBox.data('on');
				labels[1] = originalCheckBox.data('off');
			}
			else labels = options.labels;

			// Creating the new checkbox markup:
			var checkBox = $('<span></span>').addClass('styled_checkbox').css({
			  'display': 'inline-block',
			  'position': 'relative',
			  'cursor': 'pointer',
			  'overflow': 'hidden',
			  'border': 'inset 1px #d5d5d5'
			});
			
			var slider = $('<span></span>').addClass('cb_slide_bar').css({
			  'display': 'inline-block',
			  'position': 'absolute'			  
			});
			
      var on_state = $('<span></span>').addClass('on_state cb_content').css({
        'backgroundColor': options.colors[0],
        'width': options.content_width,
        'float': 'left',
        'display': 'inline-block',
        'textAlign' : 'center'               
      }).text(labels[0]);

      var off_state = $('<span></span>').addClass('off_state cb_content').css({
        'backgroundColor': options.colors[1],
        'width': options.content_width,
        'float': 'left',
        'display': 'inline-block',
        'textAlign' : 'center'      
      }).text(labels[1]);
      
      var handle = $('<span></span>').addClass('cb_handle').css({
        'width': options.handle_width,
        'backgroundColor': options.handle_color,
        'float': 'left',
        'display': 'inline-block',
        'borderStyle' : 'outset',
        'borderWidth' : '2px',
        'borderColor' : options.handle_color
      });
      
      
      
      $(slider).append(on_state).append(handle).append(off_state);
			
			$(checkBox).append(slider);

			checkBox.insertAfter(originalCheckBox.hide());
		  var left_offset = $(on_state).outerWidth();
		  var handle_width = $(handle).outerWidth();
		  var slide_width = 2 * left_offset + handle_width;
		  $(handle).css('height',options.height);
		  $(slider).css('width',slide_width);			
		  $(checkBox).css('width',left_offset + handle_width);
		
			if(!this.checked){			  
			  $(checkBox).find('.cb_slide_bar').css('marginLeft',-1 * left_offset );
			}else{
          $(checkBox).addClass('checked');
			}

			// Inserting the new checkbox, and hiding the original:

			checkBox.click(function(){
			  left = left_offset;
				checkBox.toggleClass('checked');
        $(this).find('.cb_slide_bar').animate({
          marginLeft: checkBox.hasClass('checked')? '0em' : (-1 * left)
        },'fast');
				var isChecked = checkBox.hasClass('checked');

				// Synchronizing the original checkbox:
				originalCheckBox.attr('checked',isChecked);
			});

			// Listening for changes on the original and affecting the new one:
			originalCheckBox.bind('change',function(){
				checkBox.click();
			});
		});
	};
})(jQuery);