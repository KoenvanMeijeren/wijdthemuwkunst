<?php

use Src\Core\StateInterface;
use Src\Session\Session;

$session = new Session();

$error = $session->get(StateInterface::FAILED, true);
if (!empty($error)) :
    ?>
        <div class="field error-field"><?= $error ?></div>
<?php endif; ?>

<?php
$message = $session->get(StateInterface::SUCCESSFUL, true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= $message ?></div>
<?php endif; ?>

<?php
$message = $session->get(StateInterface::FORM_VALIDATION_FAILED, true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= html_entities_decode($message) ?></div>
<?php endif; ?>
