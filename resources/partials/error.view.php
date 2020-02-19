<?php

use Src\Session\Session;
use Src\State\State;

$session = new Session();

$error = $session->get(State::FAILED, true);
if (!empty($error)) :
    ?>
        <div class="field error-field"><?= $error ?></div>
<?php endif; ?>

<?php
$message = $session->get(State::SUCCESSFUL, true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= $message ?></div>
<?php endif; ?>

<?php
$message = $session->get(State::FORM_VALIDATION_FAILED, true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= parseHtmlEntities($message) ?></div>
<?php endif; ?>
