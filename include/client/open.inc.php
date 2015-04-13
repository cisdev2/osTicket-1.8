<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$singleTopicId = $_GET['id'];
$singleTopic = Topic::lookup($singleTopicId);
if(!$singleTopic) {
    $isSingleTopic = false;
} else {
    $info['topicId'] = $singleTopicId;
    $isSingleTopic = true;
}

$form = null;
if (!$info['topicId'])
    $info['topicId'] = $cfg->getDefaultTopicId();

if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    $form = $topic->getForm();
    if ($_POST && $form) {
        $form = $form->instanciate();
        $form->isValidForClient();
    }
}

?>
<?php if($isSingleTopic) { ?>
<h1><?php echo $topic->getName();?></h1>
<?php } else { ?>
<h1><?php echo __('Submit a New Request');?></h1>
<?php } ?>
<p>Fields that have a <img src="<?php echo ROOT_PATH; ?>cisticket/required.png" alt="Required" /> are mandatory.</p>
<form id="ticketForm" method="post" action="open.php<?php if($isSingleTopic) { echo '?id='.$singleTopicId;}?>" enctype="multipart/form-data">
  <?php csrf_token(); ?>
  <input type="hidden" name="a" value="open">
  <input type="hidden" class="coursesubject" name="coursesubject" value="">
  <input type="hidden" class="coursenumber" name="coursenumber" value="">
  <table width="800" cellpadding="1" cellspacing="0" border="0">
    <tbody>
    <?php if($isSingleTopic) { ?>
    <tr style="display:none;">
    <?php } else { ?>
    <tr>
    <?php } ?>
        <td class="required"><label><?php echo __('Request Type');?>:</label></td>
        <td>
            <select id="topicId" name="topicId" onchange="javascript:
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
                <option value="" selected="selected">&mdash; <?php echo __('Select a Request Type');?> &mdash;</option>
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
            <font class="error"><img src="<?php echo ROOT_PATH; ?>cisticket/required.png" alt="Required" /><?php echo $errors['topicId']; ?></font>
        </td>
    </tr>
<?php
        if (!$thisclient) {
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
        $tform = TicketForm::getInstance();
        if ($_POST) {
            $tform->isValidForClient();
        }
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
  <label style="text-align:center;" class="checkbox">
    <input style="float:none;" type="checkbox" name="autorespond" checked="checked" value="true"/> Send a Request Confirmation Email
  </label>
  <p style="text-align:center;">
        <input class="btn btn-large" type="submit" value="<?php echo __('Create Request');?>">
  </p>
  <p style="text-align:center;">
        <input class="btn btn-info" type="reset" name="reset" value="<?php echo __('Reset');?>">
        <input class="btn btn-info" type="button" name="cancel" value="<?php echo __('Cancel'); ?>" onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.deleteDraft();
            });
            window.location.href='index.php';">
  </p>
</form>
