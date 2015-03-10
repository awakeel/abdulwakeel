define(['text!posts/tpl/post.html','backbone'],
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
				this.$el.html(this.template(this.model.toJSON()));
			},
			showSinglePost:function(ev){
				var id = $(ev.target).data('id');
				require(['posts/singlepost'],function(ViewSinglePost){
					var objViewSinglePost = new ViewSinglePost({model:{}});
					$(".posts .content").html(objViewSinglePost.$el);
				});
			}
              
		});
	});
