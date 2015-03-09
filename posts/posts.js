define(['jquery', 'backbone','underscore', 'posts/collections/posts','posts/post'  ],
        function($, Backbone, _,  ColPosts,ViewPost) {
            'use strict';
            return Backbone.View.extend({
                tagName: 'article',
                events: {
                    'click .dep-change':'changeDepartment',
                    'click .logout_open': 'logout'
                },
                initialize: function() {  
                    this.objColPosts = new ColPosts();
                    this.request = null;
                    this.render();
                },
                render: function () { 
                  this.fetchAllPosts();
                }
                ,
                fetchAllPosts:function(){
                    if(this.request)
                        this.request.abort();
                
                      this.objColPosts.fetch({data: {page: 3}, success: function(data) {
                         
                        _.each(data.models,function(model){
                            var objPost = new ViewPost({model:model});
                            $(".posts").append(objPost.$el);
                        })
                    }});
                }

            });
        });
