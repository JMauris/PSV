<html>
<head>
<script>
function test(){

  var first = document.querySelector('table tbody tr:first-child');
  first.parentNode.appendChild(first.cloneNode(true));

}


</script>

</head>
<body>
<table>
  <thead>
    <tr><th></th></tr>
  </thead>
  <tbody>
<tr>
    <td><input type="file" name="fichier[]" /></td>
    <td><input type="text" name="titre[]" placeholder="Titre photo"/></td>
    <td><input type="text" name="description[]" placeholder="Description"/></td>
    <td><input type="text" name="annee" placeholder="annee"/></td>
    <td ><button onClick="this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode)">Suppr.</button></td>

</tr>
  </tbody>
</table>

<button id="add" onClick="test()">Ajouter ligne</button>
  </body>
</html>
