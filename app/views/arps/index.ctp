
<script language="text/javascript">
    function popupVetrina(whatopen) {
      newWindow = window.open(whatopen, 'popup_vetrina', 'width=520,height=550,scrollbars=yes,toolbar=no,resizable=yes,menubar=no');
      return false;
    }
</script>

<div class="generic">
<div class="search shadow-box-bottom">

	<?php echo $form->create('Search', array( 'url' => array('controller' => 'arps', 'action' => 'index')));
	      echo $form->input('search', array( 'type'=>'text','size' => '30', 'label'=>__('Search:', true), 'default' => $srchd));
	      echo $form->input('relevance', array('options'=>$relevanceoptions, 'all','empty'=>__('-- Choose relevance --',true),'default'=>$relevance, 'label'=>__('Relevance:', true)));
	 echo $form->end(__('Go', true));?>


</div>

<!-- to-do : download these data in XLS format (or ODS) -->
<table id="messagelist" summary="Message list" cellspacing="0" table-layout="auto" class="shadow-box-bottom">
<tr>
	<th class="date"><?php echo $paginator->sort(__('Date', true), 'capture_date'); ?></th>
	<th><?php echo $paginator->sort(__('MAC', true), 'mac'); ?></th>
	<th><?php echo $paginator->sort(__('IP', true), 'ip'); ?></th>
	<th class="info"><?php __('Info'); ?></th>
</tr>
<?php foreach ($arp_msgs as $arp_msg): ?>
<?php if ($arp_msg['Arp']['first_visualization_user_id']) : ?>
  <tr>
	<td><?php echo $arp_msg['Arp']['capture_date']; ?></td>
	<td><?php echo $arp_msg['Arp']['mac']; ?></td>
	<td><?php echo $arp_msg['Arp']['ip']; ?></td>
        <td class="pinfo"><a href="#" onclick="popupVetrina('/arps/info/<?php echo $arp_msg['Arp']['id']; ?>','scrollbar=auto'); return false"><?php __('info.xml'); ?></a></td>

  </tr>
<?php else : ?>
 <tr>
	<td><b><?php echo $arp_msg['Arp']['capture_date']; ?></b></td>
        <td><b><?php echo $arp_msg['Arp']['mac']; ?></b></td>
	<td><b><?php echo $arp_msg['Arp']['ip']; ?></b></td>
        <td class="pinfo"><b><a href="#" onclick="popupVetrina('/arps/info/<?php echo $arp_msg['Arp']['id']; ?>','scrollbar=auto'); return false"><?php __('info.xml'); ?></a></b></td>
  </tr>
<?php endif ?>
<?php endforeach; ?>
</table>

<table id="listpage" summary="Message list" cellspacing="0" class="shadow-box-bottom">
<tr>
	<th class="next"><?php echo $paginator->prev(__('Previous', true), array(), null, array('class'=>'disabled')); ?></th>
       	<th><?php echo $paginator->numbers(); echo $paginator->counter(); ?></th>
	<th class="next"><?php echo $paginator->next(__('Next', true), array(), null, array('class' => 'disabled')); ?></th>
</tr>
</table>
</div>