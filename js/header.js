define(['jquery','backbone', 'underscore',  'text!tpl/header.html'],
        function($, Backbone, _,  template) {
            'use strict';
            return Backbone.View.extend({
                tagName: 'div',
                events: {
                    'click .dep-change':'changeDepartment',
                    'click #ancharaddnew': 'addNewPost'
                },
                initialize: function() { 
                    this.template = _.template(template);
                    this.render();
                },
                render: function () {
                  this.$el.html(this.template({}));
                },
                addNewPost:function(){
                    require(['cms/addpost'],function(ViewAddPost){
                        var objAddPost = new ViewAddPost();
                        $('.posts .content').html(objAddPost.$el);    
                    })
                    
                }

            });
        });
