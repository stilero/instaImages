<?php 
defined('_JEXEC') or die('Restricted access'); 


JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

// Set toolbar items for the page
$edit		= JRequest::getVar('edit', true);
$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
JToolBarHelper::title(   JText::_( 'Imagepicker' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::apply();
JToolBarHelper::save();
if (!$edit) {
	JToolBarHelper::cancel();
} else {
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
?>

<script language="javascript" type="text/javascript">
<?php 
$jv = new JVersion();
if ($jv->RELEASE < 1.6): ?>

function submitbutton(task)
{
    var form = document.adminForm;
    if (task == 'cancel' || document.formvalidator.isValid(form)) {
		submitform(task);
	}
}
<?php  else: ?>

Joomla.submitbutton = function(task)
{
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
}

<?php  endif; ?>
</script>

	 	<form method="post" action="index.php" id="adminForm" name="adminForm">
	 	<div class="col width-70 fltlft">
		  <fieldset class="adminform">
			<legend><?php  echo JText::_( 'Details' );?></legend>
					Sample Data 						
          </fieldset>                      
        </div>
        <div class="col width-30 fltrt">    
			<fieldset class="adminform">
				<legend><?php  echo JText::_( 'Parameters' ); ?></legend>
						Your Code
			</fieldset>
        </div>                   
		<input type="hidden" name="option" value="com_instaimages" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="imagepicker" />
		<?php echo JHTML::_( 'form.token' ); ?> 
	</form>