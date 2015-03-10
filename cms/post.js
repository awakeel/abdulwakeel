define(['text!posts/tpl/addpost.html','backbone'],
	function (template,backbone) {
		'use strict';
		return Backbone.View.extend({  
			tagName:'article',
			events:{
				"click #ancharsinglepost":"showSinglePost"
			},
            initialize: function () {
				this.template = _.template(template);
				this.render();
			},
			render: function () {
				this.$el.html(this.template());
				$('.textarea').wysihtml5();
			} 
              
		});
	});
