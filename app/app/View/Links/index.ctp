<h1>Links</h1>
<?php 
      echo $this->Form->create('Links', array('action' => 'add'));
      echo $this->Form->input("Link.url", array('type' => 'text', 'div' => false));
      echo $this->Form->end('Speichern', array('div' => false));
?>
<p/>
<table>
  <tr>
    <th>Link</th>
    <th>&nbsp;</th>
  </tr>

  <?php 
      foreach ($links as &$link) {
      	$linkData = $link['Link'];
   ?>
   <tr>
      <td><?php echo $this->Html->link($linkData['url'], $linkData['url']) ?></td>
      <td><?php echo $this->Html->link('Entf', array('action'=>'delete', $linkData['id'])) ?></td>
    </tr>
  <?php } ?>

</table>

