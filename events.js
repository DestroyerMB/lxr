var messages = require('./messages.js');

function gId(id) {
  return document.getElementById(id);
}

gId('test').addEventListener('click', function() {
  messages.msg('oppa!');
  $('#output').html('Done');
  $('#output').css("background-color", "yellow");
});

exports.gId = gId;
