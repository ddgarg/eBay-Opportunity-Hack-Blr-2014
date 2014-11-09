var callToDB = function(URL, type, data, onSuccess, onError) {
    $.ajax({    	
        url: URL,        
        context: document.body,        
        cache: false,
        data: data,
        type: type,
        contentType: 'application/json',
        success: onSuccess,
        error: onError
    });
};