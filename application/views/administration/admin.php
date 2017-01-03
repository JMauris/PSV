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
?>
<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actif</th>
      </tr>
    </thead>
    <tbody>
<?php
$extra  = array('disabled' => 'disabled');
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
?>
</tbody>
</table>
  <?php
      echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");
   ?>

</form>
</div>
<h3>Genre</h3>

<?php

  echo form_open('/admin/');
  echo form_label("Créer un nouveau genre");
  echo form_input( "newGender");
  echo form_submit('submit_Profil', 'Ajouté',"class='btn btn-lg btn-primary '");
  echo form_close();

  echo form_open('/admin/');

?>
<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actif</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($genres as $key => $value)
      {
        if($value['activated']==0)
        {
            echo '<tr class="active">';
        }else
          {
              echo '<tr class="info">';
          }

        echo  '<td>';
          echo form_hidden('genres['.$value['id_gender'].'][id_gender]',$value['id_gender']);
        echo '</td>';

        echo  '<td>';
        echo form_input('genres['.$value['id_gender'].'][name]',$value['name']);
        echo '</td>';

        echo  '<td>';
        echo form_checkbox('genres['.$value['id_gender'].'][activated]',1,$value['activated']);
        echo '</td>
              </tr>';
      } ?>


  </tbody>
  </table>
  <?php
      echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");
   ?>
   </form>
  </div>
<h3>Sexualité</h3>

<?php

echo form_open('/admin/');
echo form_label("Créer une nouvelle catégorie de sexualité");
echo form_input( "newSexuality");
echo form_submit('submit_Profil', 'Ajouté',"class='btn btn-lg btn-primary '");
echo form_close();

  echo form_open('/admin/');
?>
<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actif</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sexualitys as $key => $value)
      {
        if($value['activated']==0)
        {
            echo '<tr class="active">';
        }else
          {
              echo '<tr class="info">';
          }

        echo  '<td>';
          echo form_hidden('sexualitys['.$value['id_sexuality'].'][id_sexuality]',$value['id_sexuality']);
        echo '</td>';

        echo  '<td>';
        echo form_input('sexualitys['.$value['id_sexuality'].'][name]',$value['name']);
        echo '</td>';

        echo  '<td>';
        echo form_checkbox('sexualitys['.$value['id_sexuality'].'][activated]',1,$value['activated']);
        echo '</td>
              </tr>';
      } ?>
    </tbody>
    </table>
    <?php
        echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");
     ?>
     </form>
    </div>
<h3>Groupe d'age</h3>

<?php
  echo form_open('/admin/');
echo form_label("Créer un nouveau groupe d'age");
echo form_input( "newGroupAge");
echo form_submit('submit_Profil', 'Ajouté',"class='btn btn-lg btn-primary '");
echo form_close();
  echo form_open('/admin/');
?>
<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actif</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ageGroups as $key => $value)
      {
        if($value['activated']==0)
        {
            echo '<tr class="active">';
        }else
          {
              echo '<tr class="info">';
          }

        echo  '<td>';
        echo form_hidden('ageGroups['.$value['id_ages_goup'].'][id_ages_goup]',$value['id_ages_goup']);
        echo '</td>';

        echo  '<td>';
        echo form_input('ageGroups['.$value['id_ages_goup'].'][name]',$value['name']);
        echo '</td>';

        echo  '<td>';
        echo form_checkbox('ageGroups['.$value['id_ages_goup'].'][activated]',1,$value['activated']);
        echo '</td>
              </tr>';
      } ?>
    </tbody>
    </table>
    <?php
        echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");
     ?>
     </form>
</div>
