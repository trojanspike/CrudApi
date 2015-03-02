$(function(){

var csrf = $('body').attr('data-csrf'); // or $('body').data('csrf') is same

$.ajax({
    type : 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("accept", 'application/json');
    },
    dataType: "json",
    url: '/v1/exampleAuth?auth=acess',
    success: function(data) {
        console.log(data);
    }
});


$.ajax({
    type : 'POST',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("accept", 'application/json');
    },
    dataType: "json",
    data : JSON.stringify({csrf:csrf, user:'u548', message : '_csrf sent'}),
    url: '/v1/exampleAuth?auth=access',
    success: function(data) {
        console.log(data);
    }
});

        
});
    