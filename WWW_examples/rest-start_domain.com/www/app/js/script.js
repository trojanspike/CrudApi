$(function(){

var csrf = $('body').attr('data-csrf'); // or $('body').data('csrf') is same

$.ajax({
    type : 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("accept", 'application/json');
    },
    dataType: "json",
    url: '/v1/exampleAuth?auth=access',
    success: function(data) {
        console.log(data);
    }
});


$.ajax({
    type : 'POST',
    beforeSend: function(xhr) {
        console.log('Done a GET request');
        xhr.setRequestHeader("accept", 'application/json');
    },
    dataType: "json",
    data : JSON.stringify({csrf:csrf, user:'u548', message : '_csrf sent'}),
    url: '/v1/exampleAuth?auth=access',
    success: function(data) {
        console.log('Done a POST request');
        console.log(data);
    }
});

$.ajax({
    type : 'PUT',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("accept", 'application/json');
    },
    dataType: "json",
    data : JSON.stringify({csrf:csrf, update:'15', message : 'change Message '}),
    url: '/v1/exampleNoAuth',
    success: function(data) {
        console.log('Done a PUT request');
        console.log(data);
    }
});

/* Failing */
// see /rest/v1/api/exampleNoAuth @  Api::delete # $res->unAuth()
$.ajax({
    type : 'DELETE',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("accept", 'application/json');
    },
    dataType: "json",
    data : JSON.stringify({id:8}),
    url: '/v1/exampleNoAuth',
    success: function(data) {
        console.log('@');
        console.log(data);
    },
    error : function(http, text){
        console.log('Done a DELETE Failing request');
        console.log(http.status, text);
    }
});

        
});
    