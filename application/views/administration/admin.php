<script>
var intervenant;
function myFunction(val) {
    alert("The input value has changed. The new value is: " + val);
    intervenant= val;

}
</script>

<h2>Management</h2>
<?php echo anchor('/auth/register/', 'Créer un nouvel intervenant',"class='btn btn-lg btn-primary btn-block'"); ?>

<h3>Internvenants</h3>

<?php
  echo form_open('/admin/');

$extra  = array('disabled' => 'disabled');
echo '<div class="container">';
echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';
echo  '<th>ID</th>';
echo  '<th>Username</th>';
echo   '<th>Email</th>' ;
echo    '<th>Role</th>' ;
echo    '<th>Actif</th>' ;
echo    '</tr>';
echo    '</thead>';
echo "<tbody>";
foreach ($intervenants as $key => $value) {
  if($value['activated']==0)
  {
      echo '<tr class="active">';
  }elseif ($value['group_id']==300)
    {
        echo '<tr class="info">';
    }
  else {
        echo '<tr class="danger">';
    }
    echo  '<td>';
    echo form_hidden('intervenants['.$value['id'].'][id]',$value['id']);
    echo '</td>';
    echo  '<td>';
    echo form_input('intervenants['.$value['id'].'][username]',$value['username']);
    echo '</td>';
    echo '<td>';
    echo form_input('intervenants['.$value['id'].'][email]',$value['email']);
    echo '</td>';
    echo '<td>';
    echo form_dropdown('intervenants['.$value['id'].'][group_id]',$roles,$value['group_id']);
    echo '</td>';
    echo '<td>';
    echo form_checkbox('intervenants['.$value['id'].'][activated]',1,$value['activated']);
    echo '</td>
          </tr>';
}
echo "</tbody>";
echo '</table>';
?>

    <?php

  echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");


   ?>
</form>

</div>
