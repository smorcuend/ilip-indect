<!--
Copyright: Gianluca Costa & Andrea de Franceschi 2007-2010, http://www.xplico.org
 Version: MPL 1.1/GPL 2.0/LGPL 2.1
-->
<script language="JavaScript">
    function popupVetrina(whatopen) {
      newWindow = window.open(whatopen, 'popup_vetrina', 'width=520,height=550,scrollbars=yes,toolbar=no,resizable=yes,menubar=no');
      return false;
    }
</script>
<div class="generic">
<div class="search">

<?php echo $form->create('Search', array( 'url' => array('controller' => 'fbuchats', 'action' => 'chats')));
      echo $form->input('search', array('type'=>'text','size' => '40', 'label' => __('Search:', true), 'default' => $srchd));
      echo $form->input('relevance', array('options'=>$relevanceoptions, 'all','empty'=>__('-- Choose relevance --',true),'default'=>$relevance));
      echo $form->end(__('Go', true));
 ?>
</div>
<br/>
 <table id="messagelist" summary="Message list" cellspacing="0">
 <tr>
	<th class="date"><?php echo $paginator->sort(__('Date', true), 'capture_date'); ?></th>
	<th class="subject"><?php echo $paginator->sort(__('User', true), 'user'); ?></th>
	<th class="subject"><?php echo $paginator->sort(__('Friend', true), 'friend'); ?></th>
	<th class="subject"><?php echo $paginator->sort(__('Duration [hh:mm:ss]', true), 'duration'); ?></th>
	<th class="size"><?php echo $paginator->sort(__('Size', true), 'data_size'); ?></th>
	<th width="80px"><?php echo $paginator->sort(__('Relevance',true), 'relevance'); ?></th>
	<th><?php echo $paginator->sort(__('Comments',true), 'comments'); ?></th>
        <th class="info"><?php __('Info'); ?></th>
 </tr>
 <?php foreach ($chats as $chat): ?>
  <?php $h = (int)($chat['Fbchat']['duration']/3600);
        $m = (int)($chat['Fbchat']['duration']/60 - $h*60);
        $s = $chat['Fbchat']['duration']%60;
        $friend = '<script type="text/javascript"> var txt="'.$chat['Fbchat']['friend'].'"; document.write(txt); </script>';
   ?>
 <?php if ($chat['Fbchat']['first_visualization_user_id']) : ?>
  <tr>
	<td rowspan='2'><?php echo $chat['Fbchat']['capture_date']; ?></td>
	<td rowspan='2'><script type="text/javascript"> var txt="<?php echo $chat['Fbchat']['user']; ?>"; document.write(txt); </script></td>
	<td rowspan='2'><a href="#" onclick="popupVetrina('/fbuchats/view/<?php echo $chat['Fbchat']['id']; ?>','scrollbar=auto'); return false"><?php echo $friend; ?></a></td>
	<td rowspan='2'><?php echo $h.":".$m.":".$s; ?></td>
	<td rowspan='2'><?php echo $chat['Fbchat']['data_size']; ?></td>
	<td>
	<?php 
		echo $form->create('Edit',array( 'url' => '/fbuchats/chats/'.$chat['Fbchat']['fbuchat_id']));
		echo $form->select('relevance', $relevanceoptions, $chat['Fbchat']['relevance'] ,array('label' => __('Choose relevance', true), 'empty' => __('-', true))); ?>
	</td>
	<td><?php
			echo $form->hidden('id', array('value' => $chat['Fbchat']['id']));
			echo $form->input ('comments', array ('default' => $chat['Fbchat']['comments'],'label' => false)       );
		?>
	</td>

        <td class="pinfo" rowspan='2'><a href="#" onclick="popupVetrina('/fbuchats/info/<?php echo $chat['Fbchat']['id']; ?>','scrollbar=auto'); return false"><?php __('info.xml'); ?></a> <div class="ipcap"><?php echo $html->link('pcap', 'pcap/' . $chat['']['id']); ?></div></td>
  </tr><tr>
	<td colspan='2'><?php echo $form->end(__('Save', true)); ?></td>
  </tr>
 <?php else : ?>
  <tr>
        <td rowspan='2'><b><?php echo $chat['Fbchat']['capture_date']; ?></b></td>
        <td rowspan='2'><b><script type="text/javascript"> var txt="<?php echo $chat['Fbchat']['user']; ?>"; document.write(txt); </script></b></td>
        <td rowspan='2'><b><a href="#" onclick="popupVetrina('/fbuchats/view/<?php echo $chat['Fbchat']['id']; ?>','scrollbar=auto'); return false"><?php echo $friend; ?></a></b></td>
        <td rowspan='2'><b><?php echo $h.":".$m.":".$s; ?></b></td>
        <td rowspan='2'><b><?php echo $chat['Fbchat']['data_size']; ?></b></td>
	<td>
	<?php 
		echo $form->create('Edit',array( 'url' => '/fbuchats/chats/'.$chat['Fbchat']['fbuchat_id']));
		echo $form->select('relevance', $relevanceoptions, $chat['Fbchat']['relevance'] ,array('label' => __('Choose relevance', true), 'empty' => __('-', true))); ?>
	</td>
	<td><?php
			echo $form->hidden('id', array('value' => $chat['Fbchat']['id']));
			echo $form->input ('comments', array ('default' => $chat['Fbchat']['comments'],'label' => false, 'size' => '90%'));
		?>
	</td>
        <td class="pinfo" rowspan='2'><b><a href="#" onclick="popupVetrina('/fbuchats/info/<?php echo $chat['Fbchat']['id']; ?>','scrollbar=auto'); return false"><?php __('info.xml'); ?></a> <div class="ipcap"><?php echo $html->link('pcap', 'pcap/' . $chat['Fbchat']['id']); ?></div></b>
	</td>
  </tr><tr>
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