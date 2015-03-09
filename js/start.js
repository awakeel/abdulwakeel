define(['jquery','js/header','posts/posts'], function (jquery,HeaderView,PostView){
    'use strict'; 
    var app = Backbone.Model.extend({
        load: function () {
            $('header').html(new HeaderView().$el);
            $('.posts').append(new PostView().$el);
		} 
    });
    return new app();

});
