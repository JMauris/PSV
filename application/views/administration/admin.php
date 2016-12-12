
<h2>Management</h2>
<h3>Internvenants actifs</h3>

<?php
  echo form_open('admin/updateStatues');
$DropDownextra  = array('style' => 'width: 100% ; height: 35px');
$extra  = array('disabled' => 'disabled');
  foreach ($intervenants_Actif as $key => $value) {
    echo '<div class="container">';
      echo '<div class="col-lg-9">';
    echo form_label($value);
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
  ?>
</form>
   </div>
<?php
  if(sizeof($intervenants_Inactif)!=0){
 echo  '<h3>Internvenants inactifs</h3>';
  foreach ($intervenants_Inactif as $key => $value) {
    echo '<div class="container">';
      echo '<div class="col-lg-9">';
    echo form_label($value);
      echo "</div>";

    echo "</div>";
  }
    echo form_open('admin/updateStatues');
?>
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
?>
</form>
 </div>
 <?php } ?>


<h2>View</h2>
