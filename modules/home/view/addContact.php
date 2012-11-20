<legend><span class="legend">Your contacts</span></legend>
<fieldset>
<?php if(isset($vars['contacts']) && is_array($vars['contacts'])):?>
  <?php foreach($vars['contacts'] as $contact): ?>
  <div style="width: 300px; float: left;">
    <ul>
      <li><b><?php echo $contact->last_name.' '.$contact->first_name ?></b></li>
      <li>Mobile <?php echo $contact->mobile ?></li>   
      <li>Home <?php echo $contact->home ?></li>   
      <li>Office <?php echo $contact->office ?></li>   
      <li>Other <?php echo $contact->other ?></li>
      </li>        
    </ul>
    <input type="button" class="delbtn" id="del<?php echo $contact->id ?>" value="delete"/>
  </div>
  <?php endforeach; ?>
<?php endif ?>
</fieldset>