define(['text!posts/tpl/post.html'],
	function (template) {
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
				this.$el.html(this.template(this.model.toJSON()));
			} 
              
		});
	});
