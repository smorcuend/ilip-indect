<!--
Copyright: Gianluca Costa & Andrea de Franceschi 2007-2010, http://www.xplico.org
 Version: MPL 1.1/GPL 2.0/LGPL 2.1
-->
<script language="JavaScript">
    function popupVetrina(whatopen) {
      newWindow = window.open(whatopen, 'popup_vetrina', 'width=620,height=550,scrollbars=yes,toolbar=no,resizable=yes,menubar=no');
      return false;
    }
</script>

<div class="generic">
<div class="search">
<center>
<?php echo $form->create('Search',array( 'url' => array('controller' => 'paltalk_rooms', 'action' => 'index')));
      echo $form->input('search', array('type'=>'text','size' => '40', 'label' => __('Search:', true), 'default' => $srchd));
      echo $form->input('relevance', array('options'=>$relevanceoptions, 'all','empty'=>__('-- Choose relevance --',true),'default'=>$relevance));
     echo $form->end(__('Go', true));?>
</center>
</div>
<br/>
<table id="messagelist" summary="Message list" cellspacing="0">
<tr>
	<th class="date"><?php echo $paginator->sort(__('Date', true), 'capture_date'); ?></th>
	<th class="date"><?php echo $paginator->sort(__('End', true), 'end_date'); ?></th>
	<th class="room"><?php echo $paginator->sort(__('Room name', true), 'room'); ?></th>
        <th class="size"><?php echo $paginator->sort(__('Duration', true), 'duration'); ?></th>
	<th class="relevance"><?php echo $paginator->sort(__('Relevance',true), 'relevance'); ?></th>
	<th><?php echo $paginator->sort(__('Comments',true), 'comments'); ?></th>
	<th class="info"><?php __('Info'); ?></th>

</tr>
<?php foreach ($paltalk_rooms as $paltalk): 
   $dh = (int)($paltalk['Paltalk_room']['duration']/3600);
   $dm = (int)(($paltalk['Paltalk_room']['duration'] - $dh*3600)/60);
   $ds = (int)(($paltalk['Paltalk_room']['duration'] - $dh*3600) - $dm*60);
   $duration = $dh.':'.$dm.':'.$ds;
?>
<?php if ($paltalk['Paltalk_room']['first_visualization_user_id']) : ?>
  <tr>
	<td rowspan='2'><?php echo $paltalk['Paltalk_room']['capture_date']; ?></td>
	<td rowspan='2'><?php echo $paltalk['Paltalk_room']['end_date']; ?></td>
        <td rowspan='2'>
		<a href="#" onclick="popupVetrina('/paltalk_rooms/room/<?php echo $paltalk['Paltalk_room']['id']; ?>','scrollbar=auto'); return false"><?php echo $paltalk['Paltalk_room']['room']; ?></a>
	</td>
        <td rowspan='2'><?php echo $duration; ?></td>
	<td><?php 
		echo $form->create('Edit',array( 'url' => '/paltalk_rooms/index'));
		echo $form->select('relevance', $relevanceoptions, $paltalk['Paltalk_room']['relevance'] ,array('label' => __('Choose relevance', true), 'empty' => __('-', true))); ?>
	</td>
	<td><?php
		echo $form->hidden('id', array('value' => $paltalk['Paltalk_room']['id']));
		echo $form->input ('comments', array ('default' => $paltalk['Paltalk_room']['comments'],'label' => false, 'size' => '90%')       );
		?>
	</td>
        <td class="pinfo" rowspan='2'><a href="#" onclick="popupVetrina('/paltalk_rooms/info/<?php echo $paltalk['Paltalk_room']['id']; ?>','scrollbar=auto'); return false"><?php __('info.xml'); ?></a>
	<div class="ipcap"><?php echo $html->link('pcap', 'pcap/' . $paltalk['Paltalk_room']['id']); ?></div></td>
  </tr>
<tr>
	<td colspan='2'><?php echo $form->end(__('Save', true)); ?></td>
</tr>
<?php else : ?>
 <tr>
	<td rowspan='2'><b><?php echo $paltalk['Paltalk_room']['capture_date']; ?></b></td>
        <td rowspan='2'><b><?php echo $paltalk['Paltalk_room']['end_date']; ?></b></td>
        <td rowspan='2'><b><a href="#" onclick="popupVetrina('/paltalk_rooms/room/<?php echo $paltalk['Paltalk_room']['id']; ?>','scrollbar=auto'); return false"><?php echo $paltalk['Paltalk_room']['room']; ?></a></b></td>
        <td rowspan='2'><b><?php echo $duration; ?></b></td>
	<td><?php 
		echo $form->create('Edit',array( 'url' => '/paltalk_rooms/index'));
		echo $form->select('relevance', $relevanceoptions, $paltalk['Paltalk_room']['relevance'] ,array('label' => __('Choose relevance', true), 'empty' => __('-', true))); ?>
	</td>
	<td><?php
		echo $form->hidden('id', array('value' => $paltalk['Paltalk_room']['id']));
		echo $form->input ('comments', array ('default' => $paltalk['Paltalk_room']['comments'],'label' => false, 'size' => '90%')       );
		?>
	</td>

        <td class="pinfo" rowspan='2'><b><a href="#" onclick="popupVetrina('/paltalk_rooms/info/<?php echo $paltalk['Paltalk_room']['id']; ?>','scrollbar=auto'); return false"><?php __('info.xml'); ?></a> <div class="ipcap"><?php echo $html->link('pcap', 'pcap/' . $paltalk['Paltalk_room']['id']); ?></div></b></td>

  </tr>
<tr>
	<td colspan='2'><?php echo $form->end(__('Save', true)); ?></td>
</tr>
<?php endif ?>
<?php endforeach; ?>
</table>

<table id="listpage" summary="Message list" cellspacing="0">
<tr>
	<th class="next"><?php echo $paginator->prev(__('Previous', true), array(), null, array('class'=>'disabled')); ?></th>
       	<th><?php echo $paginator->numbers(); echo '<br/>'.$paginator->counter(); ?></th>
	<th class="next"><?php echo $paginator->next(__('Next', true), array(), null, array('class' => 'disabled')); ?></th>
</tr>
</table>
</div>