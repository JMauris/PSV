<?php //setup
  $genreDefault = $genres['0']['name'];
  unset($genres['0']);
  $sexualityDefault = $sexualitys['0']['name'];
  unset($sexualitys['0']);
  $ageGroupDefault = $ageGroups['0']['name'];
  unset($ageGroups['0']);
  $placeKindDefault = $placeKinds['0']['descr'];
  unset($ageGroups['0']);
  $origineDefault = $origines['0']['name'];
  $prestGrpSelector = array();
  foreach ($prestationGroups as $key => $value)
    $prestGrpSelector[$value['id_presstationGroup']]=$value['presstationGroup_descr'];
 ?>
<script>
var intervenant;
function myFunction(val) {
    alert("The input value has changed. The new value is: " + val);
    intervenant= val;

}
</script>

<h2>Management</h2>
<div>
  <ul class="nav nav-stacked">
    <li><a href="#rac_genders">Sexe</a></li>
    <li><a href="#rac_sexualitys">Sexualité</a></li>
    <li><a href="#rac_ageGroup_add">Groupe d'âges</a></li>
    <li><a href="#rac_thematics_Sct">Thématiques</a></li>
    <li><a href="#rac_Material_Sct">Matériel</a></li>
    <li><a href="#rac_placeKind">Types de lieux</a></li>
    <li><a href="#rac_prestGrp">PROSPREH - Catégories</a></li>
    <li><a href="#rac_prestations">PROSPREH - Prestations</a></li>
  </ul>

</div>
<h3>Intervenants</h3>

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
      echo form_submit('submit_Profil', 'Modifier',"class='btn btn-lg btn-primary btn-block'");
   ?>

</form>
</div>
	<div id="rac_genders" style="height: 60px;"> </div>
<!-- =====================genders================================================================================ -->
  <div id="genders" class="container">
    <h3>Sexe</h3>
    <div id="gender_add">
      <?php echo form_open('/admin/gender_add');?>
        <div class="row">
          <div class="col-xs-4">
            <?php	echo form_submit('submit_Profil', 'Créer un nouveau sexe',"class='btn btn-lg btn-primary btn-block'"); ?>
          </div>
          <div  class="col-xs-8">
            <?php
              $input= array(
                'id' 		=> 'addedGender',
                'name'	=> 'addedGender',
                'class'	=> 'form-control',
                'value' => 'Nouveau Sexe'
              );
                echo form_input($input);
            ?>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
    <div id="gender_defaultEdit">
      <h4>Description - Valeur par défaut</h4>
      <?php echo form_open('/admin/gender_defaultEdit');?>
        <div class="row">
          <div class="col-xs-4">
            <?php	echo form_submit('submit_Profil', 'Définir la valeur par défaut',"class='btn btn-lg btn-primary btn-block'"); ?>
          </div>
          <div  class="col-xs-8">
            <?php
              $input= array(
                'id' 		=> 'defaultGenre',
                'name'	=> 'defaultGenre',
                'class'	=> 'form-control',
                'value' => $genreDefault
              );
                echo form_input($input);
            ?>
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
                <th>Position</th>
                <th>Actif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($genres as $key => $value): ?>
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
                    <?php
                      $input= array(
                        'id' 		=> 'genres['.$value['id_gender'].'][position]',
                        'name'	=> 'genres['.$value['id_gender'].'][position]',
                        'class'	=> 'form-control',
                        'value' => $value['position']);
                        echo form_input($input);
                    ?>
                  </td>
                  <td>
                    <?php echo form_checkbox('genres['.$value['id_gender'].'][activated]',1,$value['activated']);?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
      <?php echo form_close(); ?>
    </div>
  </div>
  <div id="rac_sexualitys" style="height: 60px;"> </div>
<!-- =====================sexualitys================================================================================ -->
<div id="sexualitys" class="container">
  <h3>Sexualité</h3>
  <div id="sexuality_add">
    <?php echo form_open('/admin/sexuality_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer une nouvelle sexualité',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
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
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="sexuality_defaultEdit">
    <h4>Description - Valeur par défaut</h4>
    <?php echo form_open('/admin/sexuality_defaultEdit');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Définir la valeur par défaut',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'defaultSexuality',
              'name'	=> 'defaultSexuality',
              'class'	=> 'form-control',
              'value' => $sexualityDefault
            );
              echo form_input($input);
          ?>
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
              <th>Position</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sexualitys as $key => $value):?>
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
                    <?php
                      $input= array(
                        'id' 		=> 'sexualitys['.$value['id_sexuality'].'][position]',
                        'name'	=> 'sexualitys['.$value['id_sexuality'].'][position]',
                        'class'	=> 'form-control',
                        'value' => $value['position']);
                        echo form_input($input);
                    ?>
                  </td>
                  <td>
                    <?php echo form_checkbox('sexualitys['.$value['id_sexuality'].'][activated]',1,$value['activated']);?>
                  </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="rac_ageGroup_add" style="height: 60px;"> </div>
<!-- =====================ageGroup_add================================================================================= -->
<div id="ageGroup_add" class="container">
  <h3>Groupe d'âge</h3>
  <div id="ageGroup_add">
    <?php echo form_open('/admin/ageGroup_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer un nouveau groupe',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'addedAgeGroup',
              'name'	=> 'addedAgeGroup',
              'class'	=> 'form-control',
              'value' => "Nouveau groupe d'âge"
            );
              echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="ageGroup_defaultEdit">
    <h4>Description - Valeur par défaut</h4>
    <?php echo form_open('/admin/ageGroup_defaultEdit');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Définir la valeur par défaut',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'defaultAgeGroup',
              'name'	=> 'defaultAgeGroup',
              'class'	=> 'form-control',
              'value' => $ageGroupDefault
            );
              echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="gender_edit">

    <?php echo form_open('/admin/ageGroup_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Position</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ageGroups as $key => $value): ?>
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
                  <?php
                    $input= array(
                      'id' 		=> 'ageGroups['.$value['id_ages_goup'].'][position]',
                      'name'	=> 'ageGroups['.$value['id_ages_goup'].'][position]',
                      'class'	=> 'form-control',
                      'value' => $value['position']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php echo form_checkbox('ageGroups['.$value['id_ages_goup'].'][activated]',1,$value['activated']);?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="rac_thematics_Sct" style="height: 60px;"> </div>

<!-- =====================thematics_Sct============================================================================ -->
<?php
  $parentSelector = array('0'=> "racine");
  foreach ($thematicsTree['children'] as $topLvlThema)
    $parentSelector[$topLvlThema['id_thematic']]=$topLvlThema['name'];
 ?>
<div id="thematics_Sct" class="container">
  <h3>Thématiques</h3>
  <div id="thematics_add">
    <?php echo form_open('/admin/thematics_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer un nouveau thème',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-4">
          <?php
            echo form_dropdown('addedthema[parent]',$parentSelector);
          ?>
        </div>
        <div  class="col-xs-4">
          <?php
          $input= array(
            'id' 		=> 'addedthema[name]',
            'name'	=> 'addedthema[name]',
            'class'	=> 'form-control',
            'value' => "Nouvelle catégorie"
          );
            echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="thematics_edit">
    <?php echo form_open('/admin/thematics_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th colspan="2">Parent</th>
              <th colspan="2">Description</th>
              <th colspan="2">Position</th>
              <th colspan="2">Actif</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($thematicsTree['children'] as $topLvlId => $topLvlThema):?>
              <tr class="<?php if($topLvlThema['isActiv']==0):?>active<?php else:?>info<?php endif?>">
                <td colspan="2">
                  <?php
                    echo form_hidden('themaTree[children]['.$topLvlId.'][id_thematic]',$topLvlId);
                    echo form_dropdown('themaTree[children]['.$topLvlId.'][parent_id]',$parentSelector,$thematicsTree['id_thematic']);
                  ?>
                </td>
                <td colspan="2">
                  <?php
                    $input= array(
                      'id' 		=> 'themaTree[children]['.$topLvlId.'][name]',
                      'name'	=> 'themaTree[children]['.$topLvlId.'][name]',
                      'class'	=> 'form-control',
                      'value' => $topLvlThema['name']);
                      echo form_input($input);
                  ?>
                </td>
                <td colspan="2">
                  <?php
                    $input= array(
                      'id' 		=> 'themaTree[children]['.$topLvlId.'][position]',
                      'name'	=> 'themaTree[children]['.$topLvlId.'][position]',
                      'class'	=> 'form-control',
                      'value' => $topLvlThema['position']);
                      echo form_input($input);
                  ?>
                </td>
                <td colspan="2">
                  <?php echo form_checkbox('themaTree[children]['.$topLvlId.'][isActiv]',1,$topLvlThema['isActiv']);?>
                </td>
                <td/>
              </tr>
              <?php if (isset($topLvlThema['children'])): ?>
                <?php foreach ($topLvlThema['children'] as $lowLvlThemaId => $lowLvlThema): ?>
                    <tr class="<?php if($lowLvlThema['isActiv']==0):?>active<?php else:?>info<?php endif?>">
                      <td/>
                      <td colspan="2">
                        <?php
                          echo form_hidden('themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][id_thematic]',$lowLvlThemaId);
                          echo form_dropdown('themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][parent_id]',$parentSelector,$topLvlId);
                        ?>
                      </td>
                      <td colspan="2">
                        <?php
                          $input= array(
                            'id' 		=> 'themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][name]',
                            'name'	=> 'themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][name]',
                            'class'	=> 'form-control',
                            'value' => $lowLvlThema['name']);
                            echo form_input($input);
                        ?>
                      </td>
                      <td colspan="2">
                        <?php
                          $input= array(
                            'id' 		=> 'themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][position]',
                            'name'	=> 'themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][position]',
                            'class'	=> 'form-control',
                            'value' => $lowLvlThema['position']);
                            echo form_input($input);
                        ?>
                      </td>
                      <td colspan="2">
                        <?php echo form_checkbox('themaTree[children]['.$topLvlId.'][children]['.$lowLvlThemaId.'][isActiv]',1,$lowLvlThema['isActiv']);?>
                      </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="rac_Material_Sct" style="height: 60px;"> </div>




<!-- =====================Material_Sct============================================================================ -->
<div id="Material_Sct" class="container">
  <h3>Matériel</h3>
  <div id="material_add">
    <?php echo form_open('/admin/material_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer un nouveau materiel',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'addedMatterial',
              'name'	=> 'addedMatterial',
              'class'	=> 'form-control',
              'value' => "Nouveau materiel"
            );
              echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="material_edit">
    <?php echo form_open('/admin/material_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Description</th>
              <th>Position</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($materials as $key => $value): ?>
              <tr class="<?php if($value['actived']==0):?>active<?php else:?>info<?php endif?>">
                <td>
                  <?php
                    echo form_hidden('$materials['.$value['id_material'].'][id_material]',$value['id_material']);
                    $input= array(
                      'id' 		=> 'materials['.$value['id_material'].'][descr]',
                      'name'	=> 'materials['.$value['id_material'].'][descr]',
                      'class'	=> 'form-control',
                      'value' => $value['descr']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php
                    $input= array(
                      'id' 		=> 'materials['.$value['id_material'].'][position]',
                      'name'	=> 'materials['.$value['id_material'].'][position]',
                      'class'	=> 'form-control',
                      'value' => $value['position']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php echo form_checkbox('materials['.$value['id_material'].'][actived]',1,$value['actived']);?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="rac_placeKind" style="height: 60px;"> </div>




<!-- =====================place kind============================================================================ -->
<div id="placeKind" class="container">
  <h3>Types de lieux</h3>
  <div id="placeKind_add">
    <?php echo form_open('/admin/placeKind_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer un nouveau type',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'addedPlaceKind',
              'name'	=> 'addedPlaceKind',
              'class'	=> 'form-control',
              'value' => "Nouveau type de lieu"
            );
              echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="placeKind_defaultEdit">
    <h4>Description - Valeur par défaut</h4>
    <?php echo form_open('/admin/placeKind_defaultEdit');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Définir la valeur par défaut',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'defaultPlaceKind',
              'name'	=> 'defaultPlaceKind',
              'class'	=> 'form-control',
              'value' => $placeKindDefault
            );
              echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="placeKind_edit">

    <?php echo form_open('/admin/placeKind_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Position</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($placeKinds as $key => $value): ?>
              <tr class="<?php if($value['kind_actived']==0):?>active<?php else:?>info<?php endif?>">
                <td>
                  <?php
                    echo form_hidden('$placeKinds['.$value['id_kind'].'][id_kind]',$value['id_kind']);
                    $input= array(
                      'id' 		=> 'placeKinds['.$value['id_kind'].'][descr]',
                      'name'	=> 'placeKinds['.$value['id_kind'].'][descr]',
                      'class'	=> 'form-control',
                      'value' => $value['descr']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php
                    $input= array(
                      'id' 		=> 'placeKinds['.$value['id_kind'].'][position]',
                      'name'	=> 'placeKinds['.$value['id_kind'].'][position]',
                      'class'	=> 'form-control',
                      'value' => $value['position']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php echo form_checkbox('placeKinds['.$value['id_kind'].'][kind_actived]',1,$value['kind_actived']);?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="rac_prestGrp" style="height: 60px;"> </div>


<!-- =====================prestGrp============================================================================ -->
<div id="prestGrp" class="container">
  <h3>PROSPREH - Catégories</h3>
  <div id="prestGrp_add">
    <?php echo form_open('/admin/prestGrp_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer un nouveau groupe',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-8">
          <?php
            $input= array(
              'id' 		=> 'addedPrestGrp',
              'name'	=> 'addedPrestGrp',
              'class'	=> 'form-control',
              'value' => "Nouveau groupe de prestations"
            );
              echo form_input($input);
          ?>
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="prestGrp_edit">
    <?php echo form_open('/admin/prestGrp_edit/');?>
      <div class="row">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Description</th>
              <th>Position</th>
              <th>Actif</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prestationGroups as $key => $value): ?>
              <tr class="<?php if($value['isActiv']==0):?>active<?php else:?>info<?php endif?>">
                <td>
                  <?php
                    echo form_hidden('$prestationGroups['.$value['id_presstationGroup'].'][id_presstationGroup]',$value['id_presstationGroup']);
                    $input= array(
                      'id' 		=> 'prestationGroups['.$value['id_presstationGroup'].'][presstationGroup_descr]',
                      'name'	=> 'prestationGroups['.$value['id_presstationGroup'].'][presstationGroup_descr]',
                      'class'	=> 'form-control',
                      'value' => $value['presstationGroup_descr']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php
                    $input= array(
                      'id' 		=> 'prestationGroups['.$value['id_presstationGroup'].'][position]',
                      'name'	=> 'prestationGroups['.$value['id_presstationGroup'].'][position]',
                      'class'	=> 'form-control',
                      'value' => $value['position']);
                      echo form_input($input);
                  ?>
                </td>
                <td>
                  <?php echo form_checkbox('prestationGroups['.$value['id_presstationGroup'].'][isActiv]',1,$value['isActiv']);?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="rac_prestations" style="height: 60px;"> </div>

<!-- =====================prestations============================================================================ -->
<div id="prestations" class="container">
  <h3>PROSPREH - Prestations</h3>
  <div id="prest_add">
    <?php echo form_open('/admin/prest_add');?>
      <div class="row">
        <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer une nouvelle prestation',"class='btn btn-lg btn-primary btn-block'"); ?>
        </div>
        <div  class="col-xs-4">
          <?php
            echo form_dropdown('addedPrestGrp',$prestGrpSelector);
          ?>
        </div>
          <div  class="col-xs-4">
          <?php
            $input= array(
              'id' 		=> 'addedPrestDescr',
              'name'	=> 'addedPrestDescr',
              'class'	=> 'form-control',
              'value' => "Nouvelle prestation"
            );
              echo form_input($input);
          ?>
        </div>

      </div>
    <?php echo form_close(); ?>
  </div>
  <div id="prest_edit">
    <?php echo form_open('/admin/prest_edit/');?>
    <?php foreach ($prestations as $key => $value): ?>
          <div class="multiLvl">
            <div class="<?php if($value['isActiv']==0):?>unactif<?php else:?>actif<?php endif?>">
              <div class="row">
                <div class="row">
                  <div class="col-xs-12">
                    <?php
                      echo form_hidden('$prestations['.$value['id_prestation'].'][id_prestation]',$value['id_prestation']);
                      echo form_dropdown('prestations['.$value['id_prestation'].'][prestation_group]',$prestGrpSelector,$value['prestation_group']);
                    ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <?php
                      $input= array(
                        'id' 		=> 'prestations['.$value['id_prestation'].'][prestation_descr]',
                        'name'	=> 'prestations['.$value['id_prestation'].'][prestation_descr]',
                        'class'	=> 'form-control',
                        'value' => $value['prestation_descr']);
                        echo form_input($input);
                    ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6">
                    position:
                    <?php
                      echo ($value['parent_position']."-");
                      $input= array(
                        'id' 		=> 'prestations['.$value['id_prestation'].'][position]',
                        'name'	=> 'prestations['.$value['id_prestation'].'][position]',
                        //'class'	=> 'form-control',
                        'value' => $value['position']);
                        echo form_input($input);
                    ?>
                  </div>
                  <div class="col-xs-6">
                    actif:
                    <?php echo form_checkbox('prestations['.$value['id_prestation'].'][isActiv]',1,$value['isActiv']);?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <?php endforeach; ?>
      <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
    <?php echo form_close(); ?>
  </div>
</div>
<div style="height: 60px;"> </div>

<!-- =====================Origines================================================================================ -->

<div id="origines_Sct" class="container">
  <h3>Origines</h3>
  <?php
  $maxDepth=0;
  $parentSelector = array();
  foreach ($origines as $origine){
    if($origine['depth'] > $maxDepth)
      $maxDepth = $origine ['depth'];
    $parentSelector[$origine['id_origine']]='';
    for ($cpt=0; $cpt <$origine['depth'] ; $cpt++) {
      $parentSelector[$origine['id_origine']]='-'.$parentSelector[$origine['id_origine']];
      }
    $parentSelector[$origine['id_origine']]=$parentSelector[$origine['id_origine']].' '.$origine['name'];
    if($origine['actived']==0){
      $parentSelector[$origine['id_origine']]=$parentSelector[$origine['id_origine']].' (inactif)';
    }

  }
   ?>
  <div id="origines_add">
    <?php echo form_open('admin/origines_add');?>
    <div class="row">
      <div class="col-xs-4">
          <?php	echo form_submit('submit_Profil', 'Créer une nouvelle origine',"class='btn btn-lg btn-primary btn-block'"); ?>
      </div>
      <div  class="col-xs-4">
        <?php
          echo form_dropdown('addOrigine[parent]',$parentSelector);
        ?>
      </div>
      <div  class="col-xs-4">
        <?php
        $input= array(
          'id' 		=> 'addOrigine[name]',
          'name'	=> 'addOrigine[name]',
          'class'	=> 'form-control',
          'value' => "Nouvelle origine"
        );
          echo form_input($input);
        ?>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>
<div id="origine_defaultEdit">
  <h4>Description - Valeur par défaut</h4>
  <?php echo form_open('/admin/origine_defaultEdit');?>
    <div class="row">
      <div class="col-xs-4">
        <?php	echo form_submit('submit_Profil', 'Définir la valeur par défaut',"class='btn btn-lg btn-primary btn-block'"); ?>
      </div>
      <div  class="col-xs-8">
        <?php
          $input= array(
            'id' 		=> 'origineDefault',
            'name'	=> 'origineDefault',
            'class'	=> 'form-control',
            'value' => $origineDefault
          );
            echo form_input($input);
        ?>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>
<div id="origines_edit">
  <?php echo form_open('/admin/origines_edit/');?>
    <div class="row">

      <table class="table table-hover">
        <thead>
          <tr>
            <th colspan="<?php echo $maxDepth;?>">Parent</th>
            <th style="min-width: 250px" colspan="<?php echo ($maxDepth+2);?>">Nom</th>
            <th colspan="<?php echo $maxDepth;?>">Position</th>
            <th colspan="<?php echo $maxDepth;?>">Actif</th>
            <th colspan="<?php echo $maxDepth-1;?>"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($origines as $origine):?>
            <tr>
              <?php for($marge = 1; $marge < $origine['depth']; $marge++): ?>
                <td/>
              <?php endfor; ?>
              <td colspan="<?php echo $maxDepth;?>">
                <?php
                    echo form_hidden('origines['.$origine['id_origine'].'][id_origine]',$origine['id_origine']);

                    echo form_dropdown('origines['.$origine['id_origine'].'][parent_id]',$parentSelector,$origine['parent_id']);

                ?>
              </td>
              <td style="min-width: 250px" colspan="<?php echo ($maxDepth+2);?>">
                <?php
                  $input= array(
                    'id' 		=> 'origines['.$origine['id_origine'].'][name]',
                    'name'	=> 'origines['.$origine['id_origine'].'][name]',
                    'class'	=> 'form-control',
                    'value' => $origine['name']);
                    echo form_input($input);
                ?>
              </td>
              <td colspan="<?php echo $maxDepth;?>">
                <?php
                $input= array(
                  'id' 		=> 'origines['.$origine['id_origine'].'][position]',
                  'name'	=> 'origines['.$origine['id_origine'].'][position]',
                  'class'	=> 'form-control',
                  'value' =>$origine['position']);
                  echo form_input($input);
                ?>
              </td>
              <td colspan="<?php echo $maxDepth;?>">
                <?php
                echo form_checkbox('origines['.$origine['id_origine'].'][actived]',1,$origine['actived']);  ?>
              </td>
              <?php for($marge = $origine['depth']; $marge < $maxDepth; $marge++): ?>
                <td/>
              <?php endfor; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php	echo form_submit('submit_Profil', 'Modifer',"class='btn btn-lg btn-primary btn-block'");?>
  <?php echo form_close(); ?>
</div>

<!-- =====================cities================================================================================ -->
  <div class="container">
  	<h3>Villes</h3>
  	<div id="cities_activByNPA">
      <?php echo form_open('/admin/cities_activByNPA');?>
        <div class="row">
          <div class="col-xs-4">
  					<?php	echo form_submit('submit_Profil', 'activer par npa',"class='btn btn-lg btn-primary btn-block'"); ?>
  				</div>
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
  			</div>
  		<?php echo form_close(); ?>
  	</div>
    <div id="cities_activByName">
      <?php echo form_open('/admin/cities_activByName');?>
        <div class="row">
          <div class="col-xs-4">
            <?php	echo form_submit('submit_Profil', 'activer par nom',"class='btn btn-lg btn-primary btn-block'"); ?>
          </div>
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
