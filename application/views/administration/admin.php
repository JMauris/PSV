<script>
var intervenant;
function myFunction(val) {
    alert("The input value has changed. The new value is: " + val);
    intervenant= val;

}
</script>

<h2>Management</h2>
<h3>Internvenants</h3>

<?php
  echo anchor('/auth/register/', 'Créer un nouvel intervenant',"class='btn btn-lg btn-primary btn-block'");
  echo form_open('/admin/user_edit');
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
<!-- =====================gender================================================================================ -->
  <div class="container">
    <h3>Genre</h3>
    <div id="gender_add">
      <?php echo form_open('/admin/gender_add');?>
        <div class="row">
          <div  class="col-xs-8">
            <?php
              $input= array(
                'id' 		=> 'addedGender',
                'name'	=> 'addedGender',
                'class'	=> 'form-control',
                'value' => 'Nouveau Genre'
              );
                echo form_input($input);
            ?>
          </div>
          <div class="col-xs-4">
            <?php	echo form_submit('submit_Profil', 'Créer un nouveau genre',"class='btn btn-lg btn-primary btn-block'"); ?>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
    <div id="gender_edit">
      <?php echo form_open('/admin/gender_edit/');?>
        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Actif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($genres as $key => $value) {
                ?>
                  <tr class="<?php if($value['activated']==0):?>active<?php else:?>info<?php endif?>">
                    <td>
                      <?php
                        echo form_hidden('genres['.$value['id_gender'].'][id_gender]',$value['id_gender']);
              					$input= array(
              						'id' 		=> 'genres['.$value['id_gender'].'][name]',
              						'name'	=> 'genres['.$value['id_gender'].'][name]',
              						'class'	=> 'form-control',
              						'value' => $value['name']);
              						echo form_input($input);
                      ?>
                    </td>
                    <td>
                      <?php echo form_checkbox('genres['.$value['id_gender'].'][activated]',1,$value['activated']);?>
                    </td>
                  </tr>
                <?php
              }
                ?>
            </tbody>
          </table>
        </div>
        <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
      <?php echo form_close(); ?>
    </div>
  </div>
<!-- =====================sexualitys================================================================================ -->
<div class="container">
  <h3>Sexualité</h3>
  <div id="sexuality_add">
    <?php echo form_open('/admin/sexuality_add');?>
      <div class="row">
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'addedSexuality',
              'name'	=> 'addedSexuality',
              'class'	=> 'form-control',
              'value' => 'Nouvelle Sexualité'
            );
              echo form_input($input);
          ?>
        </div>
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer une nouvelle sexualité',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="sexuality_edit">
    <?php echo form_open('/admin/sexuality_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sexualitys as $key => $value) {
              ?>
                <tr class="<?php if($value['activated']==0):?>active<?php else:?>info<?php endif?>">
                  <td>
                    <?php
                      echo form_hidden('sexualitys['.$value['id_sexuality'].'][id_sexuality]',$value['id_sexuality']);
                      $input= array(
                        'id' 		=> 'sexualitys['.$value['id_sexuality'].'][name]',
                        'name'	=> 'sexualitys['.$value['id_sexuality'].'][name]',
                        'class'	=> 'form-control',
                        'value' => $value['name']);
                        echo form_input($input);
                    ?>
                  </td>
                  <td>
                    <?php echo form_checkbox('sexualitys['.$value['id_sexuality'].'][activated]',1,$value['activated']);?>
                  </td>
                </tr>
              <?php
            }
              ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<!-- =====================Age group================================================================================= -->
<div class="container">
  <h3>Groupe d'age</h3>
  <div id="ageGroup_add">
    <?php echo form_open('/admin/ageGroup_add');?>
      <div class="row">
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'addedAgeGroup',
              'name'	=> 'addedAgeGroup',
              'class'	=> 'form-control',
              'value' => "Nouveau groupe d'age"
            );
              echo form_input($input);
          ?>
        </div>
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', "Créer une nouvelle classe d'age","class='btn btn-lg btn-primary btn-block"); ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="ageGroup_edit">
    <?php echo form_open('/admin/ageGroup_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ageGroups as $key => $value) {
              ?>
                <tr class="<?php if($value['activated']==0):?>active<?php else:?>info<?php endif?>">
                  <td>
                    <?php
                      echo form_hidden('ageGroups['.$value['id_ages_goup'].'][id_ages_goup]',$value['id_ages_goup']);
                      $input= array(
                        'id' 		=> 'ageGroups['.$value['id_ages_goup'].'][name]',
                        'name'	=> 'ageGroups['.$value['id_ages_goup'].'][name]',
                        'class'	=> 'form-control',
                        'value' => $value['name']);
                        echo form_input($input);
                    ?>
                  </td>
                  <td>
                    <?php echo form_checkbox('ageGroups['.$value['id_ages_goup'].'][activated]',1,$value['activated']);?>
                  </td>
                </tr>
              <?php
            }
              ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
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
<!-- =====================cities================================================================================ -->
  <div class="container">
  	<h3>Villes</h3>
  	<div id="cities_activByNPA">
      <?php echo form_open('/admin/cities_activByNPA');?>
        <div class="row">
  				<div  class="col-xs-8">
  					<?php
  						$input= array(
  							'id' 		=> 'activatedNPA',
  							'name'	=> 'activatedNPA',
  							'class'	=> 'form-control',
                'value' => 'NPA'
              );
  							echo form_input($input);
  					?>
  				</div>
  				<div class="col-xs-4">
  					<?php	echo form_submit('submit_Profil', 'activer par npa',"class='btn btn-lg btn-primary btn-block'"); ?>
  				</div>
  			</div>
  		<?php echo form_close(); ?>
  	</div>
    <div id="cities_activByName">
      <?php echo form_open('/admin/cities_activByName');?>
        <div class="row">
          <div  class="col-xs-8">
            <?php
              $input= array(
                'id' 		=> 'activatedName',
                'name'	=> 'activatedName',
                'class'	=> 'form-control',
                'value' => 'nom'
              );
                echo form_input($input);
            ?>
          </div>
          <div class="col-xs-4">
            <?php	echo form_submit('submit_Profil', 'activer par nom',"class='btn btn-lg btn-primary btn-block'"); ?>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
  	<div id="cities_GroupEdit">
  		<?php echo form_open('/admin/cities_GroupEdit/');?>
  			<div class="row">
  				<table class="table table-hover">
  					<thead>
  						<tr>
                <th>NPA</th>
  							<th>Nom</th>
  							<th>Actif</th>
  						</tr>
  					</thead>
  					<tbody>
  						<?php
  						foreach ($cities as $city) {
                $id= $city['id_city'];
  							?>
  								<tr>
                    <td>
                      <input type="hidden" name="cities[<?php echo($id); ?>][id_city]" value="<?php echo($id); ?>" />
                      <label><?php echo $city['npa'];?></label>
  									</td>
                    <td><?php echo $city['name']; ?></td>
  									<td>
                      <select name="cities[<?php echo($id); ?>][action]">
                        <option value="none" selected="selected"></option>
                        <option value="unactiv">Désactiver</option>
                      </select>
  									</td>
  								</tr>
  							<?php
  						}
  						?>
  					</tbody>
  				</table>
  			</div>
  			<?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
  		<?php echo form_close(); ?>
  	</div>
  </div>
