<h1>Contacts</h1>

<fieldset>
  <legend><span class="legend">Add a new contact</span></legend>
  <form class="addForm" action="#" method="POST">
    
    <?php foreach(myContact::$form_fields as $inc => $field): ?>
      <div>
        <label for="contact_<?php echo $field['key'] ?>"><?php echo $field['label'] ?></label>
        <input type="text" value="<?php echo isset($vars['form']['val'][$field['key']]) ? $vars['form']['val'][$field['key']] : '' ?>" id="contact_<?php echo $field['key'] ?>" name="contact[<?php echo $field['key'] ?>]" />
        <span id="inc<?php echo $inc ?>"><?php echo isset($vars['form']['err'][$field['key']]) ? $vars['form']['err'][$field['key']] : ''?></span>
      </div>
    <?php endforeach; ?>
      <div>
        <label>&nbsp;</label>
        <input type="button" id="addFormSubmit" value="add" />
      </div>
        
  </form>
</fieldset>

<br />

<div id="contact_list">
  
  <fieldset>
    <legend><span class="legend">Your contacts</span></legend>
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
<div>



<script type="text/javascript">
 
$(document).ready(function() {
    

    $('#contact_list').on('click', '.delbtn', function(event){
        event.preventDefault(); 
        var id = $(this).attr('id').substr(3);
        $.ajax({
            url: "index.php?module=home&action=deleteContact", 
            type: "POST",
            data: {id: id},     
            cache: false,
            success: function (html) {              
              $('div#contact_list').html(html);
            }       
        });
    });
    
    
    
    $('#addFormSubmit').on('click', function(event){
      event.preventDefault();
      var first_name = $('#contact_first_name').val();
      var last_name = $('#contact_last_name').val();
      var mobile = $('#contact_mobile').val();
      var home = $('#contact_home').val();
      var office = $('#contact_office').val();
      var other = $('#contact_other').val();    
      
      var errors = new Array();                 
      
      if(first_name.length == 0){
        errors[0] = 'First name is required'; 
      }else if(first_name.length < 2){
        errors[0] = '2 characters minimum';
      }else if(first_name.length > 30){
        errors[0] = '30 characters maximum';
      }
      
      
      
      if(last_name.length == 0){
        errors[1] = 'Last name is required';        
      }else if(last_name.length < 2){
        errors[1] = '2 characters minimum';
      }else if(last_name.length > 30){
        errors[1] = '30 characters maximum';
      }
      
      var digits = /^\d{10}$/;
      
      if(mobile.length == 0){
        errors[2] = 'Mobile number is required';        
      }else if(mobile.search(digits) == -1){
        errors[2] = 'Enter a 10 digit phone number';
      }
            
      if(home.length != 0 && home.search(digits) == -1){
        errors[3] = 'Enter a 10 digit phone number';
      }
      
      if(office.length != 0 && office.search(digits) == -1){
        errors[4] = 'Enter a 10 digit phone number';
      }
      
      if(other.length != 0 && other.search(digits) == -1){
        errors[5] = 'Enter a 10 digit phone number';
      }
      
      if(errors.length > 0){
        for (var i = 0; i < errors.length; i++){
          $('span#inc'+i).html('');
          $('span#inc'+i).html(errors[i]);
        }
        return false;
      }
      
      
      $.ajax({
            url: "index.php?module=home&action=addContact", 
            type: "POST",
            data: $('form.addForm').serialize(),     
            cache: false,
            success: function (html) {              
              $('div#contact_list').html('');
              $('div#contact_list').html(html);              
            }
        });
    });
  
});  
  
</script>  

