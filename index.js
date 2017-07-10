require('./include.js');
//var events = require('./events.js');
//import $ from 'jquery';

;;console.log($);

/*var id = events.gId('test');
console.log(id);*/

// Get the modal
var $modal = $('#myModal');

// Get the button that opens the modal
var $btn = $("#myBtn");

// Get the <span> element that closes the modal
var $span = $(".close:eq(0)");

console.log($btn);

// When the user clicks the button, open the modal
$btn.on('click', function() {
    console.log(86868);
    $modal.show();
});

// When the user clicks on <span> (x), close the modal
$span.on('click', function() {
    $modal.hide();
});

// When the user clicks anywhere outside of the modal, close it
$(window).on('click', function(event) {
    if (event.target == $modal.get(0)) {
        $modal.hide();
    }
});
