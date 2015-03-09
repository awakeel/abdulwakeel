(function() {
	'use strict';
	require.config({
		deps : [ 'main' ],
		waitSeconds : 400,
		urlArgs : "v=4"  + new Date().getTime(),
		paths : {
			jquery : 'lib/jquery-2.0.3.min',
			underscore : 'lib/underscore',
			backbone : 'lib/backbone-min',
			text : 'lib/text' ,
			'bootstrap' : 'lib/b/js/bootstrap.min' 
		},
		shim : {
			jquery : {
				exports : 'jQuery'
			},
			backbone : {
				deps : [ 'jquery', 'underscore' ],
				exports : 'Backbone'
			},
			underscore : {
				exports : '_'
			},
			 
			bootstrap : [ 'jquery' ] 
		}
	});

	require([ 'jquery', 'bootstrap', 'backbone','js/start'], function($,bootstrap,Backbone ,start) {
		    start.load();
 			Backbone.history.start({
				pushState : true
			}); //Start routing
			/// what is going wrong with this
		})

})();