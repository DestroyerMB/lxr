<!DOCTYPE html>
<html>
<body>

<p id="demo"></p>
<p id="demo_opt"></p>

<script>
var person = { firstName: "John", lastName: "Doe", id: 5566 };

var books = {};
books.o1 = "Alice";
books.o22 = "Dark Soul";

person.age=56;
person.books = books;

document.getElementById("demo").innerHTML =
person.firstName + " " + person.lastName + " " + person.age;

var txt = '';
for (var opt in person.books) {
    if (person.books.hasOwnProperty(opt)) {
        txt += person.books[opt] + '<br>';
    }
}
document.getElementById("demo_opt").innerHTML = txt;

</script>

</body>
</html>
