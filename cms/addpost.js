define(['text!cms/tpl/addpost.html','backbone','wyswing','cms/models/addpost'],
	function (template,backbone,wyswing,ModelPost) {
		'use strict';
		return Backbone.View.extend({  
			tagName:'article',
			events:{
				'click #btnadd':'savePost'
			},
            initialize: function () {
				this.template = _.template(template);
				this.render();
			},
			render: function () {
				this.$el.html(this.template({}));
				$('.textarea').wysihtml5();
			} ,
			savePost:function(){
				var objModel = new ModelPost();
				var title = this.$el.find("#txttitle").val();
				var text = this.$el.find('.textarea').val();
				objModel.set('title',title);
				objModel.set('text',text);
				objModel.save();
			}
              
		});
	});
