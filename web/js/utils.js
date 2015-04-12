$( document ).ready(function() {


$("#form").submit(function( event ) {
    event.preventDefault();
    $.ajax({
        url: "/"+$('#action').val()+"/",
        type: 'POST',
        dataType: "html",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data, status) {
            updateUrlAndBody(queryString(),$('#action').val());
            $('#resultOutput').html(syntaxHighlight(JSON.parse(data)));
        },
        error: function (xhr, desc, err) {

        }
    });

    return false;
});



//http://stackoverflow.com/questions/4810841/how-can-i-pretty-print-json-using-javascript/7220510#7220510
function syntaxHighlight(json) {
        if (typeof json != 'string') {
            json = JSON.stringify(json, undefined, 2);
        }
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            var cls = 'number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'key';
                } else {
                    cls = 'string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'boolean';
            } else if (/null/.test(match)) {
                cls = 'null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    }


function fields() {
    return $('#form .argument');
}

function queryString() {
    var list = fields().map(
        function(){
            var value = encodeURIComponent($(this).val());
            return (value != '') ? (value) : null;
        }
    ).filter(
        function(x){
            return x != null
        }
    );
    return $.makeArray(list).join('/') ;
}

function updateUrlAndBody(url, action) {
    $('#displayUrl').attr( 'href', encodeURI(url) ).html( truncateWithEllipsis( url, 60 ) );
}

function truncateWithEllipsis(s, maxLength) {
    if( s.length > maxLength )
        return( s.substr(0,maxLength) + "..." )
    else
        return( s )
}

});