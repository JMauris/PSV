<script>
var intervenant;
function myFunction(val) {
    alert("The input value has changed. The new value is: " + val);
    intervenant= val;

}
</script>

<h2>Management</h2>
<?php echo anchor('/auth/register/', 'Créer un nouvel intervenant',"class='btn btn-lg btn-primary btn-block'"); ?>

<h3>Internvenants actifs</h3>

<?php
  echo form_open('admin/updateStatues');
$DropDownextra  = array(
'style' => 'width: 100% ; height: 35px',
'id' =>  'intervenant',
'onChange' => 'myFunction(this.value);');
$extra  = array('disabled' => 'disabled');
  foreach ($intervenants_Actif as $key => $value) {
    echo '<div class="container">';
    echo  '<div class="form-group row">';
    echo '<div class="col-lg-9">';
    echo form_input("",$value);
    echo "</div>";
    echo '<div class="col-lg-3">';
    echo anchor(
        '/admin/edit/' . $value ,
        'modifier',
        "class='btn btn-default'");
    echo "</div>";
    echo "</div>";
    echo "</div>";


  }
?>
  <div class="col-lg-7">
  </div>
    <?php
  echo '<div class="col-lg-3">';
  echo form_label('Intervenant');
  echo form_dropdown('intervenant', $intervenants_Actif,'',$DropDownextra);
  echo '</div>';
  echo '<div class="col-lg-2">';
  echo "</br>";
  echo form_submit('submit_Profil', 'Rendre inactif',"class='btn btn-lg btn-primary btn-block'");
  echo '</div>';

   ?>
</form>
<?php
  if(sizeof($intervenants_Inactif)!=0){
  echo '<div class="container">';
 echo  '<h3>Internvenants inactifs</h3>';
 echo '<table class="table table-hover">';
  echo '<thead>';
  echo '<tr>';
  echo  '<th>Username</th>';
  echo   '<th>Email</th>' ;
  echo    '<th>Role</th>' ;
  echo    '</tr>';
  echo    '</thead>';
  echo "<tbody>";
  foreach ($intervenants_Inactif as $key => $value) {
      echo '<tr>
          <td>';
      echo form_input('',$value['username']);
      echo '</td>';
      echo '<td>';
      echo form_input('',$value['email']);
      echo '</td>';
      echo '<td>';
      echo form_input('',$value['group_id']);
      echo '</td>
            </tr>';
      var_dump($intervenants_Inactif);

  }
  echo "</tbody>";
  echo '</table>';
    echo form_open('admin/updateStatues');
?>
</div>
<div class="col-lg-7">
</div>
  <?php

echo '<div class="col-lg-3">';
echo form_label('Intervenant');
echo form_dropdown('intervenant', $intervenants_Inactif,'',$DropDownextra);
  echo '</div>';
echo '<div class="col-lg-2">';
echo "</br>";
echo form_submit('submit_Profil', 'Réactivé',"class='btn btn-lg btn-primary btn-block'");
echo "</div>";

echo "</div>";


?>
</form>
 </div>
 <?php } ?>


<h2>View</h2>
