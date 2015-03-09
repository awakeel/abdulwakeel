define(['jquery', 'backbone','underscore',  'text!tpl/posts.html'],
        function($, Backbone, _,  template) {
            'use strict';
            return Backbone.View.extend({
                tagName: 'article',
                events: {
                    'click .dep-change':'changeDepartment',
                    'click .logout_open': 'logout'
                },
                initialize: function() { 
                    this.template = _.template(template);
                    this.render();
                },
                render: function () {
                  this.$el.html(this.template({}));
                }

            });
        });
