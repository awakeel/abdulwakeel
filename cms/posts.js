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
                 }

            });
        });
