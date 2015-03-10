define(['text!posts/tpl/singlepost.html','backbone'],
	function (template,backbone) {
		'use strict';
		return Backbone.View.extend({  
			tagName:'article',
			events:{
			},
            initialize: function () {
				this.template = _.template(template);
				this.render();
			},
			render: function () {
				this.$el.html(this.template({}));
			} 
              
		});
	});
