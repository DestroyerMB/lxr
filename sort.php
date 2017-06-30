<!DOCTYPE html>
<html>

<body>

<h2>Request With a Callback Function</h2>
<p>The PHP file returns a call to the function you send as a callback.</p>

<select id="test">
  <option value="1">Room</option>
  <option value="2" selected="selected">Apartments</option>
  <option value="3">House</option>
</select>

<button onclick="findResults('search.php', displayResults)">Find</button>

<select id="sort" onchange="sortResults()">
  <option value="price_asc" selected="selected">Price ^</option>
  <option value="price_desc">Price v</option>
</select>

<p id="demo"></p>

<script>
function compare_by_price(a,b) {
  var record1 = JSON.parse(a);
  var record2 = JSON.parse(b);
  if (record1.price < record2.price)
    return -1;
  if (record1.price > record2.price)
    return 1;
  return 0;
}

function compare_by_price_desc(a,b) {
  var record1 = JSON.parse(a);
  var record2 = JSON.parse(b);
  if (record1.price > record2.price)
    return -1;
  if (record1.price < record2.price)
    return 1;
  return 0;
}

function findResults(url, cFunction) {
    var selects = document.getElementById("test");
    var selectedValue = selects.options[selects.selectedIndex].value;
    var selectedText = selects.options[selects.selectedIndex].text;
    var obj = { "id":selectedValue, "name":selectedText };

    var xhttp;
    xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        cFunction(this.responseText);
      }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(obj));
}

function displayResults(responseText) {
    rs =  JSON.parse(responseText);
    sortResults();
}

function sortResults() {
  var sort_select = document.getElementById("sort");
  var sort_by = sort_select.options[sort_select.selectedIndex].value;
  if(sort_by=="price_asc")
    rs.sort(compare_by_price);
  else
    rs.sort(compare_by_price_desc);
  var x, txt = "";
  for (i in rs) {
  var shielded = rs[i].replace('\r','\\r').replace('\n','\\n').replace(/[\u0000-\u0019]+/g,"");
    var record = JSON.parse(shielded);
    for (var property in record) {
      if (record.hasOwnProperty(property)) {
        var s = '' + record[property];
        record[property] = s.replace('\\r','\r').replace('\\n','\n');
      }
    }
    txt += record.name + " in " + record.city + " for " + record.price + "<br>";
  }
  document.getElementById("demo").innerHTML = '<pre>'+txt+'</pre>';
}
</script>

</body>
</html>
