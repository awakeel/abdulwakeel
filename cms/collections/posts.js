/* 
 * Name: Notification Dialog
 * Date: 04 June 2014
 * Author: Pir Abdul Wakeel
 * Description: Used to fetch all notifications , anouncement
 * Dependency: Notificaiton Model
 */

define(['backbone',  'posts/models/post'], function (Backbone, ModelPost) {
	'use strict';
	return Backbone.Collection.extend({
            
            model:ModelPost,
            url: 'api/posts'
           
           
             
	});
});