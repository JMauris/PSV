<?php
$thematics['children']['0']['children']['0']['children']=$thematics['children']['2']['children'];
var_dump($thematics);
 ?>

<h2>Test</h2>

<?php
$this->output->enable_profiler(true);
echo form_open('test');
  $selctedThema = array();
  $labelExtraTopLevel = array('style' => 'font-weight:700');
  $labelExtraMidLevel = array('style' => 'font-weight:400');
  $labelExtraLowLevel = array('style' => 'font-weight:400;font-style: italic');
  if(isset($thematics['children']))
    foreach ($thematics['children'] as $topLevelThema) {
      $selctedThema[$topLevelThema['id']]=false;
      if(isset($topLevelThema['children']))
          foreach ($topLevelThema['children'] as $midLevelThema) {
            $selctedThema[$midLevelThema['id']]=false;
            if(isset($midLevelThema['children']))
              foreach ($midLevelThema['children'] as $lowLevelThema) {
                  $selctedThema[$lowLevelThema['id']]=false;
              }
          }
  }


  if(isset($thematics['children']))
    foreach ($thematics['children'] as $topLevelThema) {
      echo '<div style="padding-left: 10px">';
      $selctedThema[$topLevelThema['id']]=false;
      $id=$topLevelThema['id'];
      $data = array(
            'name'          => 'selctedThema[]',
            'id'            => 'thematics_'.$id,
            'value'         => 'accept',
            'checked'       => &$selctedThema[$id],
            'style'         => 'margin:10px'
        );
        echo form_checkbox($data);
        echo form_label($topLevelThema['text'],'',$labelExtraTopLevel);
        if(isset($topLevelThema['children']))
          foreach ($topLevelThema['children'] as $midLevelThema) {
            echo '<div style="padding-left: 10px">';
            $id=$midLevelThema['id'];
            $data = array(
                  'name'          => 'selctedThema[]',
                  'id'            => 'thematics_'.$id,
                  'value'         => 'accept',
                  'checked'       => &$selctedThema[$id],
                  'style'         => 'margin:10px'
              );
              echo form_checkbox($data);
              echo form_label($midLevelThema['text'],'',$labelExtraMidLevel);
              if(isset($midLevelThema['children']))
                foreach ($midLevelThema['children'] as $lowLevelThema) {
                  echo '<div style="padding-left: 10px">';
                  $id=$lowLevelThema['id'];
                  $data = array(
                        'name'          => 'selctedThema[]',
                        'id'            => 'thematics_'.$id,
                        'value'         => 'accept',
                        'checked'       => &$selctedThema[$id],
                        'style'         => 'margin:10px'
                    );
                    echo form_checkbox($data);
                    echo form_label($lowLevelThema['text'],'',$labelExtraLowLevel);
                    echo "</div>";
                }
            echo "</div>";
          }
      echo "</div>";
  }
  echo "</div>";
  echo form_submit('submit_Profil', 'Créer une nouvelle intervention', "class='btn btn-lg btn-primary btn-block'");

?>
