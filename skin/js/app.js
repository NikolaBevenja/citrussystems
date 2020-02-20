function remote(remote, action, callbackFunction, newdata){
    var ajaxUrl = location.protocol.concat("//").concat(window.location.hostname).concat('/remote.php');
    var data = {
        "remote": remote,
        "action": action
    };
    if(newdata){
        data['data'] = JSON.stringify(newdata);
    }
    $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: data,
        success: function(content){
            callbackFunction(content);
        }
    });
}