<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');

$internalTopicId = $_GET['id'];
$internalTopic = Topic::lookup($internalTopicId);
if (!$internalTopic) {
    $internalTopicId = NULL;
}
$internalSingleForm = isset($internalTopicId);


$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$form = null;
if (!$info['topicId'])
    $info['topicId'] = $cfg->getDefaultTopicId();

if($internalSingleForm) {
    $info['topicId'] = $internalTopicId;
}
	
if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    $form = $topic->getForm();
    if ($_POST && $form) {
        $form = $form->instanciate();
        $form->isValidForClient();
    }
}

?>
<h1><?php if(!$internalSingleForm) { echo __('Submit a New Request'); } else { echo $topic->getName(); }?></h1>
<p>Fields that have a <img src="/assets/default/images/icons/required.png" alt="Required" /> are mandatory.</p>
<!--<p class="nomargin"><?php echo __('Please fill in the form below to submit a new request.');?></p>-->
<form id="ticketForm" method="post" action="open.php<?php if($internalSingleForm) { echo '?id='.$internalTopicId;}?>" enctype="multipart/form-data">
  <?php csrf_token(); ?>
  <input type="hidden" name="a" value="open">
  <table width="800" cellpadding="1" cellspacing="0" border="0">
    <tbody>
    <tr <?php if($internalSingleForm) {echo 'style="height:1px;border:none"';} ?>>
        <td  class="required"><?php if(!$internalSingleForm) {echo __('Request Type:');}?></td>
        <td>
            <select <?php if($internalSingleForm) {echo 'style="display:none;"';} ?> id="topicId" name="topicId" onchange="javascript:
                    var data = $(':input[name]', '#dynamic-form').serialize();
                    $.ajax(
                      'ajax.php/form/help-topic/' + this.value,
                      {
                        data: data,
                        dataType: 'json',
                        success: function(json) {
                          $('#dynamic-form').empty().append(json.html);
                          $(document.head).append(json.media);
                        }
                      });">
                <option value="" <?php if(!$internalSingleForm) { ?>selected="selected"<?php } ?>>&mdash; <?php echo __('Select a Request Type');?> &mdash;</option>
                <?php
                if($topics=Topic::getPublicHelpTopics()) {
                    foreach($topics as $id =>$name) {
                        echo sprintf('<option value="%d" %s>%s</option>',
                                $id, ($info['topicId']==$id)?'selected="selected"':'', $name);
                    }
                } else { ?>
                    <option value="0" ><?php echo __('General Inquiry');?></option>
                <?php
                } ?>
            </select>
            <?php if(!$internalSingleForm) { ?><img src="/assets/default/images/icons/required.png" alt="Required" /><?php } ?> <font class="error"><?php echo $errors['topicId']; ?></font>
        </td>
    </tr>
<?php
        if (true || !$thisclient) {
            $uform = UserForm::getUserForm()->getForm($_POST);
            if ($_POST) $uform->isValid();
            $uform->render(false);
        }
        else { ?>
            <tr><td colspan="2"><hr /></td></tr>
        <tr><td><?php echo __('Email'); ?>:</td><td><?php echo $thisclient->getEmail(); ?></td></tr>
        <tr><td><?php echo __('Client'); ?>:</td><td><?php echo $thisclient->getName(); ?></td></tr>
        <?php } ?>
    </tbody>
    <tbody id="dynamic-form">
        <?php if ($form) {
            include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
        } ?>
    </tbody>
    <tbody><?php
        $tform = TicketForm::getInstance()->getForm($_POST);
        if ($_POST) $tform->isValid();
        $tform->render(false); ?>
    </tbody>
    <tbody>
    <?php
    if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
        if($_POST && $errors && !$errors['captcha'])
            $errors['captcha']=__('Please re-enter the text again');
        ?>
    <tr class="captchaRow">
        <td class="required"><?php echo __('CAPTCHA Text');?>:</td>
        <td>
            <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
            &nbsp;&nbsp;
            <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
            <em><?php echo __('Enter the text shown on the image.');?></em>
            <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
        </td>
    </tr>
    <?php
    } ?>
    <tr><td colspan=2>&nbsp;</td></tr>
    </tbody>
  </table>
  <label class="leftinput" class="checkbox">
			<input type="checkbox" name="autorespond" checked="checked" value="true"/> Send a Request Confirmation Email
	</label>
  <p style="text-align:center;">
        <input class="btn btn-large" type="submit" value="<?php echo __('Create Request');?>">
        <p style="text-align:center;">
		<input class="btn btn-info" type="reset" name="reset" value="<?php echo __('Reset');?>">
        <input class="btn btn-info" type="button" name="cancel" value="<?php echo __('Cancel'); ?>" onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.deleteDraft();
            });
            window.location.href='index.php';">
  </p></p>
</form>
